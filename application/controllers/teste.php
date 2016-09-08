<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('array');
        $this->load->model('modelTeste');
    }



    public function index()	{
		
		if ($this->session->userdata('logged_in')) {
			$erro = $this->uri->segment(3);
        	$erro = urldecode($erro);
            $inputJogador = array('null'=> 'nulo');
			$pagina = array(
				'tela' => 'menu-teste', 
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff', 
				'abrirModal' => "FALSE",
				'inputJogador' => $inputJogador,
				'gabarito' => NULL,
				'pontuacao' => NULL,
				'erro' => $erro,
				'inseriu' => TRUE,
				);
			$this->load->view('construtor', $pagina);
        } else {
			redirect('principal/index');
		}
	}

	public function jogarTeste() 	{
			
		if ($this->session->userdata('logged_in')) {
        	$grafema = $this->uri->segment(3);
        	$grafema = urldecode($grafema);
			$retorno = $this->modelTeste->sortearTestes($grafema);			

			if($retorno){

				$testesSorteados = $retorno[0];
				$codGrafema = $retorno[1];
				$alternativas = $retorno[2];				

				foreach ($testesSorteados as $key) {			 			
					$testes[] = $key[0];					
				}

				//fazer função para mostrar a historia
				$abrirModalHistoria = FALSE;

				$pagina = array('tela' => 'jogar-teste', 
					'linkNovel'=> 'principal/menu', 
					'linkLogoff'=>'principal/logoff', 
					'testes'=> $testes,
					'codGrafema' => $codGrafema,
					'abrirModalHistoria' => $abrirModalHistoria,
					'alternativas' => $alternativas
					);

				$this->load->view('construtor', $pagina);
			} else {
				redirect('teste/index/0');
			}
        } else {
			redirect('principal/index');
		}		
	}

	public function inserirRodadaTeste(){
		if ($this->session->userdata('logged_in')) {

			$erro = $this->uri->segment(3);
        	$erro = urldecode($erro);

			$dados = $this->input->post();

			for ($i = 0; $i<5; $i++){
				$inputJogador[] = $dados['inputJogador'.$i];
			}

			for ($i = 0; $i<5; $i++){
				$gabarito[] = $dados['gabarito'.$i];
			}

			for ($i = 0; $i<5; $i++){
				$justificativa[] = $dados['justificativa'.$i];
			}

			$pontuacao = $this->modelTeste->calcularPontuacao($inputJogador, $gabarito);

			$inseriu = $this->modelTeste->inserirRodadaPalavra($dados['codGrafema'], $this->session->userdata('codJogador'), $dados['duracao'], $pontuacao);

			$pagina = array(
				'tela' => 'menu-teste',
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff', 
				'inputJogador' => $inputJogador,
				'gabarito' => $gabarito,
				'pontuacao' => $pontuacao,
				'justificativa' => $justificativa,
				'abrirModal' => "TRUE",
				'inseriu' => $inseriu,
				'erro' => $erro,
				);
			$this->load->view('construtor', $pagina);
		
        } else {
        	redirect('principal/index');
		}	
	}
}