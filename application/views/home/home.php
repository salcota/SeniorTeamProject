<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
?>

<div class="jumbotron" style="; margin-top: 55px; text-align: center; background: url('https://unsplash.com/search/san-francisco?photo=HWK1zd0OxUU') center">

    <h1 class="display-4">SFSU Congre-Gators</h1>

    <p class="lead">
        Welcome to SFSU Congre-Gators, where SFSU students can buy and sell a variety of different items relevant to their needs. Shop anything from books, furniture, laptops, and much more from other students just like you,  who know what its like to need that extra support to make it through college!
    </p>

    <hr class="my-4" >

    <p>Want to know more? Search our options!</p>

</div>

<div class="container" style="margin-top: -100px; padding:5px; background-color: #FFF">

  <br />
  <p style="text-align: center; font-size:12px">Most Recent Item Listings</p>

    <div class="row">
        <?php foreach ($itemList as $item): ?>
            <div class="col-sm-4">
                <div class="card text-center" style="margin: auto; margin-top: 20px">
                    <a href=#"><?php echo '<img style="padding:5px; max-width: 100%; max-height: 300px;" class="card-img-top" src="data:image/jpg;base64,' . base64_encode($item->dp_thumbnail) . '" alt="Card image cap">' ?></a>
                    <div class="card-block">
                        <h4 class="card-title"><?php echo $item->title; ?></h4>
                        <p class="card-text"><?php echo "$".$item->price; ?></p>
                    </div>
                    <div class="card-block">
                        <a href="#" class="card-link">Add to cart</a>
                        <a href="#" class="card-link">Buy</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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
