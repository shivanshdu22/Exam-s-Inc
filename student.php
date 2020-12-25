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
    <link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
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

<body>
    <?php include('userhead.php'); ?>
    <div id="admin-wrapper" class="png_bg">
        <div class="m-5 text-center pt-4" id="admin-top">
            <h1 class="text-primary">Exam's Inc.</h1>
            <h6>Let's Create the Future Together</h6>
            <hr>
        </div> <!-- End #logn-top -->
        <div class="row-lg-12 p-5" id="admin-content">
            <h2 class="text-center text-primary bg-dark mb-5 p-4">ALL TESTS</h2>
            <div class="row pb-5" id="all-test">


                <?php $sql = "SELECT * FROM tests"; ?>
                <?php $result = $conn->query($sql);?>
                <?php
                        if ($result->num_rows > 0) {
                            // output data of each row
                         while ($row = $result->fetch_assoc()) {?>

                <div class="col-lg-3 card mx-auto bg-primary text-white text-center p-5" style="width: 18rem;">
                    <div class="card-body">
                        <h4 class="card-title">TEST ID: <?php echo $row['Test_ID'];?> </h4>
                        <h5 class="card-title bg-dark p-4">Title: <?php echo $row['Name'];?></h5>
                        <p class="card-text bg-dark p-4">Subject: <?php echo $row['Category'];?></p>
                        <a href="question.php?id=<?php echo $row['Test_ID'];?>" class="btn btn-light ">Attempt</a>
                    </div>
                </div>
                <?php }
                } ?>
            </div>
        </div> <!-- End #login-content -->

    </div> <!-- End #login-wrapper -->
    <footer class="bg-dark text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center p-3">
            © 2020 Copyright:
            <a class="text-light" href="#">Exam's Inc</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>