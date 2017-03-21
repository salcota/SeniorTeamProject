<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!--Responsive Login Form --> 
          <div class="container">
              
              <div class = "row justify-content-center pagetitle">
                  <div class="col-12 subtitle" id="subheader">LOGIN</div>
              </div>
              
              <br /><br /><br />
              
              <form>
                  <div class="row justify-content-center">
                      <div class="col-6 input-group">
                          <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                          <input type="email" class="form-control" placeholder="Username" aria-describedby="basic-addon1" style="max-width: 300px">
                      </div>
                  </div>
                  <br />
                  <div class="row justify-content-center">
                      <div class="col-6 input-group">
                          <span class="input-group-addon" id="basic-addon2" style="width: 41px;"><i class="fa fa-lock" aria-hidden="true"></i></span>
                          <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1"  style="max-width: 300px">
                      </div>
                  </div>
                  <div class="row justify-content-center">
                      <small class="form-text text-muted">Forgot password?</small>
                  </div>
                  <div class="row justify-content-center">
                      <div class="col-6">
                          <button type="submit" class="btn btn-success" style="width: 90px">Submit</button>
                      </div>
                  </div>
              </form>
              
              <br /><br />
              
              <div class="row justify-content-center">
                  <div class="col-6">
                      <h5>Not a member? Sign up!</h5>
                  </div>
              </div>
              
              <div class="row justify-content-center">
                <div class="col-6">
                    <button type="submit" class="btn btn-success">Sign Up</button>
                </div>
              </div>
              
              <br />
              
          </div>

	  <?php $this->load->view('common/jquery_tether_bootstrap'); ?>
         
  </body>

</html>
