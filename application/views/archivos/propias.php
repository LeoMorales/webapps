<link href="<?= base_url('static/css/micss.css');?>" rel="stylesheet">
<script src="<?= base_url('static/js/ajaxgaleria.js');?>"></script>
<script src="<?= base_url('static/js/modaljs.js');?>"></script>

<center>
	<h1> Galería Personal </h1>
	<br><br>
	<input id="buscar" data-url="Archivos/Propias/" template="propias" type="text" name="tags" class="form-control" placeholder="verano vacaciones familia">
	<br><br>

	<div id="contenido">	
	<?php foreach ($imagenes as $imagen){?>
		<div class="miDiv row" id=<?=$imagen["id"]?>>
			<div class="mi-imagen col-md-4">
			<?=img($imagen['thumbnail']);?> 
			</div>
			<div class="mi-datos-imagen col-md-8">
				<label>Nombre: <?=$imagen['nombre']?></label><br>
				<label>Descripción: <?= $imagen['descripcion']?></label><br>
				<label>Publico: <?php echo ($imagen['publico'] == 1) ? 'Si' : 'No'; ?></label><br>
				<label>Tags: <?= $imagen['tags']?></label><br>
				<button type="button" class="btn btn-primary"
						onclick="removeImagen('<?=$imagen["id"]?>')">Modificar</button>
				<button type="button" class="btn btn-primary"
				onclick="removeImagen('<?=$imagen["id"]?>')">Eliminar</button>
			</div>
		</div>
	<?php } ?>
	</div>
<!--
	<div id="divthumbnails" class="row">
		<center>
		<?php
		foreach ($imagenes as $imagen){?>
			<div id="<?=$imagen["id"]?>" class="col-md-3">
				<a href="#" class="thumbnail thumbnail-propias" data-toggle="modal" data-title="<?=$imagen['nombre']?>"
				data-image="../<?=$imagen['archivo']?>">
				<?= img($imagen['thumbnail']); ?>
				</a>
				<button type="button" class="btn btn-default glyphicon glyphicon-remove-circle btn-eliminar"
				onclick="removeImagen('<?=$imagen["id"]?>')"></button>
			</div>
		<?php } ?>
		</center>	
	</div>
	<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	            	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
	                <h4 class="modal-title" id="image-gallery-title"></h4>
	            </div>
	            <div class="modal-body">
	                <img id="image-gallery-image" class="img-responsive" src="">
	            </div>
	        </div>
	    </div>
	</div>	
-->
</center>