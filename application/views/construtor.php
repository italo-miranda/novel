<?php
if($tela =='controle'){
	$this->load->view('controle');
}elseif ($tela == 'index') {
		$this->load->view($tela);
	} else {
		$this->load->view('header');
		if ($tela != 'login' && $tela != 'recuperar-senha' && $tela != 'login-administrador' && $tela != 'cadastrar-jogador'){
		 	$this->load->view('navbar');
	     	$this->load->view($tela);
		} else {			
	    	$this->load->view($tela);
		}	
	$this->load->view('footer');
	}
?>