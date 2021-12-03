<?php
    // Memanggil file koneksi db
	include('dbconn/dbconn.php');
    //Hapus Data
    $id_data = $_GET["id"];
    $imagehapus;
    $imagehapus = "SELECT gambar FROM mahasiswa WHERE id  = '$id_data'";
    unlink('upload/'.$imagehapus);

    $sql_hapus = "DELETE FROM mahasiswa WHERE id='$id_data'";
    
    if($conn->query($sql_hapus) === TRUE)
    {
        echo "Data telah dihapus ke tabel";
    }
    else
    {
        echo "Error : ". $sql_update . "<br>" . $conn->error;
    }        

    $conn->close();

    //Redirect
      echo "<script>alert('data berhasil dihapus');window.location = 'Tampil.php'</script>";
?>
