<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Palavra extends CI_Controller {

	public function index()
	{
		$pagina = array('tela' => 'menu-palavra', 'linkNovel'=> 'principal/menu', 'linkLogoff'=>'principal/logoff');
		$this->load->view('construtor', $pagina);
	}

	public function jogarPalavra()
	{
		$id = $this->uri->segment(3);
		$pagina = array('tela' => 'jogar-palavra', 'linkNovel'=> 'principal/menu', 'linkLogoff'=>'principal/logoff');
		$this->load->view('construtor', $pagina);
	}
}
