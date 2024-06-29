<?php

class Koneksi {
    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbpasswd = "";
    private $dbname = "biznet";
    
    public $db;

    public function __construct()
    {
      //* set default timezone
      date_default_timezone_set("Asia/Bangkok");

      $this->db = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpasswd, $this->dbname) or die("Koneksi ke db gagal!");
    } 
}

?>