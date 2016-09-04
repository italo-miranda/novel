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
		if ($this->session->userdata('logged_in')) {
                redirect('principal/menu');
            } else{ 			       
				$pagina = array('tela' => 'login', 'erro'=> FALSE,);
				$this->load->view('construtor', $pagina);
		}
	}

	public function fazerLogin(){

		//Se o jogador já estiver logado, redireciona para o menu principal
		if ($this->session->userdata('logged_in')) {
                redirect('principal/menu');
        } else{ 
			//Salva o login e a senha digitados no array $dados
		    $dados = $this->input->post(array('login', 'senha'));

		    //tenta fazer o login
		    $login = $this->modelJogador->fazerLogin($dados['login'], $dados['senha']);
		    	        
		    if($login){	        	
		    	$this->session->set_userdata(array(
	                    'codJogador' => $login['codJogador'],
	                    'avatar' => $login['avatar'],
	                    'nome' => $login['nome'],	                    
	                    'logged_in' => TRUE,                   
	                ));
		    	redirect('principal/menu');
		    } else {
		    	$pagina = array('tela' => 'login', 'erro'=> TRUE,);
			$this->load->view('construtor', $pagina);
		    }
		} 		
	}

	public function logoff() {

        $this->session->sess_destroy();
        redirect('principal/index');
    }

	public function recuperarSenha()
	{
		$pagina = array('tela' => 'recuperar-senha');
		$this->load->view('construtor', $pagina);
	}

	public function menu()
	{
		$pagina = array('tela' => 'menu', 'linkNovel'=> 'principal/menu', 'linkLogoff'=>'principal/logoff',);
		$this->load->view('construtor', $pagina);
	}

	public function controle()
	{
		$pagina = array('tela' => 'controle');
		$this->load->view('construtor', $pagina);
	}

	public function cadastrarJogador()
	{
		$pagina = array('tela' => 'cadastrar-jogador', 'linkNovel'=> 'principal/menu', 'linkLogoff'=>'principal/logoff');
		$this->load->view('construtor', $pagina);
	}


}
