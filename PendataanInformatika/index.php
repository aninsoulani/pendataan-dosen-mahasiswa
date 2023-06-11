<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $page = "Dashboard";
  session_start();
  include 'auth/connect.php';
  include "part/head.php";
  include 'part_func/tgl_ind.php';

  $mahasiswaAktif = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE keterangan='1'");
  $jumlahMahasiswaAktif = mysqli_num_rows($mahasiswaAktif);
  $mahasiswaTidakAktif = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE keterangan='2'");
  $jumlahMahasiswaTidakAktif = mysqli_num_rows($mahasiswaTidakAktif);
  $dosenAktif = mysqli_query($conn, "SELECT * FROM dosen WHERE keterangan='1'");
  $jumlahDosenAktif = mysqli_num_rows($dosenAktif);
  $dosenTidakAktif = mysqli_query($conn, "SELECT * FROM dosen WHERE keterangan='2'");
  $jumlahDosenTidakAktif = mysqli_num_rows($dosenTidakAktif);
  ?>
  <style>
  #link-no {
    text-decoration: none;
  }
  </style>
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
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Mahasiswa Aktif</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumlahMahasiswaAktif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Mahasiswa Tidak Aktif</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumlahMahasiswaTidakAktif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Dosen Aktif</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumlahDosenAktif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Dosen Tidak Aktif</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $jumlahDosenTidakAktif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    </section>
  </div>
  <?php include 'part/footer.php'; ?>
  </div>
  </div>

  <?php include "part/all-js.php"; ?>
</body>

</html>