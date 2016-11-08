<nav class="navbar navbar-default">
	 <div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	    	<span class="icon-bar"></span>
	    	<span class="icon-bar"></span>
	    	<span class="icon-bar"></span>
	    </button>
		<a class="navbar-brand" href="<?php echo base_url($linkNovel); ?>">Novel</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav navbar-right">
			<li class="active" ><img class="img-responsive" id="avatarNav" src="<?php echo base_url('assets/img/'.$this->session->userdata('avatar').'.png'); ?>"></li>
		    <li>
		    	<a href="#"><?php  echo("Olá, " . $this->session->userdata('nome') . "!"); ?></a>
		    </li>
		    <li>
		    	<a href="<?php echo base_url('principal/minhaConta'); ?>">
		    		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Minha conta
		    	</a>
		    </li>
			<li>
				<a href="<?php echo base_url('principal/meusPontos'); ?>">
					<span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Meus pontos
				</a>
			</li> 
			<li>
				<a href="<?php echo base_url($linkLogoff);?>">
				<span class="glyphicon glyphicon-log-out"></span> Sair</a>
			</li>
	    </ul> 
	</div> 
</nav>

