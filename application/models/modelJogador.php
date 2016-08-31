<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include 'jogador.php';
include 'rodada.php';

class modelJogador extends CI_Model {

	public  $jogador = NULL;
	public  $rodada = NULL;

	public function __construct() {
        parent::__construct();
        $jogador = new Jogador;
		$rodada = new Rodada;
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
		//Define string que será usada na função query do codeigniter
		$consulta = "SELECT `*` FROM `Jogador` WHERE `login`='{$login}' AND `senha`= '{$senha}' LIMIT 1";

		//Define que $query recebe o resultado da consulta feita utilizando $consulta
		$query = $this->db->query($consulta);
		
		//Se a consulta não for vazia, então é preciso setar os atributos de $jogador
		if ($query){
			$this->jogador->setCodJogador($query->codJogador);
			$this->jogador->setNome($query->nome);
			$this->jogador->setEmail($query->email);
			$this->jogador->setLogin($query->login);
			$this->jogador->setSenha($query->senha);
			$this->jogador->setAvatar($query->avatar);
			$this->jogador->setTempoTotal($query->tempoTotal);
			$this->jogador->setPontuacaoTotal($query->pontuacaoTotal);

			$dados = array(
				'nome' => $this->getNome,
				'avatar' => $this->getAvatar,
				'codJogador' => $this->getCodJogador,
			 );

			return $dados;

		} else {
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

		$this->jogador->codJogador = $codJogador;
	}

	protected function setEmail($email){
		$this->jogador->email = $email;
	}

	protected function setNome($nome){

		$this->jogador->nome = $nome;
	}

	protected function setlogin($login){
		$this->jogador->login = $login;
	}

	protected function setSenha($senha){
		$this->jogador->senha = $senha;
	}

	protected function setAvatar($avatar){
		$this->jogador->avatar = $avatar;
	}

	protected function setTempoTotal($tempoTotal){
		$this->jogador->TempoTotal = $tempoTotal;
	}

	protected function setPontuacaoTotal($pontuacaoTotal){
		$this->jogador->pontuacaoTotal = $pontuacaoTotal;
	}
	
}
