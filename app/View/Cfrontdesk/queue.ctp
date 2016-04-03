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
    <li class="active">
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
    <li >
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
        Antrian

    </h1>

</section>

<section class="content">




    <div class="row">
        <div class="col-xs-12">


            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Daftar Antrian</h3>
                    <?php //echo var_dump($queue);?>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example3" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($queue as $f): ?>
                            <tr>
                                <td></td>
                                <td id="nama_lengkap"><?php echo $f['Patient First Name'].' '.$f['Patient Last Name']; ?></td>
                                <td><?php echo $f['Doctor First Name'].' '.$f['Doctor Last Name']; ?></td>

                                <td class="status"><?php echo $f['Queue Status'];?></td>
                                <td>
                                    <input class="id_visit" type="hidden" value="<?php echo $f['ID_Visit'] ;?>">
                                    <input class="queue_num" type="hidden" value="<?php echo $f['Queue Number'] ;?>">
                                    <input class="id_doc" type="hidden" value="<?php echo $f['ID_Doctor'] ;?>">
                                    <input id="soc_number" type="hidden" value="<?php echo $f['Social_Number'] ;?>">
                                    <input id="address" type="hidden" value="<?php echo $f['Address'] ;?>">
                                    <input id="birthdate" type="hidden" value="<?php echo $f['Birth_Date'] ;?>">

                                    <button class="btn btn-primary detail"  >Detail</button></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section>
</aside>



<div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Detail Antrian</h4>
            </div>
            <div class="modal-body">
                <div class="box" >
                    <div class="box-body text-center">
                        <form action="processQueue" method="POST">
                            <p id="nama">Test</p>
                            <p id="soc_num">Test</p>
                            <p id="alamat">Test</p>
                            <p id="birth_date">Test</p>
                            <input type="hidden" id="id_visit" name="id_visit">
                            <input type="hidden" id="status" name="status">
                            <input type="hidden" id="queue_num" name="queue_num">
                            <input type="hidden" id="id_doctor" name="id_doctor">
                            <p><input type="text" class="form-control" placeholder="Keterangan Batal" id="detail" name="detail"></p>
							<button type="submit" name ="proc" value="1" class="btn btn-info btn-lg">PROSES</button>
                            <button type="submit" name ="proc" value="2" class="btn btn-danger btn-lg">BATAL</button>
                            <button type="submit" name ="proc" value="3" class="btn btn-primary btn-lg">PEMBAYARAN</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>			

<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
$this->start('additional'); 
echo $this->Html->script('plugins/timepicker/bootstrap-timepicker.min');
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
?>	

<script type="text/javascript">
    $(function() {

        var t = $('#example3').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true,
            "order": [[1, 'asc']]
        });

        t.on('order.dt search.dt', function() {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        $(".timepicker").timepicker({
            showInputs: true
        });
    });
    $(document).on('click', '.detail', function() {

        idv = $(this).siblings('.id_visit').val();

        queue_num = $(this).siblings('.queue_num').val();
        id_doc = $(this).siblings('.id_doc').val();
        stat = $(this).parent().parent().find('.status').text();
        $('#id_visit').val(idv);
        $('#status').val(stat);
        $('#id_doctor').val(id_doc);
        $('#queue_num').val(queue_num);
        $('#nama').text($('#nama_lengkap').text());
        $('#soc_num').text($('#soc_number').val());
        $('#alamat').text($('#address').val());
        $('#birth_date').text($('#birthdate').val());
        $('#detail').modal('show');


    });

</script>
<?php $this->end(); ?>