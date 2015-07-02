<link href="<?php echo base_url(); ?>static/css/micss.css" rel="stylesheet">

<center><h1>Modificar imagen</h1></center>
<div class="form-personalizado">
 	<form method="post" enctype="multipart/form-data">
		<div class="form-group">
	    	<label for="nombre">Nombre:</label>
	    	<input type="text" class="form-control" name="nombre" value="<?=$datosImagen->nombre?>">
	  	</div>
	  	<div class="form-group">
	    	<label for="desc">Descripción:</label>
	    	<textarea name="desc" class="form-control" rows="4"><?=$datosImagen->descripcion?></textarea>
	  	</div>
	  	<div class="checkbox form-group">
	    	<label><input <?=$datosImagen->publico ?'checked':''?> name="public" type="checkbox"> Publico</label>
	  	</div><br>
	  		<button type="submit" class="btn btn-default">Enviar</button>
	</form>
</div>