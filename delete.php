<?php 
	require_once 'autoload.inc.php';

    use App\ServiceFunctions;
    $obj = new ServiceFunctions();
	
	if($obj->getAuthontication()){
		if($_SESSION['category'] =='Admin'){
			$id = $_GET['id'];
			$obj->deleteQuery('employee',['id'=>$id]);
		}
		$obj->redirect('employee.php');
	}else{
		$obj->redirect('index.php');
	}
	
?>