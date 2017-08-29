<?php

namespace sgbdtrue\entities\cours;

use sgbdtrue\entities\prof\Prof;

class Cours
{
	/**
	 * @var int
	 */
	private $id;
	/**
	 * @var string
	 */
	private $intitule;
	/**
	 * @var int
	 */
	private $periode;
	/**
	 * @var Prof
	 */
	private $prof;
	/**
	 * @var string
	 */
	private $anneeScolaire;
	/**
	 * @return int
	 */
	public function getId(){
		return $this->id;
	}
	/**
	 * @return string
	 */
	public function getIntitule(){
		return $this->intitule;
	}
	/**
	 * @return int
	 */
	public function getPeriode(){
		return $this->periode;
	}
	/**
	 * @return Prof
	 */
	public function getProf(){
		return $this->prof;
	}
	/**
	 * @return string
	 */
	public function getAnneeScolaire(){
		return $this->anneeScolaire;
	}
	/**
	 * @param int $id
	 */
	public function setId($id){
		$this->id = (int)$id;
        if ($this->id === 0)
            $this->id = null;
	}
	/**
	 * @param string $intitule
	 */
	public function setIntitule($intitule){
		$this->intitule=$intitule;
	}
	/**
	 * @param int $periode
	 */
	public function setPeriode($periode){
		$this->periode=$periode;
	}
	/**
	 * @param Prof $prof
	 */
	public function setProf(Prof $prof){
		$this->prof=$prof;
	}
	/**
	 * @param string $anneeScolaire
	 */
	public function setAnneeScolaire($anneeScolaire){
		$this->anneeScolaire=$anneeScolaire;
	}
}