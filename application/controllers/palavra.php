<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Palavra extends CI_Controller {

	public function index()
	{
		$pagina = array('tela' => 'menu-palavra');
		$this->load->view('construtor', $pagina);
	}

	public function login()
	{
		$pagina = array('tela' => 'login');
		$this->load->view('construtor', $pagina);
	}

	public function recuperarSenha()
	{
		$pagina = array('tela' => 'recuperarSenha');
		$this->load->view('construtor', $pagina);
	}

	public function menu()
	{
		$pagina = array('tela' => 'menu');
		$this->load->view('construtor', $pagina);
	}

	public function jogarPalavra()
	{
		$pagina = array('tela' => 'jogar-palavra');
		$this->load->view('construtor', $pagina);
	}
}
