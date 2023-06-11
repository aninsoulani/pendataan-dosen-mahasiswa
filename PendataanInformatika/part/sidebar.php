<?php
$judul = "Aplikasi Pendataan";
$pecahjudul = explode(" ", $judul);
$acronym = "";

$status = $_GET["status"];

foreach ($pecahjudul as $w) {
  $acronym .= $w[0];
}
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="../"><?php echo $judul; ?></a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html"><?php echo $acronym; ?></a>
    </div>
    <ul class="sidebar-menu">
      <li <?php echo ($page == "Dashboard") ? "class=active" : ""; ?>><a class="nav-link"
          href="index.php?status=<?php echo $status ?>"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
      <li class="menu-header">Menu</li>

      <li <?php echo ($page == "Data Dosen") ? "class=active" : ""; ?>><a href="dosen.php?status=<?php echo $status ?>"
          class="nav-link"><i class="fas fa-users"></i> <span>Data Dosen</span></a></li>
      <li <?php echo ($page == "Data Mahasiswa") ? "class=active" : ""; ?>><a class="nav-link"
          href="mahasiswa.php?status=<?php echo $status?>"><i class="fas fa-users"></i> <span>Data Mahasiswa</span></a>
      </li>
      <?php if($status != 3) {
        ?>
      <li <?php echo ($page == "Mahasiswa Bimbingan") ? "class=active" : ""; ?>><a class="nav-link"
          href="mahasiswaBimbingan.php?status=<?php echo $status?>"><i class="fas fa-users"></i> <span>Mahasiswa
            Bimbingan</span></a>
      </li>
      <?php
      } else {
        ?>
      <li <?php echo ($page == "Dosen Pembimbing") ? "class=active" : ""; ?>><a class="nav-link"
          href="dosenPembimbing.php?status=<?php echo $status?>"><i class="fas fa-users"></i> <span>Dosen
            Pembimbing</span></a>
      </li>
      <?php
      }
      ?>
  </aside>
</div>