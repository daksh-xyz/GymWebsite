<?php
      session_start();
      unset($_SESSION["Trainervalid"]);
      header("Location: ../TrainerPortal.php");
?>