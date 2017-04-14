<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemlisting extends CI_Controller{

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

        $userinfo = $this->loginhelper->getLoginData();
        $data = array('items' => Null);
        if ( array_key_exists('username', $userinfo) and $userinfo['username'] != NUll){
            $search['user'] = $userinfo['username'];
            $items = $this->Item_Listing->getItems($search);
            $data['items'] = $items;
        }
        print_r("Username = ".$userinfo['username']);
        $this->load->view('home/item_listings',$data);

        // Gets basic footer and data that enables javascript, jQuery, and tether for all pages.
        $this->load->view('common/jquery_tether_bootstrap');
        $this->load->view('common/footerbar');
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

    public function post_listing(){}

    public function update_listing(){}
}
