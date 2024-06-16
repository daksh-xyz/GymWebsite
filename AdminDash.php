<?php
session_start();

include ("php/config.php");
if (!isset($_SESSION['Adminvalid'])) {
    header("Location: AdminPortal.php");
}
$aMembers = mysqli_query($con, "SELECT count(MemberID) as activeMembers from member where Status = 'activated'");
if($aMembers){
    $aMem = mysqli_fetch_assoc($aMembers);
}
$nMembers = mysqli_query($con, "SELECT count(MemberID) as totalMembers from member");
$nMem = mysqli_fetch_assoc($nMembers);
$nTrainers = mysqli_query($con, "SELECT count(TrainerID) as totalTrainers from trainer");
$nTrain = mysqli_fetch_assoc($nTrainers);
$incomequery = mysqli_query($con, "SELECT SUM(Amount) as cash FROM payment p LEFT JOIN member m ON p.MemberID = m.MemberID WHERE m.Status = 'activated'");
$newMembers = mysqli_query($con, "SELECT count(MemberID) as newMem from member where Join_Date = CURDATE()");
$newMem = mysqli_fetch_assoc($newMembers);
if($incomequery){
    $income = mysqli_fetch_assoc($incomequery);
}else {
    // If the query failed, output the error
    echo "Error: " . mysqli_error($con);
}
$revenuequery = mysqli_query($con,"SELECT SUM(Salary) as sal from trainer");
$revenue = mysqli_fetch_assoc($revenuequery);
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
                <td width=10% style="text-align:right;"><a href="AdminHome.php">Home</a></td>
                <td width=10%><a href="php/Adminlogout.php"><button id="logOut">Log Out</button></a></td>
            </tr>
        </table>
    </div>
    <div class="">
        <table class="Dashtable" align="CENTER">
            <tr>
                <td>
                    Total Revenue <h2><?php echo $income['cash'] ?></h2>
                </td>
                <td>
                    Number of Members <h2><?php echo $nMem['totalMembers']; ?></h2>
                </td>
                <td>
                    Number of Trainers <h2><?php echo $nTrain['totalTrainers']; ?></h2>
                </td>
                <td>
                    Total Income <h2><?php echo $income['cash'] - $revenue['sal']; ?></h2>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <?php include('chart.php') ?>
                </td>
                <td>
                    <?php $lMem = (int)$nMem['totalMembers'] - (int)($aMem['activeMembers']);
                    if($newMem['newMem']){
                        echo "New Members\n<h2>", $newMem['newMem'], "<span style='color: #008000;'> ▲</span></h2>";
                    }if($lMem < (int)$nMem['totalMembers']){
                        echo "Lost Memberships\n<h2>", $lMem , "<span style='color: red;'> ▼</span></h2>";
                    } ?>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>