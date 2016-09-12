<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class modelHistoria extends CI_Model {

	public function __construct() {
        parent::__construct();
    }

    public function buscarCenaPeloNivel($nivel){
    	$this->db->select('nomeCena, quadros');
    	$this->db->from('Cenas');
    	$this->db->where('nivelDesbloqueio', $nivel);
    	$this->db->limit(1);
    	$retorno = $this->db->get()->result();
    	return $retorno;
    }

}
