<?php
if($tela =='controle'):
	$this->load->view('controle');
else:
	$this->load->view('header');
		if ($tela != 'index' && $tela != 'login' && $tela != 'recuperar-senha' && $tela != 'login-administrador'):
		 	$this->load->view('navbar');
	     	$this->load->view($tela);
		else :
	    	$this->load->view($tela);
		endif;
	$this->load->view('footer');
endif;
?>