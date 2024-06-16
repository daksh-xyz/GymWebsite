<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration | GHS - MUJ</title>
  <link rel="stylesheet" href="../src/StudentStyles.css">
  <script src="src/scripts.js"></script>
</head>

<body>
  <div class="wrapper">
    <?php
    include ("../php/config.php");
    if (isset($_POST['submit'])) {
      $username = $_POST['username'];
      $gender = $_POST['gender'];
      $age = $_POST['age'];
      $contact = $_POST['contact'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Verifying the uniqueness of email
      $verify_query = mysqli_query($con, "SELECT Email FROM member WHERE Email='$email'");

      if (mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message'>
                  <p style='color:red;'>This email is already in use. Please log in.</p>
              </div> <br>";
        echo "<a href='StudentPortal.php'><button class='btn'>Log In</button></a>&nbsp;&nbsp;<a href='StudentRegister.php'><button class='btn'>Register</button></a>";
      } else {
        mysqli_query($con, "INSERT INTO member(Name, Gender, Age, Contact, Email, Password) VALUES('$username', '$gender', '$age', '$contact', '$email', '$password')") or die("Error Occurred");
        echo "<div class='message'>
                  <p style='color: #fff;'>Registered successfully!</p>
              </div> <br>";
        echo "<a href='StudentPortal.php'><button class='btn'>Login Now</button></a>";
      }
    } else {
      ?>
      <form action="" method="post">
        <h2>Student Sign Up</h2>
        <div class="input-field">
          <input type="text" name="username" id="username" autocomplete="off" required>
          <label for="username">Name</label>
        </div>
        <div class="input-field">
          <input type="text" name="gender" id="gender" autocomplete="off" required>
          <label for="gender">Gender</label>
        </div>
        <div class="input-field">
          <input type="number" name="age" id="age" autocomplete="off" required>
          <label for="age">Age</label>
        </div>
        <div class="input-field">
          <input type="number" name="contact" minlength="5" maxlength="9" id="contact" autocomplete="off" required>
          <label for="contact">Contact</label>
        </div>
        <div class="input-field">
          <input type="email" name="email" id="email" autocomplete="off" required>
          <label for="email">Email</label>
        </div>
        <div class="input-field">
          <input type="password" name="password" minlength="8" maxlength="20" id="password" autocomplete="off" required>
          <label for="password">Password</label>
        </div>
        <input type="submit" class="btn" name="submit" value="Sign Up"
          style="background: #fff;color: #000;font-weight: 600;border: none;padding: 12px 20px;cursor: pointer;border-radius: 3px;font-size: 16px;border: 2px solid transparent;"
          required>
        <div class="register">
          <p>Already have an account? <b><a href="StudentPortal.php">Sign In</a></b></p>
        </div>
      </form>
    <?php } ?>
  </div>
</body>

</html>