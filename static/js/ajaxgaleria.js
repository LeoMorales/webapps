$(document).ready(function() {
	$("#form").submit(function() {
		$url = __base_url + 'Archivos/';
		$data = $('#form').serialize();
		enviarFiltro($url, $data);
		return false;
	});

	$("#form-propias").submit(function() {
		$url = __base_url + 'Archivos/Propias';
		$data = $('#form-propias').serialize();
		enviarFiltro($url, $data);
		return false;
	});
});

function enviarFiltro(url, tags){
	var template = '<div class="col-md-3">' +
	'<a href="#" class="thumbnail">' +
	'<img src="${src}">' +
	'</a>' +
	'</div>';
	$.ajax({
		url: url,
		type: 'POST',
		data: tags,
		success:function(respuesta){
			var obj = JSON.parse(respuesta);
            if (obj.result.length == 0){
            	alert("No se encontraron coincidencias de tags");
            	$("#buscar").val("");
            }
            else{
				$("#divthumbnails").children().remove();
            	$("#buscar").val("");
                for (i = 0; i < obj.result.length; i++) { 
                    var src = __base_url + obj.result[i].thumbnail;
                    var markup = template.replace(/\$\{src\}/i, src)
                    $('#divthumbnails').append($(markup));
                }
            }
        }
	});
}

function removeImagen(path, id){
	if (confirm("Desea eliminar la imagen?")) {
		$.ajax({
			url: __base_url + 'Archivos/EliminarImagen',
			type: 'POST',
			dataType: 'json',
			data: {path: path},
			success:function(res){
				$("#"+id).remove();
				alert("Imagen eliminada");
            }
		});
    }
}