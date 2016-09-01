<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include 'jogador.php';
include 'rodada.php';

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

	//Getters

	protected function getCodJogador(){
		return $jogador->codJogador;
	}

	protected function getNome(){
		return $jogador->nome;
	}

	protected function getEmail(){
		return $jogador->email;
	}

	protected function getlogin(){
		return $jogador->login;
	}

	protected function getSenha(){
		return $jogador->senha;
	}

	protected function getAvatar(){
		return $jogador->avatar;
	}

	protected function getTempoTotal(){
		return $jogador->senha;
	}

	protected function getPontuacaoTotal(){
		return $jogador->senha;
	}

	//Setters

	protected function setCodJogador($codJogador){
		$jogador->codJogador = $codJogador;
	}

	protected function setEmail($email){
		$jogador->email = $email;
	}

	protected function setNome($nome){

		$jogador->nome = $nome;
	}

	protected function setlogin($login){
		$jogador->login = $login;
	}

	protected function setSenha($senha){
		$jogador->senha = $senha;
	}

	protected function setAvatar($avatar){
		$jogador->avatar = $avatar;
	}

	protected function setTempoTotal($tempoTotal){
		$jogador->TempoTotal = $tempoTotal;
	}

	protected function setPontuacaoTotal($pontuacaoTotal){
		$jogador->pontuacaoTotal = $pontuacaoTotal;
	}
	
}
