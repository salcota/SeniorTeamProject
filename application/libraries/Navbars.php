<?php
class Navbars
{
	private $navSearch;
	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		
		$this->CI->load->library('Loginhelper');
		
		// Gets user's search terms.
		$this->navSearch['searchTerms'] = $this->CI->input->get('search');
		$this->navSearch['currentCategory'] = $this->CI->input->get('category');
			
		// Retrieves all item categories.
		$this->CI->load->model('Category');
		$this->navSearch['categories'] = $this->CI->Category->getCategories();
	}
	
	// Loads the default Search-based navbar.
	public function load()
	{
		if ($this->CI->loginhelper->isRegistered())
			$this->loadRegistered();
		else
		{
			$this->navSearch['searchTerms'] = htmlentities($this->navSearch['searchTerms']);
			$this->CI->load->view('common/navbar', $this->navSearch);
		}
	}
	
	// Loads the navbar without searchbar.
	public function loadNoSearch()
	{
		if ($this->CI->loginhelper->isRegistered())
			$this->loadRegisteredNoSearch();
		else
			$this->CI->load->view('common/navbar_nosearch', $this->navSearch);
	}
	
	
	
	private function loadRegistered()
	{
		$this->CI->load->view('common/registered_navbar', $this->navSearch);
	}
	
	private function loadRegisteredNoSearch()
	{
		$this->CI->load->view('common/registered_navbar_nosearch', $this->navSearch);
	}
}
?>