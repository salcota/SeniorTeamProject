<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="<?php echo base_url() . 'public/js/jquery-3.1.1.min.js'?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="<?php echo base_url() . 'public/js/bootstrap.min.js'?>"></script>

<script type="text/javascript">
    $(".category").click(function() {
        if ($(this).attr("id") == "default")
	    {
            $("#btnGroupDrop1").html("All");
        }
        else 
        {
            $("#btnGroupDrop1").html($(this).html());
        }
    });
 
    // test for uploading new photos on for the personal listings page
    $("#filechooser").click(function() 
    {
        for (var i = 1; i<= 3; i++) {
                $source = $('#file' + i).val().replace("C:\\fakepath\\", "");
                $("#image" + i).attr('src', $source);
            alert($("#image" + i).attr("src"));
        }
    });
function readImageFile(input, id){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
