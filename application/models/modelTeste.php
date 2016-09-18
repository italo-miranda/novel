<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class modelTeste extends CI_Model {

	public function __construct() {
        parent::__construct();
    }

    //Esta função deve receber o tipo do grafema,
    //buscar as palavras referentes ao grafema,
    //e sortear 5 palavras, que irão compor uma rodada
    public function sortearTestes($tipoGrafema){

        $retorno = NULL;
                    	
    	$codigo = $this->buscarCodigoPeloTipo($tipoGrafema);

        if ($codigo){
            $codGrafema = $codigo[0]->codGrafema;                           
            $listaTestes = $this->buscarConjuntoTestes($codGrafema);  
            
            //Se a consulta não for nula
            if ($listaTestes) {
                $qtd = 0;
                $listaCodigos = array();
                unset($listaCodigos);

                //Guarda os códigos das palavras em $listaCódigos
                foreach ($listaTestes as $list) {
                    $listaCodigos[] = $list->codTeste;
                    $qtd++;
                }
            
                //Armazena os códigos das palavras e escolhe 5 aleatoreamente           
                $selecionados = array_rand($listaCodigos, 5);            
                $testesSorteados = array();
                unset($testesSorteados);
                $alternativas = array();
                unset($alternativas);

                //Armazena as palavras escolhidas em $palavrasSorteadas
                for ($i=0; $i < 5; $i++) { 
                    $numero = $listaCodigos[$selecionados[$i]];                            
                    $testesSorteados[] = $this->buscarTestePeloCodigo($numero);
                    $alternativas[] = $this-> buscarAlternativasPeloCodigoTeste($numero);                                  
                }
                

                $retorno[] = $testesSorteados;                
                $retorno[] = $codGrafema;
                $retorno[] = $alternativas;
                return $retorno;
            } else {
                $retorno = FALSE;
            }
        } else {
            $retorno = FALSE;
        }		         	    

        return $retorno;
    }

    //Esta função deve receber as respostas escolhidas pelo jogador
    //e o gabarito da rodada. Em seguida, deve verificar se as respostas
    //estão certas. Para cada palavra certa, o jogador recebe 30 pontos
    public function calcularPontuacao($inputJogador, $gabarito){
    	$pontuacao = 0;
    	for ($i = 0; $i < 5 ; $i++){
    		if (strcasecmp($inputJogador[$i], $gabarito[$i]) == 0){
    			$pontuacao = $pontuacao + 30;    		
    		}
    	}
    	return $pontuacao;
    }

    //Esta função recebe os dados de uma rodada e os armazena no banco de dados
    public function inserirRodadaTeste($codGrafema, $codJogador, $duracao, $pontuacao){
    	if ($codGrafema != NULL && $codJogador != NULL && $duracao != NULL && $pontuacao != NULL){
    		$dados = array(
    			'codGrafema' => $codGrafema,
    			'codJogador' => $codJogador,
    			'tipoRodada' => 'teste',
    			'duracao' => $duracao,
    			'pontuacao' => $pontuacao,
    			);

    		$this->db->insert('rodada', $dados);
            $this->adicionarTempo($codJogador, $duracao);
            return TRUE;
    	} else{
            return FALSE;
        }
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

    //Busca todos os códigos dos testes referentes ao código do grafema
    public function buscarConjuntoTestes($codGrafema){             
        $this->db->select('codTeste');
        $this->db->from('Teste');
        $this->db->where('codGrafema', $codGrafema);                            
        $listaTestes = $this->db->get()->result(); 
        return $listaTestes;
    }

    //Busca uma palavra utilizando como parâmetro o seu código
    public function buscarTestePeloCodigo($codTeste){
        $this->db->select('*');
        $this->db->from('Teste');
        $this->db->where('codTeste', $codTeste);                            
        $teste = $this->db->get()->result(); 
        return $teste;
    }

    //Busca do código do grafema pelo tipo do Grafema
    public function buscarCodigoPeloTipo($tipoGrafema){
        $this->db->select('codGrafema');
        $this->db->from('Grafema');
        $this->db->where('tipoGrafema', $tipoGrafema);
        $this->db->limit(1);
        $codigo = $this->db->get()->result();
        return $codigo;
    }

    public function buscarAlternativasPeloCodigoTeste($codTeste){
        $this->db->select('alternativa');
        $this->db->from('Alternativas');
        $this->db->where('codTeste', $codTeste);        
        $alternativas = $this->db->get()->result();
        return $alternativas;
    }
}
