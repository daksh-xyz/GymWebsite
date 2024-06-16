<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registeration | GHS - MUJ</title>
  <link rel="stylesheet" href="src/StudentStyles.css">
  <script src="src/scripts.js"></script>
</head>
<body>
  <div class="wrapper">
    <form onsubmit="return validateForm()">
      <h2>Sign Up</h2>
        <div class="input-field">
        <input type="text" id="username" required>
        <label>Enter your email</label>
      </div>      
      <button type="submit">Send Password Reset Link</button>
      <div class="register">
        <p><a href="index.php">Return to home page?</a></p>
      </div>
    </form>
  </div>
</body>
</html>