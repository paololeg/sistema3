<?php
 session_start();
 session_unset();
 session_destroy();
 include '../backup.php';
 echo "<script>window.location.href='../index.html';</script>";
 //header("location:../index.html");
?>