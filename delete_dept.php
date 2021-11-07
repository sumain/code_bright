<?php 
require_once 'autoload.inc.php';

    use App\ServiceFunctions;
    $obj = new ServiceFunctions();
	
	if($obj->getAuthontication()){
		if($_SESSION['category'] =='Admin'){
			$id = $_GET['id'];
			$obj->deleteQuery('departments',['id'=>$id]);
		}
		$obj->redirect('departments.php');
	}else{
		$obj->redirect('index.php');
	}
	
?>