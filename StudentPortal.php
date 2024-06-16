<?php 
   session_start();
?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Login | GHS - MUJ</title>
  <link rel="stylesheet" href="src/StudentStyles.css">
  <script src="src/scripts.js"></script>
</head>

<body>
  <div class="wrapper">
    <?php

    include ("php/config.php");
    if (isset($_POST['submit'])) {
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $password = mysqli_real_escape_string($con, $_POST['password']);

      $result = mysqli_query($con, "SELECT * FROM member WHERE Email='$email' AND Password='$password' ") or die("Select Error");
      $row = mysqli_fetch_assoc($result);

      if (is_array($row) && !empty($row)) {
        $_SESSION['Studentvalid'] = $row['Email'];
        $_SESSION['username'] = $row['Name'];
        $_SESSION['password'] = $row['Password'];
        $_SESSION['gender'] = $row['Gender'];
        $_SESSION['contact'] = $row['Contact'];
        $_SESSION['age'] = $row['Age'];
        $_SESSION['id'] = $row['MemberID'];
      } else {
        echo "<div class='message'>
                     <p>Wrong Username or Password</p>
                      </div> <br>";
        echo "<a href='StudentPortal.php'><button class='btn'>Go Back</button>";

      }
      if (isset($_SESSION['Studentvalid'])) {
        header("location: StudentHome.php");
      }
    } else {


      ?>
      <form action="" method="post">
        <h2>Student Login</h2>
        <div class="input-field">
          <input type="text" name="email" id="email" autocomplete="off" id="username" required>
          <label for="email">Email</label>
        </div>
        <div class="input-field">
          <input type="password" name="password" minlength="8" id="password" autocomplete="off" required>
          <label for="password">Password</label>
        </div>
        <div class="forget">
          <label for="remember">
            <input type="checkbox" id="remember">
            <p>Remember me</p>
          </label>
          <a href="ForgotPass.php">Forgot password?</a>
        </div>
        <div class="field">
          <input type="submit" class="btn" name="submit" value="Login" style="background: #fff;color: #000;font-weight: 600;border: none;padding: 12px 20px;cursor: pointer;border-radius: 3px;font-size: 16px;border: 2px solid transparent;" required>
        </div>
        <div class="register">
          <p>Don't have an account? <b><a href="StudentRegister.php">Register</a></b></p>
        </div>
      </form>
    <?php } ?>
  </div>
</body>

</html>

