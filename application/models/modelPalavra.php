<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class modelPalavra extends CI_Model {

	public function __construct() {
        parent::__construct();
    }



    public function sortearPalavras($tipoGrafema){

    	$this->db->select('codGrafema');
    	$this->db->from('Grafema');
    	$this->db->where('tipoGrafema', $tipoGrafema);
    	$this->db->limit(1);
    	$codigo = $this->db->get()->result();
    	        	
		$codGrafema = $codigo[0]->codGrafema;		
	   	$this->db->select('codPalavra');
    	$this->db->from('Palavra');
    	$this->db->where('codGrafema', $codGrafema);     			    		
    	$listaPalavras = $this->db->get()->result();    	    	

		if ($listaPalavras) {

			$qtd = 0;
	    	$listaCodigos = array();
	    	unset($listaCodigos);


			foreach ($listaPalavras as $list) {
				$listaCodigos[] = $list->codPalavra;
				$qtd++;
			}
    	

			$selecionados = array_rand($listaCodigos, $qtd);	
			$palavrasSorteadas = array();
			unset($palavrasSorteadas);
			for ($i=0; $i < 2; $i++) { 
				
				$numero = $listaCodigos[$selecionados[$i]];
				$this->db->select('enunciado, codPalavra, imagem, palavraIncompleta, letraGabarito');
		    	$this->db->from('Palavra');
		    	$this->db->where('codPalavra', $numero);     			    		
		    	$palavrasSorteadas[] = $this->db->get()->result();				
			}
			$retorno = NULL;
			unset($retorno);
			$retorno[] = $palavrasSorteadas;
			$retorno[] = $codGrafema;
			return $retorno;
    	} else {
    		return FALSE;
    	}
    }

    public function calcularPontuacao($inputJogador, $gabarito){
    	$pontuacao = 0;
    	for ($i = 0; $i < 2 ; $i++){
    		if (strcmp($inputJogador['inputLetra'.$i], $gabarito['gabarito'.$i]) == 0){
    			$pontuacao = $pontuacao + 10;    		
    		}
    	}
    	return $pontuacao;
    }

    public function inserirRodadaPalavra($codGrafema, $codJogador, $duracao, $pontuacao){
    	if ($codGrafema != NULL && $codJogador != NULL && $duracao != NULL && $pontuacao != NULL){
    		$dados = array(
    			'codGrafema' => $codGrafema,
    			'codJogador' => $codJogador,
    			'tipoRodada' => 'palavra',
    			'duracao' => $duracao,
    			'pontuacao' => $pontuacao,
    			);

    		$this->db->insert('rodada', $dados);
    	}
    }



	
}
