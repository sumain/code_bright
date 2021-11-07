<?php 
    require_once 'autoload.inc.php';

    use App\ServiceFunctions;
    $obj = new ServiceFunctions();


    if($obj->getAuthontication()){
        $obj->redirect('dashboard.php');
    }
    $flag=false;
    $mgs ='';
        if(isset($_POST['login'])){
            
            $user = $_POST['user_name'];
            $pass = $_POST['password'];
            $dept = $_POST['department'];
           $query = "Select employee.id, employee.name,email,roleid,dept,parent  from employee ";
           $query .= "left join emp_dept_role on emp_dept_role.employeeid = employee.id ";
           $query .= "where dept ='".$dept."' and  email='".$user."' and '".md5($pass)."'";
           //echo  $query;
           //exit;
           $rows = $obj->selectQuery($query);
          // $obj->printr($rows);
           //exit; 
           if(!empty($rows)){
                $_SESSION['userid'] = $rows[0]['id']; 
                $_SESSION['email'] = $rows[0]['email']; 
                $_SESSION['role'] = $rows[0]['roleid']; 
                $_SESSION['dept'] = $rows[0]['dept']; 
                if($rows[0]['id'] ==1)
                  $_SESSION['category'] = 'Admin';
                else 
                $_SESSION['category'] = '';
                
                //$obj->printr($rows);
                $obj->redirect('employee.php');
            }else{
                $mgs ='Incorrect username or password';
                $flag=true;
            }
            
        }

        $query = "Select * from departments";
        $departments = $obj->selectQuery($query);
        //$obj->printr($departments);   
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
				
				<div class="col-md-3"></div>
				<div class="col-md-6">
				<form class="login-form" action="index.php" method="post">
					<h3 class="form-title">Login to your account</h3>
					<?php if($flag){?>
					<div class="alert alert-danger display-hide">
						<button class="close" data-close="alert"></button>
						<span><?=$mgs?>  </span>
					</div>
					<?php }?>
					
					
					<div class="form-group">
						<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
						<label class="control-label visible-ie8 visible-ie9">Email</label>
						<div class="input-icon">
							
							<input type="text" name="user_name" value=""  id="user_name" placeholder="Email ID" autocomplete="off" class="form-control placeholder-no-fix" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label visible-ie8 visible-ie9">Password</label>
						<div class="input-icon">
							<input type="password" name="password" value="123"  id="password" placeholder="Password" autocomplete="off" class="form-control placeholder-no-fix" />
						</div>
					</div>
					<div class="form-group">
						<label class="control-label visible-ie8 visible-ie9">Department</label>
						<div class="input-icon">
							<select name="department" class="form-control">
								<option value="0">Select Department</option>
								<?php foreach($departments as $k => $val){?>
                                <option value="<?=$val['id']?>"><?=$val['name']?></option>
                                <?php }?>
							</select >
						</div>
					</div>
					<div class="form-actions">
						
						<button type="submit" name="login" class="btn green pull-right"> Login </button>
					</div>
					</form>
				</div>
				<div class="col-md-3"></div>
			</div>
		</div>
	</body>
</html>

<script src="js/jquery.min.js"></script>
<script src="css/bootstrap/js/bootstrap.min.js"></script>
<script src="js/login.min.js"></script>
