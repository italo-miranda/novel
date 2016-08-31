<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Texto extends CI_Model {

	public $codTexto = 0;
	public $textoIncompleto = "";
	public $imagem = NULL;
	public $codGrafema = 0;
	public senha = "";
	public $avatar = "";
	public $tempoTotal = 0;
	public $pontuacaoTotal = 0;

	function __construct() {
        parent::__construct();
    }
}