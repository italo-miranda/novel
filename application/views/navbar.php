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
			<li class="active"><img src="<?php echo base_url('assets/img/'.$this->session->userdata('avatar').'.jpg'); ?>"></li>
		    <li><a href="#"><?php  echo("Bem vindo, " . $this->session->userdata('nome') . "!"); ?></a></li>
		    <li><a href="#">Minha conta</a></li>
			<li><a href="#">Ranking</a></li> 
			<li><a href="<?php echo base_url($linkLogoff);?>"><span class="glyphicon glyphicon-log-out"></span>Sair</a></li>
	    </ul> 
	</div> 
</nav>

