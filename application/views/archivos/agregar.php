<link href="<?php echo base_url(); ?>static/css/micss.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>static/css/fileinput.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>static/js/fileinput.js"></script>
<script src="<?php echo base_url(); ?>static/js/mijs.js"></script>

<?php
if (isset($respuesta))
	echo $respuesta;
?>
<center><h1>Agregar imagen</h1></center>
<div class="form-personalizado">
 	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
	    	<label for="nombre">Nombre:</label>
	    	<input type="text" class="form-control" name="nombre">
	  	</div>
	  	<div class="form-group">
	    	<label for="desc">Descripción:</label>
	    	<textarea name="desc" class="form-control" rows="4"></textarea>
	  	</div>
	  	<div class="form-group">
	  		<label for="imagen">Seleccione imagen</label><br>
	  		<input  id="arch" name="imagen" type="file">
	  	</div>
	  	<div class="form-group">
	    	<label for="tags">Tags:</label>
	    	<textarea name="tags" class="form-control" rows="2"></textarea>
	  	</div>
	  	<div class="checkbox form-group">
	    	<label><input name="public" type="checkbox"> Publico</label>
	  	</div><br>
	  		<button type="submit" class="btn btn-default">Enviar</button>
	</form>
</div>