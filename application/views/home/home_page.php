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
      
      <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "public/guis/Font-Awesome/css/font-awesome.min.css"?>">
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
