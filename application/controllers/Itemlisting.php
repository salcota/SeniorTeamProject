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
        $this->userinfo = $this->loginhelper->getLoginData();
        if($this->loginhelper->isRegistered()){

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
        }else{
            $this->loginhelper->forceLogin();
        }

        //$data = array('items' => Null);
    }

    /**
     * Returns an item listing
     * @param null $listingID
     */
    public function get_listing_by_id($listingID = Null){

        if($listingID != Null){
            $search['listingID'] = $listingID;
            $item = $this->Item_Listing->getItems($search);
            $data['item'] = $item;
            $item_pics = $this->Item_Listing->getAllItemListingPictures($listingID);
            $data['itemPics'] = $item_pics;
            $this->load->view('home/current_listing',$data);
        }

	    // Gets basic footer and data that enables javascript, jQuery, and thether for all pages.
	    $this->load->view('common/jquery_tether_bootstrap');
        $this->load->view('common/footerbar');
    }


    // form validations for edit item via Itemlisting page, not working yet
    /**
    public function edit($page = "edit_listing")
    {
	$this->form_validation->set_rules('name', 'Item_Name', 'trim|required|alpha_numeric');
	
	if($this->form_validation->run() == FALSE)
	{
		$edit_atrributes = array(
			'errors' => validation_errors()
		);

		$this->session->set_flashdata($edit_attributes);
		//redirect('home/view/home');
	} else {
	
	}		
    }
    */

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
                        print_r("Listing id = null");
                        redirect('add_item');
                    }else{
                        print_r($_FILES);
                        //if(!empty($_FILES['pic']['name'][0])){
                            /$files = $this->diverse_array($_FILES['pic']);
                           // print_r($files);
                        //    print_r($files);
                            foreach ($files as $pic){
                                echo "pic";
                                if($this->upload->do_upload($pic['name'])){
                                    echo "pic1";
                                    $picdata = $this->upload->data();
                                    echo "pic2";
                                    $this->genthumbnail($picdata['full_path']);
                                    echo "pic3";
                                    $this->Item_Listing->addItemPicture($listing_id, $picdata);
                                    echo "pic4";
                                    unlink($picdata['full_path']);
                                }else{
                                    echo $this->upload->display_errors();
                                    //exit;
                                }
                            }// end of for each
                        //}//end of if
                        echo "No item pics found";
                        exit;
                    }
                    //$this->load->view('upload_success', $data);
                }

            }else{
                //Todo
                $data = array('item_form_errors' => "Please fill the details of this Item Listing");
                $this->session->set_flashdata($data);
                redirect('add_item',$data);
            }

        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
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
        $this->form_validation->set_rules('price', 'Price of Item', 'trim|required|decimal|min_length[1]|max_length[3]',
            array('required' => 'You must provide a %s.')
        );
        $this->form_validation->set_rules('description', 'Description of Item', 'trim|required|max_length[200]');

        if ($this->form_validation->run() == FALSE)
        {
            if(file_exists($this->uploadpath)){
                unlink($this->fileToDelete);
                unlink(str_replace(".","_thumb.", $this->fileToDelete));
            }
            //print_r(validation_errors());
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
     * Copied from commnet section of php.net $_FILE manual
     * @param $vector
     * @return array
     */
    function diverse_array($vector) {
        $result = array();
        foreach($vector as $key1 => $value1)
            foreach($value1 as $key2 => $value2)
                $result[$key2][$key1] = $value2;
        return $result;
    }

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
