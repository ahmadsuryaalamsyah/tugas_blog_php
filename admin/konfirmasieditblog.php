<?php 
session_start();
include('../koneksi/koneksi.php');
if(isset($_SESSION['id_blog'])){
    $id_blog = $_SESSION['id_blog'];
    $id_kategori_blog = $_POST['kategori'];
    $judul = $_POST['judul'];
    $tgl = $_POST['tanggal'];
    $isi = $_POST['isi'];
    $tag = $_POST['tag'];
    $lokasi_file = $_FILES['cover']['tmp_name'];
    $nama_file = $_FILES['cover']['name'];
    $direktori = 'cover/'.$nama_file;
 
    //get cover 
    $sql_f = "SELECT `cover` FROM `blog` WHERE `id_blog`='$id_blog'";
    $query_f = mysqli_query($koneksi,$sql_f);
    while($data_f = mysqli_fetch_row($query_f)){
        $cover = $data_f[0];
        //echo $foto;
    }
   
     if(empty($id_kategori_blog)){
        header("Location:editblog.php?data=$id_blog&notif=editkosong&jenis=kategoriblog");
    }else if(empty($judul)){
        header("Location:editblog.php?data=$id_blog&notif =editkosong&jenis=judul");
    }else if(empty($tgl)){
        header("Location:editblog.php?data=$id_blog&notif =editkosong&jenis=tanggal");
    }else if(empty($tag)){
        header("Location:editblog.php?data=$id_blog&notif=editkosong&jenis=tag");
    }else{
        $ex = explode("-",$tgl);
        $hari = $ex[0];
        $bulan = $ex[1];
        $tahun = $ex[2];
        $tanggal = $tahun.'-'.$bulan.'-'.$hari;


        $lokasi_file = $_FILES['cover']['tmp_name'];
        $nama_file = $_FILES['cover']['name'];
        $direktori = 'cover/'.$nama_file;
        if(move_uploaded_file($lokasi_file,$direktori)){
            if(!empty($cover)){
                unlink("cover/$cover");
            }
            $sql = "UPDATE `blog` set 
            `id_kategori_blog`='$id_kategori_blog',`judul`='$judul',
            `isi`='$isi',`tanggal`='$tanggal',`cover`='$nama_file'
            WHERE `id_blog`='$id_blog'";
            mysqli_query($koneksi,$sql);
            //echo $sql;
        }else{
            $sql = "UPDATE `blog` set 
            `id_kategori_blog`='$id_kategori_blog',`judul`='$judul',
            `isi`='$isi',`tanggal`='$tanggal'
            WHERE `id_blog`='$id_blog'";
             //echo $sql;
            mysqli_query($koneksi,$sql);
        }
        //hapus tag
        $sql_d = "delete from `tag_blog` where `id_blog`='$id_blog'";
        mysqli_query($koneksi,$sql_d);
        //tambah tag
        if(!empty($_POST['tag'])){
        foreach($_POST['tag'] as $id_tag){
            $sql_i = "insert into `tag_blog` (`id_blog`, `id_tag`) 
            values ('$id_blog', '$id_tag')";
            mysqli_query($koneksi,$sql_i);
            }
        }
        header("Location:blog.php?notif=editberhasil");
    }
}
 
?>
