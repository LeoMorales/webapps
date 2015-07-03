<link href="<?= base_url('static/css/micss.css');?>" rel="stylesheet">
<script src="<?= base_url('static/js/ajaxgaleria.js');?>"></script>
<script src="<?= base_url('static/js/modaljs.js');?>"></script>
<script src="<?= base_url('static/js/mijs.js');?>"></script>

<center>
	<h1> Galería Personal </h1>
	<br><br>
	<input id="buscar" data-url="Archivos/Propias/" template="propias" type="text" name="tags" class="form-control" placeholder="verano vacaciones familia">
	<br>
	<label>Nombre</label>
	<button class="btn-primary glyphicon glyphicon-arrow-up" onclick="ordenarArriba('data-nombre')"></button>
	<button class="btn-primary glyphicon glyphicon-arrow-down" onclick="ordenarAbajo('data-nombre')"></button>
	<label>Descripción</label>
	<button class="btn-primary glyphicon glyphicon-arrow-up" onclick="ordenarArriba('data-descripcion')"></button>
	<button class="btn-primary glyphicon glyphicon-arrow-down" onclick="ordenarAbajo('data-descripcion')"></button>
	<label>Fecha</label>
	<button class="btn-primary glyphicon glyphicon-arrow-up" onclick="ordenarArriba('data-fecha')"></button>
	<button class="btn-primary glyphicon glyphicon-arrow-down" onclick="ordenarAbajo('data-fecha')"></button>
	<br><br>
	<div id="contenido">	
	<?php foreach ($imagenes as $imagen){?>
		<div class="miDiv row" data-nombre="<?=$imagen['nombre']?>" data-descripcion="<?=$imagen['descripcion']?>"
		data-fecha="<?=$imagen['fecha']?>" id="<?=$imagen['id']?>">
			<div class="mi-imagen col-md-4">
			<?=img($imagen['thumbnail']);?> 
			</div>
			<div class="mi-datos-imagen col-md-8">
				<label>Nombre: <?=$imagen['nombre']?></label><br>
				<label>Descripción: <?= $imagen['descripcion']?></label><br>
				<label>Tags: <?= $imagen['tags']?></label><br>
				<label>Fecha: <?= $imagen['fecha']?></label><br>
				<label>Publico: <?php echo ($imagen['publico'] == 1) ? 'Si' : 'No'; ?></label><br>
				<a href="modificar?imagen=<?=$imagen['id']?>" class="btn btn-primary">Modificar</a>
				<button type="button" class="btn btn-primary"
				onclick="removeImagen('<?=$imagen["id"]?>')">Eliminar</button>
			</div>
		</div>
	<?php } ?>
	</div>
</center>