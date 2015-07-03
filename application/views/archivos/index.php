<link href="<?= base_url('static/css/micss.css');?>" rel="stylesheet">
<script src="<?= base_url('static/js/ajaxgaleria.js');?>"></script>
<script src="<?= base_url('static/js/modaljs.js');?>"></script>

<center>
	<h1> Pagina Principal </h1>
	<br><br>
	<input id="buscar" data-url="Archivos/" type="text" name="tags" class="form-control" placeholder="verano vacaciones familia">
	<br><br>
	<div id="divthumbnails" class="row">
		<center>
		<?php
		foreach ($imagenes as $imagen){?>
			<div class="col-md-3">
				<a href="#" class="thumbnail" data-toggle="modal" data-title="<?=$imagen['nombre']?>"
				data-image="<?=$imagen['archivo']?>">
				<?= img($imagen['thumbnail']);?>
				</a>
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
</center>