<?php
	include('config.php');
	session_start();
	$error=array();
	if(isset($_POST['submit'])){
		$username=isset($_POST['username'])?$_POST['username']:'';
		$password=isset($_POST['password'])?$_POST['password']:'';
		
		if(sizeof($error)==0){
			$sql = "SELECT * FROM user WHERE Username='".$username."'AND Password='".$password."'";
			$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$_SESSION['userdata']=array('username'=>$row['Username']);	
				//print_r($_SESSION);
				if($row["Role"]=="Admin"){
					header('Location:admin.php');
				}
				else{
					header('Location:student.php');
				}
				
			}
		} 
		else{
			$error[]=array('input'=>'username','msg'=>'Invalid Login');	  
		}
		$conn->close();
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

<body id="login" class="bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
        <a class="h1 navbar-brand text-primary" href="#">Exam's Inc.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">

                <a class="nav-item nav-link  btn btn-primary text-white mx-3" >Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link btn btn-primary text-white" href="register.php">SIGN UP</a>         
            </div>
        </div>
    </nav>
    <div class="container center-block bg-dark" id="login-wrapper" class="png_bg">
        <div class="row justify-content-center mt-5 text-cyan" id="login-top">

            <h1 class="bg-primary p-3">Welcome to Cedcoss's Online Platform</h1>
            <!-- Logo (221px width) -->

        </div> <!-- End #logn-top -->
        <?php if(sizeof($error)!=0) : ?>
        <?php foreach ($error as $err):?>
        <li><?php echo $err["msg"]; ?></li>,[value-5]
        <?php endforeach ; ?>
        <?php endif ; ?>
        <div class="row justify-content-center p-5" id="login-content">

            <form class="bg-primary justify-content-center p-5" action="login.php" method="POST">
			<p>
                <h2 class="bg-dark text-white text-center p-1">LOGIN</h2>
                </p>
                <div class="form-group justify-content-center">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" name="username" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Enter username">
                    <small id="emailHelp" class="form-text">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group justify-content-center">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                        placeholder="Password">
                </div>
                <div class="form-group form-check justify-content-center">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember Me!</label>
                </div>
                <button type="submit" name="submit"
                    class="btn btn-white text-primary justify-content-center">Submit</button>
            </form>
        </div>
        <div class="row justify-content-center">
            <!-- End #login-content -->
            <br>
            <h5>Not a user! Wanna Register?</h5>
        </div>
        <div class="row justify-content-center">
            <button onclick="location.href='register.php'" class="btn btn-primary" type="button">Register Now</button>
        </div>
    </div> <!-- End #login-wrapper -->
</body>

</html>