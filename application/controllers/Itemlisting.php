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
 
        // Gets user's search terms.
        $navSearch['searchTerms'] = htmlentities($this->input->get('search'));
        $navSearch['currentCategory'] = $this->input->get('category');

        // Retrieves all item categories.
        $this->load->model('Category');
        $navSearch['categories'] = $this->Category->getCategories();

        $this->load->view('common/navbar',$navSearch);
    }

    public function get_all_listings_of_user(){}

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
            $this->load->view('home/current_item',$data);
        }

	// Gets basic footer and data that enables javascript, jQuery, and thether for all pages.
	$this->load->view('common/jquery_tether_bootstrap');
        $this->load->view('common/footerbar');
    }

    public function post_listing(){}

    public function update_listing(){}
}
