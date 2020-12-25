<?php
session_start();
include('config.php');
if (isset($_POST)) {
    $id=isset($_POST['id'])?$_POST['id']:'';
    $action=isset($_POST['action'])?$_POST['action']:'';
    if ($action=="next") {
        $sql = "SELECT * FROM ".$_SESSION['testdata']['name'] ." LIMIT 1,".$id."";
        $result = $conn->query($sql);
        $array=[];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($array, $row);
            }
        }
        $array = json_encode($array);
        echo $array;
    }
    else{
        $id=$id-1;
        if ($id==1) {
            $sql = "SELECT * FROM ".$_SESSION['testdata']['name'] ." LIMIT 1";
        }
        else{
            $sql = "SELECT * FROM ".$_SESSION['testdata']['name'] ." LIMIT 1,".$id."";
        }
        $result = $conn->query($sql);
        $array=[];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($array, $row);
            }
        }
        $array = json_encode($array);
        echo $array;
    }
}
?>