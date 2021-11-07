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
		$data['password'] = md5($data['password']);
		$id=$obj->insertQuery($data,'employee');
		
		$data = $_POST['many'];
		$data = array_map('trim',$data);
		$data['employeeid'] = $id;
		$obj->insertQuery($data,'emp_dept_role');
		
		$obj->redirect('employee.php');
		
	}
	
	 $query = "Select * from departments";
     $departments = $obj->selectQuery($query);
	 
	 $query = "Select * from roles where id !=1";
     $roles = $obj->selectQuery($query);
	 $query = "Select * from roles where id !=1";
     $roles = $obj->selectQuery($query);
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
					<form class="login-form" action="user.php" method="post">
					
					
					<div class="form-group">
						<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
						<label class="control-label visible-ie8 visible-ie9">Name</label>
						<div class="input-icon">
							<input type="text" name="data[name]" id="name" placeholder="Name" autocomplete="off" class="form-control placeholder-no-fix" />
						</div>
					</div>
					<div class="form-group">
						<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
						<label class="control-label visible-ie8 visible-ie9">Email ID</label>
						<div class="input-icon">
							<input type="text" name="data[email]" value=""  id="user_name" placeholder="Email ID" autocomplete="off" class="form-control placeholder-no-fix" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label visible-ie8 visible-ie9">Password</label>
						<div class="input-icon">
							<input type="password" name="data[password]"  id="password" placeholder="Password" autocomplete="off" class="form-control placeholder-no-fix" />
						</div>
					</div>
					<input type="hidden" name="data[status]" value="1">
					<div class="form-group row">						
						<div class=" col-md-4">
						<label class="">Department</label>
							<select name="many[dept]" class="form-control" id="dept">
								<option value="">Select Department</option>
								<?php foreach($departments as $k => $val){?>
                                <option value="<?=$val['id']?>"><?=$val['name']?></option>
                                <?php }?>
							</select>
						</div>
						
						<div class=" col-md-4">
							<label class="control-label col-md-2 ">Role</label>
							<select name="many[roleid]" class="form-control emp" id="role">
								<option value="">Select Role</option>
								<?php foreach($roles as $k => $val){?>
                                <option value="<?=$val['id']?>"><?=$val['details']?></option>
                                <?php }?>
							</select>
						</div>
						<div class=" col-md-4">
							<label class="control-label">Parent </label>
							<select name="data[parent]" class="form-control" id="parent">
								<option value="0">Select Parent</option>
								
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

<script>
      $('.emp').on('change',function(){
		 
		 var id = $('#dept').val();
		 var role = $('#role').val();
		 $.ajax({
			url :  "ajax.php",
			type: "POST",
			data: {'dept':id,'role':role},
			success: function(data)
			{
				var obj = JSON.parse(data);
				console.log(data);
				console.log(obj);
				var cont_row = '<option value="">Select All</option>';
				
				$.each(obj.emp, function(key,val){					
					cont_row += '<option value="'+val.id+'">'+val.name+' ('+val.details+')</option>'; 
				});
				
				$('#parent').html(cont_row);
								
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		}); 
	  })
	
</script>
