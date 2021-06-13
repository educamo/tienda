function loadUsuarios(codigo) {
    $.post(urlbase + "administracion/cuentasUsuarios", { tab: codigo }, function(data) {
        $("#contenido" + codigo).html("Cargando... Por favor espere!");
        var datos = JSON.parse(data);
        $("#contenido" + codigo).html(datos);
    });
}