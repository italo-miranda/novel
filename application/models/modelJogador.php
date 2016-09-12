<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class modelJogador extends CI_Model {

	public function __construct() {
        parent::__construct();
    }

	
	public function fazerLogin($login, $senha)
	{
		
		$this->db->select('*');
		$this->db->from('Jogador');
		$this->db->where('login', $login);
		$this->db->where('senha', $senha);
		$this->db->limit(1);
		$query = $this->db->get()->result();

		if ($query != NULL){

			$palavrasJogadas = $this->buscarGrafemasJogadosPalavra($query[0]->codJogador);
			$testesJogados = $this->buscarGrafemasJogadosTeste($query[0]->codJogador);

			//Se a consulta não for vazia, então é preciso setar os atributos de $jogador
			foreach ($query as $q) {
				$dados = array(
					'nome' => $q->nome,
					'avatar' => $q->avatar,
					'codJogador' => $q->codJogador,
					'nivel' => $q->nivel,
					'experiencia' => $q->experiencia,
					'palavrasJogadas' => $palavrasJogadas,
					'testesJogados'=> $testesJogados,
				 );
				return $dados;
			}
		}else {
			return FALSE;
		} 
	}

	public function cadastrarJogador($dados){
		$nome = $dados['nome'];
		$email = $dados['email'];
		$login = $dados['login'];
		$senha = $dados['senha1'];
		$avatar = $dados['avatar'];

		$return = FALSE;
		if($dados != NULL){
			$string = array(
			'nome'=>$nome,
			'email'=>$email,
			'login'=>$login,
			'senha'=>$senha,
			'avatar'=>$avatar,			
			);

		$retorno = $this->db->insert('Jogador', $string);
		} 
		return $retorno;	
	}

	public function subirNivel($codJogador, $pontuacao, $codGrafema, $tipoRodada){
		$retorno = NULL;						
		if (($tipoRodada == 'palavra') && ($pontuacao > 20 )){						
			$jogou = $this->verificarNivelAlcancado($codGrafema, $codJogador, $tipoRodada);				
			$nivel = $this->buscarNivelJogador($codJogador);
			$nivel = $nivel[0]->nivel;				
			if ((!$jogou) || ($jogou[0]->pontuacao < 30)) {				
				$nivel++;				
				$this->db->set('nivel', $nivel);
				$this->db->where('codJogador', $codJogador);
				$this->db->update('Jogador');
				$retorno = TRUE;			
			} else {
				$retorno = FALSE;
			}
		} elseif (($tipoRodada == 'teste') && ($pontuacao > 60 )) {
			$jogou = $this->verificarNivelAlcancado($codGrafema, $codJogador, $tipoRodada);
			$nivel = $this->buscarNivelJogador($codJogador);
			$nivel = $nivel[0]->nivel;
			if ((!$jogou) || ($jogou[0]->pontuacao < 90)) {
				$nivel++;				
				$this->db->set('nivel', $nivel);
				$this->db->where('codJogador', $codJogador);
				$this->db->update('Jogador');
				$retorno = TRUE;
			} else {
				$retorno = FALSE;
			} 
		}else {
			$retorno = FALSE;
		}
		return $retorno;
	}

	public function subirNivelTexto($codJogador, $pontuacao, $Grafemas){
		$retorno = NULL;
		if ($pontuacao > 100){

		}
	}

	public function verificarNivelAlcancado($codGrafema, $codJogador, $tipoRodada){		
			$this->db->select('MAX(pontuacao) AS pontuacao');
			$this->db->from('Rodada');
			$this->db->where('tipoRodada', $tipoRodada);
			$this->db->where('codJogador', $codJogador);
			$this->db->where('codGrafema', $codGrafema);
			$retorno = $this->db->get()->result();
			return $retorno;
	}

	//Esta função verifica se o jogador já jogou um texto que possui
    //determinados grafemas.
    public function verificarNivelAlcandadoTexto($Grafemas, $codJogador){

    	$tiposGrafemas = explode("&", $grafemas);
    	$where = '';
    	$tamanho = count($tiposGrafemas);

    	for($i = 0; $i < $tamanho; $i++) {
    		$where = $where.'g.tipoGrafema = "'. $tiposGrafemas[$i].'"';
    		if ($i < $tamanho -1){
    			$where = $where.' OR ';
    		}
    	} 
          
		$this->db->select('MAX(r.pontuacao)');
		$this->db->from('Rodada as r');
		$this->db->join('Grafema as g', 'r.codGrafema = g.codGrafema');
		$this->db->where($where);
		$this->db->where('codJogador', $codJogador);
		$this->db->group_by('r.codTexto');
		$this->db->having('COUNT(r.codGrafema)', $tamanho);
		$codTexto = $this->db->get()->result();
        
    	if($resultado){
    		return $codTexto;
    	} else {
    		return FALSE;
    	}
    }

    //Esta função deve verificar qual foi a pontuação máxima
    //do jogador em um nível. $tipoRodada pode ser de palavra, texto ou teste
    public function verificarPontuacaoMaxima($tipoRodada, $codJogador){
    	$this->db->select('MAX(pontuacao)');
    	$this->db->from('Rodada');
    	$this->db->where('tipoRodada', $tipoRodada);
    	$this->db->where('codJogador', $codJogador);
    	$retorno = $this->db->get()->result();

    	return $retorno;
    }

	public function buscarNivelJogador($codJogador){
		$this->db->select('nivel');
		$this->db->from('Jogador');
		$this->db->where('codJogador', $codJogador);
		$retorno = $this->db->get()->result();
		return $retorno;
	}

	public function verificarEmailCadastrado($email){
		$this->db->select('codJogador');
		$this->db->from('Jogador');
		$this->db->where('email', $email);
		$retorno = $this->db->get()->result();
		return $retorno;
	}

	public function buscarGrafemasJogadosPalavra($codJogador){		
		$this->db->select('g.tipoGrafema, r.pontuacao');
		$this->db->from('Rodada as r');
		$this->db->join('Grafema as g', 't.codGrafema  = g.codGrafema');
		$this->db->where('tipoRodada = palavra');
		$this->db->where('codJogador', $codJogador);
		$retorno = $this->db->get()->result();
		return $retorno;
	}

	public function buscarGrafemasJogadosTeste($codJogador){		
		$this->db->select('g.tipoGrafema, r.pontuacao');
		$this->db->from('Rodada as r');
		$this->db->join('Grafema as g', 't.codGrafema  = g.codGrafema');
		$this->db->where('tipoRodada = teste');
		$this->db->where('codJogador', $codJogador);
		$retorno = $this->db->get()->result();
		return $retorno;
	}
	
}


