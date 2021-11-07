<?php 

	require_once 'autoload.inc.php';

    use App\ServiceFunctions;
    $obj = new ServiceFunctions();
	
	//$obj->printr($_SESSION);
	if(!$obj->getAuthontication()){
		$obj->redirect('index.php');
		//echo $obj->getAuthontication();
	}
		$dept = $_POST['dept'];
		$role = $_POST['role'];
		
		$query = "Select employee.id, employee.name ,email,roleid,dept,parent,departments.name as department,details  from employee ";
		$query .= "left join emp_dept_role on emp_dept_role.employeeid = employee.id ";
		$query .= "left join departments on emp_dept_role.dept = departments.id ";
		$query .= "left join roles on emp_dept_role.roleid = roles.id ";
		$query .= "where dept ='".$dept."' and  roleid !='".$role."'";
		
		$result['emp'] = $obj->selectQuery($query);
	    echo json_encode($result);
	
?>