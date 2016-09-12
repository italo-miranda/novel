<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teste extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('array');
        $this->load->model('modelTeste');
        $this->load->model('modelJogador');
        $this->load->model('modelHistoria');
    }



    public function index()	{
		
		if ($this->session->userdata('logged_in')) {
			$erro = $this->uri->segment(3);
        	$erro = urldecode($erro);
            $inputJogador = array('null'=> 'nulo');

            $nivel = $this->session->userdata('nivel');
            $cenas = $this->modelHistoria->buscarCenaPeloNivel($nivel);
			if($cenas){
				$abrirModalHistoria[] = $cenas[0]->nomeCena;
				$abrirModalHistoria[] = $cenas[0]->quadros;
			} else {
				$abrirModalHistoria = FALSE;
			}
			
			$pagina = array(
				'tela' => 'menu-teste', 
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff', 
				'abrirModalGabarito' => FALSE,
				'abrirModalHistoria' => $abrirModalHistoria,
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


				$pagina = array('tela' => 'jogar-teste', 
					'linkNovel'=> 'principal/menu', 
					'linkLogoff'=>'principal/logoff', 
					'testes'=> $testes,
					'codGrafema' => $codGrafema,					
					'alternativas' => $alternativas,
					'abrirModalHistoria'=> FALSE,
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

			$codGrafema = $dados['codGrafema'];
			$codJogador = $this->session->userdata('codJogador');
			$tipoRodada = 'teste';			
			$pontuacao = $this->modelTeste->calcularPontuacao($inputJogador, $gabarito);

			$nivelAntigo = $this->session->userdata('nivel');

			$nivelNovo = $this->modelJogador->subirNivel($codJogador, $pontuacao, $codGrafema, $tipoRodada);	

			if($nivelNovo){
				$this->session->set_userdata('nivel', $nivelAntigo + 1);
			}

			$inseriu = $this->modelTeste->inserirRodadaTeste($dados['codGrafema'], $codJogador, $dados['duracao'], $pontuacao);
			
            $cenas = $this->modelHistoria->buscarCenaPeloNivel($this->session->userdata('nivel'));
			if($cenas){
				$abrirModalHistoria[] = $cenas[0]->nomeCena;
				$abrirModalHistoria[] = $cenas[0]->quadros;
			} else {
				$abrirModalHistoria = FALSE;
			}

			$pagina = array(
				'tela' => 'menu-teste',
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff', 
				'inputJogador' => $inputJogador,
				'gabarito' => $gabarito,
				'pontuacao' => $pontuacao,
				'abrirModalGabarito' => TRUE,				
				'abrirModalHistoria'=> $abrirModalHistoria,
				'erro' => $erro,				
				);
			$this->load->view('construtor', $pagina);
		
        } else {
        	redirect('principal/index');
		}	
	}
}