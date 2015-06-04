<link href="<?php echo base_url(); ?>static/css/micss.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>static/css/fileinput.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>static/js/fileinput.js"></script>
<script src="<?php echo base_url(); ?>static/js/mijs.js"></script>

<?php
if (isset($respuesta))
	echo $respuesta;
?>
<center><h1>Agregar imagen</h1></center>
<div id="form-agregar">
 	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
	    	<label for="nombre">Nombre:</label>
	    	<input type="text" placeholder="Bosque" class="form-control" name="nombre">
	  	</div><br>
	  	<div class="form-group">
	    	<label for="desc">Descripción:</label>
	    	<textarea name="desc" class="form-control" rows="4"></textarea>
	  	</div><br>
	  	<div class="form-group">
	  		<label for="arch">Seleccione imagen</label><br>
	  		<input  id="arch" name="imagen" type="file">
	  	</div><br>
	  	<div class="checkbox form-group">
	    	<label><input name="public" type="checkbox"> Publico</label>
	  	</div><br>
	  		<button type="submit" class="btn btn-default">Enviar</button>
	</form>
</div>