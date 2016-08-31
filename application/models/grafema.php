<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Grafema extends CI_Model {

	public $codGrafema = 0;
	public $regra = "";
	public $homonimoParonimo = "";
	public $excecoes = "";	
	public $tipoGrafema = "";

	
	function __construct() {
        parent::__construct();
    }
}