<?php 
	require_once 'autoload.inc.php';

    use App\ServiceFunctions;
    $obj = new ServiceFunctions();
	
	if(!$obj->getAuthontication()){
		$obj->redirect('index.php');
		
	}
	
	if(isset($_POST['reg'])){
		
		
		$data = $_POST['data'];
		$data = array_map('trim',$data);
		
		$obj->insertQuery($data,'emp_dept_role');
		
		$obj->redirect('employee.php');
		
	}
	
	 $query = "Select * from departments";
     $departments = $obj->selectQuery($query);
	 
	 $query = "Select * from roles where id !=1";
     $roles = $obj->selectQuery($query);
	 
	$query = "Select employee.id, employee.name as emp,details,departments.name as department  from employee ";
	$query .= "left join emp_dept_role on emp_dept_role.employeeid = employee.id ";
	$query .= "left join roles on emp_dept_role.roleid = roles.id ";
	$query .= "left join departments on emp_dept_role.dept = departments.id ";
	$query .= "where employee.id !=1 ";
	//echo $query;	
     $employee = $obj->selectQuery($query);
?>
<html>
	<title>Code Bright: Sr. Software Engineer</title>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
		<link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<style>
		.container{
			width:960px;
		}
	</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<?php 
				include_once('nav.php');
				?>
				<div class="col-md-12">					
					<form class="login-form" action="multiRole.php" method="post">
					
					
					<div class="form-group row">

						<div class=" col-md-4">
							<label class="control-label">Employee </label>
							<select name="data[employeeid]" class="form-control" id="parent">
								<option value="0">Select Employee</option>
								<?php foreach($employee as $k => $val){?>
                                <option value="<?=$val['id']?>"><?=$val['emp']?> (<?=$val['details']?> in <?=$val['department']?>)</option>
                                <?php }?>
							</select>
						</div>
						
						<div class=" col-md-4">
						<label class="">Department</label>
							<select name="data[dept]" class="form-control" id="dept">
								<option value="">Select Department</option>
								<?php foreach($departments as $k => $val){?>
                                <option value="<?=$val['id']?>"><?=$val['name']?></option>
                                <?php }?>
							</select>
						</div>
						
						<div class=" col-md-4">
							<label class="control-label col-md-2 ">Role</label>
							<select name="data[roleid]" class="form-control emp" id="role">
								<option value="">Select Role</option>
								<?php foreach($roles as $k => $val){?>
                                <option value="<?=$val['id']?>"><?=$val['details']?></option>
                                <?php }?>
							</select>
						</div>
					</div>
					<div class="form-actions">
						<button type="submit" name="reg" class="btn green"> Submit </button>
					</div>
					</form>
				</div>
				
				
			</div>
		</div>
	</body>
</html>

<script src="js/jquery.min.js"></script>
<script src="css/bootstrap/js/bootstrap.min.js"></script>

