<?php 
	require_once 'autoload.inc.php';

    use App\ServiceFunctions;
    $obj = new ServiceFunctions();
	
	if(!$obj->getAuthontication()){
		$obj->redirect('index.php');
		
	}
	
	if(isset($_POST['reg'])){
		$date = date('Y-m-d H:i:s');
		$data = $_POST['data'];
		$data = array_map('trim',$data);
		$data['created_on'] = $date;
		$data['updated_on'] = $date;
		$id=$obj->insertQuery($data,'departments');
		
		$obj->redirect('departments.php');
		
	}

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
					<form class="login-form" action="dept.php" method="post">
					
					
					<div class="form-group">
						<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
						<label class="control-label visible-ie8 visible-ie9">Department Name</label>
						<div class="input-icon">
							<input type="text" name="data[name]" id="name" placeholder="Name" autocomplete="off" class="form-control placeholder-no-fix" />
						</div>
					</div>
					<div class="form-group">						
						<label class="control-label visible-ie8 visible-ie9">Status</label>
						<div class="">
						
							<select name="data[status]" class="form-control">
								<option value="">Select one</option>
								<option value="1">Active</option>
								<option value="2">Inactive</option>
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
<script src="js/login.min.js"></script>
