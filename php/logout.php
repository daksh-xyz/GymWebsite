<?php
      session_start();
      unset($_SESSION["Studentvalid"]);
      header("Location: ../StudentPortal.php");
?>