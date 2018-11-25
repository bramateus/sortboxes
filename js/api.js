var areaAtual = "";

//FUNÇÃO RESPONSÁVEL PELAS ÁREAS
function buscaArea() {
    //console.log("#01 - ÁREA SELECIONADA [" + $("#areaCurso").val() + "]");
    $("#listaCursos").children().remove();
    areaAtual = $("#areaCurso").val();
    $.ajax({
        url: 'https://synapselabs.com.br/api/cursos/lista/',
        type: "get",
        dataType: "jsonp",

        success: function (data) {
            buscaCursos(data);

        }
    });

    document.getElementById("listaCursos").style.display = "inline-block";
}

function buscaCursos(data) {
    //console.log("#02 - LISTA DE CURSOS");
    for (var i = 0; i < data.length; i++) {
        if (data[i]["nivel"] === "PÓS-GRADUAÇÃO") {
            listaDeCursos(data[i]);
        }
    }
}

function listaDeCursos(lsData) {
    //console.log("#03 - " + areaAtual);
    if (lsData.area === areaAtual) {
        $("#listaCursos").append($("<option>", {
            value: lsData.curso,
            text: lsData.curso
        }));
        //console.log(lsData.curso);
    }
}
