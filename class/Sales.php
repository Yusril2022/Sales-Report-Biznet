<?php

class sales
{
  public $koneksi;

  public function __construct()
  {
    $this->koneksi = new Koneksi();
  }

  public function getListDataSales()
  {
    $query = "SELECT * FROM data_sales";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $listDataSales = [];
    if ($result->num_rows > 0)
    {
      while ($row = $result->fetch_array(MYSQLI_ASSOC))
      {
        $listDataSales[] = $row;
      }
    }
    $stmt->close();
    return $listDataSales;
  }

  public function getNextIDDataSales()
  {
    $query = "SELECT MAX(id) FROM data_sales";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      $row = $result->fetch_array();
      $last_id = (int) $row[0];
      $next_id = str_pad($last_id + 1, 2, "0", STR_PAD_LEFT);
    }
    else
    {
      $next_id = "01";
    }
    $stmt->close();
    return $next_id;
  }

  public function addDataSales($nama, $alamat, $no_telp, $email, $nik, $service)
  {
    $nama = strtoupper(trim($nama));
    $id = $this->getNextIDDataSales();

    $verify = "SELECT * FROM data_sales WHERE id=?";
    $stmt = $this->koneksi->db->prepare($verify);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0)
    {
      $query = "INSERT INTO data_sales (id, nama, alamat, no_telp, email, nik, service) VALUES (?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->koneksi->db->prepare($query);
      $stmt->bind_param("sssssss", $id, $nama, $alamat, $no_telp, $email, $nik, $service);
      $result = $stmt->execute();

      if ($result)
      {
        $notice = "<div class='alert alert-success alert-dismissible fade show mb-0'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                    <i class='fas fa-check mr-2'></i> Data berhasil disimpan!
                   </div>";
      }
      else
      {
        $notice = "<div class='alert alert-danger alert-dismissible fade show mb-0'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                    <i class='fas fa-exclamation mr-2'></i> Terjadi kesalahan saat menyimpan data!
                   </div>";
      }
    }
    else
    {
      $notice = "<div class='alert alert-danger alert-dismissible fade show mb-0'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <i class='fas fa-exclamation mr-2'></i> Ditemukan id jenis yang sama pada sistem!
                 </div>";
    }
    $stmt->close();
    return $notice;
  }

  public function getInfoDataSales($id)
  {
    $query = "SELECT * FROM data_sales WHERE id=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      $stmt->close();
      return $row;
    }
    $stmt->close();
    return null;
  }

  public function editDataSales($id, $nama, $alamat, $no_telp, $email, $nik, $service)
  {
    $nama = strtoupper(trim($nama));

    $query = "UPDATE data_sales SET nama=?, alamat=?, no_telp=?, email=?, nik=?, service=? WHERE id=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("sssssss", $nama, $alamat, $no_telp, $email, $nik, $service, $id);
    $result = $stmt->execute();

    if ($result)
    {
      $notice = "<div class='alert alert-success alert-dismissible fade show mb-0'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <i class='fas fa-check mr-2'></i> Data berhasil diperbarui!
                 </div>";
      echo "<meta http-equiv='refresh' content='4'>";
    }
    else
    {
      $notice = "<div class='alert alert-danger alert-dismissible fade show mb-0'>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                  <i class='fas fa-exclamation mr-2'></i> Terjadi kesalahan saat memperbarui data!
                 </div>";
    }
    $stmt->close();
    return $notice;
  }

  public function deleteDataSales($id)
  {
    $query = "DELETE FROM data_sales WHERE id=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id);
    $result = $stmt->execute();

    if ($result)
    {
      echo "<script>
              window.location.href = \"?p=data-sales\";
            </script>";
    }
    else
    {
      echo "<script>
              alert('Terjadi kesalahan pada database!');
              window.location.href = \"?p=data-sales\";
            </script>";
    }
  }
}
?>
