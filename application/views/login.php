<!-- Aqui e a area do conteudo -->
	<div class="col-md-12 col-xs-12 vertical-center">
		<div id="conteudo" class="col-md-4 col-xs-12 centered well" >
			<div class="row">
				<div id="painel-login" class="centered col-md-12 col-xs-12">
					<h1>Painel de login</h1>
					<form class="form-inline" role="form" method="post" action="<?php echo base_url('principal/fazerLogin');?>">
					  	<div class="form-group">
					    	<label for="login">Login:</label>
					    	<input type="text" required="" name="login" class="form-control" id="login">
					  	</div>
					  	<div class="form-group">
					    	<label for="pwd">Senha:</label>
					   		<input type="password" required="" name="senha" class="form-control" id="senha">
					  	</div>
						<div class="centered afastado-1pc col-md-10 col-xs-12">
							<button type="submit" id="btn-login"  name="btn-login" class="btn btn-lg btn-block btn-success">Começar</button>
							
						</div>
						<div class="row centered afastado-1pc col-md-10 col-xs-12">
							<a href="<?php echo base_url('principal/cadastrarJogador'); ?>" class="btn btn-block btn-lg btn-info" role="button">Não tenho cadastro</a>
						</div>
						<div class="row">
							<div id="botao-esqueciSenha" class="col-md-6 col-xs-6 centered">
								<a href="<?php echo base_url('principal/recuperarSenha'); ?>" class="btn btn-link" role="button">Esqueci a senha</a>
							</div>
						</div>
					</form>						
				</div>
			</div>
		</div>
							
