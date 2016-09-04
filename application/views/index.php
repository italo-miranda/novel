	<!-- Aqui e a area do conteudo -->
	<div class="col-md-12 col-xs-12 vertical-center">
		<div id="conteudo" class="col-md-12 col-xs-12 well">
			<div class="row">
				<div class="col-md-12 col-xs-12 centered">
					<img src="<?php echo base_url('assets/img/logo-fake.png'); ?>">
				</div>			
			</div>
			<div class="row">
				<div class="col-md-4 col-xs-8 centered afastado-1pc">
					<button type="button" class="btn btn-success btn-lg btn-block" onclick="mostrarLogin()">Jogar</button>
				</div>
			</div>
		</div>	

<!--ÁREA DO LOGIN -->

  <!-- Modal -->
  	<div class="modal fade" id="pop" role="dialog">
	    <div class="modal-dialog modal-sm">
	      <div class="modal-content">
	        <div class="modal-header" style="text-align: center">
	          	<button type="submit" class="close">&times;</button>
	          <h4 class="modal-title">Painel de login</h4>
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
				</div>
	        </div>
		    <div class="row centered">
		    	<div class="modal-footer">
		    		<div class="row centered afastado-1pc col-md-10 col-xs-12">
						<a href="<?php echo base_url('principal/cadastrarJogador'); ?>" class="btn btn-block btn-lg btn-link" role="button">Não tenho cadastro</a>
					</div>
					<div class="row">
						<div id="botao-esqueciSenha" class="col-md-6 col-xs-6 centered">
							<a href="<?php echo base_url('principal/recuperarSenha'); ?>" class="btn btn-link" role="button">Esqueci a senha</a>
						</div>
					</div>
					</div>
		        </div>
		    </div>
	      </div>
	    </div>
	  </div>
	</div>


<script type="text/javascript">

	function mostrarLogin(){		
		$("#pop").modal();		
	}

</script>