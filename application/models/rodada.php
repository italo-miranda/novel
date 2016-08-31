<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rodada extends CI_Model {

	public $codRodada = 0;
	public $tipoRodada = "";
	public $duracao = 0;
	public $pontuacao = 0;	
	public $codJogador = 0;
	public $codGrafema = 0;


	function __construct() {
        parent::__construct();
    }
}