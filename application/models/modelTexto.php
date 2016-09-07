<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class modelTexto extends CI_Model {

	public function __construct() {
        parent::__construct();
    }


    //Esta função deve receber o tipo do grafema,
    //buscar os textos referentes ao grafema,
    //e sortear 1 texto, que irão compor uma rodada
    public function sortearTexto($grafemas){

    	$tiposGrafemas = $this->separarGrafemas($grafemas);

    	$jogadorApto = $this->verificarJogadorGrafemas($tiposGrafemas);

    	if ($jogadorApto){

	    	$where = '';
	    	$tamanho = count($tiposGrafemas);

	    	for($i = 0; $i < $tamanho; $i++) {
	    		$where = $where.'b.tipoGrafema = "'. $tiposGrafemas[$i].'"';
	    		if ($i < $tamanho -1){
	    			$where = $where.' OR ';
	    		}
	    	}    	
	    	

    		$this->db->select('a.codTexto');
    		$this->db->from('GrafemaTexto as a');
    		$this->db->join('Grafema as b', 'a.codGrafema = b.codGrafema');
    		$this->db->where($where);
    		$this->db->group_by('a.codTexto');
    		$this->db->having('COUNT(a.codGrafema) = 3');
    		$textos = $this->db->get()->result();

			//Se a consulta não for nula
			if ($textos) {

		    	$listaCodigos = array();
		    	unset($listaCodigos);

	            //Guarda os códigos dos textos em $listaCódigos
				foreach ($textos as $lista) {
					$listaCodigos[] = $lista->codTexto;
				}
	    		
	            //Armazena os códigos dos textos e escolhe 1 aleatoreamente			
	            $selecionados = array_rand($listaCodigos, 1);            

	            //Armazena o código sorteado em $numero e pesquisa pelo 
	            //texto cujo código é igual a $numero

	            $numero = $listaCodigos[$selecionados];
	            $this->db->select('*');
	            $this->db->from('Texto');
	            $this->db->where('codTexto', $numero);                            
	            $textoSorteado = $this->db->get()->result();              	              
				return $textoSorteado;
	    	} else {
	    		return FALSE;
	    	}
	    }  else {
	    	return FALSE;
	    }         	    	        
    }

    //Esta função verifica se o jogador já passou pelos grafemas
    //que são pré-requisitos para um determinado texto.
    //Os parâmetros de entrada são os grafemas pertencentes ao texto
    public function verificarJogadorGrafemas($tiposGrafemas){

    	$where = '';
    	$tamanho = count($tiposGrafemas);

    	for($i = 0; $i < $tamanho; $i++) {
    		$where = $where.'tipoGrafema = "'. $tiposGrafemas[$i].'"';
    		if ($i < $tamanho -1){
    			$where = $where.' OR ';
    		}
    	} 
    	

    	$codJogador = $this->session->userdata('codJogador');


    	$this->db->select('COUNT(DISTINCT r.codGrafema)');
    	$this->db->from('Rodada as r');
    	$this->db->join('Grafema as g', 'r.codGrafema = g.codGrafema');
    	$this->db->where('tipoRodada = "palavra"');
    	$this->db->where($where);
    	$this->db->where('codJogador', $codJogador);
    	$this->db->limit(1);
    	$resultado = $this->db->get()->result();
    	if($resultado > 0){
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }


    //Esta função recebe um codTexto e encontra seu gabarito
    public function encontrarGabarito($codTexto){
    	$this->db->select('letraGabarito, posicao');
    	$this->db->from('Gabarito');
    	$this->db->where('codTexto', $codTexto);
    	$gabarito = $this->db->get()->result();
    	return $gabarito;
    }

    //Esta função deve receber as respostas digitadas pelo jogador
    //e o gabarito da rodada. Em seguida, deve verificar se as respostas
    //estão certas. Para cada palavra certa, o jogador recebe 10 pontos
    public function calcularPontuacao($inputJogador, $gabarito){    	
    	$pontuacao = 0;
    	$tamanho = count($gabarito);
    	for ($i = 0; $i < $tamanho ; $i++){
    		$posicao = $gabarito[$i]->posicao;
    		$letraGabarito = $gabarito[$i]->letraGabarito;
    		if ((strcmp($inputJogador[$i], $letraGabarito) == 0) && ($posicao == $i +1)){
    			$pontuacao = $pontuacao + 20;    		
    		}
    	}  
        return $pontuacao;  	    	
    }

    public function inserirRodadaTexto($grafemas, $codJogador, $duracao, $pontuacao){
    	if ($grafemas != NULL && $codJogador != NULL && $duracao != NULL && $pontuacao != NULL){
    		    	
    		$grafemaSeparado = $this->separarGrafemas($grafemas);

    		foreach ($grafemaSeparado as $gr => $valor) {
    			$codGrafema = $this->encontrarCodigoGrafema($valor);
    			$dados = array(
    			'codGrafema' => $codGrafema[0]->codGrafema,
    			'codJogador' => $codJogador,
    			'tipoRodada' => 'texto',
    			'duracao' => $duracao,
    			'pontuacao' => $pontuacao,
    			);    		

    		$this->db->insert('rodada', $dados);
    		} 
    	} else{
            return FALSE;
        }
    }

    public function separarGrafemas($grafemas){
    	$tiposGrafemas = explode("&", $grafemas);
    	return $tiposGrafemas;
    }

    public function encontrarCodigoGrafema($grafema){
    	$this->db->select('codGrafema');
    	$this->db->from('Grafema');
    	$this->db->where('tipoGrafema', $grafema);
    	$codGrafema = $this->db->get()->result();
    	return $codGrafema;
    }
}
