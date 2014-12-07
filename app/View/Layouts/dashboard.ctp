<!DOCTYPE html>
<html lang="en">
    <head>
	<?php echo $this->Html->charset(); ?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php echo $this->fetch('meta'); ?>
	<title>
	    <?php echo $this->fetch('title'); ?>
	</title>
	<?php //echo $this->Html->meta('icon'); ?>

	<!-- Bootstrap -->
	<?php 
	    echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css');
	    echo $this->Html->css('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
	    echo $this->Html->css('style');
	    echo $this->fetch('css'); 
	?>


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
    </head>
    <body>
	<div class="container-fluid">
	    <div class="row">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	    </div>
	</div>
	<?php
	echo $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js');
	echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js');
	echo $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js');
	echo $this->fetch('script');
	?>
    </body>
</html>
