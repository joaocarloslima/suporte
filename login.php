<?php 
  session_start();
  include "notificacao.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>ETECIA - Suporte</title>
	<link rel="stylesheet" type="text/css" href="semanticui/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="semanticui/suporte.css">
</head>

<body>
  <div class="ui middle aligned center aligned grid">
    <div class="five wide column">
      <h2 class="ui teal image header ">
        <img src="imagens/logo.png" class="image">
        <div class="content">
          Sistema de Suporte
        </div>
      </h2>
      <form class="ui large form" action="logar.php" method="POST">
        <div class="ui stacked segment">
          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="number" name="matricula" placeholder="Matrícula">
            </div>
          </div>
          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="senha" placeholder="Senha">
            </div>
          </div>
          <button class="ui fluid large teal submit button">Entrar</button>
        </div>
      </form>

      <?php 
        mostrarNotificacao('red');
        mostrarNotificacao('green');
      ?>
      </div>
    </div>


  </body>
  </html>