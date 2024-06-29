<?php
  //* check direct access permission
  if (!defined('access')) { die('Direct access is not permitted!'); }
  //* check access page by level
  if (!defined('supervisor')) { die('Access denied, not enough level!'); }
?>

<div class="page-inner">
  <div class="page-header">
		<h4 class="page-title">Kelola Data Customer</h4>
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
				<a href="">Kelola Data Customer</a>
			</li>
		</ul>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex align-items-center">
            <h4 class="card-title">Data Customer</h4>
            <a href="?p=tambah-data-customer" class="btn btn-primary btn-round btn-sm ml-auto"> <i class="fas fa-plus mr-2"></i> Tambah</a>
          </div>
				</div>
				<div class="card-body">
          <div class="table-responsive">
            <table id="DataTables" class="display table table-striped table-hover">
              <thead>
                <th>ID</th>
                <th class="w-20">Nama</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Email</th>
                <th>Nik</th>
                <th class="w-20">Setting</th>
              </thead>
              <tbody>
                <?php
                  $rows = $customer->getListDataCustomer();
                  if ($rows != false)
                  {
                    foreach ($rows as $data_customer)
                    {
                ?>
                  <tr>
                    <td> <?php echo $data_customer['id'] ?> </td>
                    <td> <?php echo $data_customer['nama'] ?> </td>
                    <td> <?php echo $data_customer['alamat'] ?> </td>
                    <td> <?php echo $data_customer['no_telp'] ?> </td>
                    <td> <?php echo $data_customer['email'] ?> </td>
                    <td> <?php echo $data_customer['nik'] ?> </td>
                    <td>
                      <a href="?p=ubah-data-customer&id=<?php echo $data_customer['id'] ?>" class="btn btn-primary btn-round btn-sm"> <i class="fas fa-edit mr-2"></i> Ubah</a> 
                      <a href="?p=hapus-data-customer&id=<?php echo $data_customer['id'] ?>" onclick="validateRemove(event)" class="btn btn-danger btn-round btn-sm"> <i class="fas fa-trash-alt mr-2"></i> Hapus</a>
                    </td>
                  </tr>
                <?php
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>