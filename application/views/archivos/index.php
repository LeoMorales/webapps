<link href="<?= base_url('static/css/micss.css');?>" rel="stylesheet">
<script src="<?= base_url('static/js/ajaxgaleria.js');?>"></script>

<?php
if (isset($respuesta))
	echo $respuesta;
?>
<center>
	<h1> Pagina Principal </h1>
	<br><br>
	<form id="form">
		<div class="input-group">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="submit">Buscar</button>
	      </span>
	      <input id="buscar" type="text" name="tags" class="form-control" placeholder="verano vacaciones familia">
	    </div>
	</form>
    <br><br>
	<div id="divthumbnails" class="row">
		<center>
		<?php
		foreach ($imagenes as $imagen){?>
			<div class="col-md-3">
				<a href="#" class="thumbnail">
				<?= img($imagen['thumbnail']); ?>
				</a>
			</div>
		<?php } ?>
		</center>	
	</div>	
</center>