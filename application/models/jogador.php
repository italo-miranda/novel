<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jogador extends CI_Model {

	public $codJogador = 0;
	public $nome = "";
	public $email = "";
	public $login = "";	
	public $senha = "";
	public $avatar = "";
	public $tempoTotal = 0;
	public $pontuacaoTotal = 0;

	function __construct() {
        parent::__construct();
    }
}