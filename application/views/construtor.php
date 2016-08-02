<?php
$this->load->view('header');
	if ($tela != 'index' && $tela != 'login' && $tela != 'recuperarsenha'):
	 	$this->load->view('sidebar');
     	$this->load->view($tela);
	else :
    	$this->load->view($tela);
	endif;
$this->load->view('footer');
