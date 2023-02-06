<?php

  function dadosGet($link){
    $ch = curl_init($link);
    curl_setopt_array($ch, [
      
        // Equivalente ao -X:
        CURLOPT_CUSTOMREQUEST => 'GET',
      
        // Equivalente ao -H:
        CURLOPT_HTTPHEADER => [
            'JsonOdds-API-Key: yourapikey'
        ],
        // Permite obter o resultado
        CURLOPT_RETURNTRANSFER => 1,
    ]);  
    $resposta = json_decode(curl_exec($ch), true);
    curl_close($ch);
    return $resposta;
  }

?>

<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="bower_components/jquery/dist/jquery.js"></script>
  <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.js"></script> 
  <script type="text/javascript" src="bower_components/inputmask/dist/jquery.inputmask.js"></script>

  <script type="text/javascript" src="js/estadoLista.js"></script> 
  <script type="text/javascript" src="js/municipiosLista.js"></script> 
  <script type="text/javascript" src="js/config_form.js"></script> 

  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css"><link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
  <div class="container-fluid">

    <!-- Crie um formulário que colete os dados pessoais de uma pessoa, que são:
         Nome Completo,
         Endereço,
         Bairro,
         CEP,
         Cidade,
         UF (Estado),
         Telefone e
         E-mail.
         Em seguida, apresente esses dados em uma nova página pelo método POST. -->

    <section class="centralizador">

      <?php if($_POST){
          $val_nome     = $_POST['valorNome'];
          $val_email    = $_POST['valorEmail'];
          $val_telefone = $_POST['valorTelefone'];
          $val_cep      = $_POST['valorCep'];
          $val_endereco = $_POST['valorEndereco'];
          $val_bairro   = $_POST['valorBairro'];
          $val_cidade   = $_POST['valorCidade'];
          $val_estado   = $_POST['valorEstado'];

          $estado = dadosGet("https://servicodados.ibge.gov.br/api/v1/localidades/estados/".$val_estado);
          $cidade = dadosGet("https://servicodados.ibge.gov.br/api/v1/localidades/distritos/".$val_cidade); ?>

        <h1> Dados: </h1>
        <h2> Nome:      <?=$val_nome?></h2>
        <h2> Email:     <?=$val_email?></h2>
        <h2> Telefone:  <?=$val_telefone?></h2>
        <h2> CEP:       <?=$val_cep?></h2>
        <h2> Endereco:  <?=$val_endereco?></h2>
        <h2> Bairro:    <?=$val_bairro?></h2>
        <h2> Estado:    <?=$estado['nome']?></h2>
        <h2> Cidade:    <?=$cidade[0]['nome']?></h2>

        <div class='d-flex justify-content-center'>
          <a class='btn btn-success' href='index.php'>Voltar</a>
        </div>
        
      <?php } else { ?>

      <form class="form-cadastro" action="index.php" method="POST">
        <h1>Insira seus Dados!!</h1>

        <div class="mb-3">
          <label for="Name" class="form-label">Nome</label>
          <input name="valorNome" type="text" class="form-control" id="Name">
        </div>

        <div class="mb-3">
          <label for="Email" class="form-label">Email</label>
          <input name="valorEmail" type="email" class="form-control" id="Email" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">Fica tranquilo nós não vamos compartilhar seu email com ninguem</div>
        </div>

        <div class="mb-3">
          <label for="Phone" class="form-label">Telefone</label>
          <input name="valorTelefone" type="text" class="form-control" id="Phone" aria-describedby="phoneHelp">
          <div id="phoneHelp" class="form-text">Fica tranquilo nós não vamos compartilhar seu telefone com ninguem</div>
        </div>

        <div class="mb-3">
          <label for="Adress" class="form-label">Endereço</label>
          <input name="valorEndereco" type="text" class="form-control" id="Adress" aria-describedby="adressHelp">
          <div id="adressHelp" class="form-text">Insira Aqui seu Endereço</div>
        </div>

        <div class="mb-3">
          <label for="CEP" class="form-label">CEP</label>
          <input name="valorCep" type="text" class="form-control" id="CEP" aria-describedby="cepHelp">
          <div id="cepHelp" class="form-text">Insira Aqui seu CEP</div>
        </div>

        <div class="mb-3">
          <label for="State" class="form-label">Estado</label>
          <select name="valorEstado" id="State" class="form-select form-select-sm" aria-label=".form-select-sm example" aria-describedby="stateHelp">
            <option selected>Selecione seu Estado</option>
          </select>
          <div id="stateHelp" class="form-text">Insira Aqui Seu Estado</div>
        </div>

        <div class="mb-3">
          <label for="City" class="form-label">Cidade</label>
          <select name="valorCidade" id="City" class="form-select form-select-sm" aria-label=".form-select-sm example" aria-describedby="cityHelp">
            <option selected>Selecione sua Cidade</option>
          </select>
          <div id="cityHelp" class="form-text">Insira Aqui Sua Cidade</div>
        </div>

        <div class="mb-3">
          <label for="District" class="form-label">Bairro</label>
          <input name="valorBairro" type="text" class="form-control" id="District" aria-describedby="districtHelp">
          <div id="districtHelp" class="form-text">Insira Aqui seu Bairro</div>
        </div>
  
        <button type="submit" class="btn btn-primary">
          Submit
        </button>
      </form>

      <?php } ?>

    </section>

  </div>
</body>
</html>