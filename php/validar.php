<?php
session_start();

if (!isset($_SESSION['email']) || !$_SESSION['habilitado']) {
  header("Location: ../login.html");
  exit();
}
?>
