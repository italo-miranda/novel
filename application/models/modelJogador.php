<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class modelJogador extends CI_Model {

	public function __construct() {
        parent::__construct();
    }

	

	/*
	Esta função é genérica. Serve para qualquer tipo de rodada.
	Isto deve evitar que se tenha uma função para cada tipo de
	nível do jogo.
	*/

	public function jogarRodada($grafemas, $tipoRodada)
	{
		$this->rodada->jogar($this->codJogador, $grafemas, $tipoRodada);
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

			//Se a consulta não for vazia, então é preciso setar os atributos de $jogador
			foreach ($query as $q) {
				$dados = array(
					'nome' => $q->nome,
					'avatar' => $q->avatar,
					'codJogador' => $q->codJogador,
				 );
				return $dados;
			}
		}else {
			return FALSE;
		} 
	}
	
}
