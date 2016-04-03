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

    <li class="active">
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
	<li>
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
        Riwayat Pasien

    </h1>

</section>

<section class="content">


    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Riwayat Pasien</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
					<?php //echo var_dump($history);?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Identitas</th>
                                    <th>Pasien</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach ($history as $f): ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $f['Social_Number']; ?></td>
                                    <td><?php echo $f['First_Name'].' '.$f['Last_Name']; ?></td>
                                    <td><?php echo $f['Gender']; ?></td>
                                    <td><?php echo $this->Html->link(
                                        'Detail',
                                        '/cdoctor/patient/'.$f['ID_Patient'],
                                        array('class' => 'btn btn-info')
                                        );?>
                                        <?php echo $this->Html->link(
                                        'Riwayat',
                                        '/cdoctor/history_patient/'.$f['ID_Patient'],
                                        array('class' => 'btn btn-primary')
                                        );?>
                                    </td>
                                </tr>
								 <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                     <th>No</th>
                                    <th>Identitas</th>
                                    <th>Pasien</th>
                                    <th>Jenis Kelamin</th>
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



<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
$this->start('additional'); 
echo $this->Html->script('plugins/timepicker/bootstrap-timepicker.min');
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
?>	

<script type="text/javascript">
    $(function() {
        var t = $('#example1').DataTable({
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
    });
</script>
<?php $this->end(); ?>