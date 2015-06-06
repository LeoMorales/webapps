<link href="<?= base_url('static/css/micss.css'); ?>" rel="stylesheet">

<center>
	<h1> Pagina Principal </h1>
	<br><br>
	<div class="row">
		<center>
		<?php
		foreach ($imagenes as $imagen){?>
			<div class="col-md-3">
				<a href="#" class="thumbnail">
				<?= img($imagen['thumbnail']); ?>
				</a>
			</div>
		<?php	
		}
		?>
		</center>	
	</div>	
</center>