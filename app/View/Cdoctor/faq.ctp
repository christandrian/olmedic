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
        array('controller' => 'cdoctor',
        'action' => 'dashboard',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>

    </li>

    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-calendar"></i> <span>Riwayat</span>',
        array('controller' => 'cdoctor',
        'action' => 'history',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>

    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-stack-exchange"></i> <span>Antrian</span>',
        array('controller' => 'cdoctor',
        'action' => 'queue',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>

    </li>
<li class="active">
        <?php echo $this->Html->link(
        '<i class="fa fa-stack-exchange"></i> <span>Petunjuk Penggunaan</span>',
        array('controller' => 'cdoctor',
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
			  <div class="panel-heading">Antrian</div>
			  <div class="panel-body">
				<ul class="list-group">
				  <li class="list-group-item">1. Aksi Detail: memunculkan Pop-Up berisi Anamnesa, Diagnosa, Penanganan, Resep, Gambar
					<ul class="list-group">
				  <li class="list-group-item">1. Isi bagian Diagnosa, Penanganan, dan Resep. Lalu Tekan tombol "Simpan"</li>
				  
				  <li class="list-group-item">2. Jika masih ada yang ditambahkan maka tinggal ubah data yang kurang tepat lalu tekan "Simpan" lagi</li>
				</ul>
				  </li>
				  
				  <li class="list-group-item">2. Aksi Selesai: jika sudah selesai memasukkan Data Detail maka akan mengeluarkan pasien dari daftar antrian dokter</li>
				</ul>

			  </div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="panel panel-default">
			  <div class="panel-heading">Riwayat: berisi daftar pasien yang sudah pernah diperiksa dokter tsb.</div>
			  <div class="panel-body">
				<ul class="list-group">
				  <li class="list-group-item">1. Detail Pasien: berisi detail keterangan pasien tsb
					
				  </li>
				  
				  <li class="list-group-item">2. Riwayat Pasien
					<ul class="list-group">
				  <li class="list-group-item">1. berisi riwayat pemeriksaan yang dilakukan oleh pasien. </li>
				  
				  <li class="list-group-item">2. Aksi Detail: memunculkan pop up berisi Anamnesa, Diagnosa, Penanganan, Resep, dan Gambar terkait.</li>
				</ul>
				  </li>
				</ul>

			  </div>
			</div>
		</div>
			
    </div><!-- ./col -->



</section>

