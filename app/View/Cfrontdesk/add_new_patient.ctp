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
    <li>
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
        Pendaftaran
    </h1>

</section>

<section class="content">

    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">

                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="formPatient" method ="post" action="addPatient">
                    <div class="box-body">

                        <div class="form-group">
                            <label for="nama">Nama Depan</label>
                            <input type="text" class="form-control" name="first_name" placeholder="First Name">

                        </div>

                        <div class="form-group">
                            <label for="nama">Nama Belakang</label>
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">

                        </div>

                        <label for="nomor">No. Identitas</label>
                        <div class="form-inline">

                            <div class="form-group">
                                <select class="form-control" name="id_type">
                                    <option value="KTP">KTP</option>
                                    <option value="SIM">SIM</option>
                                    <option value="KP">Kartu Pelajar</option>
                                    <option value="Other">dll</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="id_number" placeholder="Identity Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="birth_date" placeholder="Birth Date">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="gender" class="form-control">
                                <option value="Male">Laki-laki</option>
                                <option value="Female">Perempuan</option>                                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Golongan Darah</label>
                            <select name="blood_type" class="form-control">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Berat</label>
                            <input type="number" class="form-control" name="weight" placeholder="kgs">

                        </div>
                    </div><!-- /.box-body -->


            </div><!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">

                </div><!-- /.box-header -->
                <!-- form start -->

                <div class="box-body">
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="address" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Handphone</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" name="handphone" class="form-control" data-inputmask='"mask": "(+99) 99-999-999999"' data-mask/>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->


                    <div class="form-group">
                        <label>Kontak Darurat</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" name="contact" class="form-control" data-inputmask='"mask": "(+99) 99-999-999999"' data-mask/>
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Proses</button>
                </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>
</aside>



<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
$this->start('additional'); 
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
echo $this->Html->script('plugins/input-mask/jquery.inputmask');
echo $this->Html->script('plugins/input-mask/jquery.inputmask.date.extensions');
echo $this->Html->script('plugins/input-mask/jquery.inputmask.extensions');
?>	
<script>
    $("[data-mask]").inputmask();
</script>		
<?php $this->end(); ?>