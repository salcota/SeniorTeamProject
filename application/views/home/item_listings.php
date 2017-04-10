<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 
          <div class="container">
              
              <div class = "row justify-content-center pagetitle">
                  <div class="col-6 subtitle" id="subheader">YOUR LISTINGS</div>

		  <div class = "col-sm-6" style="text-align: right; padding-top: 10px; padding-left: -5px">

                      <?php
                           $registered = true;

                           if ($registered)
                            {
                                $this->load->view('reguser/reguser_navbar');
                            }
                      ?>

                  </div>

              </div>
              <br /><br /><br />
              
              <div class="row justify-content-center">
                  <div class="col-sm-10" style="text-align: right">
		      <a class="btn btn-success" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">ADD ITEM</a>
		  </div>		
              </div>

	      <br />
	
	      <div class="row justify-content-center">
		  <div class="col-sm-10">
		      <table class="table table-bordered table-hover table-info table-striped" style="border: solid 2px #ACF; font-size: 10pt">
			  <tr>
			      <th>#</th>
                	      <th>Item Name</th>
                	      <th>Category</th>
                	      <th>Price</th>
                	      <th>Date</th>
                	      <th>Update Listing</th>
            	          </tr>

                          <tr>
			      <td>1</td>
                              <td>Table Lamp</td>
                              <td>Furniture</td>
                              <td>$10.00</td>
                              <td>Aug 8, 2016</td>
                              <td>
			           <a class="btn btn-secondary btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Edit</a>
                              	       &emsp;
			           <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Remove</a>
                              </td>
                         </tr>
                          <tr>
                              <td>2</td>
                              <td>Mac Book</td>
                              <td>Electronics</td>
                              <td>$1000.00</td>
                              <td>Sep 20, 2016</td>
                              <td> 
                                   <a class="btn btn-secondary btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Edit</a> 
                                       &emsp; 
                                   <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Remove</a> 
                              </td>                              
			  </tr>
                          <tr>
                              <td>3</td>
                              <td>Lamp</td>
                              <td>Furniture</td>
                              <td>$8.00</td>
                              <td>Aug 15, 2016</td>
                              <td> 
                                   <a class="btn btn-secondary btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Edit</a> 
                                       &emsp; 
                                   <a class="btn btn-danger btn-sm" style="font-size: 9pt; margin-bottom: 5px; width: 60px" href="<?php echo base_url() . 'Home/view/edit_listing'?>" target="blank">Remove</a> 
                              </td> 
                        </tr>
		      </table>
		  </div>
	      </div>

	      <br />

	   </div>
