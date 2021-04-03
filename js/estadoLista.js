
  $.ajax({
    url : "https://servicodados.ibge.gov.br/api/v1/localidades/estados",
    type : 'get',
    beforeSend : function(){
    }
  }).done(function(msg){
    msg.forEach(element => {
      $("#State").append('<option value="' + element.id + '">' + element.nome + '</option>');
    });   
  }).fail(function(jqXHR, textStatus, msg){
    alert(msg);
  });
