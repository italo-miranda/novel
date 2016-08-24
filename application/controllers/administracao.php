<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administracao extends CI_Controller {

	public function index()
	{
		$pagina = array('tela' => 'login-administrador');
		$this->load->view('construtor', $pagina);
	}

	public function recuperarSenha()
	{
		$pagina = array('tela' => 'recuperar-senha');
		$this->load->view('construtor', $pagina);
	}

	public function cadastrarPalavra()
	{
		$pagina = array('tela' => 'cadastrar-palavra');
		$this->load->view('construtor', $pagina);
	}

	public function editarPalavra()
	{
		$pagina = array('tela' => 'editar-palavra');
		$this->load->view('construtor', $pagina);
	}

	public function cadastrarTexto()
	{
		$pagina = array('tela' => 'cadastrar-texto');
		$this->load->view('construtor', $pagina);
	}

	public function editarTexto()
	{
		$pagina = array('tela' => 'editar-texto');
		$this->load->view('construtor', $pagina);
	}
	
}
