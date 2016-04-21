jQuery(function($){
    $("#cpf").mask("999.999.999-99");
    $("#telefone").mask("(99)9999-9999?9");
    $("#telefone2").mask("(99)9999-9999?9");
    $("#endereco_cep").mask("99999-999");
    $("#endereco_numero").mask("9?99999");
    endereco();
});

function endereco(){
    cep = $("#endereco_cep").val().substring(0,5).concat($("#endereco_cep").val().substring(6,9));
    $.getJSON("http://viacep.com.br/ws/"+cep+"/json/", function(result){
        if(!result["erro"])
            $("#endereco").html(result['logradouro']+", "+result['localidade']+"-"+result['uf']);
        else
            $("#endereco").html("(Endereço não encontrado)");
    });
}