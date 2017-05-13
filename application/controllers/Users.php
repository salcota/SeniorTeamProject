<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        // Gets item listing,  basic header and styles for all pages.
        parent::__construct();
        $this->load->model('Item_Listing');
        $this->load->view('common/sfsu_demo');
        $this->load->view('common/resources');

        // Load navbar
        $this->navbars->load();
    }
   
    // Attempting form validations for report misconduct, scota
    public function report()
    {
	$this->form_validation->set_rules('reportText', 'report', 'trim|required|alpha_numeric_spaces');
	$this->form_validation->set_rules('reportTerms', 'terms of agreement', 'required|callback_reportTerms');


	if($this->form_validation->run() == FALSE)
	{
		if(!$this->input->post('reportTerms'))
		{
			//echo "please check following claim is true.";
			// do redirection??
		}
		else
		{
			// do something??
		}
		$data = array(
			'bad_report' => validation_errors()
		);
		echo $data['bad_report']; 
		//$this->session->set_flashdata($data);
		//redirect('home/view/home');
	} else {
		//do something
		//redirect('home/view/home');
		
        }
     }
     public function reportTerms()
     {
	if (isset($_POST['reportTerms'])) return true;
	$this->form_validation->set_message('reportTerms', 'Please check following claim is true.');
	return false;
     }

	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		
		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'errors' => validation_errors()
			);

			$this->session->set_flashdata($data);
			redirect('home/view/login');
		}

		else
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$this->load->model('Reg_User');
			//$user_id = $this->R_User->login_user($email,$password);	
			$userID = $this->Reg_User->getUser($email,$password);
			if(is_numeric($userID) && $userID >= 0)
			{
				$user_data = array(
					//'user_id' => $user_id,
					'email' => $userID,
					// need to add password
					'logged_in' => true
				);

				$this->session->set_userdata($user_data);

				// Sets user as logged in.
				$this->loginhelper->login($userID);
				
				// Redirects to previous page.
				$previousPage = $this->loginhelper->beforeLogin();
				// Does previous page exist?
				if ($previousPage != NULL)
					redirect($previousPage);
				else					
					redirect('home/view/home');
			}
			else
			{
				$this->session->set_flashdata('login_failed', 'The information you provided is unrecognized.');		
				redirect('home/view/login');
			}
		}
	}

	public function update_profile()
	{

	}

	public function buy_request()
	{

	}

     /* This function returns the add_item page to the user so that User can add new item listing to the portfolio.
     */
	public function sell_item(){
        $this->load->model('Category');
        $data['categories'] = $this->Category->getCategories();

        $this->load->view('reguser/add_itemlisting.php',$data);
        $this->load->view('common/footerbar');
	}


    /**
	 * This function deletes allows user to delete an item listing posted by him/her.
     * @param $listingId
	 * redirects to the item_listings page again.
     */
	public function delete_listing($listingId){
		try{
            if(!$this->authorizedUser($listingId)){
                $data['delete_listing_error'] = "You are not authorized to delete this listing";
                $this->session->set_flashdata($data);
                redirect('user_listings');
            }

            $this->userinfo = $this->loginhelper->getLoginData();
            if($this->loginhelper->isRegistered()) {

				$this->load->model('Notification_Model');
				$this->Notification_Model->orphanNotifications($listingId);
                $this->Item_Listing->deleteItemListing($listingId);
                redirect("user_listings");
            }else{
                $this->loginhelper->forceLogin();
            }
		}catch (Exception $e){
            $data = array('delete_listing_error' => $e->getMessage());
            $this->session->set_flashdata($data);
            redirect('user_listings',$data);
		}
	}

    /**
	 * This function loads a listing's details and redirects to the edit listing page
     * @param $listingId
     */
	public function edit_listing($listingId){
		//Check if the user is logged in
        $this->loginhelper->forceLogin();
        if(!$this->authorizedUser($listingId)){
            $data['delete_listing_error'] = "You are not authorized to edit this listing";
            $this->session->set_flashdata($data);
            redirect('user_listings');
        }
        //Load categories
        $this->load->model('Category');
        $data['categories'] = $this->Category->getCategories();

        if($listingId != Null){
        	//Build search
            $search['listingID'] = $listingId;
            //Get item from DB
            $item = $this->Item_Listing->getItems($search);
            if($item != Null) {
                $data['item'] = $item[0];
                //Get all pics of the item listing
                $item_pics = $this->Item_Listing->getAllItemListingPictures($listingId);
                $data['itemPics'] = $item_pics;

                // Send login info.
                if ($this->loginhelper->isRegistered())
                    $data['myInfo'] = $this->loginhelper->getLoginData();

                //Load view with data
                $this->load->view('home/edit_listing', $data);
            }else{
            	//If lisitngID does not exists
                redirect('user_listings');
			}
        }else{
        	//If listing id not provided
            redirect('user_listings');
		}
        
        // Gets basic footer.
        $this->load->view('common/footerbar');
	}

    private function authorizedUser($listingId){

        if($this->loginhelper->isRegistered()){
            $ownerId = $this->Item_Listing->getUserIdForListing($listingId);
            $user = $this->loginhelper->getLoginData();

            if($ownerId == $user->user_id)
                return true;
            else
                return false;
        }else{
            return false;
        }
    }
}
?>
