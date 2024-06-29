<?php

class customer
{
  public $koneksi;

  public function __construct()
  {
    $this->koneksi = new Koneksi();
  }

  public function getListDataCustomer()
  {
    $query = "SELECT * FROM data_customer";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    $listDataCustomer = [];
    if ($result->num_rows > 0)
    {
      while ($row = $result->fetch_array(MYSQLI_ASSOC))
      {
        $listDataCustomer[] = $row;
      }
    }
    $stmt->close();
    return $listDataCustomer;
  }

  public function getNextIDDataCustomer()
  {
    $query = "SELECT MAX(id) FROM data_customer";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0)
    {
      $row = $result->fetch_array();
      $last_id = substr($row[0], 2);
      $next_id = "" . str_pad($last_id, 2, "0", STR_PAD_LEFT);
    }
    else
    {
      $next_id = "";
    }
    $stmt->close();
    return $next_id;
  }

  public function addDataCustomer($nama, $alamat, $no_telp, $email, $nik)
  {
    $nama = strtoupper(trim($nama));

    $id = $this->getNextIDDataCustomer();

    $verify = "SELECT * FROM data_customer WHERE id=?";
    $stmt = $this->koneksi->db->prepare($verify);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0)
    {
      $query = "INSERT INTO data_customer (id, nama, alamat, no_telp, email, nik) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $this->koneksi->db->prepare($query);
      $stmt->bind_param("ssssss", $id, $nama, $alamat, $no_telp, $email, $nik);
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

  public function getInfoDataCustomer($id)
  {
    $query = "SELECT * FROM data_customer WHERE id=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      return $row;
    }
    $stmt->close();
    return null;
  }

  public function editDataCustomer($id, $nama, $alamat, $no_telp, $email, $nik)
  {
    $nama = strtoupper(trim($nama));

    $query = "UPDATE data_customer SET nama=?, alamat=?, no_telp=?, email=?, nik=? WHERE id=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("ssssss", $nama, $alamat, $no_telp, $email, $nik, $id);
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

  public function deleteDataCustomer($id)
  {
    $query = "DELETE FROM data_customer WHERE id=?";
    $stmt = $this->koneksi->db->prepare($query);
    $stmt->bind_param("s", $id);
    $result = $stmt->execute();

    if ($result)
    {
      echo "<script>
              window.location.href = \"?p=data-customer\";
            </script>";
    }
    else
    {
      echo "<script>
              alert('Terjadi kesalahan pada database!');
              window.location.href = \"?p=data-customer\";
            </script>";
    }
  }
}
?>
