<center>
	<h1> Pagina Principal </h1>
	
	<div class="row">
	<?php
	foreach ($imagenes as $imagen){
	?>
		<div class="col-xs-6 col-md-3">
			<a href="#" class="thumbnail">
			<img src=<?php$imagen['thumbnail'];?> alt="...">
			</a>
		</div>
	<?php}
	?>
	</div>
</center>