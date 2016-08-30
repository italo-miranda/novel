<!DOCTYPE html>
<html>
<head>
	<title>Novel</title>
	<link rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/css/estilo.css"); ?>" />
</head>

<body>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery-3.1.0.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>


<!-- Aqui começa o conteudo -->
<div role="main">
	<div class="col-md-12 col-xs-12">
<!--
		<nav class="navbar navbar-default">
			 <div class="navbar-header">
			    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			    	<span class="icon-bar"></span>
			    	<span class="icon-bar"></span>
			    	<span class="icon-bar"></span>
			    </button>
				<a class="navbar-brand" href="<?php echo base_url('principal/menu'); ?>">Novel</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><img src="<?php echo base_url('assets/img/avatar-fake.png'); ?>"></li>
				    <li><a href="#"><?php // echo("Bem vindo, " + $nome + "!"); ?></a></li>
				    <li><a href="#">Meus Pontos</a></li>
					<li><a href="#">Ranking</a></li> 
					<li><a href="#"><span class="glyphicon glyphicon-log-out"></span>Sair</a></li>
			    </ul> 
			</div> 
		</nav> -->

		<!-- Aqui é a área do conteúdo -->
		<div class="row">
			<div id="conteudo" class="col-md-12 col-xs-12 vertical-center">
				<div id="conteudo" class="col-md-12 col-xs-12 well">
					<div class="row">
						<div class="col-md-12 col-xs-12 centered">
							<img src="<?php echo base_url('assets/img/logo-fake.png'); ?>">
						</div>			
					</div>
					<div class="row">
						<div class="col-md-4 col-xs-8 centered afastado-1pc">
							<a class="link-sem-linha" href="<?php echo base_url('principal/login'); ?>"><button type="button" class="btn btn-success btn-lg btn-block">Jogar</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row centered">
			<div class="col-md-12 col-xs-12" id="footer">
				<h5>Novel - Um Software Educativo para a Aprendizagem Autônoma de Ortografia - 2016</h5>
			</div>
		</div>

<!-- Fechamentos das divs principais. Não apagar!-->
	</div>
</div>
<!-- Fim do conteudo -->

</body>
</html>