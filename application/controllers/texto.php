<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Texto extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->helper('array');
        $this->load->model('modelTexto');
    }

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			$pagina = array('tela' => 'menu-texto', 'linkNovel'=> 'principal/menu', 'linkLogoff'=>'principal/logoff');
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
				);
			
			$this->load->view('construtor', $pagina); 
			} else{
				echo "Não encontrado!";
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
			$inseriu = $this->modelTexto->inserirRodadaTexto($grafemas, $this->session->userdata('codJogador'), $duracao, $pontuacao);

			$pagina = array(
				'tela' => 'menu-texto',
				'linkNovel'=> 'principal/menu', 
				'linkLogoff'=>'principal/logoff', 
				'inputJogador' => $inputJogador,
				'gabarito' => $gabarito,
				'pontuacao' => $pontuacao,
				'abrirModal' => "TRUE",
				'inseriu' => $inseriu,
				);
			$this->load->view('construtor', $pagina);

		} else {
			redirect('principal/index');
		}
	}
}