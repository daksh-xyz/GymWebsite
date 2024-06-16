<?php

include '../../php/config.php';
$id = $_GET['editid'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../src/AdminStyle.css">
    <title>Admin Member Edit</title>
</head>

<body>
    <?php

    if (isset($_POST['submit'])) {
        $status = $_POST['status'];
        $contact = $_POST['contact'];
        $trainerid = $_POST['trainerid'];

        $query = "UPDATE member SET TrainerID='$trainerid',Contact='$contact',Status='$status' WHERE MemberID=$id;";
        $result = mysqli_query($con, $query);

        if ($query) {
            echo "<div class='message'>
            <p style='text-align:center;'>Profile Updated!</p>
        </div> <br>";
            echo "<a href='../AdminHome.php'><button class='btn'>Go Home</button>";
        }

    } else {
        $query = mysqli_query($con, "SELECT*FROM member WHERE MemberID=$id;");
        $query2 = mysqli_query($con,"SELECT MAX(TrainerID) AS MaxTrainerID FROM trainer;");
        $result2 = mysqli_fetch_assoc($query2);
        $res_MAX = $result2['MaxTrainerID'];
        while ($result = mysqli_fetch_assoc($query)) {
            $res_Uname = $result['Name'];
            $res_TrainerID = $result['TrainerID'];
            $res_Contact = $result['Contact'];
            $res_Email = $result['Email'];
            $res_Password = $result['Password'];
            $res_Status = $result['Status'];
        }


        ?>
        <h2 style="text-align: center;">Edit Member Profile</h2>
        <form action="" method="post">
            <table class="EditTable">
                <th>Name</th>
                <th>TrainerID</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Password</th>
                <th>Status</th>
                <tr>
                    <td><span id="input-field"><input type="text" name="name" value="<?php echo $res_Uname; ?>"
                                required></span></td>
                    <td><span id="input-field"><input type="number" name="trainerid" min="1" max="<?php echo $res_MAX; ?>"
                                value="<?php echo $res_TrainerID; ?>" required></span></td>
                    <td><span id="input-field"><input type="number" minlength="5" maxlength="9" name="contact" value="<?php echo $res_Contact; ?>"
                                required></span></td>
                    <td><span id="input-field"><input type="text" name="email" value="<?php echo $res_Email; ?>"
                                required></span></td>
                    <td><span id="input-field"><input type="text" name="password" minlength="8" id="password"
                                value="<?php echo $res_Password; ?>" required></span></td>
                    <td><span id="input-field">
                            <select id="status" name="status">
                                <option value="deactivated">Deactivated</option>
                                <option value="activated">Activated</option>
                            </select>
                        </span>
                    </td>
                </tr>
            </table>
            <div class="updateDiv">
                <input type="submit" id="Update" name="submit" value="Update" required>
                <br>
                <a id="Update" name="back" href="../AdminHome.php" style="text-align:center;text-decoration:none;">Go Back</a>
            </div>

        </form>
        </div>
    <?php } ?>
</body>

</html>