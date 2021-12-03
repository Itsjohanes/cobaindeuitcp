<?php
$namaserver = "localhost";
$username = "root";
$password = "";
$namadb = "mahasiswa"; 
$conn = new mysqli($namaserver,$username,$password,$namadb);

if(!$conn)
{
    die("Koneksi gagal : " . $conn->connect_error);
}
$createdatabase = "CREATE TABLE mahasiswa(
    id int(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    email VARCHAR(50) NOT NULL,
    alamat TEXT NOT NULL,
    nim VARCHAR(7) NOT NULL,
    kelamin VARCHAR(10) NOT NULL
)";
$koneksi = mysqli_query($conn,$createdatabase);

?>