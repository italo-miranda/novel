<!-- Aqui e a area do conteudo -->
			<div class="col-md-12 col-xs-12 afastado-1pc vertical-center">
				<div id="conteudo" class="col-md-6 col-xs-12 centered well" >
					<div class="row">
						<div id="painel-login" class="col-md-12 col-xs-12">
							<div class="row">
								<h1 class="titulo-menu centered">Cadastre-se para jogar!</h1>
							</div>							
							<form class="form-vertical" role="form" method="post" action="<?php echo base_url('principal/realizarCadastro');?>">
							  	<div class="row">
							  		<div class="form-group centered">
							  			<div class="col-md-4 col-xs-4">
							  				<label for="nome">Nome:</label>
							  			</div>
								    	<div class="col-md-8 col-xs-8">
								    		<input type="text" class="form-control" required="" size="40" id="nome" name="nome">
								    	</div>								    
							  		</div>
							  	</div>
							  	<div class="row">
							  		<div class="form-group centered">
							  			<div class="col-md-4 col-xs-4">
							  				<label for="email">E-mail:</label>
							  			</div>
								    	<div class="col-md-8 col-xs-8">
								    		<input type="email" class="form-control" required="" size="40" id="email" name="email">
								    	</div>								    
							  		</div>
							  	</div>
							  	<div class="row">
								  	<div class="form-group centered">
								  		<div class="col-md-4 col-xs-4">
									    	<label for="login">Login:</label>
									    </div>
									    <div class="col-md-8 col-xs-8">
								   			<input type="text" class="form-control" required="" size="40" id="login" name="login">
								   		</div>
								  	</div>
							  	</div>
							  	<div class="row">
								  	<div class="form-group centered">
								  		<div class="col-md-4 col-xs-4">
								    		<label for="senha1">Senha:</label>
								    	</div>
								   		<div class="col-md-8 col-xs-8">
								   			<input type="password" class="form-control" required=""  size="40" id="senha1" name="senha1">
								   		</div>
								  	</div>
							  	</div>
							  	<div class="row">
								  	<div class="form-group centered">
								  		<div class="col-md-4 col-xs-4">
								    		<label for="senha2">Repita a senha:</label>
								    	</div>
								   		<div class="col-md-8 col-xs-8">
								   			<input type="password" class="form-control" required=""  size="40" id="senha2" name="senha2">
								   		</div>
								  	</div>
							  	</div>
							  	<div class="row">
								  	<div class="form-group centered">
								  		<div class="col-md-12 col-xs-12">
								    		<label for="avatar">Escolha seu avatar:</label>
								    	</div>
								   		<div class="col-md-3 col-xs-6">
								   			<label class="centered">
								   				<div class="row">
								   					<img class="centered" alt="alt funcionado" src="<?php echo base_url('assets/img/cecilia.jpg'); ?>">
								   				</div>
								   				<div class="row">
								   					<input class="centered" required type="radio" name="avatar" value="cecilia">
								   				</div>								   											   	
	   							 			</label>					
								   		</div>
								   		<div class="col-md-3 col-xs-6">
								   			<label class="centered">
								   				<div class="row">
								   					<img class="centered" src="<?php echo base_url('assets/img/graciliano.jpg'); ?>">
								   				</div>
								   				<div class="row">
								   					<input class="centered" required type="radio" name="avatar" value="graciliano">
								   				</div>								   											   	
	   							 			</label>	
								   		</div>
								   		<div class="col-md-3 col-xs-6">
								   			<label class="centered">
								   				<div class="row">
								   					<img class="centered" src="<?php echo base_url('assets/img/clarice.jpg'); ?>">
								   				</div>
								   				<div class="row">
								   					<input class="centered" required type="radio" name="avatar" value="clarice">
								   				</div>								   											   	
	   							 			</label>						
								   		</div>
								   		<div class="col-md-3 col-xs-6">
								   			<label class="centered">
								   				<div class="row">
								   					<img class="centered" src="<?php echo base_url('assets/img/joao.jpg'); ?>">
								   				</div>
								   				<div class="row">
								   					<input class="centered" required type="radio" name="avatar" value="joao">
								   				</div>								   											   	
	   							 			</label>								
								   		</div>
								  	</div>
							  	</div>
								<div class="row centered">
									<button type="submit" class="btn btn-lg btn-success">Cadastrar</button>
								</div>
							</form>																				
						</div>
					</div>
				</div>

					<!--Mostrar mensagem de erro se o login ou senha forem inválidos-->
					<?php
						if ($erro){
							echo '<script language="javascript">';
								echo 'function mensagemErro(){';
									echo 'alert("Não foi possível realizar o cadastro. Por favor, tente novamente!");';
								echo '}';
								echo 'onload=mensagemErro();';
							echo '</script>';
						}
					?>