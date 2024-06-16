<?php
      session_start();
      unset($_SESSION["AdminValid"]);
      header("Location: ../AdminPortal.php");
?>