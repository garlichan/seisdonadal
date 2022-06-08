window.onload = function() {
    document.getElementById("arrow2").addEventListener("click", cambiarPictograma);
    document.getElementById("arrow1").addEventListener("click", cambiarImagen);
    document.getElementById("arrow1").style.opacity = "0";
    //
    var arrayResultado = [];
    var actividad = document.getElementById("imagen").getAttribute("src");
    var actividadarray = actividad.split("/");
    var src = actividadarray[3];
    var arraysrc = src.split("_");
    arrayResultado.push(arraysrc[0], arraysrc[1]);
    console.log(arraysrc);
}

function cambiarImagen() {
    document.getElementById("arrow2").style.opacity = "1";
    document.getElementById("arrow1").style.opacity = "0";
    //
    var arrayResultado = [];
    var actividad = document.getElementById("imagen").getAttribute("src");
    var actividadarray = actividad.split("/");
    var src = actividadarray[3];
    var arraysrc = src.split("_");
    console.log(arraysrc);
    if (arraysrc.length < 3) {
        var resultado = arraysrc[0];
        var resultadofinal = "/imagenes/actividades/" + resultado + "_pictograma.png";
    } else {
        arrayResultado.push(arraysrc[0], arraysrc[1]);
        var resultadofinal = "/imagenes/actividades/" + arrayResultado.join("_") + "_pictograma.png";
    }
    if (actividad != resultadofinal) {
        document.getElementById("imagen").removeAttribute("src");
        document.getElementById("imagen").setAttribute("src", resultadofinal);
    }

}

function cambiarPictograma() {
    document.getElementById("arrow1").style.opacity = "1";
    document.getElementById("arrow2").style.opacity = "0";
    //
    var arrayResultado = [];
    var actividad = document.getElementById("imagen").getAttribute("src");
    var actividadarray = actividad.split("/");
    var src = actividadarray[3];
    var arraysrc = src.split("_");
    if (arraysrc.length < 3) {
        var resultado = arraysrc[0];
        var resultadofinal = "/imagenes/actividades/" + resultado + "_nenos.jpg";
    } else {
        arrayResultado.push(arraysrc[0], arraysrc[1]);
        var resultadofinal = "/imagenes/actividades/" + arrayResultado.join("_") + "_nenos.jpg";
    }
    document.getElementById("imagen").removeAttribute("src");
    document.getElementById("imagen").setAttribute("src", resultadofinal);

}