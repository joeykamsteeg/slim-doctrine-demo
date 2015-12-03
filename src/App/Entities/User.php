<?php

namespace App\Entities;

use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="users")
 */
class User{

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
	 * @Column(type="string", length=64)
	 */
	protected $firstname;


	/**
	 * @var string
	 * @Column(type="string", length=64)
	 */
	protected $lastname;

	/**
	 * @var string
	 * @Column(type="string", length=255)
	 */
	protected $email;

	/**
	 * @var string
	 * @Column(type="string", length=255)
	 */
	protected $password;

	public function getId(){
		return $this->id;
	}


	public function getFirstname(){
		return $this->firstname;
	}


	public function getLastname(){
		return $this->lastname;
	}


	public function getEmail(){
		return $this->email;
	}
}
?>