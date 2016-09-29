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

	    	$textos = $this->buscarCodigoTextoPelosGrafemas($tiposGrafemas);

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

    public function buscarCodigoTextoPelosGrafemas($tiposGrafemas){
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
        $this->db->having('COUNT(a.codGrafema)', $tamanho);
        $retorno = $this->db->get()->result();
        return $retorno;
    }

    public function adicionarTempo($codJogador, $tempo){
        $this->db->select('tempoTotal');
        $this->db->from('Jogador');
        $this->db->where('codJogador', $codJogador);
        
        $tempoAntigo = $this->db->get()->result();
        $tempoNovo = $tempoAntigo[0]->tempoTotal + $tempo;
        
        $this->db->set('tempoTotal', $tempoNovo);        
        $this->db->where('codJogador', $codJogador);
        $this->db->update('Jogador');
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

    	$this->db->select('COUNT(DISTINCT r.codGrafema) as qtd');
    	$this->db->from('Rodada as r');
    	$this->db->join('Grafema as g', 'r.codGrafema = g.codGrafema');
    	$this->db->where('tipoRodada = "palavra"');
    	$this->db->where($where);
    	$this->db->where('codJogador', $codJogador);
    	$this->db->limit(1);
    	$resultado = $this->db->get()->result();        
        
    	if($resultado[0]->qtd == $tamanho){
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
    		if ((strcasecmp($inputJogador[$i], $letraGabarito) == 0) && ($posicao == $i +1)){
    			$pontuacao = $pontuacao + 20;    		
    		}
    	}  
        return $pontuacao;  	    	
    }

    public function inserirRodadaTexto($grafemas, $codJogador, $duracao, $pontuacao, $codTexto){
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

            $this->adicionarTempo($codJogador, $duracao);
            $dados = array(
                'codTexto'=>$codTexto,
                'codJogador'=>$codJogador
            );

            $this->db->insert('JogadorTexto', $dados);  
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

    public function buscarListaGrafemasTexto(){        
        $retorno = NULL;
        $codigos = $this->buscarListaCodigosTexto();         
        foreach ($codigos as $key) { 
           $separados = $this->buscarGrafemaPeloCodigoTexto($key->codTexto);           
           $retorno[] = $this->juntarGrafemas($separados);                   
        }        
        return $retorno;
    }

    public function buscarGrafemasJogadosTexto($codJogador){
        $this->db->select('codTexto');
        $this->db->from('JogadorTexto');
        $this->db->where('codJogador', $codJogador);
        $this->db->group_by('codTexto');
        $listaCodigos = $this->db->get()->result();         
        $juntos = NULL;      
        foreach ($listaCodigos as $key) {  

            $pontuacao = $this->buscarPontuacaoPeloCodigoTexto($key->codTexto, $codJogador);

            $passou = $this->verificarPontuacaoSuperiorTexto($key->codTexto, $pontuacao);             
            if($passou){
                $separados = $this->buscarGrafemaPeloCodigoTexto($key->codTexto);                                 
                $juntos[] = $this->juntarGrafemas($separados);            
            }    
        }

        $unicos = $this->coletarGrafemasUnicosTexto($juntos);         
        return $unicos;        
    }

    public function buscarPontuacaoPeloCodigoTexto($codTexto, $codJogador){
        $this->db->select('MAX(r.pontuacao) as pontuacao');
        $this->db->from('Rodada r');
        $this->db->join('GrafemaTexto gt', 'r.codGrafema = gt.codGrafema');
        $this->db->where('r.codJogador', $codJogador);
        $this->db->where('gt.codTexto', $codTexto);
        $retorno = $this->db->get()->result();        
        return $retorno;
    }

    public function verificarPontuacaoSuperiorTexto($codTexto, $pontuacao){
        $retorno = FALSE;
        if(($codTexto != NULL) && ($pontuacao != NULL)){
            $qtd = $this->buscarQuantidadeGabaritoTexto($codTexto);
            $media = floor($qtd[0]->qtd*12); //12 é 0,6*20 (60% de 20 pontos)
            if ($pontuacao > $media){
                $retorno = TRUE;
            }
        }
        return $retorno;
    }

    public function buscarQuantidadeGabaritoTexto($codTexto){
        $this->db->select('count(codGabarito) as qtd');
        $this->db->from('Gabarito');
        $this->db->where('codTexto', $codTexto);
        $retorno = $this->db->get()->result();
        return $retorno;
    }   

    public function buscarGrafemaPeloCodigoTexto($codTexto){        
        $this->db->select('g.tipoGrafema');
        $this->db->from('Grafema g');
        $this->db->join('GrafemaTexto gt', 'g.codGrafema = gt.codGrafema');        
        $this->db->where('gt.codTexto', $codTexto);
        $this->db->order_by('g.tipoGrafema', 'ASC');
        $retorno= $this->db->get()->result();

        return $retorno;
    }

    public function buscarListaCodigosTexto(){
        $this->db->select('codTexto');
        $this->db->from('Texto');
        $retorno = $this->db->get()->result();
        return $retorno;
    }

    public function juntarGrafemas($separados){
        $retorno = NULL;
        $tamanho = count($separados);
        for ($i=0; $i < $tamanho; $i++) { 
            if($i == 0){
                $retorno = $retorno.$separados[$i]->tipoGrafema; 
            } else{
                $retorno = $retorno.'&'.$separados[$i]->tipoGrafema; 
            }
        }        

        return $retorno;
    }  

    public function coletarGrafemasUnicosTexto($listaGrafemas){
        $retorno = array();
        $tamListaGrafemas = count($listaGrafemas);         
        for ($i=1; $i < $tamListaGrafemas; $i++) { 
            if(!array_search($listaGrafemas[$i], $retorno)){
                $retorno[] = $listaGrafemas[$i];
            }                                                               
        }

        return $retorno;
    }

}
