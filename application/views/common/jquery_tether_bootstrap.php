<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-97440164-1', 'auto');
  ga('send', 'pageview');

</script>
<script src="<?php echo base_url() . '/public/js/jquery-3.1.1.min.js'?>">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="<?php echo base_url() . '/public/js/bootstrap.min.js'?>">

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
    })
 
    // test for uploading new photos on for the personal listings page
    $("#filechooser").click(function() 
    {
        for (var i = 1; i<= 3; i++) {
                $source = $('#file' + i).val().replace("C:\\fakepath\\", "");
                $("#image" + i).attr('src', $source);
            alert($("#image" + i).attr("src"));
        }
    })

</script>
