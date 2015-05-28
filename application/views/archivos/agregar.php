<link href="<?php echo base_url(); ?>static/css/micss.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>static/css/fileinput.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>static/js/fileinput.js"></script>
<script src="<?php echo base_url(); ?>static/js/mijs.js"></script>

<center><h1>Agregar imagen</h1></center>
<div id="form-agregar">
 	<form action="#">
		<div class="form-group">
	    	<label for="nombre">Nombre:</label>
	    	<input type="text" placeholder="Bosque" class="form-control" id="nombre">
	  	</div><br>
	  	<div class="form-group">
	    	<label for="desc">Descripción:</label>
	    	<textarea id="desc" class="form-control" rows="4"></textarea>
	  	</div><br>
	  	<div class="form-group">
	  		<label for="arch">Seleccione imagen</label><br>
	  		<input  id="arch" type="file">
	  	</div><br>
	  	<div class="checkbox form-group">
	    	<label><input type="checkbox"> Publico</label>
	  	</div><br>
	  		<button type="submit" class="btn btn-default">Enviar</button>
	</form>
</div>