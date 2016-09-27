
function valida(){
  console.log('validando');
  var nome = $('input[name=nome]').val();
  var todosNomes = sessionStorage.getItem('nomesJuntores').split(',');
  var nomeAntigo = $('#nome_antigo').val();
  
  console.log(nome+nomeAntigo );
  
  if(nome.length < 5){
      penduraErro('O nome precisa ter pelo menos 5 dígitos');
      return 0;
  }

  if( todosNomes.indexOf(nome) != -1 && nome != nomeAntigo ){
    penduraErro('Este nome já está sendo usado');
    return 0;
  }

  $('#divNome').removeClass('has-error');
  $('#divErrorNome').hide();
  console.log('1');
  return 1;
}

function penduraErro(erro){
    $('#divNome').addClass('has-error');
    $('#divErrorNome').append(erro);
    $('#divErrorNome').show()
    $('input[name=nome]').on('input', function(){
      $('#divErrorNome').hide();
      $(this).parent().removeClass('has-error');
    });
}