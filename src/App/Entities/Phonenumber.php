<?php

namespace App\Entities;

use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="phonenumbers")
 */
class Phonenumber{

	 /**
	 * @var integer
	 *
	 * @Id
	 * @Column(name="id",type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @var string
	 * @Column(type="string", length=24)
	 */
	public $number;

	public function setNumber( $number ){
		$this->number = $number;
	}

	public function getNumber( ){
		return $this->number;
	}

	public function getId(){
		return $this->id;
	}
}