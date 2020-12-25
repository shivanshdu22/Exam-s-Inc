<nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
        <a class="h1 navbar-brand text-primary" href="#">Exam's Inc.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">

                <a class="nav-item nav-link active" href="admin.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="#">Create New Test</a>
                <a class="nav-item nav-link" href="subject.php">Subject</a>
                <a class="nav-item nav-link" href="user.php">Users</a>
                <a class="nav-item nav-link active"
                    href="#">
                    <span class="sr-only">(current)</span></a>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<?php echo "Welcome <b>".$_SESSION['userdata']['username']."</b>"; ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>