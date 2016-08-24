<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Palavra extends CI_Controller {

	public function index()
	{
		$pagina = array('tela' => 'menu-palavra');
		$this->load->view('construtor', $pagina);
	}

	public function jogarPalavra()
	{
		$id = $this->uri->segment(3);
		$pagina = array('tela' => 'jogar-palavra');
		$this->load->view('construtor', $pagina);
	}
}
