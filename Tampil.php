<?php

	include('dbconn/dbconn.php');
?>
<?php 
session_start();
 
 if (!isset($_SESSION['username'])) {
	 header("Location: index.php");
 }
  
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>List Data</title>
	<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
	<!-- Font Awesome -->
	<link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
	<!-- JS -->
	<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="sweetallert.js"> </script>

	<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
   
	</head>    
<body>
<div class="container">
	<?php 
	echo "Selamat datang". "<br>".$_SESSION['username'];
	?>
	<h2><center>List Data Mahasiswa</center></h2>
	<div class="card-header">
		<a class="btn btn-success btn-sm float-right" href="form-tambah.php"><i class="fas fa-plus">&nbsp;</i>Tambah</a>
	</div>
	<br/>
	<script>
    swal("Selamat Datang!");
    
    </script>

    

	<div class="card-body">
	<?php
		$sql_select = "SELECT * FROM mahasiswa";
		$result = $conn->query($sql_select);

		if($result->num_rows>0)
		{
	?>

		<table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
			<thead>
				<tr>
					<th>No</th>	
					<th>Nim</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Alamat</th>
                    <th>Jenis Kelamin</th>
					<th>foto</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i=0;
				while($row = $result->fetch_assoc())
				{
					$i++;
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><?php echo $row["nim"];?></td>
					<td><?php echo $row["nama"];?></td>
					<td><?php echo $row["email"];?></td>
                    <td><?php echo $row["alamat"];?></td>
                    <td><?php echo $row["kelamin"];?></td>
					<td><a href = "upload/<?php echo $row["photo"];?>" class="btn btn-primary btn-sm float-right">Tampilkan Gambar</a></td>

					<td align="center">
						<a class="btn btn-primary btn-sm float-right" href="form-ubah.php?id=<?php echo $row["id"];?>"><i class="fas fa-pencil-alt">&nbsp;</i>Ubah</a>&nbsp;|&nbsp;
						<a class="btn btn-danger btn-sm float-right" href="hapus.php?id=<?php echo $row["id"];?> " onclick = "return confirm('yakin hapus?')"><i class="fas fa-trash">&nbsp;</i>Hapus</a>&nbsp;
					</td>
				</tr>
				<?php
				}
				?>
			</tbody>
		</table>

	<?php
		}
		else
		{
			echo "<p align='center'>Data Kosong</p>";
		}
		$conn->close();
	?>	
	</div>

</div>
<div align = "right">
<a class="btn btn-danger btn-sm float-right" href="logout.php" onclick = "return confirm('yakin logout')"> &nbsp;</i>Logout</a>&nbsp;
</div>
<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>
</body>
</html>