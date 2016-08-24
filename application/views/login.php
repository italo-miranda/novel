<!-- Aqui e a area do conteudo -->
			<div class="col-md-12 col-xs-12 afastado-1pc">
				<div id="conteudo" class="col-md-4 col-xs-8 centered well" >
					<div class="row">
						<div id="painel-login" class="centered col-md-12 col-xs-12">
							<h1>Painel de login</h1>
							<form class="form-inline" role="form">
							  	<div class="form-group">
							    	<label for="login">Login:</label>
							    	<input type="text" class="form-control" id="login">
							  	</div>
							  	<div class="form-group">
							    	<label for="pwd">Senha:</label>
							   		<input type="password" class="form-control" id="senha">
							  	</div>
								<div>
									<button type="submit" class="btn btn-success">Começar</button>
								</div>
								<div class="row">
									<div id="botao-admin" class="col-md-6 col-xs-6">
										<a href="<?php echo base_url('administracao'); ?>" class="btn" role="button">
											<span class="glyphicon glyphicon-cog"></span>
										</a>
									</div>
									<div id="botao-esqueciSenha" class="col-md-6 col-xs-6">
										<a href="<?php echo base_url('principal/recuperarSenha'); ?>" class="btn btn-link" role="button">Esqueci a senha</a>
									</div>
								</div>
							</form>						
						</div>
					</div>
				</div>
							
