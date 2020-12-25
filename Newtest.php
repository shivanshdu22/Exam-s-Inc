<?php
session_start();
include 'config.php';
$error = array();
if (isset($_REQUEST['qid'])) {
    $sql = "SELECT * from " . $_SESSION['testdata']['name'] . " where id=" . $_REQUEST['qid'] . "";
    $conn->query($sql);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $sql = "DELETE from " . $_SESSION['testdata']['name'] . " where id=" . $_REQUEST['qid'] . "";
        $conn->query($sql);
    }
    //$_SESSION['testdata']=array('id'=>"$_REQUEST['id']");
}
if (isset($_REQUEST['id'])) {
    $sql = "SELECT * from tests where Test_ID=" . $_REQUEST['id'] . "";
    $conn->query($sql);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            unset($_SESSION['testdata']);
            $name = str_replace(' ', '', $row['Name']);
            $_SESSION['testdata'] = array('name' => $name);
        }
    }
    //$_SESSION['testdata']=array('id'=>"$_REQUEST['id']");
}
if (isset($_POST['NextQuestion'])) {
    $question = isset($_POST['Question']) ? $_POST['Question'] : '';
    $op1 = isset($_POST['op1']) ? $_POST['op1'] : '';
    $op2 = isset($_POST['op2']) ? $_POST['op2'] : '';
    $op3 = isset($_POST['op3']) ? $_POST['op3'] : '';
    $op4 = isset($_POST['op4']) ? $_POST['op4'] : '';
    $correct = isset($_POST['correct']) ? $_POST['correct'] : '';

    $sql = "INSERT INTO " . $_SESSION['testdata']['name'] . " (Question, op1, op2, op3, op4, correct) VALUES ('" . $question . "', '" . $op1 . "', '" . $op2 . "','" . $op3 . "','" . $op4 . "','" . $correct . "')";

    if ($conn->query($sql) === true) {
        echo "<script type='text/javascript'>alert('Question added Successfully!');</script>";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        $error = array('input' => 'dberror', 'msg' => "" . $conn->error);
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
    <?php include 'header.php';?>
    <div id="admin-wrapper container" class="png_bg ">
        <div class="m-5 text-center" id="admin-top">
            <h1 class="text-primary">Exam's Inc.</h1>
            <h6>Let's Create the Future Together</h6>
            <hr>
        </div> <!-- End #logn-top -->

        <div id="admin-content">
            <div id="new-test" class="text-center">
                <form>
                    <input type="text" name="name" value="<?php echo $_SESSION['testdata']['name']; ?>" required hidden>

                </form>
                <h3>TEST NAME:<?php echo "  <b>" . $_SESSION['testdata']['name'] . "</b>"; ?> </h3>
                <button onclick="location.href='admin.php'" class="btn btn-primary mb-5" type="button">Back</button>
                <form class="form col-lg-4 mx-auto text-center" action="Newtest.php" method="post">

                    <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

                    <div class="form-group">
                        <label>Question</label>
                        <input type="test" placeholder="Question" class="form-control" id="small-input" name="Question"
                            required />
                    </div>
                    <div class="form-group">
                        <label>Option 1</label>
                        <input type="text" placeholder="1th option" class="form-control" name="op1" required>
                    </div>
                    <div class="form-group">
                        <label>Option 2</label>
                        <input type="text" placeholder="2th option" class="form-control" name="op2" required>
                    </div>
                    <div class="form-group">
                        <label>Option 3</label>
                        <input type="text" placeholder="3th option" class="form-control" name="op3" required>
                    </div>
                    <div class="form-group">
                        <label>Option 4</label>
                        <input type="text" placeholder="4th option" class="form-control" name="op4" required>
                    </div>
                    <div class="form-group">
                        <label>Correct Option Number</label>
                        <input type="number" placeholder="(1-4)" class="form-control"
                            pattern="[1]{1}|(2){1}|(3){1}|(4){1}" name="correct" required>
                    </div>

                    <input class="btn btn-primary" type="submit" name="NextQuestion" value="Submit Question">



                </form>
            </div>
            <div id="test" class="col-lg-10 mx-auto bg-light text-primary">
                <h3 class="text-center">QUESTIONS</h3>
                <table class="table text-dark">
                    <thead class="text-primary">
                        <tr>
                            <th>Question </th>
                            <th>Option 1 </th>
                            <th>Option 2 </th>
                            <th>Option 3 </th>
                            <th>Option 4 </th>
                            <th>Correct </th>
                            <th>Options </th>
                        </tr>
                    </thead>
                    <?php $sql = "SELECT * FROM " . $_SESSION['testdata']['name'] . "";?>
                    <?php $result = $conn->query($sql);?>
                    <?php
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $row['Question']; ?></td>
                        <td><?php echo $row['op1']; ?></td>
                        <td><?php echo $row['op2']; ?></td>
                        <td><?php echo $row['op3']; ?></td>
                        <td><?php echo $row['op4']; ?></td>
                        <td><?php echo $row['correct']; ?></td>
                        <td><a href="Newtest.php?qid=<?php echo $row['id']; ?>" title="Delete"><img
                                    src="resources/images/icons/cross.png" alt="Delete" /></a>
                        </td>
                    </tr>
                    <?php }
}?>
                </table>
            </div>
        </div>
    </div> <!-- End #login-wrapper -->
</body>

</html>