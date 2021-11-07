<div class="col-md-12">
	<table class="table table-striped table-bordered table-hover table-checkable order-column data_grid" id="sample_1">
		<thead>
			<tr>                             
				<td><a href="departments.php">Department</a></td>                             
				<td><a href="employee.php">Employee </a></td>
				<td><a href="multiRole.php">Multi Role </a></td>
				
				<?php if(@$_SESSION['userid']){?>
				<td><a href="logout.php">Logout </a></td>
				<?php }else{?>
				<td><a href="index.php">Login</a></td>
				<?php }?>				
			</tr>
		</thead>
	</table>
</div>