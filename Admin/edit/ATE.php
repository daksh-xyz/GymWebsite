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
    <title>Admin Trainer Edit</title>
</head>

<body>
    <?php

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $password = $_POST['password'];
        $salary = $_POST['salary'];

        $query = "UPDATE trainer SET Name='$name',Age='$age',Gender='$gender',Email='$email',Contact='$contact',Password='$password',Salary='$salary' WHERE TrainerID=$id";
        $result = mysqli_query($con, $query);

        if ($query) {
            echo "<div class='message'>
            <p>Profile Updated!</p>
        </div> <br>";
            echo "<a href='AdminHome.php'><button class='btn'>Go Home</button>";

        }

    } else {
        $query = mysqli_query($con, "SELECT*FROM trainer WHERE TrainerID=$id ");

        while ($result = mysqli_fetch_assoc($query)) {
            $res_Uname = $result['Name'];
            $res_Age = $result['Age'];
            $res_Gender = $result['Gender'];
            $res_Contact = $result['Contact'];
            $res_Email = $result['Email'];
            $res_Password = $result['Password'];
            $res_Salary = $result['Salary'];
        }


        ?>
        <h2 style="text-align: center;">Edit Trainer Profile</h2>
        <form action="" method="post">
            <table id="usertable" class="Member">
                <th>Name</th>
                <th>Age</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Password</th>
                <th>Salary</th>
                <tr>
                    <td><span id="input-field"><input type="text" name="name" value="<?php echo $res_Uname; ?>" required></span></td>
                    <td><span id="input-field"><input type="number" name="age" value="<?php echo $res_Age; ?>" required></span></td>
                    <td><span id="input-field">
                        <select id="gender" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        </span>
                    </td>
                    <td><span id="input-field"><input type="number" name="contact" minlength="5" maxlength="9" value="<?php echo $res_Contact; ?>" required></span></td>
                    <td><span id="input-field"><input type="text" name="email" value="<?php echo $res_Email; ?>" required></span></td>
                    <td><span id="input-field"><input type="text" name="password" minlength="8" id="password" value="<?php echo $res_Password; ?>" required></span></td>
                    <td><span id="input-field"><input type="number" name="salary" id="salary" value="<?php echo $res_Salary; ?>" required></span></td>
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