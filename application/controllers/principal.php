<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$pagina = array('tela' => 'index');
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

	public function controle()
	{
		$pagina = array('tela' => 'controle');
		$this->load->view('construtor', $pagina);
	}
}
