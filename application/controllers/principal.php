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
		//Validação dos campos
		$this->form_validation->set_rules('login', 'trin|xss_clean');
        $this->form_validation->set_rules('senha', 'trin|xss_clean');

        //Se a validação passa, o sistema tenta fazer o login
        if ($this->form_validation->run()){
        	//Salva o login e a senha digitados no array $dados
	        $dados = elements(array('login', 'senha'), $this->input->post());

	        //tenta fazer o login
	        $login = $this->modelJogador->fazerLogin($dados['login'], $dados['senha']);

	        if($login){	        	
	        	echo "deu certo!"
	        } else {
	        	echo "Login deu errado!";
	        }
        }
        

		$pagina = array('tela' => 'login');
		$this->load->view('construtor', $pagina);
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
