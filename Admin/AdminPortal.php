<?php 
   session_start();
?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login | GHS - MUJ</title>
  <link rel="stylesheet" href="../src/StudentStyles.css">
</head>

<body>
  <div class="wrapper">
    <?php

    include ("../php/config.php");
    if (isset($_POST['submit'])) {
      $username = mysqli_real_escape_string($con, $_POST['username']);
      $password = mysqli_real_escape_string($con, $_POST['password']);

      $result = mysqli_query($con, "SELECT * FROM admin WHERE Username='$username' AND Password='$password' ") or die("Select Error");
      $row = mysqli_fetch_assoc($result);

      if (is_array($row) && !empty($row)) {
        $_SESSION['Adminvalid'] = $row['Username'];
        $_SESSION['password'] = $row['Password'];
        $_SESSION['id'] = $row['AdminID'];
      } else {
        echo "<div class='message'>
                     <p>Wrong Username or Password</p>
                      </div> <br>";
        echo "<a href='AdminPortal.php'><button class='btn'>Go Back</button>";

      }
      if (isset($_SESSION['Adminvalid'])) {
        header("location: AdminDash.php");
      }
    } else {


      ?>
      <form action="" method="post">
        <h2>Admin Login</h2>
        <div class="input-field">
          <input type="text" name="username" id="username" autocomplete="off" required>
          <label for="username">Username</label>
        </div>
        <div class="input-field">
          <input type="password" name="password" id="password" autocomplete="off" required>
          <label for="password">Password</label>
        </div>
        <div class="forget">
          <label for="remember">
            <input type="checkbox" id="remember">
            <p>Remember me</p>
          </label>
          <a href="../ForgotPass.php">Forgot password?</a>
        </div>
        <div class="field">
          <input type="submit" class="btn" name="submit" value="Login" style="background: #fff;color: #000;font-weight: 600;border: none;padding: 12px 20px;cursor: pointer;border-radius: 3px;font-size: 16px;border: 2px solid transparent;" required>
        </div>
      </form>
    <?php } ?>
  </div>
</body>

</html>

