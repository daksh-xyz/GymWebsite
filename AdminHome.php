<?php
session_start();

include ("php/config.php");
if (!isset($_SESSION['Adminvalid'])) {
    header("Location: AdminPortal.php");
}
$Memberquery = "SELECT * FROM member";
$Memberresult = mysqli_query($con, $Memberquery);



$Trainerquery = "SELECT * FROM trainer";
$Trainerresult = mysqli_query($con, $Trainerquery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/AdminStyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <title>Admin Home</title>
</head>

<body>

    <div class="navbar">
        <table width=100% height="100px" class="navtable">
            <tr>
                <td width="10%">
                    <a href="AdminHome.php"><img src="./src/GHSlogoFinal-011-1-300x147.png.webp" height="80px"
                            width="160px"></a>
                </td>
                <td width=70%></td>
                <td width=10%><a href="AdminDash.php">Dashboard</a< /td>
                <td width=10%><a href="php/Adminlogout.php"><button id="logOut">Log Out</button></a></td>
            </tr>
        </table>
    </div>

    <div class="content">
        <!-- Member Record -->
        <table width="90%" class="Member" align="CENTER">
            <tr>
                <th colspan="11">
                    <h2>Member Record</h2>
                </th>
            </tr>
            <th>ID</th>
            <th>Name</th>
            <th>Trainer Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Address</th>
            <th style="white-space:nowrap;">Join Date</th>
            <th>Status</th>
            <th colspan="2">Operations</th>
            <?php
            while ($row = mysqli_fetch_assoc($Memberresult)) {
                $id = $row['MemberID'];
                $name = $row['Name'];
                $getTname = "SELECT t.Name FROM member m JOIN trainer t ON m.trainerid = t.trainerid where m.MemberID = $id";
                $getTresult = mysqli_query($con, $getTname);
                $row2 = mysqli_fetch_assoc($getTresult);
                $tid = $row2['Name'];
                $email = $row['Email'];
                $age = $row['Age'];
                $gender = $row['Gender'];
                $contact = $row['Contact'];
                $address = $row['Address'];
                $joinDate = $row['Join_Date'];
                $status = $row['Status'];
                echo ' <tr>
                    <th>' . $id . '</th>
                    <td>' . $name . '</td>
                    <td>' . $tid . '</td>
                    <td>' . $email . '</td>
                    <td>' . $age . '</td>
                    <td>' . $gender . '</td>
                    <td>' . $contact . '</td>
                    <td>' . $address . '</td>
                    <td>' . $joinDate . '</td>
                    <td>' . $status . '</td>
                    <td><button id="edit"><a href="ASE.php?editid=' . $id . '">Edit</a></button></td>
                    <td><button id="delete"><a href="ASD.php?deleteid=' . $id . '">Delete</a></button></td>
                ';
            }
            ?>
        </table>
        <br><br><br>
        <!-- Trainer Update Form -->
        <table width="80%" class="Trainer" align="CENTER">
            <tr>
                <th colspan="9">
                    <h2>Trainer Record</h2>
                </th>
            </tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Salary</th>
            <th colspan="2">Operations</th>
            <?php
            while ($row = mysqli_fetch_assoc($Trainerresult)) {
                $id = $row['TrainerID'];
                $name = $row['Name'];
                $age = $row['Age'];
                $gender = $row['Gender'];
                $email = $row['Email'];
                $contact = $row['Contact'];
                $salary = $row['Salary'];
                echo ' <tr>
                    <th>' . $id . '</th>
                    <td>' . $name . '</td>
                    <td>' . $age . '</td>
                    <td>' . $gender . '</td>
                    <td>' . $email . '</td>
                    <td>' . $contact . '</td>
                    <td>₹' . $salary . '</td>
                    <td><button id="edit"><a href="ATE.php?editid=' . $id . '">Edit</a></button></td>
                    <td><button id="delete"><a href="ATD.php?deleteid=' . $id . '">Delete</a></button></td>
                ';
            }
            ?>
        </table>

    </div>
</body>

</html>