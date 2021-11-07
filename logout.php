<?php
	require_once 'autoload.inc.php';

    use App\ServiceFunctions;
    $obj = new ServiceFunctions();
	
	if($obj->getAuthontication()){		
		unset($_SESSION['userid']);
		unset($_SESSION['email']);
		unset($_SESSION['dept']);
		unset($_SESSION['role']);
		$obj->redirect('index.php');
	}else{
		$obj->redirect('index.php');
	}
	
?>
