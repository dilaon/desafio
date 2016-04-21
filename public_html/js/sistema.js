function envia(acao){
    $("#acao").val(acao);
    if(acao=='E')
        if(!confirm("Deseja continuar com a exclusão?"))
            return;
    $("#formulario").submit();
}

function captchaReload(){
    document.getElementById('captcha').src='captcha.php?'+Math.random();
    document.getElementById('captcha_input').value = '';
    document.getElementById('captcha_input').focus();
}