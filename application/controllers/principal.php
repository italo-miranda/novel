<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('array');
        $this->load->model('modelJogador');

    }


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

	public function fazerLogin(){

		//Salva o login e a senha digitados no array $dados
	    $dados = $this->input->post(array('login', 'senha'));

	    var_dump($dados);
	    //tenta fazer o login
	    $login = $this->modelJogador->fazerLogin($dados['login'], $dados['senha']);
	    	        
	    if($login){	        	
	    	redirect('principal/menu');
	    } else {
	    	redirect('principal/index');
	    }
	}

	public function recuperarSenha()
	{
		$pagina = array('tela' => 'recuperar-senha');
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

	public function cadastrarJogador()
	{
		$pagina = array('tela' => 'cadastrar-jogador');
		$this->load->view('construtor', $pagina);
	}
}
