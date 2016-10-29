<?php 
use seguranca\modelo;

namespace seguranca\controlador ; 
	class acl{
	
		public function index(){
			include("modulos/seguranca/ACL/assets/php/database.php"); 

			//$userID = $_GET['userID'] =1;
			//$_SESSION['userID'] = 1;

			$userID = ($_GET['userID']) ? $_GET['userID'] : 1 ;

			$myACL = new \Seguranca\Modelo\Acl();
			$userACL = new \Seguranca\Modelo\Acl($userID);

			
			include 'modulos/seguranca/ACL/index.php' ;
		}

		public function admin(){
			include("modulos/seguranca/ACL/assets/php/database.php"); 

			//$userID = $_GET['userID'] =1;
			//$_SESSION['userID'] = 1;

			//$userID = ($_GET['userID']) ? $_GET['userID'] : 1 ;

			$myACL = new \Seguranca\Modelo\Acl();
			//$userACL = new \Seguranca\Modelo\Acl($userID);

			
			include 'modulos/seguranca/ACL/admin/index.php' ;
		}

		public function user(){
			include("modulos/seguranca/ACL/assets/php/database.php"); 

			//$userID = $_GET['userID'] =1;
			//$_SESSION['userID'] = 1;

			//$userID = ($_GET['userID']) ? $_GET['userID'] : 1 ;

			$myACL = new \Seguranca\Modelo\Acl();
			//$userACL = new \Seguranca\Modelo\Acl($userID);

			
			include 'modulos/seguranca/ACL/admin/users.php' ;
		}

		public function roles(){
			include("modulos/seguranca/ACL/assets/php/database.php"); 

			//$userID = $_GET['userID'] =1;
			//$_SESSION['userID'] = 1;

			//$userID = ($_GET['userID']) ? $_GET['userID'] : 1 ;

			$myACL = new \Seguranca\Modelo\Acl();
			//$userACL = new \Seguranca\Modelo\Acl($userID);

			
			include 'modulos/seguranca/ACL/admin/roles.php' ;
		}

		public function perms(){
			include("modulos/seguranca/ACL/assets/php/database.php"); 

			//$userID = $_GET['userID'] =1;
			//$_SESSION['userID'] = 1;

			//$userID = ($_GET['userID']) ? $_GET['userID'] : 1 ;

			$myACL = new \Seguranca\Modelo\Acl();
			//$userACL = new \Seguranca\Modelo\Acl($userID);

			
			include 'modulos/seguranca/ACL/admin/perms.php' ;
		}

}
