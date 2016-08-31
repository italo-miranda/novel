<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Palavra extends CI_Model {

	public $codPalavra = 0;
	public $enunciado = "";
	public $letraGabarito = "";
	public $palavraIncompleta = "";	
	public $imagem = "";
	public $codGrafema = "";	

	function __construct() {
        parent::__construct();
    }
}