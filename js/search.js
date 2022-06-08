window.onload = function() {
    let buscador = $(".noticia_destacada");
    //console.log(buscador);
    let h3 = "";
    $("#input-search").keyup(function() {
        for (let index = 0; index < buscador.length; index++) {
            //console.log(buscador[index].innerText);
            h3 = buscador[index].innerText.substr(0, 10);
            //console.log(h3.search($(this).val()));
            if (h3.search($(this).val()) == 0) {
                console.log($(buscador[index]).siblings());
                $(buscador[index]).siblings().css("display", "none");
                //$("#resultado_busqueda").append(buscador[index]);
                // console.log(buscador[index]);
            }
            console.log();
            if ($(this).val() == "") {
                $(".noticia_destacada").css("display", "flex");
            }
        }
    })

}