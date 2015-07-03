<!DOCTYPE html>
<html>
<head lang="es">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo base_url(); ?>static/js/jquery-2.1.4.min.js"></script>
    <script>
    	__base_url = "<?php echo base_url(); ?>";
    </script>
    <!-- include the Google Platform Library on your web pages that integrate Google Sign-In. -->
	<script src="https://apis.google.com/js/platform.js" async defer></script>

	<!-- Specify the client ID you created for your app in the Google Developers Console with the google-signin-client_id meta element. -->
	<meta name="google-signin-client_id" content="247475190591-e59sg0qhf5j10udhp805nt3lsmoucu10.apps.googleusercontent.com">


	<title>
		<?php echo $titulo; ?> | Web
	</title>
    <!-- Bootstrap -->	
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="<?php echo base_url()?>">Home</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="barra-collapse">
	      <ul id="super_nav_bar" class="nav navbar-nav">
	        <!-- <li class="active"> -->
	        <li><a href="<?php echo base_url()?>Archivos">Archivos</a></li>
	        <?php if(isset($_SESSION["user_correo"])){?>
	        <li><a href="<?php echo base_url()?>Archivos/Propias">Propias</a></li>
	        <li><a href="<?php echo base_url()?>Archivos/Agregar">Nuevo</a></li>
	        <?php }?> <!-- isset($_SESION["user_token"]){ -->
	      </ul>
	      
	      <ul class="nav navbar-nav navbar-right">
	      	<li class="navbar-brand active" id="nombre_del_usuario"><?php echo $nombre_del_usuario ?></li>
	      </ul>
	      
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
<!-- </body> // esta en el footer!!-->