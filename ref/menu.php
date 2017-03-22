<ul class="sidebar-menu">
<li class="active">
        <a href="#">
            <img height="20" src="assets/theme_admin/img/home.png"> <span>Beranda</span>
        </a>
</li>

<!-- Menu Transaksi -->


<!-- Menu Simpanan -->
<li  class="treeview ">

    <a href="#">
        <img height="20" src="assets/theme_admin/img/uang.png">
        <span>Simpanan</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li class="">
            <!--<a href="#" rel="simpanan" id="simpanan"> <i class="fa fa-folder-open-o"></i> Simpanan Per Anggota </a>-->
            <li><a href="#" rel="simpanan/simpanan_anggota_form.php" id="simpanan_anggota"> <i class="fa fa-folder-open-o"></i> Simpanan Anggota</a></li>
        </li>
        <li class="">
            <a href="#" rel="simpanan/simpanan_perbulan.php" id="simpanan_perbulan"> <i class="fa fa-folder-open-o"></i> Simpanan Per Bulan </a>
        </li>
        <?
        if($_SESSION['username'] == 'mnurulamri'){
            echo '<li><a href="potongan/upload_simpanan.php" rel="" id="upload_simpanan"> <i class="fa fa-folder-open-o"></i> Upload Simpanan</a></li>';
            echo '<li><a href="#" rel="simpanan/simpanan_anggota_form.php" id="simpanan_anggota"> <i class="fa fa-folder-open-o"></i> Simpanan Anggota</a></li>';
        }
        ?>
    </ul>
</li>

<!-- menu pinjaman -->
<li  class="treeview ">
    <a href="#">
        <img height="20" src="assets/theme_admin/img/pinjam.png">
        <span>Pinjaman Koperasi</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <!--<li><a href="#" rel="pinjaman" id="pinjaman"> <i class="fa fa-folder-open-o"></i> Buku Pinjaman</a></li>-->
        <li><a href="#" rel="pinjaman/pinjaman_anggota_form.php" id="pinjaman_anggota"> <i class="fa fa-folder-open-o"></i> Buku Pinjaman Anggota</a></li>
        <li><a href="#" rel="pinjaman/pengajuan/" id="pengajuan"> <i class="fa fa-folder-open-o"></i> Pengajuan Pinjaman</a></li>
        <li><a href="#" rel="pinjaman/pengajuan/pengajuan.php" id="data_pengajuan"> <i class="fa fa-folder-open-o"></i> Data Pengajuan Pinjaman</a></li>
        
        <?
        //if($_SESSION['username'] == 'mnurulamri'){
            //echo '<li><a href="#" rel="pinjaman/pinjaman_anggota_form.php" id="pinjaman_anggota"> <i class="fa fa-folder-open-o"></i> Pinjaman Anggota</a></li>';
        //}
        ?>
    </ul>
</li>

<!-- menu Potongan -->
<li  class="treeview ">
    <a href="#">
        <img height="20" src="assets/theme_admin/img/pinjam.png">
        <span>Potongan BNI</span>
        <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu">
        <li><a href="#" rel="potongan/potongan_bni.php" id="potongan"> <i class="fa fa-folder-open-o"></i> History Potongan</a></li>
        <li><a href="#" rel="potongan/edit_potongan_form.php" id="form_edit_pot"> <i class="fa fa-folder-open-o"></i> Edit Potongan </a></li>
        <li><a href="#" rel="potongan/edit_realisasi_form.php" id="form_edit_realisasi"> <i class="fa fa-folder-open-o"></i> Edit Realisasi </a></li>
		<li><a href="#" rel="bank/data_peminjam_bank_form.php" id="peminjam_bank"> <i class="fa fa-folder-open-o"></i> Data Peminjam Bank </a></li>
    </ul>
</li>

<li>
   <a href="#" rel="bnihistori" id="bnihistori"> <i class="fa fa-folder-open-o"></i> History Transaksi BNI </a>
</li>

<!--
<li>
    <a target="_blank" href="bnihistori">History Transaksi BNI</a>
</li>  
-->

<li>
    <a href="https://remunerasi.fisip.ui.ac.id/koperasi/login/logout.php">Logout</a>
</li>
<!-- laporan -->

<!-- Master data -->

<!-- MENU Setting -->

</ul>