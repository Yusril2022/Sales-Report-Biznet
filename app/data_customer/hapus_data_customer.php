<?php
  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('supervisor')) { die('Access denied, not enough level!'); }

  //* check retrieved variable
  $id = mysqli_real_escape_string($koneksi->db, $_GET['id']);
  //* call delete function
  $customer->deleteDataCustomer($id);
?>