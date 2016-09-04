<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Palavra extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('array');
        $this->load->model('modelPalavra');
    }

	public function index()	{

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
	}

	public function jogarPalavra() 	{
		$grafema = $this->uri->segment(3);

		$retorno = $this->modelPalavra->sortearPalavras($grafema);
		
		$palavrasSorteadas = $retorno[0];
		$codGrafema = $retorno[1];

		foreach ($palavrasSorteadas as $key) {			 			
			$palavras[] = $key[0];
		}

		if($palavrasSorteadas){
			$pagina = array('tela' => 'jogar-palavra', 'linkNovel'=> 'principal/menu', 'linkLogoff'=>'principal/logoff', 'palavras'=> $palavras,'grafema'=> $grafema, 'codGrafema' => $codGrafema);
			$this->load->view('construtor', $pagina);
		}		
	}

	public function inserirRodadaPalavra(){

		$dados = elements(array('codGrafema', 'inputLetra0', 'inputLetra1', 'duracao', 'gabarito0', 'gabarito1'), $this->input->post());

		$inputJogador = array(
			'inputLetra0' => $dados['inputLetra0'],
			'inputLetra1' => $dados['inputLetra1'],
			);

		$gabarito = array(
			'gabarito0' => $dados['gabarito0'],
			'gabarito1' => $dados['gabarito1'],
			);			

		$pontuacao = $this->modelPalavra->calcularPontuacao($inputJogador, $gabarito);

		$inseriu = $this->modelPalavra->inserirRodadaPalavra($dados['codGrafema'], $this->session->userdata('codJogador'), $dados['duracao'], $pontuacao);

		$pagina = array(
			'tela' => 'menu-palavra',
			'linkNovel'=> 'principal/menu', 
			'linkLogoff'=>'principal/logoff', 
			'inputJogador' => $inputJogador,
			'gabarito' => $gabarito,
			'pontuacao' => $pontuacao,
			'abrirModal' => "TRUE",
			'inseriu' => $inseriu,
			);
		$this->load->view('construtor', $pagina);
	}
}
