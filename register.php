<?php
	include ('config.php');
	
	$error= array();
	if(isset($_POST['submit'])){
		$username=isset($_POST['username'])?$_POST['username']:'';
		$password=isset($_POST['password'])?$_POST['password']:'';
		$password2=isset($_POST['password2'])?$_POST['password2']:'';
		$email=isset($_POST['email'])?$_POST['email']:'';
		
		
		$sql = "SELECT * FROM user where Username='".$username."'OR Email='".$email."'";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
		  	$error[]=array('input'=>'username','msg'=>'Data already present');	  
		} 
		
		
		if($password!=$password2){
			$error[]=array('input'=>'password','msg'=>'Password dosent match');
		}
		
		if(sizeof($error)==0){
			$sql = "INSERT INTO user (Username, Password, Email) VALUES ('".$username."', '".$password."', '".$email."')";

			if ($conn->query($sql) === true) {
			  echo "Registered Successfully!";
			} else {
			  //echo "Error: " . $sql . "<br>" . $conn->error;
			  $error=array('input'=>'dberror','msg'=>"". $conn->error);
			}

			$conn->close();
		}
		
	}
?>
<!DOCTYPE html>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
        <a class="h1 navbar-brand text-primary" href="#">Exam's Inc.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">

                <a class="nav-item nav-link bg-primary btn mx-3 text-white active">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link btn btn-primary text-white" href="login.php">LOGIN</a>
            </div>
        </div>
    </nav>
    <div class="bg-dark text-white container-fluid p-5" id="wrapper">
        <div class="row justify-content-center   p-3 text-cyan" id="login-top">

            <h1 class="bg-primary p-3">Welcome to Cedcoss's Online Platform</h1>
            <!-- Logo (221px width) -->
            <br>

        </div> <!-- End #logn-top -->

        <?php if(sizeof($error)!=0) : ?>
        <?php foreach ($error as $err):?>
        <li><?php echo $err["msg"]; ?></li>
        <?php endforeach ; ?>
        <?php endif ; ?>


        <div class="row justify-content-center p-4" id="signup-form">

            <form class="bg-primary justify-content-center p-5" action="register.php" method="POST">
                <p>
                <h2 class="bg-dark text-white text-center p-1">Sign Up</h2>
                </p>
                <div class="form-group justify-content-center">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" patten="(a-zA-Z0-9){5,15}"
                        aria-describedby="emailHelp" placeholder="Enter username" required>
                    <small id="emailHelp" class="form-text">Username in Alphanumeric of length 5-15 words</small>
                </div>
                <div class="form-group justify-content-center">
                    <label for="password">Password </label>
                    <input type="password" class="form-control" placeholder="Password"
                        pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" aria-describedby="passHelp" name="password"
                        required>
                    <small id="passHelp" class="form-text">Minimum eight characters, at least one letter and one
                        number</small>

                </div>
                <div class="form-group justify-content-center">
                    <label for="password2">Confirm Password </label>
                    <input type="password" class="form-control" placeholder="Re-Password"
                        pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" aria-describedby="passHelp" name="password2"
                        required>

                </div>
                <div class="form-group justify-content-center">
                    <label for="email">Email </label>
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                </div>
                <div class="text-center">
                    <input type="submit" class="  btn btn-white text-primary" name="submit" value="Register">
                </div>
            </form>
        </div>
        <div class="row justify-content-center">
            <!-- End #login-content -->
            <br>
            <h3>Already Registered? Login Below!</h3>
        </div>
        <div class="row justify-content-center">
            <button onclick="location.href='login.php'" class="btn btn-primary" type="button">LOGIN</button>
        </div>

    </div>
</body>

</html>