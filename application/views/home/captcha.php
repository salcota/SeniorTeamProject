<!DOCTYPE hmtl>
<html>
<head>
    <title>Captcha implement in Codeigniter by Scota :-)</title>
    <script src=<?php echo base_url(); ?>asses/js/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
	$('.refreshCaptcha').on('click', function(){
	    $.get('<?php echo base_url().'captcha/refresh'; ?>', function(data){
		$('#captImg').html(data);
	    });
	});
    });
    </script>

    <?php $this->load->view("common/resources"); ?>

</head>
<body>
   <p>Submit the word you see:</p>
    <p id="captImg"><?php echo $captchaImg; ?></p>
    <a href ="javascript:void(0);" class="refreshCaptcha" ><i class="fa fa-refresh" aria-hidden="true"></i></a>
    <form method="post">
	<input type="text" name="captcha" value=""/?>
	<input type="submit" name="submit" value="SUBMIT"/>
    </form>
</body>
</html>
