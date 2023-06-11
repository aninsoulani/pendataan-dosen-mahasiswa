<!DOCTYPE html>
<html lang="en">

<head>
  <?php
	$page = "Dosen Pembimbing";
	session_start();
	include 'auth/connect.php';
	include "part/head.php";
	include "part_func/tgl_ind.php";
  $status = $_GET["status"];

	if (isset($_POST['submit'])) {
		$id = $_POST['id'];
    $nip = $_POST['nip'];
		$nama = $_POST['nama'];
		$password = $_POST['password'];
		$status = $_POST['status'];
		$keterangan = $_POST['keterangan'];

		$up2 = mysqli_query($conn, "UPDATE dosen SET nip='$nip', nama_dosen='$nama', password='$password', status='$status', keterangan='$keterangan' WHERE id='$id'");
    $up3 = mysqli_query($conn, "UPDATE dosen_mahasiswa SET nip_nim='$nip', nama='$nama', password='$password', status='$status' WHERE id='$id'");
		echo '<script>
				setTimeout(function() {
					swal({
					title: "Data Diubah",
					text: "Data dosen berhasil diubah!",
					icon: "success"
					});
					}, 500);
				</script>';
	}

	if (isset($_POST['submit2'])) {
    $id = $_POST['id'];
    $nip = $_POST['nip'];
		$nama = $_POST['nama'];
		$password = $_POST['password'];
		$status = $_POST['status'];
		$keterangan = $_POST['keterangan'];

		$cekuser = mysqli_query($conn, "SELECT * FROM dosen WHERE nip='$nip'");
		$baris = mysqli_num_rows($cekuser);
		if ($baris >= 1) {
			echo '<script>
				setTimeout(function() {
					swal({
						title: "Dosen sudah pernah di masukan",
						text: "Dosen sudah ada, silahkan cari dengan nim yang ada!",
						icon: "error"
						});
					}, 500);
			</script>';
		} else {
			$add = mysqli_query($conn, "INSERT INTO dosen (nip, nama_dosen, password, status, keterangan) VALUES ('$nip', '$nama', '$password', '$status', '$keterangan')");
      $add2 = mysqli_query($conn, "INSERT INTO dosen_mahasiswa (nip_nim, nama, password, status) VALUES ('$nip', '$nama', '$password', '$status')");
			echo '<script>
				setTimeout(function() {
					swal({
						title: "Berhasil!",
						text: "Dosen baru telah ditambahkan!",
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
            <h1>Data Dosen Pembimbing</h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data Dosen Pembimbing</h4>
                    <div class="card-header-action">
                      <!-- <?php if ($status == '3') { ?>
                      <a href="#" class="btn btn-primary disabled"
                        title="Status anda mahasiswa, tidak dapat menambah data" data-target="#addUser"
                        data-toggle="modal">Tambah
                        Dosen</a>
                      <?php } else if($status == "2"){ ?>
                      <a href="#" class="btn btn-primary disabled" data-toggle="tooltip"
                        title="Status anda dosen (admin), tidak dapat menambah data" data-target="#addUser"
                        data-toggle="modal">Tambah
                        Dosen</a>
                      <?php } else { ?>
                      <a href="#" class="btn btn-primary" data-target="#addUser" data-toggle="modal">Tambah
                        Dosen</a>
                      <?php }?> -->
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>NIP</th>
                            <th>Nama Dosen</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sessionid = $_SESSION['id_users'];
                          $dospem = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id=$sessionid");
                          $output = mysqli_fetch_array($dospem);
                          $nip = $output['nip_dospem'];
                          
													$sql = mysqli_query($conn, "SELECT * FROM dosen WHERE nip=$nip ORDER BY nip ASC");
													$i = 0;
													while ($row = mysqli_fetch_array($sql)) {
														$dosen = $row['id'];
														$i++;
													?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <th><?php echo ucwords($row['nip']); ?></th>
                            <th><?php echo ucwords($row['nama_dosen']); ?></th>
                            <th><?php 
                            if ($row["status"] == "1") {
                              echo '<div class="badge badge-pill badge-success mb-1">';
                              echo 'Dosen (Super Admin)';
                            } else {
                              echo '<div class="badge badge-pill badge-warning mb-1">';
                              echo 'Dosen (Admin)';
                            }?></th>
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
                      <?php } else if($status == "2"){ ?>
                      <span data-toggle="tooltip" title="Status anda dosen (admin), Data tidak dapat diedit">
                        <a class="btn btn-primary disabled btn-action mr-1"><i class="fas fa-pencil-alt"></i></a>
                      </span>
                      <span data-toggle="tooltip" title="Status anda dosen (admin), Data tidak dapat dihapus">
                        <a class="btn btn-danger disabled btn-action mr-1"><i class="fas fa-trash"></i></a>
                      </span>
                      <?php } else{ ?>
                      <span data-target="#editDosen" data-toggle="modal" data-id="<?php echo $row['id']; ?>"
                        data-nip="<?php echo $row['nip']; ?>" data-nama="<?php echo $row['nama_dosen']; ?>"
                        data-password="<?php echo $row['password']?>">
                        <a class="btn btn-primary btn-action mr-1" title="Edit" data-toggle="tooltip"><i
                            class="fas fa-pencil-alt"></i></a>
                      </span>
                      <a class="btn btn-danger btn-action mr-1" data-toggle="tooltip" title="Hapus"
                        data-confirm="Hapus Data|Apakah anda ingin menghapus data ini?"
                        data-confirm-yes="window.location.href = 'auth/delete.php?type=dosen&id=<?php echo $row['id']; ?>&status=<?php echo $status;?>'"
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

    <div class="modal fade" tabindex="-1" role="dialog" id="addUser">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Dosen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST" class="needs-validation" novalidate="">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">NIP</label>
                <div class="col-sm-9">
                  <input type="hidden" class="form-control" name="id" required="" id="getId">
                  <input type="text" class="form-control" name="nip" required="">
                  <div class="invalid-feedback">
                    Mohon data diisi!
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Dosen</label>
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
              <div class="form-group">
                <label>Status</label>
                <select class="form-control selectric" name="status">
                  <option disabled selected> Pilih </option>
                  <option value="2">Dosen/Admin</option>
                  <option value="1">Dosen/Super Admin</option>
                  <!-- <option value="3">Mahasiswa</option> -->
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <select class="form-control selectric" name="keterangan">
                  <option disabled selected> Pilih </option>
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
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="editDosen">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Dosen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST" class="needs-validation" novalidate="">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">NIP</label>
                <div class="col-sm-9">
                  <input type="hidden" class="form-control" name="id" required="" id="getId">
                  <input type="text" class="form-control" name="nip" required="" id="getNip">
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
                  <option value="2">Dosen/Admin</option>
                  <option value="1">Dosen/Super Admin</option>
                  <!-- <option value="3">Mahasiswa</option> -->
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
  $('#editDosen').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var nip = button.data('nip');
    var nama = button.data('nama')
    var password = button.data('password')
    var modal = $(this)
    modal.find('#getId').val(id)
    modal.find('#getNip').val(nip)
    modal.find('#getNama').val(nama)
    modal.find('#getPassword').val(password)
  })
  </script>
</body>

</html>