/* MÁSCARA DE CAMPOS */
$(document).ready(function () {
    var options = {
        onInvalid: function (val, e, f, invalid, options) {
            var error = invalid[0];
            alert($("#celular").length);
            /*if($("#celular").length < 3) {
                alert("TESTE");
            }*/
        }
    };

    $("#cpf").mask("999.999.999-99");
    $("#fixo").mask("(99) 99999-9999");
    $("#celular").mask("(99) 99999-9999", options);
});

/* EFEITO MOBILE FORMULÁRIO */
$(".efeito").hide();
$("#btn-formulario-a,#btn-formulario-b").click(function () {
    $("#form-box").show();
    $(".efeito").show();
});

$(".btn-close").click(function () {
    $("#form-box").hide();
    $(".efeito").hide();

    $('html, body').animate({
        scrollTop: $("body").offset().top
    }, 1000);
});

$("#eft").click(function () {
    $("#form-box").hide();
    $(".efeito").hide();
});

/* ENVIO DO FORMULÁRIO */
$("#aguarde").hide();
$('form').submit(function () {
    $("#submit").attr("disabled", "disabled");
    $("#aguarde").show();
    $("#inscreva").hide();
});