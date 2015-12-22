<?php

namespace App\Entities;

use Doctrine\ORM\Mapping;
use Doctrine\Common\Collections\ArrayCollection;

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

	/**
     * @ManyToMany(targetEntity="Phonenumber")
     * @JoinTable(name="users_phonenumbers",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="phonenumber_id", referencedColumnName="id", unique=true)}
     *      )
     */
	protected $phonenumbers;

	public function __construct(){
		//$this->phonenumbers = new ArrayCollection();
	}

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

	public function setFirstname( $firstname ){
		$this->firstname = $firstname;
	}

	public function setLastname( $lastname ){
		$this->lastname = $lastname;
	}

	public function setEmail ( $email ){
		$this->email = $email;
	}

	public function setPassword( $password ){
		$this->password = hash('sha512', $password );
	}

	public function getPhonenumbers(){
		return $this->phonenumbers;
	}
}
?>