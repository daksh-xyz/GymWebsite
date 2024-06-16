<?php
session_start();

include ("php/config.php");
if (!isset($_SESSION['Trainervalid'])) {
    header("Location: TrainerPortal.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/HomeStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <title>Trainer Home | Gym</title>
</head>

<body>

</body>

</html>

<body>
    <div class="navbar">
        <table width=100% height="100px" class="navtable">
            <tr>
                <td width="10%">
                    <a href="TrainerHome.php"><img src="./src/GHSlogoFinal-011-1-300x147.png.webp" height="80px"
                            width="160px"></a>
                </td>
                <td width=70%></td>
                <?php
                $res_id = null;
                $res_Uname = null;
                $res_Email = null;
                $res_Salary = null;

                $id = (int) $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM trainer WHERE TrainerID=$id");


                while ($result = mysqli_fetch_assoc($query)) {
                    $res_id = $result['TrainerID'];
                    $res_Uname = $result['Name'];
                    $res_Age = $result['Age'];
                    $res_Gender = $result['Gender'];
                    $res_Contact = $result['Contact'];
                    $res_Email = $result['Email'];
                    $res_Salary = $result['Salary'];
                }
                echo "<td><a href='TrainerEdit.php?TrainerID=$res_id'>Change Profile</a></td>";
                ?>

                <td><a href="php/Trainerlogout.php"> <button id="logOut">Log Out</button></a></td>
            </tr>
        </table>
    </div>
    <div class="content">
        <table width="60%" class="Trainer">
            <tr><th colspan="6">Your Details</th></tr>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Salary</th>
            <tr>
                <?php echo "<td>$res_Uname</td>";?>
                
                <?php echo "<td>$res_Age</td>";?>
                
                <?php echo "<td>$res_Gender</td>";?>
                
                <?php echo "<td>$res_Contact</td>";?>
            
                <?php echo "<td style='white-space:nowrap;'>$res_Email</td>";?>

                <?php echo "<td>₹$res_Salary</td>";?>
            </tr>
        </table>
    </div>
    <div class="members">
        <table class="Member" align="center">
            <tr><th colspan="7">Members Assigned</th></tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Status</th>
            <?php
            $Memberquery = "SELECT * FROM member WHERE TrainerID = $id";
            $Memberresult = mysqli_query($con, $Memberquery);
            while ($row = mysqli_fetch_assoc($Memberresult)) {
                $id = $row['MemberID'];
                $name = $row['Name'];
                $email = $row['Email'];
                $age = $row['Age'];
                $gender = $row['Gender'];
                $contact = $row['Contact'];
                $status = $row['Status'];
                echo ' <tr>
                    <td>'.$id.'</td>
                    <td>'.$name.'</td>
                    <td>'.$email.'</td>
                    <td>'.$age.'</td>
                    <td>'.$gender.'</td>
                    <td>'.$contact.'</td>
                    <td>'.$status.'</td>
                ';
            }
            ?>
        </table>
    </div>
</body>

</html>