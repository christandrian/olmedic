<?php
$this->start('store');
echo $data['storeName'];
$this->end();
?>


<?php
$this->start('user');
echo '<p>'.$data['username'].'- '.$data['storeName'].'<small>Frontdesk</small></p>';
$this->end();
?>
<?php $this->start('sidebar'); ?>
<ul class="sidebar-menu">
    <li >
        <?php echo $this->Html->link(
        '<i class="fa fa-dashboard"></i> <span>Beranda</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'dashboard',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>

    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Pasien</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <?php echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Pasien</span>',
                array('controller' => 'cfrontdesk',
                'action' => 'addNewPatient',
                'full_base' => true
                ),
                array('escape'=>false)
                );?>
            </li>
            <li><?php echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Daftar Pasien</span>',
                array('controller' => 'cfrontdesk',
                'action' => 'list_patients',
                'full_base' => true
                ),
                array('escape'=>false)
                );?></li>
        </ul>
    </li>
    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-stack-exchange"></i> <span>Antrian</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'queue',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>
    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-stack-exchange"></i> <span>Inventory</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'stock',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>
    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-money"></i> <span>Pembayaran</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'payment',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>

    </li>
    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-file-text"></i> <span>Laporan</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'reports',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>
	
	<li>
        <?php echo $this->Html->link(
        '<i class="fa fa-file-text"></i> <span>FAQ</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'faq',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>
	<li class="active">
        <?php echo $this->Html->link(
        '<i class="fa fa-file-text"></i> <span>Petunjuk Penggunaan</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'faq',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>
</ul>
<?php $this->end(); ?>

<section class="content-header">
    <h1>
        FAQ

    </h1>

</section>


<section class="content">


    <div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">Tambah Pasien</div>
			  <div class="panel-body">
				<ul class="list-group">
				  <li class="list-group-item">1. Kolom kiri: berisi field Nama Depan, Nama Belakang, No Identitas(KTP, SIM, Kartu Pelajar, dll), Tanggal Lahir, Jenis Kelamin, Golongan Darah, Berat
					
				  </li>
				  <li class="list-group-item">2. Kolom kanan : berisi field Alamat, Handphone(format +628112345678), Kontak Darurat(format +628112345678)
					
				  </li>
				  
				   
					
				</ul>

			  </div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">Daftar Pasien</div>
			  <div class="panel-body">
				<ul class="list-group">
				  <li class="list-group-item">1. Aksi Detail: pindah halaman ke detail pasien dan dapat mengubah detail pasien tsb.
					
				  </li>
				  <li class="list-group-item">2. Aksi Tambah Antrian: memunculkan Pop-Up Pendaftaran Antrian: field opsi Dokter, Waktu, Via, Anamnesa, dan Keterangan; tombol "Tambah" untuk menambahkan pasien ke antrian dan akan menuju halaman Antrian
					
				  </li>
				  
				   
					
				</ul>

			  </div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">Antrian</div>
			  <div class="panel-body">
				<ul class="list-group">
				  <li class="list-group-item">1. berisi list pasien yang sedang mengantri(Status=0 -> baru masuk antrian,Status=1 -> masuk ke ruang dokter, Status=2 -> selesai diperiksa)
					
				  </li>
				  <li class="list-group-item">2. Aksi Detail: memunculkan Pop-Up Detail Antrian. Berisi:
					<ul class="list-group">
				  <li class="list-group-item">1. tombol PROSES: memproses status menjadi 1 (pasien masuk ruang dokter)
					
				  </li>
				  <li class="list-group-item">2. tombol BATAL: memproses pasien yang batal disertai dengan field "Keterangan Batal"
					
				  </li>
				  <li class="list-group-item">3. tombol PEMBAYARAN: memproses pasien yang sudah selesai dari dokter(status=2) untuk melakukan pembayaran dan akan menuju halaman Pembayaran
					
				  </li>
				   
					
				</ul>
				  </li>
				  
				   
					
				</ul>

			  </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">Pembayaran</div>
			  <div class="panel-body">
				<ul class="list-group">
				  <li class="list-group-item">1. Kolom Atas: field  Pasien, Dokter ,Penanganan(akan terisi otomatis setelah Selesai Antrian), Waktu, tombol "Resep" akan menampilkan pop-up isi resep hasil pemeriksaan dokter</li>
				  
				   <li class="list-group-item">2. Kolom Kiri Bawah: berisi daftar produk di apotik(item,servis,paket)
						<ul class="list-group">
						<li class="list-group-item">A. Aksi Beli untuk menambahkan produk tsb ke Cart(Keranjang Belanja)</li>
					</ul>
				   </li>
				   
				    <li class="list-group-item">3. Kolom Kanan Bawah: daftar produk yang akan dibeli
						<ul class="list-group">
							<li class="list-group-item">A. Kolom Qty dapat diganti sesuai banyak produk yang dibeli</li>
							<li class="list-group-item">B. Kolom X untuk menghapus barang tersebut dari Cart</li>
							<li class="list-group-item">C. Field Total Barang, Total, Total Pembayaran (terisi otomatis dan tidak dapat diedit)</li>
							<li class="list-group-item">D. Field Diskon, Pajak dapat diedit dengan menekan angkanya lalu merubahnya, Field lainnya akan menjadi NaN dapat diabaikan(akan kembali berfungsi setelah menambahkan produk ke cart jika cart sebelumnya kosong)</li>
						</ul>
					</li>
					<li class="list-group-item">4. Tombol "Bayar" untuk melanjutkan transaksi dan akan muncul Pop-up
						
					</li>
					<li class="list-group-item">5. Pop-up Pembayaran: field Kuantitas dan Total akan terisi otomatis. Metode Pembayaran:
						<ul class="list-group">
						<li class="list-group-item">A. Cash: field Bayar untuk informasi uang yang dibayarkan, field Kembalian otomatis terisi jika field Bayar sudah terisi</li>
						<li class="list-group-item">B. Credit Card/ Debit: field Credit card untuk nomor CC/debit, field Pemegang Credit card untuk nama pemegang kartu CC/debit</li>
						<li class="list-group-item">C. Komplemen: pembayaran gratis dikarenakan satu dan lain hal.</li>
						<li class="list-group-item">D. Piutang/Asuransi: field Asuransi diisikan nama Asuransi berkaitan misal BPJS/InHealth.</li>
					</ul>
					</li>
					
				</ul>

			  </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">Laporan: halaman berisi daftar transaksi</div>
			  <div class="panel-body">
				Filter:
				<ul class="list-group">
				  <li class="list-group-item">1. Nama Pasien</li>
				  <li class="list-group-item">2. Nama Dokter </li>
				  <li class="list-group-item">3. Tanggal </li>
				  
				   
					
				</ul>

			  </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">Invoice: halaman detail transaksi</div>
			  <div class="panel-body">
				<ul class="list-group">
				  <li class="list-group-item">1. Tombol Print -> mencetak invoice</li>
				</ul>

			  </div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">Inventory</div>
			  <div class="panel-body">
				<ul class="list-group">
				  <li class="list-group-item">1. List
					<ul class="list-group">
					  <li class="list-group-item">A. Item
						<ul class="list-group">
					  <li class="list-group-item">1. Update Item: akan muncul Pop-Up berisikan form lengkap detail Item. Tombol Update untuk mengupdate detail item tsb</li>
					  <li class="list-group-item">2. Restock Item: akan muncul Pop-Up berisikan Field Satuan di gudang, Harga Beli, Harga Jual, Supplier, Catatan, dan Tambah(banyaknya kuantitas item yang akan masuk). Tombol "Tambah" akan menambahkan stok item tsb. </li>
					   <li class="list-group-item">3. Hapus Item: akan mucul Pop-Up berisikan tombol "Hapus"(akan menghapus item tsb.) dan "Batal".</li>
					  
					</ul>
					  </li>
					  <li class="list-group-item">B. Paket
							<ul class="list-group">
					  <li class="list-group-item">1. Update Servis: akan muncul Pop-Up berisikan form lengkap detail Servis. Tombol Update untuk mengupdate detail servis tsb</li>
					   <li class="list-group-item">2. Hapus Servis: akan mucul Pop-Up berisikan tombol "Hapus"(akan menghapus servis tsb.) dan "Batal".</li>
					  
					</ul>
						</li>
					   <li class="list-group-item">C. Servis
						<ul class="list-group">
					  <li class="list-group-item">1. Update Paket: akan muncul halaman "Update Paket"(prosedur mirip dengan Tambah Paket)</li>
					   <li class="list-group-item">2. Hapus Paket: akan mucul Pop-Up berisikan tombol "Hapus"(akan menghapus paket tsb.) dan "Batal".</li>
					  
					</ul>
					   
					   </li>
					  
					</ul>
				  </li>
				  <li class="list-group-item">2. Tambah Item
					<ul class="list-group">
					  <li class="list-group-item">Kolom Atas: daftar item yang sudah tersedia dari master dapat dikopi untuk didapatkan dengan menekan tombol "Ambil Data Item". Lalu, akan muncul Pop-Up dan tinggal mengisi semua field yang sudah tersedia</li>
					   <li class="list-group-item">Kolom Bawah: form untuk menambahkan item yang tidak ada di master. Tinggal isi semua field yang disediakan.</li>
					</ul>
				  </li>
				  <li class="list-group-item">3. Tambah Servis
					<ul class="list-group">
					  <li class="list-group-item">Field Nama, Kode, Deksripsi, Kategori, Kode Servis, Intruksi, Harga Jual, Diskon(%), Diskon2(angka), dan Deskripsi Diskon. Tombol "Tambah" untuk menambahkan Servis</li>
					</ul>
				  </li>
				  <li class="list-group-item">4. Tambah Paket
					<ul class="list-group">
				  <li class="list-group-item">1. Kolom Kiri Atas: isi field Nama, Harga, Deskripsi, Diskon(%), Diskon2(angka), dan Deskripsi Diskon
					
				  </li>
				  
				   <li class="list-group-item">2. Kolom Kanan Atas: daftar item atau servis yang ada di klinik tsb
						<ul class="list-group">
						<li class="list-group-item">A. Tekan tombol "Tambah" untuk memasukkan item/servis ke Kolom Bawah</li>
					</ul>
				   </li>
				   
				    <li class="list-group-item">3. Kolom Bawah: daftar obat yang dimasukkan dari Kolom Kanan Atas
						<ul class="list-group">
							<li class="list-group-item">A. isi field Qty</li>
							<li class="list-group-item">B. Aksi delete untuk menghilangkan item/servis tsb dari daftar</li>
						</ul>
					</li>
					
					<li class="list-group-item">4. Tekan Tombol "Simpan" pada Kolom Kiri Atas jika sudah selesai menambahkan paket
						
					</li>
					
				</ul>
				  </li>
				  <li class="list-group-item">5. Tambah Kategori
					<ul class="list-group">
					  <li class="list-group-item">1. Kolom Atas: Field Nama, Kode, Deksripsi, dan Kategori Grup(Item atau Servis). Tombol "Tambah" untuk menambahkan Kategori</li>
					  <li class="list-group-item">2. Kolom Bawah: Daftar Kategori yang dibuat. Aksi X untuk menghapus Kategori tsb.</li>
					</ul>
				  </li>
				  <li class="list-group-item">6. Tambah Brand
					<ul class="list-group">
					  <li class="list-group-item">1. Kolom Atas: Field Nama Owner dan Memo. Tombol "Tambah" untuk menambahkan Brand Owner</li>
					  <li class="list-group-item">2. Kolom Bawah: Daftar Brand Owner yang dibuat. Aksi X untuk menghapus Brand Owner tsb.</li>
					</ul>
				  </li>
				</ul>

			  </div>
			</div>
		</div>
    </div>

</section>

