<?php
session_start();

include ("php/config.php");
if (!isset($_SESSION['Studentvalid'])) {
    header("Location: StudentPortal.php");
}
$mid = (int) $_SESSION['id'];
$getTname = "SELECT t.Name FROM member m JOIN trainer t ON m.trainerid = t.trainerid where m.MemberID = $mid";
$getTresult= mysqli_query($con, $getTname);
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
    <title>Student Home | Gym</title>
</head>

<body>

</body>

</html>

<body>
    <div class="navbar">
        <table width=100% height="100px" class="navtable">
            <tr>
                <td width="10%">
                    <a href="StudentHome.php"><img src="./src/GHSlogoFinal-011-1-300x147.png.webp" height="80px"
                            width="160px"></a>
                </td>
                <td width=70%></td>
                <?php
                $res_id = null;
                $res_Uname = null;
                $res_Email = null;
                $res_Age = null;
                $res_Gender = null;
                $res_Contact = null;
                $res_Address = null;
                $res_Status = null;

                $id = (int) $_SESSION['id'];
                $query = mysqli_query($con, "SELECT*FROM member WHERE MemberID=$id");


                while ($result = mysqli_fetch_assoc($query)) {
                    $res_id = $result['MemberID'];
                    $res_Uname = $result['Name'];
                    $row2 = mysqli_fetch_assoc($getTresult);
                    $tid = $row2['Name'];
                    $res_Age = $result['Age'];
                    $res_Gender = $result['Gender'];
                    $res_Email = $result['Email'];
                    $res_Contact = $result['Contact'];
                    $res_Address = $result['Address'];
                    $res_Status = $result['Status'];
                }
                echo "<td style='text-align:right;'><a href='StudentEdit.php?MemberID=$res_id'><img src='./src/account.png' width='50px' height='50px'></a></td>
                <td style='text-align:left;padding-left:15px'><a href='StudentEdit.php?MemberID=$res_id'>$res_Uname</a></td>";
                ?>
            </tr>
        </table>
    </div>
    <div class="content">
        <table class="Member">
            <th>Name</th>
            <th style='white-space: nowrap;'>Trainer Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Status</th>
            <tr>
                
                <?php echo "<td style='white-space: nowrap;'>$res_Uname</td>";?>

                <?php echo "<td style='white-space: nowrap;'>$tid</td>";?>

                <?php echo "<td>$res_Email</td>";?>
                
                <?php echo "<td>$res_Age</td>";?>

                <?php echo "<td>$res_Gender</td>";?>

                <?php echo "<td>$res_Contact</td>";?>
                
                <?php echo "<td id='address'>$res_Address</td>";?>
                
                <?php echo "<td>$res_Status</td>";?>
            </tr>
        </table>
    </div>
    <div class="logOutdiv">
        <a href="php/logout.php"> <button id="logOut">Log Out</button></a>
    </div>
</body>

</html>