<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="<?php echo base_url() . 'public/js/jquery-3.1.1.min.js'?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="<?php echo base_url() . 'public/js/bootstrap.min.js'?>"></script>

<!-- Light Box -->

	<script type="text/javascript" src="<?php echo base_url() . 'public/js/lightbox.js'?>"></script>


	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() . 'public/css/lightbox.css'?>">


<script>

    // Google Analytics
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-97440164-1', 'auto');
    ga('send', 'pageview');

    // Warns users about having to be logged in to post or edit a listing.
    $(document).ready(function()
    {
        $('[data-toggle="popover"]').popover();   
    });

</script>

