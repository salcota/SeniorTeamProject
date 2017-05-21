<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemlisting extends CI_Controller
{

    private $userinfo;
    private $uploadpath;
    private $fileToDelete;
    private $listingCountLimit;

    public function __construct()
    {
        // Gets item listing,  basic header and styles for all pages.
        parent::__construct();
        $this->listingCountLimit = 5;
        $this->load->model('Item_Listing');

        $this->load->view('common/sfsu_demo');
        $this->load->view('common/resources');
        // Load navbar
        $this->navbars->load();

    }

    /**
     * Returns all available listings of the user by accessing details from session
     */
    public function get_all_listings_of_user()
    {
        // Check if user is logged in.
        $this->loginhelper->forceLogin();

        $this->userinfo = $this->loginhelper->getLoginData();

        //print_r($userinfo);
        if ($this->userinfo->username != NUll) {
            $search['user'] = $this->userinfo->username;
            $items = $this->Item_Listing->getItems($search);
            //print_r($items);
            $data['items'] = $items;
        }
        //print_r("Username = ".$userinfo['username']);
        $this->load->view('home/item_listings', $data);

        // Gets basic footer
        $this->load->view('common/footerbar');

        //$data = array('items' => Null);
    }

    /**
     * Returns an item listing
     * @param null $listingID
     */
    public function get_listing_by_id($listingID = Null)
    {
        $this->load->view('notifications/LiveMessage');

        if ($listingID != Null) {
            $search['listingID'] = $listingID;
            $item = $this->Item_Listing->getItems($search);
            $data['item'] = $item[0];
            $item_pics = $this->Item_Listing->getAllItemListingPictures($listingID);
            $data['itemPics'] = $item_pics;

            // Send login info.
            if ($this->loginhelper->isRegistered())
                $data['myInfo'] = $this->loginhelper->getLoginData();

            $this->load->view('home/current_listing', $data);
        }

        // Gets basic footer.

        $this->load->view('common/footerbar');
    }

    /**
     * Updates only the details of the listing and not images
     * @param null $listingId
     */
    public function update_listingdetails($listingId = Null)
    {
        $this->loginhelper->forceLogin();
        if (!$this->authorizedUser($listingId)) {
            $data['edit_form_errors'] = "You are not authorized to change this listing's details";
            $this->session->set_flashdata($data);
            redirect('edit_listing/' . $listingId);
        }

        if ($listingId == Null) {
            redirect('user_listings');
        }

        $this->load->library('form_validation');
	
	if(strpos($_POST['price'],'.') == false){
		$_POST['price'] = $_POST['price'].".0"; 	
	}

        $this->form_validation->set_rules('name', 'Item Name', 'trim|required|min_length[3]|max_length[30]|regex_match[/^[A-Za-z0-9 \.\-\',\?\!\:&@\(\)"]*$/]');
        $this->form_validation->set_rules('price', 'Price of Item', 'trim|required|decimal|min_length[1]|max_length[5]',
            array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('description', 'Description of Item', 'trim|required|max_length[300]|regex_match[/^[A-Za-z0-9 \.\-\',\?\!\:&@\(\)\\n"]*$/]');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'edit_form_errors' => validation_errors()
            );
            $this->session->set_flashdata($data);
            redirect('edit_listing/' . $listingId);
        } else {
            $listing = array(
                'category_id' => $this->input->post('category'),
                'title' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description')
            );
            $listing = $this->security->xss_clean($listing);
            try {
                $this->Item_Listing->updateItemListingDetails($listingId, $listing);
                $data['edit_response'] = "Changes saved successfully";
                $this->session->set_flashdata($data);
                redirect('edit_listing/' . $listingId);
            } catch (Exception $e) {
                $data = array(
                    'edit_form_errors' => $e->getMessage()
                );
                $this->session->set_flashdata($data);
                redirect('edit_listing/' . $listingId);
            }
        }
    }

    /**
     * Saves an itemlisting with images
     */
    public function post_listing()
    {
        $this->userinfo = $this->loginhelper->getLoginData();
        $this->uploadpath = './public/temp/';
        $this->load->model('Category');
        $data['categories'] = $this->Category->getCategories();

        try {

            if ($this->input->post('submit') && !empty($_FILES['dp']['name'])) {

                $config['upload_path'] = $this->uploadpath;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 5120;
                $config['max_width'] = 2565;
                $config['max_height'] = 1445;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('dp')) {
                    $data = array('item_form_errors' => $this->upload->display_errors());
                    $this->session->set_flashdata($data);
                    redirect('add_item', $data);
                } else {
                    $imgdata = $this->upload->data();
                    $this->fileToDelete = $imgdata['full_path'];
                    $this->genthumbnail($imgdata['full_path']);

                    $listing = $this->genListingDetails();

                    $listing_id = $this->Item_Listing->addItemListing($listing, $imgdata);

                    unlink($this->fileToDelete);
                    unlink(str_replace(".", "_thumb.", $this->fileToDelete));

                    if ($listing_id == Null) {
                        redirect('add_item');
                    } else {

                        $filecount = count($_FILES['pic']['name']);

                        for ($i = 0; $i < $filecount; $i++) {

                            if ($this->Item_Listing->getListingPicCount($listing_id) >= $this->listingCountLimit) {
                                $data = array('item_form_errors' => "Cannot upload more than " . $this->listingCountLimit . " pictures for a listing.");
                                $this->session->set_flashdata($data);
                                redirect('add_item', $data);
                            }

                            $_FILES['userFile']['name'] = $_FILES['pic']['name'][$i];
                            $_FILES['userFile']['type'] = $_FILES['pic']['type'][$i];
                            $_FILES['userFile']['tmp_name'] = $_FILES['pic']['tmp_name'][$i];
                            $_FILES['userFile']['error'] = $_FILES['pic']['error'][$i];
                            $_FILES['userFile']['size'] = $_FILES['pic']['size'][$i];

                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if ($this->upload->do_upload('userFile')) {
                                $picdata = $this->upload->data();
                                $this->genthumbnail($picdata['full_path']);
                                $this->Item_Listing->addItemPicture($listing_id, $picdata);
                                unlink($picdata['full_path']);
                                unlink(str_replace(".", "_thumb.", $picdata['full_path']));
                            } else {

                            }
                        }
                        //print "Error occured";
                        redirect('user_listings');
                        //print "Error 1213";
                    }
                    //$this->load->view('upload_success', $data);
                }

            } else {
                $data = array('item_form_errors' => "Please fill the details of this Item Listing");
                $this->session->set_flashdata($data);
                redirect('add_item', $data);
            }

        } catch (Exception $e) {
            $data = array('item_form_errors' => "Please fill the details of this Item Listing");
            $this->session->set_flashdata($data);
            redirect('add_item', $data);
        } finally {
            if (file_exists($this->fileToDelete)) {
                $filename = $this->fileToDelete;
                unlink($filename);
                $filename = str_replace(".", "_thumb.", $filename);
                unlink($filename);
            }
        }
    }

    private function genListingDetails()
    {
        $this->load->library('form_validation');
	
	if(strpos($_POST['price'],'.') == false){
		$_POST['price'] = $_POST['price'].".0"; 
	}

        $this->form_validation->set_rules('name', 'Item Name', 'trim|required|min_length[3]|max_length[30]|regex_match[/^[A-Za-z0-9 \.\',\?\!\:&@\(\)"]*$/]');
        $this->form_validation->set_rules('price', 'Price of Item', 'trim|required|numeric|min_length[1]|max_length[5]',
            array('required' => 'You must provide a %s.')
        );
        $this->form_validation->set_rules('description', 'Description of Item', 'trim|required|max_length[300]|regex_match[/^[A-Za-z0-9 \.\',\?\!\:&@\(\)\\n"]*$/]');

        if ($this->form_validation->run() == FALSE) {
            if (file_exists($this->uploadpath)) {
                unlink($this->fileToDelete);
                unlink(str_replace(".", "_thumb.", $this->fileToDelete));
            }

            $data = array(
                'item_form_errors' => validation_errors()
            );
            $this->session->set_flashdata($data);

            redirect('add_item');
        } else {
            $this->load->model('Reg_User');
            $userid = $this->Reg_User->getUserIdByUsername($this->userinfo->username);
            $listing = array(
                'seller_id' => $userid[0]->user_id,
                'category_id' => $this->input->post('category'),
                'title' => $this->input->post('name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description')
            );

            return $this->security->xss_clean($listing);
        }
    }

    /**
     * Generates thumbnail of an image
     * @param $imgpath
     * @return mixed
     */
    private function genthumbnail($imgpath)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $imgpath;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 75 * 4;
        $config['height'] = 50 * 3;

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        if(!$this->image_lib->resize())
            echo $this->image_lib->display_errors();
        else{
            $this->image_lib->clear();
        }
        return true;

    }

    public function update_listing_dp($listingId = NULL)
    {
        $this->loginhelper->forceLogin();
        if (!$this->authorizedUser($listingId)) {
            $data['edit_form_errors'] = "You are not authorized to update this display picture";
            $this->session->set_flashdata($data);
            redirect('edit_listing/' . $listingId);
        }
        $this->uploadpath = './public/temp/';
        if ($listingId == Null) {
            redirect('user_listings');
        }

        try {
            if (!empty($_FILES['dp']['name'])) {
                $config['upload_path'] = $this->uploadpath;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 5120;
                $config['max_width'] = 2565;
                $config['max_height'] = 1445;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('dp')) {
                    $data = array('edit_form_errors' => $this->upload->display_errors());
                    $this->session->set_flashdata($data);
                    redirect('edit_listing/' . $listingId);
                } else {
                    $imgdata = $this->upload->data();
                    $this->fileToDelete = $imgdata['full_path'];
                    $this->genthumbnail($imgdata['full_path']);
                    $this->Item_Listing->updateItemDisplayPicture($listingId, $imgdata);
                    $data['edit_response'] = "Display Picture updated successfully";
                    $this->session->set_flashdata($data);
                    redirect('edit_listing/' . $listingId);
                }
            } else {
                $data = array('edit_form_errors' => "Please provide an image file");
                $this->session->set_flashdata($data);
                redirect('edit_listing/' . $listingId);
            }
        } catch (Exception $e) {
            $data = array('edit_form_errors' => $e->getMessage());
            $this->session->set_flashdata($data);
            redirect('edit_listing/' . $listingId);
        } finally {
            if (file_exists($this->uploadpath)) {
                $filename = $this->fileToDelete;
                unlink($filename);
                $filename = str_replace(".", "_thumb.", $filename);
                unlink($filename);
            }
        }
    }

    public function update_listing_pic($picId, $listingId)
    {
        $this->loginhelper->forceLogin();
        if (!$this->authorizedUser($listingId)) {
            $data['edit_form_errors'] = "You are not authorized to update this picture";
            $this->session->set_flashdata($data);
            redirect('edit_listing/' . $listingId);
        }

        if ($picId == -1 && ($this->Item_Listing->getListingPicCount($listingId) >= $this->listingCountLimit)) {
            $data = array('edit_form_errors' => "Cannot upload more than " . $this->listingCountLimit . " pictures for a listing.");
            $this->session->set_flashdata($data);
            redirect('edit_listing/' . $listingId);
        }
        $this->uploadpath = './public/temp/';
        if ($listingId == Null) {
            redirect('user_listings');
        }
        try {
            if (!empty($_FILES['pic']['name'])) {
                $config['upload_path'] = $this->uploadpath;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 5120;
                $config['max_width'] = 2565;
                $config['max_height'] = 1445;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('pic')) {
                    $data = array('edit_form_errors' => $this->upload->display_errors());
                    $this->session->set_flashdata($data);
                    redirect('edit_listing/' . $listingId);
                } else {
                    $imgdata = $this->upload->data();
                    $this->fileToDelete = $imgdata['full_path'];
                    $this->genthumbnail($imgdata['full_path']);
                    if ($picId == -1) {
                        $this->Item_Listing->addItemPicture($listingId, $imgdata);
                        $data['edit_response'] = "New Picture uploaded successfully";
                        $this->session->set_flashdata($data);
                        redirect('edit_listing/' . $listingId);
                    } else {
                        $this->Item_Listing->updateItemPic($picId, $imgdata);
                        $data['edit_response'] = "Item Listing picture updated successfully";
                        $this->session->set_flashdata($data);
                        redirect('edit_listing/' . $listingId);
                    }

                }
            } else {
                $data = array('edit_form_errors' => "Please provide an image file");
                $this->session->set_flashdata($data);
                redirect('edit_listing/' . $listingId);
            }
        } catch (Exception $e) {
            $data = array('edit_form_errors' => $e->getMessage());
            $this->session->set_flashdata($data);
            redirect('edit_listing/' . $listingId);
        } finally {
            if (file_exists($this->uploadpath)) {
                $filename = $this->fileToDelete;
                unlink($filename);
                $filename = str_replace(".", "_thumb.", $filename);
                unlink($filename);
            }
        }
    }

    public function remove_listing_pic($picId, $listingId)
    {
        try {
            if (!$this->authorizedUser($listingId)) {
                $data['edit_form_errors'] = "You are not authorized to delete this picture";
                $this->session->set_flashdata($data);
                redirect('edit_listing/' . $listingId);
            }
            if ($picId != Null) {
                $this->Item_Listing->deleteItemPic($picId);
                $data['edit_response'] = "Picture removed successfully";
                $this->session->set_flashdata($data);
                redirect('edit_listing/' . $listingId, $data);
            } else {
                $data['edit_form_errors'] = "No Picture to delete";
                $this->session->set_flashdata($data);
                redirect('edit_listing/' . $listingId);
            }
        } catch (Exception $e) {
            $data = array('edit_form_errors' => $e->getMessage());
            $this->session->set_flashdata($data);
            redirect('edit_listing/' . $listingId);
        }
    }

    private function authorizedUser($listingId)
    {

        if ($this->loginhelper->isRegistered()) {
            $ownerId = $this->Item_Listing->getUserIdForListing($listingId);
            $user = $this->loginhelper->getLoginData();

            if ($ownerId == $user->user_id)
                return true;
            else
                return false;
        } else {
            return false;
        }
    }
}

?>
