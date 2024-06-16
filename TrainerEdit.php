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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/HomeStyle.css">
    <title>Change Profile</title>
</head>

<body>
    <div class="navbar">
    <table width=100% height="100px" class="navtable">
        <tr>
            <td width="10%">
                <a href="StudentHome.php"><img src="./src/GHSlogoFinal-011-1-300x147.png.webp" height="80px"
                        width="160px"></a>
            </td>
            <td width=70%></td>
            <td><a href="#">Change Profile</a></td>
            <td><a href="php/logout.php"> <button id="Update">Log Out</button></a></td>
        </tr>
    </table>
    </div>
    <div class="container">
        <div class="box form-box">
            <?php
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $age = $_POST['age'];
                $gender = $_POST['gender'];
                $contact = $_POST['contact'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con, "UPDATE trainer SET Name='$username',Age='$age',Gender='$gender', Contact='$contact', Email='$email', Password='$password' WHERE TrainerID=$id ") or die("error occurred");

                if ($edit_query) {
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
                    echo "<a href='TrainerHome.php'><button class='btn'>Go Home</button></a>";

                }
            } else {

                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT*FROM trainer WHERE TrainerID=$id ");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_Uname = $result['Name'];
                    $res_Age = $result['Age'];
                    $res_Gender = $result['Gender'];
                    $res_Contact = $result['Contact'];
                    $res_Email = $result['Email'];
                    $res_Password = $result['Password'];
                }

                ?>
                <h2 align="CENTER">Edit your profile</h2>
                <form action="" method="post">
                    <table class="Trainer" align="CENTER">
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Password</th>
                        <tr>
                            <td><span id="input-field"><input type="text" name="username" value="<?php echo $res_Uname; ?>" required></td>
                            <td><span id="input-field"><input type="number" name="age" value="<?php echo $res_Age; ?>" required></td>
                            <td><span id="input-field">
                                <select id="gender" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </td>
                            <td><span id="input-field"><input type="number" name="contact" minlength="5" maxlength="9" value="<?php echo $res_Contact; ?>" required></td>
                            <td><span id="input-field"><input type="text" name="email" value="<?php echo $res_Email; ?>" required></td>
                            <td><span id="input-field"><input type="text" name="password" minlength="8" maxlength="20" id="password" value="<?php echo $res_Password; ?>"
                                    required></td>
                        </tr>
                    </table>
                    <div class="updateDiv">
                        <input type="submit" id="Update" name="submit" value="Update" required>
                        <br>
                        <a href="TrainerHome.php" id="Update" style="text-align:center;">Go Back</a>
                    </div>

                </form>
            </div>
        <?php } ?>
    </div>
</body>

</html>