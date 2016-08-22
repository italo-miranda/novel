<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administracao extends CI_Controller {

	public function index()
	{
		$pagina = array('tela' => 'login-administrador');
		$this->load->view('construtor', $pagina);
	}

	public function cadastrarPalavra()
	{
		$pagina = array('tela' => 'cadastrar-palavra');
		$this->load->view('construtor', $pagina);
	}
}
