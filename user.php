<?php
	session_start();	
	include('config.php');
	$error= array();
	if(isset($_POST['submit'])){
		$name=isset($_POST['Name'])?$_POST['Name']:'';
		
		$sql = "SELECT * FROM subject where Name='".$name."'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		  	$error[]=array('input'=>'username','msg'=>'Subject already present');	  
		} 		
		if(sizeof($error)==0){
			$sql = "INSERT INTO subject (Name) VALUES ('".$name."')";

			if ($conn->query($sql) === true) {
            } 
            else {
			  //echo "Error: " . $sql . "<br>" . $conn->error;
			  $error=array('input'=>'dberror','msg'=>"". $conn->error);
			}	
			
		}	
		
	}
	if(isset($_REQUEST['id'])){
		$sql = "SELECT * FROM user where id='".$_REQUEST['id']."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		
		if($row){
			$sql = "DELETE FROM user WHERE id= '".$_REQUEST['id']."'";
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
                    <h2 class="text-center">ALL USERS</h2>
                    <table class="table table-light text-dark table-hover border">
					<thead class="text-primary">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Options</th>
                        </tr>
					</thead>	
                    <tbody>
                        <?php $sql = "SELECT * FROM user"; ?>
                        <?php $result = $conn->query($sql);?>
                        <?php
						if ($result->num_rows > 0) {
						 // output data of each row
						 while($row = $result->fetch_assoc()) {?>
                        <tr>
                            <td><?php echo $row['user_ID'];?></td>
                            <td><?php echo $row['Username'];?></td>
                            <td><?php echo $row['Email'];?></td>
                            <td><?php echo $row['Role'];?></td>
                            <td>
                                <!-- Icons -->
                                <a href="user.php?id=<?php echo $row['user_ID']; ?>" title="Delete"><img
                                        src="resources/images/icons/cross.png" alt="Delete" /></a>
                                <!--<a href="Newtest.php?id=<?php echo $row['id']; ?>" title="Edit"><img
                                        src="resources/images/icons/pencil.png" alt="Edit" /></a>     -->   
                            </td>
                        </tr>
                        <?php }
					} ?>
                    </tbody>
                    </table>
               
            </div>

            <!--<div id="new-test" class="row mt-5 row-lg-12 bg-primary p-5">
                <div class="col-lg-12 mb-5 text-center">    
                    <h2>Create New Subject</h2>
                    <hr>
                </div>   
                
                <div class="col-lg-12 mx-auto"> 
                <form class="form " action="subject.php" method="post">
                    <div class="form-class">
                            <label for="name">Name of Subject</label>
                            <input type="text" class="form-control" id="small-input name" name="Name" required />
                    </div>     
                    <hr>   
                    <input class="btn btn-light" type="submit" name="submit" value="Add Subject">
                  
                </form>
                </div>    
            </div>-->
        </div> <!-- End #login-content -->

    </div> <!-- End #login-wrapper -->
</body>

</html>