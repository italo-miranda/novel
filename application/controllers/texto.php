<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Texto extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('array');
        $this->load->model('modelTexto');
           $this->load->model('modelJogador');
           $this->load->model('modelHistoria');
    }

	public function index()
	{		
		if ($this->session->userdata('logged_in')) {
			
			
			$nivel = $this->session->userdata('nivel');
            $cenas = $this->modelHistoria->buscarCenaPeloNivel($nivel);
			if($cenas){
				$abrirModalHistoria[] = $cenas[0]->nomeCena;
				$abrirModalHistoria[] = $cenas[0]->quadros;
			} else {
				$abrirModalHistoria = FALSE;
			}

			$grafemasTextos = $this->modelTexto->buscarListaGrafemasTexto();				
			
			$pagina = array('tela' => 'menu-texto', 
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff', 
				'abrirModalHistoria'=> $abrirModalHistoria, 
				'abrirModalGabarito' => FALSE, 
				'erro' =>FALSE,
				'grafemasTextos' => $grafemasTextos
				);

			$this->load->view('construtor', $pagina);            
        } else {
			redirect('principal/menu');
		}
	}

	public function jogarTexto()
	{
		if ($this->session->userdata('logged_in')) {
			
			$grafemas = $this->uri->segment(3);
			$grafemas = urldecode($grafemas);

			$texto = $this->modelTexto->sortearTexto($grafemas);

			if($texto){
				$codTexto = $texto[0]->codTexto;				

				$pagina = array('tela' => 'jogar-texto', 
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff',
				'texto' => $texto,
				'grafemas' => $grafemas,
				'abrirModalHistoria' => FALSE,
				);
			
			$this->load->view('construtor', $pagina); 
			} else{				
				$pagina = array('tela' => 'menu-texto', 
					'linkNovel'=> 'principal/menu', 
					'linkLogoff'=>'principal/logoff', 
					'abrirModalHistoria'=> FALSE, 
					'abrirModalGabarito' => FALSE,	
					'erro' => TRUE,
				);
			$this->load->view('construtor', $pagina); 
			}			          
        } else {	
			redirect('principal/index');
		}
	}

	public function inserirRodadaTexto(){		
		if ($this->session->userdata('logged_in')) {
			$dados = $this->input->post();			

			$tamanho = count($dados);

			$inputJogador = NULL;


			foreach ($dados as $d => $valor) {
				$indice = $d;
				$tamanho = count($dados);				
				for ($i=0; $i < $tamanho; $i++){
					$string = 'inputLetra'.$i;
					if(strcmp($indice, $string) == 0){
						$inputJogador[] = $valor;
					}
				}			
			}					
			$grafemas = $dados['grafemas']; 
			$duracao = $dados['duracao'];
			$codTexto = $dados['codTexto'];
			$gabarito = $this->modelTexto->encontrarGabarito($codTexto);
			
			$pontuacao = $this->modelTexto->calcularPontuacao($inputJogador, $gabarito);
			$this->modelJogador->subirExperiencia($codJogador, $pontuacao);

			$nivelAntigo = $this->session->userdata('nivel');
			$tipoRodada = 'texto';
			$codJogador = $this->session->userdata('codJogador');						
			$nivelNovo = $this->modelJogador->subirNivelTexto($codJogador, $pontuacao, $grafemas);				
			if($nivelNovo){
				$this->session->set_userdata('nivel', $nivelAntigo + 1);
			}

			$inseriu = $this->modelTexto->inserirRodadaTexto($grafemas, $this->session->userdata('codJogador'), $duracao, $pontuacao);

			$cenas = $this->modelHistoria->buscarCenaPeloNivel($this->session->userdata('nivel'));
			if($cenas){
				$abrirModalHistoria[] = $cenas[0]->nomeCena;
				$abrirModalHistoria[] = $cenas[0]->quadros;
			} else {
				$abrirModalHistoria = FALSE;
			}


			$pagina = array(
				'tela' => 'menu-texto',
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff', 
				'inputJogador' => $inputJogador,
				'gabarito' => $gabarito,
				'pontuacao' => $pontuacao,
				'abrirModalGabarito' => TRUE,
				'inseriu' => $inseriu,
				'abrirModalHistoria' => $abrirModalHistoria,
				'erro' => FALSE,
				);
			$this->load->view('construtor', $pagina);

		} else {
			redirect('principal/index');
		}
	}
}