<?php
	session_start();	
	include('config.php');
	$error= array();
	if(isset($_POST['Newtest'])){
		$name=isset($_POST['Name'])?$_POST['Name']:'';
		$category=isset($_POST['category'])?$_POST['category']:'';
		
		$sql = "SELECT * FROM tests where Name='".$name."'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		  	$error[]=array('input'=>'username','msg'=>'Test already present');	  
		} 		
		if(sizeof($error)==0){
			$sql = "INSERT INTO tests (Name,Category) VALUES ('".$name."', '".$category."')";

			if ($conn->query($sql) === true) {
			  
			} else {
			  //echo "Error: " . $sql . "<br>" . $conn->error;
			  $error=array('input'=>'dberror','msg'=>"". $conn->error);
			}	
			 $name= str_replace(' ','',$name);		
			 $sql1 = "CREATE TABLE ".$name."(
				Question VARCHAR(30),
				op1 VARCHAR(30),
				op2 VARCHAR(30),
				op3 VARCHAR(30),
				op4 VARCHAR(30), 
				correct VARCHAR(30) 
				)";	
				
			if (mysqli_query($conn, $sql1)) {
				echo "New test created successfully";
				$_SESSION['testdata']=array('name'=>$name);
				header('Location:Newtest.php');
				} else {
				echo "Error: " . mysqli_error($conn);
			}	
				
		}	
	}
	
?>
<html>
	<head>
		<title>Cedcoss Online Exam</title>
		
	</head>
	<body>
			<div id="admin-wrapper" class="png_bg">
			<div id="admin-top">
				<h1>Welcome to Cedcoss's Online Platform</h1>
				<?php echo "Welcome <b>".$_SESSION['userdata']['username']."</b>"; ?>
				<?php echo"<br><a href='logout.php'>Logout</a>";?>
			</div> <!-- End #logn-top -->
			<div id="admin-content">
				<div id="all-test">
				<fieldset>
				<h2>Existing Tests</h2>
				<table>
					<tr>
						<th>Test ID</th>
						<th>Name</th>
						<th>Topic</th>
						<th>Options</th>
					</tr>
					<?php $sql = "SELECT * FROM tests"; ?>
					<?php $result = $conn->query($sql);?>
					<?php
						if ($result->num_rows > 0) {
						 // output data of each row
						 while($row = $result->fetch_assoc()) {?>
						<tr>
						<td><?php echo $row['Test_ID'];?></td>
						<td><a href="" title="title"><?php echo $row['Name'];?></a></td>
						<td><?php echo $row['Category'];?></td>
						<td>
						<!-- Icons -->		
						<a href="#" title="Delete">Attempt</a> 
						</td>
						</tr>
					<?php }
					} ?>
				</table>
				</fieldset>
				</div>
				
				<div id="new-test">
				<p>
					<form action="admin.php" method="post">
						<input class="button" type="submit" name="Newtest" value="Create New test" >
						<p>
								<label>Name of Test</label>
								<input type="text" id="small-input" name="Name" required /> 
						</p>
						<p>
								<label>Topic</label>
								<input type="text" id="small-input" name="category" required /> 
						</p>
					</form>
				</p>
				</div>	
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
	</body>
</html>	
