  $(document).ready( ()=>{
    $("#State").on("change", function(){
      let estadoId = $(this).val();
      $.ajax({
        url : `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoId}/distritos`,
        type : 'get',
        beforeSend : function(){
          $('.municipio-value').remove();  
        }
      }).done(function(msg){
        msg.forEach(element => {
          $("#City").append("<option class='municipio-value' value='" + element.id + "'>" + element.nome + "</option>");
        });   
      }).fail(function(jqXHR, textStatus, msg){
        alert(msg);
      });
    });
  });
