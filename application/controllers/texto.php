<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Texto extends CI_Controller {

	public function index()
	{
		$pagina = array('tela' => 'menu-texto');
		$this->load->view('construtor', $pagina);
	}

	public function jogarTexto()
	{
		$pagina = array('tela' => 'jogar-texto');
		$this->load->view('construtor', $pagina);
	}
}