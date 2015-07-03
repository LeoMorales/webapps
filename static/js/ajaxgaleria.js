$(document).ready(function() {
	$template = '<div class="col-md-3">' +
	'<a href="#" class="thumbnail" data-toggle="modal" data-title="${nombre}" ' +
	'data-image="${archivo}">' +
	'<img src="${src}">' +
	'</a>' +
	'</div>';

	$templatepropias = '<div class="miDiv row" data-nombre="${nombre}" data-descripcion="${descripcion}"'+
	'data-fecha="${fecha}" id=${id}> <div class="mi-imagen col-md-4">' +
	'<img src="${src}"> </div> <div class="mi-datos-imagen col-md-8">' +
	'<label>Nombre: ${nombre}</label><br> <label>Descripción: ${descripcion}' +
	'</label><br><label>Tags: ${tags}</label><br><label>Fecha: ${fecha}</label><br>' +
	'<label>Publico: ${publico}</label><br><a href="modificar?imagen=${id}"'+
	'class="btn btn-primary">Modificar</a> <button type="button" class="btn btn-primary"' +
	'onclick="removeImagen(${id})">Eliminar</button></div></div>';
	
	$("#buscar").on('keyup', function(e) {
		e.preventDefault(); // previene comportamiento por defecto del form en evento submit
		$url = __base_url + $(e.target).data('url');
		$data = {"tags" :$(e.target).val()};
		if ($(e.target).val().length == 0)
			location.reload();
		else{
			if ($("#buscar")[0].getAttribute("template") !== null)	
				enviarFiltroPropias($url, $data, $templatepropias, true);
			else
				enviarFiltro($url, $data, $template, true);
		}

	});

	$("#buscar")[0].focus();
});

function enviarFiltro(url, tags, template, live){
	$.ajax({
		url: url,
		type: 'POST',
		data: tags,
		success:function(respuesta){
			var obj = JSON.parse(respuesta);
            if (live && obj.result.length == 0){
            	$("#buscar")[0].style.color="red"; //ocurre cuando no hay conincidencias de tags
            }
            else{
            	$("#buscar")[0].style.color="green";	
				$("#divthumbnails").children().remove();
            	for (i = 0; i < obj.result.length; i++) { 
                    var src = __base_url + obj.result[i].thumbnail;
                    var nombre = obj.result[i].nombre;
                    var archivo = __base_url + obj.result[i].archivo;
                    var markup = template.replace(/\$\{src\}/i, src);
                    markup = markup.replace(/\$\{nombre\}/i, nombre);
                    markup = markup.replace(/\$\{archivo\}/i, archivo);
                    markup = markup.replace(/\$\{id\}/i, i+1);
                    $('#divthumbnails').append($(markup));
                }
            }
        }
	});
}

function enviarFiltroPropias(url, criterio, template, live){
	$.ajax({
		url: url,
		type: 'POST',
		data: criterio,
		success:function(respuesta){
			var obj = JSON.parse(respuesta);
            if (live && obj.result.length == 0){
            	$("#buscar")[0].style.color="red"; //ocurre cuando no hay conincidencias de tags
            }
            else{
            	$("#buscar")[0].style.color="green";	
				$("#contenido").children().remove()
            	for (i = 0; i < obj.result.length; i++) { 
                    var src = __base_url + obj.result[i].thumbnail;
                    var nombre = obj.result[i].nombre;
                    var descripcion = obj.result[i].descripcion;
                    var publico = obj.result[i].publico;
                    var tags = obj.result[i].tags;
                    var id = obj.result[i].id;
                    var fecha = obj.result[i].fecha;
                    var markup = template.replace(/\$\{src\}/i, src);
                    markup = markup.replace(/\$\{nombre\}/g, nombre);
                    markup = markup.replace(/\$\{descripcion\}/g, descripcion);
                    markup = markup.replace(/\$\{id\}/g, id);
                    markup = markup.replace(/\$\{publico\}/i, (publico==1)?'Si':'No');
                    markup = markup.replace(/\$\{tags\}/i, tags);
                    markup = markup.replace(/\$\{fecha\}/g, fecha);
                    $('#contenido').append($(markup));
                }
            }
        }
	});
}

function removeImagen(id){
	console.log(id);
	if (confirm("Desea eliminar la imagen?")) {
		$.ajax({
			url: __base_url + 'Archivos/EliminarImagen',
			type: 'POST',
			data: {id: id},
			 success:function(res){
			 	$("#"+id).remove();
			 	alert("Imagen eliminada");
             }
		 });
    }
}