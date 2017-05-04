<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemlisting extends CI_Controller
{

    private $userinfo;
    private $uploadpath;
    private $fileToDelete;

    public function __construct()
    {
	// Gets item listing,  basic header and styles for all pages.
        parent::__construct();
        $this->load->model('Item_Listing');
        $this->load->view('common/sfsu_demo');
        $this->load->view('common/required_meta_tags');
        // Load navbar
		$this->navbars->load();
    }

    /**
     * Returns all available listings of the user by accessing details from session
     */
    public function get_all_listings_of_user(){
		// Check if user is logged in.
		$this->loginhelper->forceLogin();
		
        $this->userinfo = $this->loginhelper->getLoginData();
		
		//print_r($userinfo);
		if ( $this->userinfo->username != NUll){
			$search['user'] = $this->userinfo->username;
			$items = $this->Item_Listing->getItems($search);
			//print_r($items);
			$data['items'] = $items;
		}
			//print_r("Username = ".$userinfo['username']);
		$this->load->view('home/item_listings',$data);

		// Gets basic footer and data that enables javascript, jQuery, and tether for all pages.
		$this->load->view('common/jquery_tether_bootstrap');
		$this->load->view('common/footerbar');

        //$data = array('items' => Null);
    }

    /**
     * Returns an item listing
     * @param null $listingID
     */
    public function get_listing_by_id($listingID = Null){
		// JQuery, Tether, Bootstrap, Lightbox2
		$this->load->view('common/jquery_tether_bootstrap');
		$this->load->view('notifications/LiveMessage');
		
        if($listingID != Null){
            $search['listingID'] = $listingID;
            $item = $this->Item_Listing->getItems($search);
            $data['item'] = $item[0];
            $item_pics = $this->Item_Listing->getAllItemListingPictures($listingID);
            $data['itemPics'] = $item_pics;
			
			// Send login info.
			if ($this->loginhelper->isRegistered())
				$data['myInfo'] = $this->loginhelper->getLoginData();
			
            $this->load->view('home/current_listing',$data);
        }

	    // Gets basic footer.
	    
        $this->load->view('common/footerbar');
    }

    public function update_listingdetails($listingId = Null){
        $this->loginhelper->forceLogin();

        if($listingId == Null){
            redirect('user_listings');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Item Name', 'trim|required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('price', 'Price of Item', 'trim|required|decimal|min_length[1]|max_length[5]',
                                array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('description', 'Description of Item', 'trim|required|max_length[300]');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'edit_form_errors' => validation_errors()
            );
            $this->session->set_flashdata($data);
            redirect('edit_listing/'.$listingId);
        }else{
            $listing = array(
                'category_id' => $this->input->post('category'),
                'title' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description')
            );
            try {
                $this->Item_Listing->updateItemListingDetails($listingId, $listing);
                $data['error'] = "Changes saved successfully";
                redirect('edit_listing/'.$listingId, $data);
            }catch (Exception $e){
                $data = array(
                    'edit_form_errors' => $e->getMessage()
                );
                $this->session->set_flashdata($data);
                redirect('edit_listing/'.$listingId);
            }
        }
    }

    /**
     * Saves an itemlisting with images
     */
    public function post_listing(){
        $this->userinfo = $this->loginhelper->getLoginData();
        $this->uploadpath = './public/temp/';
        $this->load->model('Category');
        $data['categories'] = $this->Category->getCategories();

        try{

            if($this->input->post('submit') && !empty($_FILES['dp']['name'])){

                $config['upload_path']          = $this->uploadpath;
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 5120;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->upload->initialize($config);

                if ( !$this->upload->do_upload('dp'))
                {
                    $data = array('item_form_errors' => $this->upload->display_errors());
                    $this->session->set_flashdata($data);
                    redirect('add_item',$data);
                }
                else
                {
                    $imgdata = $this->upload->data();
                    $this->fileToDelete = $imgdata['full_path'];
                    $this->genthumbnail($imgdata['full_path']);

                    $listing = $this->genListingDetails();

                    $listing_id = $this->Item_Listing->addItemListing($listing, $imgdata);

                    unlink($this->fileToDelete);
                    unlink(str_replace(".","_thumb.", $this->fileToDelete));

                    if($listing_id == Null){
                        redirect('add_item');
                    }else{
                       $filecount = count($_FILES['pic']['name']);
                       for($i=0 ; $i < $filecount; $i++){
                           $_FILES['userFile']['name'] = $_FILES['pic']['name'][$i];
                           $_FILES['userFile']['type'] = $_FILES['pic']['type'][$i];
                           $_FILES['userFile']['tmp_name'] = $_FILES['pic']['tmp_name'][$i];
                           $_FILES['userFile']['error'] = $_FILES['pic']['error'][$i];
                           $_FILES['userFile']['size'] = $_FILES['pic']['size'][$i];

                           $this->load->library('upload', $config);
                           $this->upload->initialize($config);
                           if($this->upload->do_upload('userFile')){
                               $picdata = $this->upload->data();
                               $this->genthumbnail($picdata['full_path']);
                               $this->Item_Listing->addItemPicture($listing_id, $picdata);
                               unlink($picdata['full_path']);
                               unlink(str_replace(".","_thumb.", $picdata['full_path']));
                           }else{

                           }
                       }
                       redirect('user_listings');
                    }
                    //$this->load->view('upload_success', $data);
                }

            }else{
                $data = array('item_form_errors' => "Please fill the details of this Item Listing");
                $this->session->set_flashdata($data);
                redirect('add_item',$data);
            }

        }catch(Exception $e){
            $data = array('item_form_errors' => "Please fill the details of this Item Listing");
            $this->session->set_flashdata($data);
            redirect('add_item',$data);
        }finally{
            if(file_exists($this->uploadpath)){
                $filename = $this->fileToDelete;
                unlink($filename);
                $filename = str_replace(".", "_thumb.", $filename);
                unlink($filename);
            }
        }
    }

    private function genListingDetails(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Item Name', 'trim|required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('price', 'Price of Item', 'trim|required|decimal|min_length[1]|max_length[5]',
            array('required' => 'You must provide a %s.')
        );
        $this->form_validation->set_rules('description', 'Description of Item', 'trim|required|max_length[300]');

        if ($this->form_validation->run() == FALSE)
        {
            if(file_exists($this->uploadpath)){
                unlink($this->fileToDelete);
                unlink(str_replace(".","_thumb.", $this->fileToDelete));
            }

            $data = array(
                'item_form_errors' => validation_errors()
            );
            $this->session->set_flashdata($data);

            redirect('add_item');
        }
        else
        {
            $this->load->model('Reg_User');
            $userid = $this->Reg_User->getUserIdByUsername($this->userinfo->username);
            $listing = array(
                'seller_id' => $userid[0]->user_id,
                'category_id' => $this->input->post('category'),
                'title' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description')
            );

            return $listing;
        }
    }

    /**
     * Generates thumbnail of an image
     * @param $imgpath
     * @return mixed
     */
    private function genthumbnail($imgpath){
        $config['image_library'] = 'gd2';
        $config['source_image'] = $imgpath;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']   = 75*3;
        $config['height']  = 50*2;

        $this->load->library('image_lib', $config);

        return $this->image_lib->resize();
    }

    public function update_listing($listingID = NULL){

    }
}
?>
