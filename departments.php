<?php 
	require_once 'autoload.inc.php';

    use App\ServiceFunctions;
    $obj = new ServiceFunctions();
	
	if(!$obj->getAuthontication()){
		$obj->redirect('index.php');
		
	}
	
	
	 $query = "Select * from departments";
     $result = $obj->selectQuery($query);
	
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
					<a href="dept.php" class="btn green">New Department</a>
					<table class="table table-striped table-bordered table-hover table-checkable order-column data_grid" id="sample_1">
							<thead>
								<tr>
									<th width="3%"> SL </th> 
									<th>Department Name </th>                             
									<th>Status </th>
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
								<td><?=$val['name']?></td>
								<td><?=($val['status'] ==1)?"Active":"Inactive";?>
								</td>								 <?php if($_SESSION['category'] =='Admin'){?>
								<td>
								<a href="delete_dept.php?id=<?=$val['id']?>" onclick="return confirm('Are you sure?')" class="btn btn-xs red  btn-outline" title="del"><i class="fa fa-trash"></i></a>
					
								</td>
								 <?php }?>
							</tr>
							<?php }?>
							
							
							
							</tbody>
						</table>
				</div>
				
			</div>
		</div>
	</body>
</html>

<script src="js/jquery.min.js"></script>
<script src="css/bootstrap/js/bootstrap.min.js"></script>
<script src="js/login.min.js"></script>
