<?php 
   session_start();
   include('../koneksi/koneksi.php');
   
   $judul = $_POST['judul'];
   $isi = $_POST['isi'];
   $tgl = $_POST['tanggal']; 

   if(empty($judul)){
      header("Location:tambahkonten.php?notif=tambahkosong&jenis=judul");
   } else if(empty($tgl)){
      header("Location:tambahkonten.php?notif=tambahkosong&jenis=tanggal");
   } else {   
      $ex = explode("-", $tgl);
      $hari = $ex[0];
      $bulan = $ex[1];
      $tahun = $ex[2];
      $tanggal = $tahun.'-'.$bulan.'-'.$hari;

      $sql = "INSERT INTO `konten` (`judul`, `tanggal`, `isi`) VALUES ('$judul', '$tanggal', '$isi')";
      
      if (mysqli_query($koneksi, $sql)) {
         header("Location:konten.php?notif=tambahberhasil");
      } else {
         echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
      }
   }
?>
