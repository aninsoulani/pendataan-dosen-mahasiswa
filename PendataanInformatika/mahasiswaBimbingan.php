<!DOCTYPE html>
<html lang="en">

<head>
  <?php
	$page = "Mahasiswa Bimbingan";
	session_start();
	include 'auth/connect.php';
	include "part/head.php";
	include "part_func/tgl_ind.php";
  $status = $_GET["status"];

	if (isset($_POST['submit'])) {
		$id = $_POST['id'];
    $nim = $_POST['nim'];
		$nama = $_POST['nama'];
		$password = $_POST['password'];
    $angkatan = $_POST['angkatan'];
		$status = $_POST['status'];
		$keterangan = $_POST['keterangan'];

		$up2 = mysqli_query($conn, "UPDATE mahasiswa SET nim='$nim', nama_mahasiswa='$nama', password='$password', angkatan='$angkatan', status='$status', keterangan='$keterangan' WHERE id='$id'");
    $up3 = mysqli_query($conn, "UPDATE dosen_mahasiswa SET nip_nim='$nim', nama='$nama', password='$password', status='$status' WHERE id='$id'");
		echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data Mahasiswa berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
	}

	if (isset($_POST['submit2'])) {
    $nim = $_POST['nim'];
		$nama = $_POST['nama'];
		$password = $_POST['password'];
    $angkatan = $_POST['angkatan'];
		$status = $_POST['status'];
		$keterangan = $_POST['keterangan'];

		$cekuser = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");
		$baris = mysqli_num_rows($cekuser);
		if ($baris >= 1) {
			echo '<script>
				setTimeout(function() {
					swal({
						title: "Mahasiswa sudah pernah di masukan",
						text: "Mahasiswa sudah ada, silahkan cari dengan nim yang ada!",
						icon: "error"
						});
					}, 500);
			</script>';
		} else {
			$add = mysqli_query($conn, "INSERT INTO mahasiswa (nim, nama_mahasiswa, password, angkatan, status, keterangan) VALUES ('$nim', '$nama', '$password', '$angkatan', '$status', '$keterangan')");
      $add2 = mysqli_query($conn, "INSERT INTO dosen_mahasiswa (nip_nim, nama, password, status) VALUES ('$nim', '$nama', '$password', '$status')");
      
			echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Mahasiswa baru telah ditambahkan!",
						icon: "success"
						});
					}, 500);
			</script>';
		}
	}
	?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>

      <?php
			include 'part/navbar.php';
			include 'part/sidebar.php';
			?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Mahasiswa Bimbingan</h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data Mahasiswa Bimbingan</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Angkatan</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sessionid = $_SESSION['id_users'];
                          $dospem = mysqli_query($conn, "SELECT * FROM dosen WHERE id=$sessionid");
                          $output = mysqli_fetch_array($dospem);
                          $nip = $output['nip'];
													$sql = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE status='3' AND nip_dospem=$nip ORDER BY nim ASC");
													$i = 0;
													while ($row = mysqli_fetch_array($sql)) {
														$mahasiswa = $row['id'];
														$i++;
													?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <th><?php echo ucwords($row['nim']); ?></th>
                            <th><?php echo ucwords($row['nama_mahasiswa']); ?></th>
                            <th><?php echo ucwords($row['angkatan']); ?></th>
                            <td><?php
																	if ($row["keterangan"] == "1") {
																		echo '<div class="badge badge-pill badge-success mb-1">';
																		echo '<i class="ion-checkmark-round"></i> Aktif';
																	} else {
																		echo '<div class="badge badge-pill badge-danger mb-1">';
																		echo '<i class="ion-close"></i> Tidak Aktif';
																	} ?>
                    </div>
                    <td>
                      <?php if ($status == '3') { ?>
                      <span data-toggle="tooltip" title="Status anda mahasiswa, Data tidak dapat diedit">
                        <a class="btn btn-primary disabled btn-action mr-1"><i class="fas fa-pencil-alt"></i></a>
                      </span>
                      <span data-toggle="tooltip" title="Status anda mahasiswa, Data tidak dapat dihapus">
                        <a class="btn btn-danger disabled btn-action mr-1"><i class="fas fa-trash"></i></a>
                      </span>
                      <?php } else { ?>
                      <span data-target="#editMahasiswa" data-toggle="modal" data-id="<?php echo $row['id']; ?>"
                        data-nim="<?php echo $row['nim']; ?>" data-nama="<?php echo $row['nama_mahasiswa']; ?>"
                        data-angkatan="<?php echo $row['angkatan']?>" data-password="<?php echo $row['password']?>">
                        <a class="btn btn-primary btn-action mr-1" title="Edit" data-toggle="tooltip"><i
                            class="fas fa-pencil-alt"></i></a>
                      </span>
                      <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus"
                        data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?"
                        data-confirm-yes="window.location.href = 'auth/delete.php?type=mahasiswa&id=<?php echo $row['id']; ?>&status=<?php echo $status;?>'"
                        ;><i class="fas fa-trash"></i></a>
                      <?php } ?>
                    </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      </section>
    </div>

    <!-- <div class="modal fade" tabindex="-1" role="dialog" id="addUser">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Mahasiswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST" class="needs-validation" novalidate="">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">NIM</label>
                <div class="col-sm-9">
                  <input type="hidden" class="form-control" name="id" required="" id="getId">
                  <input type="text" class="form-control" name="nim" required="">
                  <div class="invalid-feedback">
                    Mohon data diisi!
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nama" required="">
                  <div class="invalid-feedback">
                    Mohon data diisi!
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="password" required="">
                  <div class="invalid-feedback">
                    Mohon data diisi!
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Angkatan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="angkatan" required="">
                  <div class="invalid-feedback">
                    Mohon data diisi!
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control selectric" name="status">
                  <option value="3">Mahasiswa</option>
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <select class="form-control selectric" name="keterangan">
                  <option value="1">Aktif</option>
                  <option value="2">Tidak Aktif</option>
                </select>
              </div>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit2">Tambah</button>
            </form>
          </div>
        </div>
      </div>
    </div> -->

    <div class="modal fade" tabindex="-1" role="dialog" id="editMahasiswa">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Mahasiswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST" class="needs-validation" novalidate="">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">NIM</label>
                <div class="col-sm-9">
                  <input type="hidden" class="form-control" name="id" required="" id="getId">
                  <input type="text" class="form-control" name="nim" required="" id="getNim">
                  <div class="invalid-feedback">
                    Mohon data diisi!
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nama" required="" id="getNama">
                  <div class="invalid-feedback">
                    Mohon data diisi!
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Angkatan</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="angkatan" required="" id="getAngkatan">
                  <div class="invalid-feedback">
                    Mohon data diisi!
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="password" required="" id="getPassword">
                  <div class="invalid-feedback">
                    Mohon data diisi!
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control selectric" name="status">
                  <!-- <option value="1">Dosen/Super Admin</option>
                  <option value="2">Dosen/Admin</option> -->
                  <option value="3">Mahasiswa</option>
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <select class="form-control selectric" name="keterangan">
                  <option value="1">Aktif</option>
                  <option value="2">Tidak Aktif</option>
                </select>
              </div>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit">Edit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php include 'part/footer.php'; ?>
  </div>
  </div>
  <?php include "part/all-js.php"; ?>

  <script>
  $('#editMahasiswa').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var nim = button.data('nim');
    var nama = button.data('nama')
    var angkatan = button.data('angkatan');
    var password = button.data('password')
    var modal = $(this)
    modal.find('#getId').val(id)
    modal.find('#getNim').val(nim)
    modal.find('#getNama').val(nama)
    modal.find('#getAngkatan').val(angkatan)
    modal.find('#getPassword').val(password)
  })
  </script>
</body>

</html>