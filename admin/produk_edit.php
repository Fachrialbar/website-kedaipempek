<?php
	require_once 'header_template.php';

	$query_select = 'select * from produk where idproduk = "'.$_GET['id'].'" ';
	$run_query_select = mysqli_query($conn, $query_select);
	$d = mysqli_fetch_object($run_query_select);

	if(!$d){
		header('location:index.php');
	}
?>

<div class="content">
	<div class="container">
		
		<h3 class="page-title">Edit Produk</h3>

		<div class="card">
			
			<form action="" method="post" enctype="multipart/form-data">
				
				<div class="input-group">
					<label>Nama Produk</label>
					<input type="text" name="nama" placeholder="Nama produk" class="input-control" value="<?= $d->namaproduk ?>" required>
				</div>

				<div class="input-group">
					<label>Harga</label>
					<input type="text" name="harga" placeholder="Harga" class="input-control" value="<?= $d->hargaproduk ?>" required>
				</div>

				<div class="input-group">
					<label>Deskripsi</label>
					<textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?= $d->deskripsi ?></textarea>
				</div>

				<div class="input-group">
					<label>Kategori</label>
					<select class="input-control" name="kategori">
						<option value="">Pilih</option>
						<option value="Makanan" <?= ($d->kategori == 'Makanan') ? 'selected':''; ?>>Makanan</option>
						<option value="Minuman" <?= ($d->kategori == 'Minuman') ? 'selected':''; ?>>Minuman</option>
					</select>
				</div>

				<div class="input-group">
					<label>Foto</label>
					<input type="hidden" name="foto_lama" value="<?= $d->foto ?>">
					<div>
						<img src="../uploads/products/<?= $d->foto ?>" width="200">
					</div>
					<input type="file" name="foto">
				</div>
					</tbody>
				</table>

				<div class="input-group">
					<button type="button" onclick="window.location.href = 'produk.php'" class="btn-back">Kembali</button>
					<button type="submit" name="submit" class="btn-submit">Simpan</button>
				</div>

			</form>

			<?php

				if(isset($_POST['submit'])){

					// cek user upload file atau tidak
					if($_FILES['foto']['error'] <> 4){
						// jika upload file

						// tampung data file yang akan diupload
						$name = $_FILES['foto']['name'];
						$tmp_name = $_FILES['foto']['tmp_name'];

						$typefile = pathinfo($name, PATHINFO_EXTENSION);
						$renamefile = time() . '.' . $typefile;

						// proses upload file
						move_uploaded_file($tmp_name, '../uploads/products/' . $renamefile);

						// hapus file yang sebelumnya
						if(file_exists('../uploads/products/' . $_POST['foto_lama'])){
							unlink('../uploads/products/' . $_POST['foto_lama']);
						}


					}else{
						// jika tidak upload file
						$renamefile = $_POST['foto_lama'];

					}


					// proses update data produk
					$query_update = 'update produk set
					namaproduk = "'.$_POST['nama'].'",
					hargaproduk = "'.$_POST['harga'].'",
					deskripsi = "'.$_POST['deskripsi'].'",
					kategori = "'.$_POST['kategori'].'",
					foto = "'.$renamefile.'"
					where idproduk = "'.$_GET['id'].'" ';

					$run_query_update = mysqli_query($conn, $query_update);

					if(!$run_query_update){
						echo 'Data gagal diedit ' . mysqli_error($conn);
						exit();
					}

					// proses insert data extra menu
					$sql = [];
					if(isset($_POST['extraname'])){

						for($i=0; $i < count($_POST['extraname']); $i++){

							$sql[] = '("'.$_GET['id'].'", "'.$_POST['extraname'][$i].'", "'.$_POST['extraharga'][$i].'")';

						}

						$query_insert_extra_menu = 'insert into extra_menu
						(idproduk, nama, harga) values ' . implode(",", $sql);

						$run_query_insert_extra_menu = mysqli_query($conn, $query_insert_extra_menu);

						if(!$run_query_insert_extra_menu){
							echo 'Data gagal diedit ' . mysqli_error($conn);
							exit();
						}

					}

					

					echo "<script>alert('Data berhasil diedit')</script>";
					echo "<script>window.location = 'produk.php'</script>";

				}


			?>

		</div>

	</div>
</div>

<script type="text/javascript">
	
	var btnAdd = document.getElementById("btnAdd")
	var extraMenuList = document.getElementById("extraMenuList")

	btnAdd.addEventListener("click", function(e){
		e.preventDefault()

		var listItem = document.createElement('tr');

		listItem.innerHTML = `
			<tr>
				<td><input type="text" name="extraname[]" class="input-control" required></td>
				<td><input type="text" name="extraharga[]" class="input-control" required></td>
				<td align="center"><button type="button" class="btn" onclick="removeRow(this)"><i class="fa fa-times"></i></button></td>
			</tr>
		`;

		extraMenuList.appendChild(listItem)
	})


	function removeRow(e){
		e.closest('tr').remove()
	}

</script>

<?php require_once 'footer_template.php'; ?>