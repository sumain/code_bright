<?php 

	require_once 'autoload.inc.php';

    use App\ServiceFunctions;
    $obj = new ServiceFunctions();
	
	//$obj->printr($_SESSION);
	if(!$obj->getAuthontication()){
		$obj->redirect('index.php');
		//echo $obj->getAuthontication();
	}
	if($_SESSION['dept'] ==0){
		$query = "Select employee.id, employee.name as emp,employee.email,roleid,dept,employee.parent,departments.name as department,details,emp1.name as parent  from employee ";
		$query .= "left join emp_dept_role on emp_dept_role.employeeid = employee.id ";
		$query .= "left join departments on emp_dept_role.dept = departments.id ";
		$query .= "left join roles on emp_dept_role.roleid = roles.id ";
		$query .= "left join employee AS emp1 on emp1.id = employee.parent ";
		//$query .= "where dept ='".$dept."' and  email='".$user."' and '".md5($pass)."'";
		//echo $query;
		$result = $obj->selectQuery($query);
	}else{
		$dept    = $_SESSION['dept'];
		$parent  = $_SESSION['userid'];
		$query = "Select employee.id, employee.name as emp,employee.email,roleid,dept,employee.parent,departments.name as department,details,emp1.name as parent  from employee ";
		$query .= "left join emp_dept_role on emp_dept_role.employeeid = employee.id ";
		$query .= "left join departments on emp_dept_role.dept = departments.id ";
		$query .= "left join roles on emp_dept_role.roleid = roles.id ";
		$query .= "left join employee AS emp1 on emp1.id = employee.parent ";
		$query .= "where emp_dept_role.dept ='".$dept."' and  employee.parent='".$parent."'";
		$result = $obj->selectQuery($query);
		
		
		foreach($result as $k => $val){
			$obj->showChildEmployee($val['id'],$dept);
			
		}
		
		
		
		
	}
	//$obj->printr($result);
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
					<div class="table-responsive">
						<?php if($_SESSION['category'] =='Admin'){?>
						<a href="user.php" class="btn green">New Employee</a>
						<?php }?>
						<table class="table table-striped table-bordered table-hover table-checkable order-column data_grid" id="sample_1">
							<thead>
								<tr>
									<th width="3%"> SL </th> 
									<th>Name </th>                             
									<th>Email </th>                             
									<th>Department </th> 
									<th>Role </th> 
									<th>Parent </th> 
									<?php if($_SESSION['category'] =='Admin'){?>
									<th width="10%"> Actions </th>
									<?php }?>
								</tr>
							</thead>
							<tbody>
							<?php
							foreach($result as $k =>$val){
							
							?>
							<tr>
								<td><?=($k+1)?></td>
								<td><?=$val['emp']?></td>
								<td><?=$val['email']?></td>
								<td><?=$val['department']?></td>
								<td><?=$val['details']?></td>
								<td><?=$val['parent']?></td>
								 <?php if($_SESSION['category'] =='Admin'){?>
								<td>
								<a href="delete.php?id=<?=$val['id']?>" onclick="return confirm('Are you sure?')" class="btn btn-xs red  btn-outline" title="del"><i class="fa fa-trash"></i></a>
					
								</td>
								 <?php }?>
							</tr>
							<?php }
							if(!empty($obj->result_set)){
								foreach($obj->result_set as $k => $val){
									foreach($val as $key => $value){ ?>
									<tr>
									<td><?=($k+1)?></td>
									<td><?=$value['emp']?></td>
									<td><?=$value['email']?></td>
									<td><?=$value['department']?></td>
									<td><?=$value['details']?></td>
									<td><?=$value['parent']?></td>
									 <?php if($_SESSION['category'] =='Admin'){?>
									<td>
									<a href="delete.php?id=<?=$value['id']?>" onclick="return confirm('Are you sure?')" class="btn btn-xs red  btn-outline" title="del"><i class="fa fa-trash"></i></a>
						
									</td>
									 <?php }?>
								</tr>
								<?php } }
							}?>
							
							</tbody>
						</table>
					</div>
				</div>
				
			</div>
		</div>
	</body>
</html>

<script src="js/jquery.min.js"></script>
<script src="css/bootstrap/js/bootstrap.min.js"></script>
<script src="js/login.min.js"></script>
