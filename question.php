<?php
session_start();
include 'config.php';
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        var fa=parseInt($("#next").attr('data-id'));
        if(fa==1){
            $('#back').hide();
        }
        else{

        }
        $("#next").click(function() {
            var id = parseInt($(this).attr('data-id'));
            var action = "next";
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: {
                    id: id,
                    action: action
                },
                success: function(result) {
                   
                    var obj = JSON.parse(result);
                    console.log(obj[0].Question);
                    var res=" <form class='form ml-5'>";
                    res+="<p>"+obj[0].Question+"</p>";
                    res+="<div class='form-group'>"
                    res+="<input type='radio' id='male' name='op' value='1'>"
                    res+="<label for='male'>"+ obj[0].op1+"</label>"
                    res+="</div>"
                    res+="<div class='form-group'>"
                    res+="<input type='radio' id='male' name='op' value='2'>"
                    res+="<label for='male'>"+ obj[0].op2+"</label>"
                    res+="</div>"
                    res+="<div class='form-group'>"
                    res+="<input type='radio' id='male' name='op' value='3'>"
                    res+="<label for='male'>"+ obj[0].op3+"</label>"
                    res+="</div>"
                    res+="<div class='form-group'>"
                    res+="<input type='radio' id='male' name='op' value='4'>"
                    res+="<label for='male'>"+ obj[0].op4+"</label>"
                    res+="</div>"
                    res+="</form>";
                    $("#question").html(res);
                    $('#next').attr('data-id',id+1)
                    $('#back').show();
                    $('#back').attr('data-id',id+1);
                },
                error: function() {
                    alert('error');
                }
            });
        });
        $("#back").click(function() {
            var id = parseInt($(this).attr('data-id'));
            var action = "back";
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: {
                    id: id,
                    action: action
                },
                success: function(result) {
                    console.log(result);
                    var obj = JSON.parse(result);
                    console.log(obj[0].Question);
                    var res=" <form class='form ml-5'>";
                    res+="<p>"+obj[0].Question+"</p>";
                    res+="<div class='form-group'>"
                    res+="<input type='radio' id='male' name='op' value='1'>"
                    res+="<label for='male'>"+ obj[0].op1+"</label>"
                    res+="</div>"
                    res+="<div class='form-group'>"
                    res+="<input type='radio' id='male' name='op' value='2'>"
                    res+="<label for='male'>"+ obj[0].op2+"</label>"
                    res+="</div>"
                    res+="<div class='form-group'>"
                    res+="<input type='radio' id='male' name='op' value='3'>"
                    res+="<label for='male'>"+ obj[0].op3+"</label>"
                    res+="</div>"
                    res+="<div class='form-group'>"
                    res+="<input type='radio' id='male' name='op' value='4'>"
                    res+="<label for='male'>"+ obj[0].op4+"</label>"
                    res+="</div>"
                    res+="</form>";
                    $("#question").html(res);
                    $('#next').attr('data-id',id-1);
                    $('#back').attr('data-id',id-1);
                    $('#back').show();
                    if(id==2){
                        $('#back').hide();
                    }
                },
                error: function() {
                    alert('error');
                }
            });
        });
    });
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark py-3">
        <a class="h1 navbar-brand text-primary" href="#">Exam's Inc.</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">

            </div>
        </div>
    </nav>
    <div class="container p-5">
        <div class="row mx-auto ml-5 " id="question">
            <?php $sql = "SELECT * FROM ".$_SESSION['testdata']['name'] ." LIMIT 1";
           ?>
            <?php $result = $conn->query($sql);?>
            <?php
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                ?>
            <form class="form ml-5">
                <p><?php echo $row['Question']; ?></p>
                <div class="form-group">
                    <input type="radio" id="male" name="gender" value="1">
                    <label for="male"><?php echo $row['op1']; ?></label>
                </div>
                <div class="form-group">
                    <input type="radio" id="female" name="gender" value="2">
                    <label for="female"><?php echo $row['op2']; ?></label>
                </div>
                <div class="form-group">
                    <input type="radio" id="female" name="gender" value="3">
                    <label for="female"><?php echo $row['op3']; ?></label>
                </div>
                <div class="form-group">
                    <input type="radio" id="female" name="gender" value="4">
                    <label for="female"><?php echo $row['op4']; ?></label>
                </div>
            </form>
        </div>
        <div class="row p-5">
            <div class="col-lg-10" id="backdiv">
                <button class="btn btn-primary" id="back" data-id="1">BACK</button>
            </div>
            <div class="col-lg-2 ">
                <button class="btn btn-primary" id="next" data-id="1">NEXT</button>
            </div>
        </div>
        <?php
                            }
                        }?>


    </div>
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