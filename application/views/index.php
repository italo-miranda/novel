<!DOCTYPE html>
<html>
<head>
	<title>Novel</title>
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/estilo.css"); ?>" />
	
</head>

<body id="pagina-inicial">
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.1.0.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>


<!-- Aqui começa o conteudo -->
<div role="main">
	<div class="col-md-12 col-xs-12" >

	<!-- Aqui e a area do conteudo -->
	<div class="col-md-12 col-xs-12" id="pagina-inicial">
		<div id="conteudo" class="col-md-12 col-xs-12">
			<div class="row">
				<div class="col-md-4 col-xs-8 centered vertical-center afastado-1pc">
					<button type="button" class="btn btn-success btn-lg btn-block" onclick="mostrarLogin()">Jogar</button>
				</div>
			</div>
		</div>	

<!--ÁREA DO LOGIN -->

  <!-- Modal -->
  	<div class="modal fade" id="modalLogin" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header" style="text-align: center">
	          	<button type="submit" data-dismiss="modal" class="close">&times;</button>
	          <h4 class="modal-title">Entre nessa aventura ortográfica!</h4>
	        </div>
	        <div class="modal-body">          
				<div class="row">
					<div id="painel-login" class="col-md-12 col-xs-12" style="text-align: center;">
						<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('principal/fazerLogin');?>">
						  	<div class="form-group centered col-md-12 col-xs-12">
						    	<label for="login">Login:</label>
						    	<input type="text" required="" name="login" class="form-control" id="login">
						  	</div>
						  	<div class="form-group centered col-md-12 col-xs-12">
						    	<label for="pwd">Senha:</label>
						   		<input type="password" required="" name="senha" class="form-control" id="senha">
						  	</div>
							<div class="centered afastado-1pc col-md-8 col-xs-12">
								<button type="submit" id="btn-login"  name="btn-login" class="btn btn-lg btn-block btn-success">Começar</button>								
							</div>							
						</form>														
					</div>
					<div class="row" id="recuperarSenha" style="text-align: center;">
						<div class="col-md-10 col-xs-10 centered">				
							<h4>Informe o e-mail para receber sua nova senha</h4>	
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url('principal/recuperarSenha');?>">
								<div class="form-group">
								   	<label for="email">E-mail:</label>
								   	<input type="email" class="form-control afastado-1pc" id="email" name="email">
								   	<div class="row afastado-1pc">
								   		<button type="submit" class="btn btn-warning">Enviar</button>
								   	</div>
								</div>
							</form>
						</div>
					</div>					
				</div>				
	        </div>
		    <div class="row centered">
		    	<div class="modal-footer">
		    		<div class="row centered afastado-1pc col-md-10 col-xs-12">
						<a href="<?php echo base_url('principal/cadastrarJogador'); ?>" class="btn btn-block btn-lg btn-link" role="button">Não tenho cadastro</a>
					</div>
					<div class="row">
						<div id="botao-esqueciSenha" class="col-md-6 col-xs-6 centered">
							<button type="button" class="btn btn-link" role="button" onclick="mostrarRecuperarSenha()">Esqueci a senha</a>
						</div>
					</div>					
		        </div>
		    </div>
	      </div>
	    </div>
	  </div>
	</div>

			<!--Mostrar mensagem de erro se o login ou senha forem inválidos-->
					<?php					
						if ($erro){
							echo '<script language="javascript">';							
								echo 'alert("Login ou senha inválidos. Tente novamente!");';									
							echo '</script>';						
						}						
						if ($email == TRUE){
							echo '<script language="javascript">';							
								echo 'alert("Sua nova senha foi enviada para o email '.$email.'");';			
							echo '</script>';						
						}
						if ($enviou == FALSE){
							echo '<script language="javascript">';							
								echo 'alert("Senha não enviada. Tente novamente!");';			
							echo '</script>';						
						}
					?>	


<script type="text/javascript">
	$("#recuperarSenha").hide();

	function mostrarRecuperarSenha(){
		$("#painel-login").hide();
		$("#recuperarSenha").show();
	}

	function mostrarLogin(){		
		$("#modalLogin").modal();		
	}

</script>


<!-- Fechamentos das divs principais. Não apagar!-->
	</div>
</div>
<!-- Fim do conteudo -->

</body>
</html>