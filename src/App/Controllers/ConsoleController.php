<?php

	namespace App\Controllers;

	use Routing\Controller;
	use Doctrine\ORM\Tools\SchemaTool;
	use Doctrine\ORM\Tools\Console\ConsoleRunner;

	class ConsoleController extends Controller {
		/**
		 * @Route('/console/createschema')
		 * @Method('GET')
		 * @Name('console.createschema')
		 */
		public function CreateSchema(){
			$entity = $this->getApp()->getEntityManager();
			$tool = new SchemaTool( $entity );

			$tool->createSchema( array (
				$entity->getClassMetadata( 'App\\Entities\\User' )
			) );
		}

		/**
		 * @Route('/console/updateschema')
		 * @Method('GET')
		 * @Name('console.updateschema')
		 */
		public function UpdateSchema(){
			$entity = $this->getApp()->getEntityManager();
			$tool = new SchemaTool( $entity );

			$tool->updateSchema( array (
				$entity->getClassMetadata( 'App\\Entities\\User' )
			) );
		}

		/**
		 * @Route('/console/createhelpers')
		 * @Method('GET')
		 * @Name('console.createhelpers')
		 */
		public function CreateHelpers(){
			ConsoleRunner::createHelperSet( $this->getApp()->getEntityManager() );
		}
	}
?>