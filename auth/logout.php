<?php
  if (isset($_SESSION['id_pengguna']))
  {
	  $pengguna->delSession('id_pengguna');
	  $pengguna->delSession('nama');
    $pengguna->delSession('status');
  }
	echo "<script> window.location=' ../auth/login.php'; </script>";
?>