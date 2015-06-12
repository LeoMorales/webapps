$(document).ready(function() {
	$("#form").submit(function() {
		var template = '<div class="col-md-3">' +
		'<a href="#" class="thumbnail">' +
		'<img src="${src}">' +
		'</a>' +
		'</div>';
		$.ajax({
			url: __base_url + 'Archivos/',
			type: 'POST',
			data: $('#form').serialize(),
			success:function(respuesta){
				var obj = JSON.parse(respuesta);
				$("#divthumbnails").children().remove();
                $("#buscar").val("");
                for (i = 0; i < obj.result.length; i++) { 
                    var src = __base_url + obj.result[i].thumbnail;
                    var markup = template.replace(/\$\{src\}/i, src)
                    $('#divthumbnails').append($(markup));
                }
            }
		});
		return false;
	});

});

function removeImagen(path){
	if (confirm("Desea eliminar la imagen?")) {
  		$.ajax({
			url: __base_url + 'Archivos/EliminarImagen',
			type: 'POST',
			dataType: 'json',
			data: {path: path},
			success:function(res){
            }
		});
    }
}