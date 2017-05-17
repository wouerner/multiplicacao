<?php
namespace seguranca\controlador ;

use seguranca\modelo;

class acl
{
		public function index(){

			include("modulos/Seguranca/ACL/assets/php/database.php");

			$userID = !empty($_GET['userID']) ? $_GET['userID'] : 1 ;

			$myACL = new \Seguranca\Modelo\Acl();
			$userACL = new \Seguranca\Modelo\Acl($userID);

			include 'modulos/Seguranca/ACL/index.php' ;
		}

		public function admin(){
			include("modulos/Seguranca/ACL/assets/php/database.php");

			//$userID = $_GET['userID'] =1;
			//$_SESSION['userID'] = 1;

			//$userID = ($_GET['userID']) ? $_GET['userID'] : 1 ;

			$myACL = new \Seguranca\Modelo\Acl();
			//$userACL = new \Seguranca\Modelo\Acl($userID);


			include 'modulos/Seguranca/ACL/admin/index.php' ;
		}

		public function user(){
			include("modulos/Seguranca/ACL/assets/php/database.php");

			//$userID = $_GET['userID'] =1;
			//$_SESSION['userID'] = 1;

			//$userID = ($_GET['userID']) ? $_GET['userID'] : 1 ;

			$myACL = new \Seguranca\Modelo\Acl();
			//$userACL = new \Seguranca\Modelo\Acl($userID);


			include 'modulos/Seguranca/ACL/admin/users.php' ;
		}

		public function roles(){
			include("modulos/Seguranca/ACL/assets/php/database.php");

			//$userID = $_GET['userID'] =1;
			//$_SESSION['userID'] = 1;

			//$userID = ($_GET['userID']) ? $_GET['userID'] : 1 ;

			$myACL = new \Seguranca\Modelo\Acl();
			//$userACL = new \Seguranca\Modelo\Acl($userID);


			include 'modulos/Seguranca/ACL/admin/roles.php' ;
		}

		public function perms(){
			include("modulos/Seguranca/ACL/assets/php/database.php");

			//$userID = $_GET['userID'] =1;
			//$_SESSION['userID'] = 1;

			//$userID = ($_GET['userID']) ? $_GET['userID'] : 1 ;

			$myACL = new \Seguranca\Modelo\Acl();
			//$userACL = new \Seguranca\Modelo\Acl($userID);


			include 'modulos/Seguranca/ACL/admin/perms.php' ;
		}

}
