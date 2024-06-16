<?php

include '../../php/config.php';
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $query = "delete from trainer where TrainerID=$id";
    $result = mysqli_query($con, $query);
    if($result){
        echo" Deleted successfully";
        echo"<br><br><br>";
        echo'<button><a href="../AdminHome.php">Go Back</button>';
    }else{
        die(mysqli_error($con));
    }
}

?>