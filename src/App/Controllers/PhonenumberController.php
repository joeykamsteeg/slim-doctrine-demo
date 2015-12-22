<?php

	namespace App\Controllers;

	use Routing\Controller;
	use App\Entities\Phonenumber;

	class PhonenumberController extends Controller {

		/**
		 * @Route('/phonenumbers')
		 * @Method('GET')
		 * @Name('get.phonenumbers')
		 */
		public function getPhonenumbers(){
			$phonenumbers = $this->getApp()->getEntityManager()->getRepository('App\\Entities\\Phonenumber')->findAll();
			$phonenumbers = array_map( function( $phonenumber ){
				return $this->convertPhonenumber( $phonenumber );
			}, $phonenumbers );

			$this->getApp()->sendResponse( $phonenumbers );
		}

		/**
		 * @Route('/phonenumbers')
		 * @Method('POST')
		 * @Name('post.phonenumbers')
		 */
		public function postPhonenumber(){
			$phonenumber = new Phonenumber();
			$phonenumber->setNumber( $this->getRequestData('number') );

			$this->getApp()->getEntityManager()->persist( $phonenumber );
			$this->getApp()->getEntityManager()->flush();

			$this->getApp()->sendResponse( $this->convertPhonenumber( $phonenumber ) );
		}

		private function convertPhonenumber( $phonenumber ){
			if( is_null( $phonenumber ) ){
				return array();
			}

			return array(
				'id' => $phonenumber->getId(),
				'firstname' => $phonenumber->getNumber()
			);
		}

	}
?>