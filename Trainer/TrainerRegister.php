<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trainer Registeration | GHS - MUJ</title>
  <link rel="stylesheet" href="../src/StudentStyles.css">
</head>

<body>
  <div class="wrapper">
      <?php

      include ("../php/config.php");
      if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //verifying the unique email
      
        $verify_query = mysqli_query($con, "SELECT Email FROM trainer WHERE Email='$email'");

        if (mysqli_num_rows($verify_query) != 0) {
          echo "<div class='message'>
                      <p style='color:red;'>This email is used, Try logging in!</p>
                  </div> <br>";
          echo "<a href='TrainerPortal.php'><button class='btn'>Log In</button></a>&nbsp;&nbsp;<a href='TrainerRegister.php'><button class='btn'>Register</button></a>";
        } else {

          mysqli_query($con, "INSERT INTO trainer(Name,Contact,Email,Password) VALUES('$username','$contact','$email','$password')") or die("Error Occured");

          echo "<div class='message'>
                      <p style='color: #fff;'>Registered successfully!</p>
                  </div> <br>";
          echo "<a href='TrainerPortal.php'><button class='btn'>Login Now</button>";


        }

      } else {

        ?>
          <form action="" method="post">
            <h2>Trainer Sign Up</h2>
            <div class="input-field">
              <input type="text" name="username" id="username" autocomplete="off" required>
              <label for="username">Name</label>
            </div>

            <div class="input-field">
              <input type="number" name="contact" id="contact" minlength="5" maxlength="9" autocomplete="off" required>
              <label for="contact">Contact</label>
            </div>

            <div class="input-field">
              <input type="text" name="email" id="email" autocomplete="off" required>
              <label for="email">Email</label>
            </div>

            <div class="input-field">
              <input type="password" name="password" minlength="8" maxlength="20" id="password" autocomplete="off" required>
              <label for="password">Password</label>
            </div>

              <input type="submit" class="btn" name="submit" value="Sign Up" style="background: #fff;color: #000;font-weight: 600;border: none;padding: 12px 20px;cursor: pointer;border-radius: 3px;font-size: 16px;border: 2px solid transparent;" required>
            <div class="register">
          <p>Already have an account? <b><a href="TrainerPortal.php">Sign In</a></b></p>
            </div>
          </form>
      <?php } ?>
    </div>
</body>

</html>