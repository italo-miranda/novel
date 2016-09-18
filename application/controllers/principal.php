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
		if ($this->session->userdata('logged_in')) {
            redirect('principal/menu');
        } else {        	
			$pagina = array('tela' => 'index', 'erro' => FALSE, 'abrirModalHistoria'=> FALSE,);
			$this->load->view('construtor', $pagina);
		}
	}


	public function login()
	{

		if ($this->session->userdata('logged_in')) {
            redirect('principal/menu');
        } else{ 			       			
			$pagina = array('tela' => 'index', 'erro'=> FALSE, 'abrirModalHistoria'=> FALSE,);
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
	                    'nivel' => $login['nivel'],
	                    'experiencia' => $login['experiencia'],
	                ));
		    	redirect('principal/menu');
		    } else {
		    	$pagina = array('tela' => 'index', 'erro'=> TRUE, 'abrirModalHistoria'=> FALSE,);
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

		if ($this->session->userdata('logged_in')) {
            redirect('principal/index');
        } else {			
			$pagina = array('tela' => 'recuperar-senha', 'abrirModalHistoria'=> FALSE,);
			$this->load->view('construtor', $pagina);	
		}
	}

	public function menu()
	{		
		if ($this->session->userdata('logged_in')) {		
        	$pagina = array('tela' => 'menu', 'linkNovel'=> 'principal/menu', 'linkLogoff'=>'principal/logoff', 'abrirModalHistoria'=> FALSE,);
			$this->load->view('construtor', $pagina);    
        } else {
			redirect('principal/index');
		}
	}

	public function controle()
	{
		$pagina = array('tela' => 'controle');
		$this->load->view('construtor', $pagina);
	}

	public function cadastrarJogador()
	{					
		if ($this->session->userdata('logged_in')) {
        	redirect('principal/menu');    
        } else {
			$pagina = array('tela' => 'cadastrar-jogador', 'erro' => FALSE, 'existe' => FALSE, 'abrirModalHistoria'=> FALSE,);
			$this->load->view('construtor', $pagina);
		}
	}

	public function realizarCadastro(){
		if ($this->session->userdata('logged_in')) {
        	redirect('principal/menu');    
        } else {
        	$dados = $this->input->post();
        	$existe = $this->modelJogador->verificarEmailCadastrado($dados['email']);

        	if ($existe){
        		$pagina = array('tela' => 'cadastrar-jogador', 'erro' => FALSE, 'existe'=> TRUE, 'abrirModalHistoria'=> FALSE,);
				$this->load->view('construtor', $pagina);
        	} else {
        		$retorno = $this->modelJogador->cadastrarJogador($dados);			
				if($retorno){
					$this->loginCadastro($dados['login'], $dados['senha1']);
				} else {
					$pagina = array('tela' => 'cadastrar-jogador', 'erro' => TRUE, 'existe' => FALSE, 'abrirModalHistoria'=> FALSE,);
					$this->load->view('construtor', $pagina);		
				}
        	}
		}		
	}

	public function loginCadastro($login, $senha){
		$logou = $this->modelJogador->fazerLogin($login, $senha);
		    	        
		    if($logou){	        	
		    	$this->session->set_userdata(array(
	                    'codJogador' => $logou['codJogador'],
	                    'avatar' => $logou['avatar'],
	                    'nome' => $logou['nome'],	                    
	                    'logged_in' => TRUE,
	                    'nivel' => $logou['nivel'],
	                    'experiencia' => $logou['experiencia'],
	                ));
		    	redirect('principal/menu');
		    } else {
		    	$pagina = array('tela' => 'index', 'erro'=> TRUE, 'abrirModalHistoria'=> FALSE,);
				$this->load->view('construtor', $pagina);
		    }
	}

	public function meusPontos(){

		if ($this->session->userdata('logged_in')){
			
			$codJogador = $this->session->userdata('codJogador');
			$dadosPalavras = $this->modelJogador->buscarHistoricoPalavra($codJogador);
			$dadosTestes = $this->modelJogador->buscarHistoricoTeste($codJogador);
			$dadosTextos = $this->modelJogador->buscarHistoricoTexto($codJogador);
			$tempoTotal = $this->modelJogador->buscarTempoTotal($codJogador);
			$experiencia = $this->modelJogador->buscarExperienciaJogador($codJogador);
			$conquistas = $this->modelJogador->buscarConquistasJogador($codJogador);


			$pagina = array('tela' => 'meus-pontos', 
				'erro' => FALSE,
				'abrirModalHistoria'=> FALSE,
				'dadosPalavras' => $dadosPalavras,
				'dadosTestes' =>$dadosTestes,
				'dadosTextos' => $dadosTextos,
				'tempoTotal' =>$tempoTotal,
				'experiencia' =>$experiencia,
				'conquistas' =>$conquistas,
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff'
				);
			
			$this->load->view('construtor', $pagina);
		} else {
			redirect('principal/index');
		}
	}

	public function minhaConta(){
		if ($this->session->userdata('logged_in')){
			$codJogador = $this->session->userdata('codJogador');
			$jogador = $this->modelJogador->buscarDadosJogador($codJogador);

			$pagina = array('tela' => 'minha-conta', 
				'erro' => FALSE,
				'abrirModalHistoria'=> FALSE,
				'jogador' => $jogador,
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff'
				);
			
			$this->load->view('construtor', $pagina);
		} else {
			redirect('principal/index');
		}
	}
}
