<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Palavra extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('array');
        $this->load->model('modelPalavra');
    }

	public function index()	{
		
		if ($this->session->userdata('logged_in')) {
            $inputJogador = array('null'=> 'nulo');
			$pagina = array(
				'tela' => 'menu-palavra', 
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff', 
				'abrirModal' => "FALSE",
				'inputJogador' => $inputJogador,
				'gabarito' => NULL,
				'pontuacao' => NULL,
				);
			$this->load->view('construtor', $pagina);
        } else {
			redirect('principal/index');
		}
	}

	public function jogarPalavra() 	{
			
		if ($this->session->userdata('logged_in')) {
        	$grafema = $this->uri->segment(3);
        	$grafema = urldecode($grafema);
			$retorno = $this->modelPalavra->sortearPalavras($grafema);
			
			if($retorno){

				$palavrasSorteadas = $retorno[0];
				$codGrafema = $retorno[1];				

				foreach ($palavrasSorteadas as $key) {			 			
					$palavras[] = $key[0];					
				}

				$pagina = array('tela' => 'jogar-palavra', 
					'linkNovel'=> 'principal/menu', 
					'linkLogoff'=>'principal/logoff', 
					'palavras'=> $palavras,
					'grafema'=> $grafema, 
					'codGrafema' => $codGrafema);

				$this->load->view('construtor', $pagina);
			}
        } else {
			redirect('principal/index');
		}		
	}

	public function inserirRodadaPalavra(){
		if ($this->session->userdata('logged_in')) {

			$dados = $this->input->post();

			for ($i = 0; $i<5; $i++){
				$inputJogador[] = $dados['inputLetra'.$i];
			}

			for ($i = 0; $i<5; $i++){
				$gabarito[] = $dados['gabarito'.$i];
			}

			for ($i = 0; $i<5; $i++){
				$justificativa[] = $dados['justificativa'.$i];
			}

			$pontuacao = $this->modelPalavra->calcularPontuacao($inputJogador, $gabarito);

			$inseriu = $this->modelPalavra->inserirRodadaPalavra($dados['codGrafema'], $this->session->userdata('codJogador'), $dados['duracao'], $pontuacao);

			$pagina = array(
				'tela' => 'menu-palavra',
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff', 
				'inputJogador' => $inputJogador,
				'gabarito' => $gabarito,
				'pontuacao' => $pontuacao,
				'justificativa' => $justificativa,
				'abrirModal' => "TRUE",
				'inseriu' => $inseriu,
				);
			$this->load->view('construtor', $pagina);
		
        } else {
        	redirect('principal/index');
		}	
	}
}
