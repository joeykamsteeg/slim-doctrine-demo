<?php

	namespace App\Controllers;

	use Routing\Controller;

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
	}
?>