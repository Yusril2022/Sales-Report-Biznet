<?php
  //* define notice variable
  $result_notice = '';

  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('supervisor')) { die('Access denied, not enough level!'); }

  //* check retrieved variable
  $id = mysqli_real_escape_string($koneksi->db, $_GET['id']);

  //* call get info function
  $data_sales = $sales->getInfoDataSales($id);

  //* simpan
  if (isset($_POST['perbarui']))
  {
    $id          = mysqli_real_escape_string($koneksi->db, $_POST['id']);
    $nama         = mysqli_real_escape_string($koneksi->db, $_POST['nama']);
    $alamat          = mysqli_real_escape_string($koneksi->db, $_POST['alamat']);
    $no_telp          = mysqli_real_escape_string($koneksi->db, $_POST['no_telp']);
    $email          = mysqli_real_escape_string($koneksi->db, $_POST['email']);
    $nik          = mysqli_real_escape_string($koneksi->db, $_POST['nik']);
    $service          = mysqli_real_escape_string($koneksi->db, $_POST['service']);


    $result = $sales->editDataSales($id, $nama, $alamat, $no_telp, $email, $nik, $service);
    $result_notice = $result;
  }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Ubah Data Sales</h4>
		<ul class="breadcrumbs">
			<li class="nav-home">
				<a href="?p=dashboard">
					<i class="flaticon-home"></i>
				</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="?p=master-tindakan">Data Sales</a>
      </li>
      <li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="">Ubah Data Sales</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Form Ubah Data Sales</h4>
        </div>
        <div class="card-body">
          <div class="form-group">
            <?php echo $result_notice; ?>
          </div>
          <form name="frmUbahDataSales" method="POST" action="">
            <div class="form-group">
              <label for="id">ID</label>
              <input type="text" class="form-control" name="id" value="<?php echo $data_sales['id'] ?>" maxlength="11" required>
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control" name="nama" value="<?php echo $data_sales['nama'] ?>" maxlength="128" required>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" name="alamat" value="<?php echo $data_sales['alamat'] ?>" maxlength="128" required>
            </div>
            <div class="form-group">
              <label for="no telepon">No Telepon</label>
              <input type="text" class="form-control" name="no_telp" value="<?php echo $data_sales['no_telp'] ?>" maxlength="128" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" name="email" value="<?php echo $data_sales['email'] ?>" maxlength="128" required>
            </div>
            <div class="form-group">
              <label for="nik">Nik</label>
              <input type="text" class="form-control" name="nik" value="<?php echo $data_sales['nik'] ?>" maxlength="128" required>
            </div>
            <div class="form-group">
              <label for="service">Service</label>
              <input type="text" class="form-control" name="service" value="<?php echo $data_sales['service'] ?>" maxlength="128" required>
            </div>
            <div class="form-group">
              <div class="d-flex align-items-center">
                <a href="?p=data-sales" class="btn btn-danger btn-round btn-sm mr-1 ml-auto"> <i class="fas fa-angle-left mr-2"></i> Kembali</a>
                <button type="reset" class="btn btn-default btn-round btn-sm mr-1" name="batal"> <i class="fas fa-sync-alt mr-2"></i> Batal</button>
                <button type="submit" class="btn btn-primary btn-round btn-sm mr-1" name="perbarui"> <i class="fas fa-save mr-2"></i> Perbarui</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>