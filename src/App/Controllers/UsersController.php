<?php

	namespace App\Controllers;

	use Routing\Controller;
	use App\Entities\User;

	class UsersController extends Controller {

		/**
		 * @Route('/users')
		 * @Method('GET')
		 * @Name('users.get')
		 */
		public function getUsersAction( ){
			$users = $this->getApp()->getEntityManager()->getRepository('App\\Entities\\User')->findAll();
			$users = array_map( function( $user ){
				return $this->convertUser( $user );
			}, $users );

			$this->getApp()->sendResponse( $users );
		}

		/**
		 * @Route('/users/:id')
		 * @Method('GET')
		 * @Name('user.get')
		 */
		public function getUserAction( $id ){
			$user = $this->getApp()->getEntityManager()->find('App\\Entities\\User', $id );
			$this->getApp()->sendResponse( $this->convertUser( $user ) );
		}

		private function convertUser( $user ){
			if( is_null( $user ) ){
				return array();
			}

			return array(
				'id' => $user->getId(),
				'firstname' => $user->getFirstname(),
				'lastname' => $user->getLastname(),
				'email' => $user->getEmail()
			);
		}

		/**
		 * @Route('/users/:id')
		 * @Method('PUT')
		 * @Name('user.update')
		 */
		public function putUserAction( $id ){
			$user = $this->getApp()->getEntityManager()->find('App\Entities\User', $id );

			$user->setFirstname( $this->getRequestData('firstname') );
			$user->setLastname( $this->getRequestData('lastname') );
			$user->setEmail( $this->getRequestData('email') );

			$this->getApp()->getEntityManager()->persist( $user );
			$this->getApp()->getEntityManager()->flush();

			$this->getApp()->sendResponse( $this->convertUser( $user ) );
		}

		/**
		 * @Route('/users')
		 * @Method('POST')
		 * @Name('user.new')
		 */
		public function postUserAction(){
			$user = new User();
			$user->setFirstname( $this->getRequestData('firstname') );
			$user->setLastname( $this->getRequestData('lastname') );
			$user->setEmail( $this->getRequestData('email') );
			$user->setPassword( $this->getRequestData('password') );

			$this->getApp()->getEntityManager()->persist( $user );
			$this->getApp()->getEntityManager()->flush();

			$this->getApp()->sendResponse( $this->convertUser( $user ) );
		}
	}
?>