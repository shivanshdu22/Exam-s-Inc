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
                
                id int NOT NULL AUTO_INCREMENT,
				Question VARCHAR(30),
				op1 VARCHAR(30),
				op2 VARCHAR(30),
				op3 VARCHAR(30),
				op4 VARCHAR(30), 
                correct VARCHAR(30), 
                PRIMARY KEY (id)
				)";	
				
			if (mysqli_query($conn, $sql1)) {
				echo "New test created successfully";
				$_SESSION['testdata']=array('name'=>$name);
				header('Location:Newtest.php');
                } 
            else {
				echo "<script type='text/javascript'>alert('ERROR')</script>";
			}	
				
		}	
		
	}
	if(isset($_REQUEST['id'])){
		$sql = "SELECT * FROM tests where Test_ID='".$_REQUEST['id']."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		if($row){
            $name= str_replace(' ','',$row['Name']);
			$sql = "DROP TABLE `".$name."`";
			$conn->query($sql);
			$sql = "DELETE FROM tests WHERE Test_ID= '".$_REQUEST['id']."'";
			$conn->query($sql);
			echo "<script type='text/javascript'>alert('Action Done');</script>";
		}
	}
	
?>
<html>

<head>
    <title>Cedcoss Online Exam</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</head>

<body class="bg-dark text-white">
    <?php include('header.php'); ?>
    <div id="admin-wrapper container" class="png_bg ">
        <div class="m-5 text-center" id="admin-top">
            <h1 class="text-primary">Exam's Inc.</h1>
            <h6>Let's Create the Future Together</h6>
            <hr>
        </div> <!-- End #logn-top -->
        <div class=" m-5" id="admin-content">
            <div class="row-lg-12 bg-white text-primary p-5 mx-auto" id="all-test">
                <h2 class="text-center">ALL TESTS</h2>
                <table class="table table-light text-dark table-hover border">
                    <thead class="text-primary">
                        <tr>
                            <th>Test ID</th>
                            <th>Name</th>
                            <th>Topic</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sql = "SELECT * FROM tests"; ?>
                        <?php $result = $conn->query($sql);?>
                        <?php
						if ($result->num_rows > 0) {
						 // output data of each row
						 while($row = $result->fetch_assoc()) {?>
                        <tr>
                            <td><?php echo $row['Test_ID'];?></td>
                            <td><?php echo $row['Name'];?></td>
                            <td><?php echo $row['Category'];?></td>
                            <td>
                                <!-- Icons -->
                                <a href="admin.php?id=<?php echo $row['Test_ID']; ?>" title="Delete"><img
                                        src="resources/images/icons/cross.png" alt="Delete" /></a>
                                <a href="Newtest.php?id=<?php echo $row['Test_ID']; ?>" title="Edit"><img
                                        src="resources/images/icons/pencil.png" alt="Edit" /></a>
                            </td>
                        </tr>
                        <?php }
					} ?>
                    </tbody>
                </table>

            </div>

            <div id="new-test" class="row mt-5 row-lg-12 bg-primary p-5">
                <div class="col-lg-12 mb-5 text-center">
                    <h2>Create New Test</h2>
                    <hr>
                </div>

                <div class="col-lg-12 mx-auto">
                    <form class="form " action="admin.php" method="post">
                        <div class="form-class">
                            <label for="name">Name of Test</label>
                            <input type="text" class="form-control" id="small-input name" name="Name" required />
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Subject</label>
                            <select class="form-control" name="category" id="exampleFormControlSelect1">
                               <?php $sql="Select * from subject";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {?>
                                    <option value="<?php echo $row['Name'] ?>"><?php echo $row['Name'] ?></option>
                                    <?php }
					} ?>    
                            </select>
                        </div>

                        <input class="btn btn-light" type="submit" name="Newtest" value="Create New test">

                    </form>
                </div>
            </div>
        </div> <!-- End #login-content -->

    </div> <!-- End #login-wrapper -->
</body>

</html>