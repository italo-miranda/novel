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

    public function buscarNovaConquista($experiencia, $codJogador){
        $ultimaConquista = $this->buscarUltimaConquistaJogador($codJogador);        
        $novaConquista = $ultimaConquista[0]->codConquista + 1;
        $experienciaNecessaria = $this->buscarExperienciaNecessaria($novaConquista);
        if ($experiencia >= $experienciaNecessaria){
            $string = array('codConquista'=> $novaConquista, 'codJogador'=>$codJogador);
            $this->db->insert('ConquistaJogador', $string);
            return $novaConquista;
        } else {
            return 0;
        }        
    }

    public function buscarUltimaConquistaJogador($codJogador){
        $this->db->select('MAX(codConquista) as codConquista');
        $this->db->from('ConquistaJogador');
        $this->db->where('codJogador', $codJogador);
        $retorno = $this->db->get()->result();
        return $retorno;
    }

    public function buscarExperienciaNecessaria($codConquista){
        $this->db->select('experienciaDesbloqueio');
        $this->db->from('Conquista');
        $this->db->where('codConquista', $codConquista);
        $retorno = $this->db->get()->result();
        return $retorno;
    }

}
