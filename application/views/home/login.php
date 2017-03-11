<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
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
      

      
        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>



        <script type="text/javascript">
            // changes the current category in the search bar to the chosen dropdown value
            $(".category").click(function() {
                if ($(this).attr("id") == "default") {
                    $("#btnGroupDrop1").html("All");
                }
                else {
                    $("#btnGroupDrop1").html($(this).html());
                }
            })


            $("#filechooser").click(function() {
                for (var i = 1; i<= 3; i++) {
                    $source = $('#file' + i).val().replace("C:\\fakepath\\", "");
                    $("#image" + i).attr('src', $source);
                    alert($("#image" + i).attr("src"));
                }
            })
        </script>
      
  </body>

</html>
