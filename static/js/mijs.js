$(function(){
	$("#arch").fileinput({
		browseClass: "btn btn-primary",
		showCaption: false,
		showRemove: false,
		showUpload: false
	});
});

function ordenarArriba(criterio){
	var $contenido = $('#contenido'),
		$imagenes = $contenido.children();

	$imagenes.sort(function(a,b){
		var an = a.getAttribute(criterio),
			bn = b.getAttribute(criterio);

		if(an > bn)
			return 1;
		if(an < bn)
			return -1;
		return 0;
	});

	$imagenes.detach().appendTo($contenido);
}

function ordenarAbajo(criterio){
	var $contenido = $('#contenido'),
		$imagenes = $contenido.children();

	$imagenes.sort(function(a,b){
		var an = a.getAttribute(criterio),
			bn = b.getAttribute(criterio);

		if(an < bn)
			return 1;
		if(an > bn)
			return -1;
		return 0;
	});

	$imagenes.detach().appendTo($contenido);
}