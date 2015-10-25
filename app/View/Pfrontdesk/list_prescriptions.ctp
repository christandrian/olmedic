<?php
$this->start('store');
echo $data['storeName'];
$this->end();
?>


<?php
$this->start('user');
echo '<p>' . $data['username'] . '- ' . $data['storeName'] . '<small>Frontdesk</small></p>';
$this->end();
?>
<?php $this->start('sidebar'); ?>
<ul class="sidebar-menu">
    <li>
        <?php
        echo $this->Html->link(
                '<i class="fa fa-dashboard"></i> <span>Dashboard</span>', array('controller' => 'pfrontdesk',
            'action' => 'dashboard',
            'full_base' => true
                ), array('escape' => false)
        );
        ?>

    </li>
    <li class="treeview active">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Prescription</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li >
                <?php
                echo $this->Html->link(
                        '<i class="fa fa-angle-double-right"></i><span>Add New Prescription</span>', array('controller' => 'pfrontdesk',
                    'action' => 'prescription',
                    'full_base' => true
                        ), array('escape' => false)
                );
                ?>
            </li>
            <li class="active"><?php
                echo $this->Html->link(
                        '<i class="fa fa-angle-double-right"></i><span>List Prescriptions</span>', array('controller' => 'pfrontdesk',
                    'action' => 'list_prescription',
                    'full_base' => true
                        ), array('escape' => false)
                );
                ?></li>
        </ul>
    </li>
    <li>
        <?php
        echo $this->Html->link(
                '<i class="fa fa-stack-exchange"></i> <span>Stocks</span>', array('controller' => 'pfrontdesk',
            'action' => 'stock',
            'full_base' => true
                ), array('escape' => false)
        );
        ?>
    </li>
    <li>
        <?php
        echo $this->Html->link(
                '<i class="fa fa-money"></i> <span>Payment</span>', array('controller' => 'pfrontdesk',
            'action' => 'payment',
            'full_base' => true
                ), array('escape' => false)
        );
        ?>

    </li>
    <li>
        <?php
        echo $this->Html->link(
                '<i class="fa fa-file-text"></i> <span>Reports</span>', array('controller' => 'pfrontdesk',
            'action' => 'reports',
            'full_base' => true
                ), array('escape' => false)
        );
        ?>
    </li>

</ul>
<?php $this->end(); ?>

<section class="content-header">
    <h1>
        List of Prescriptions

    </h1>

</section>

<section class="content">

    <div class="row">
        <div class="col-xs-12 connectedSortable">

        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Prescriptions</h3>
                    </div>
                    <?php // print_r($data);?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Presc. ID</th>
                                    <th>Patient Name</th>
                                    <th>Doctor Name</th>
                                    <th>Intitution Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($dataPresc as $f): ?>
                                    <tr>
                                        <td></td>
										<input type="hidden" value="<?php echo $f['SYS_ID']; ?>" class="id_presc"/>
                                        <td><?php echo $f['ID_Prescription']; ?></td>
                                        <td><?php echo $f['Pasient_Name']; ?></td>
                                        <td><?php echo $f['Doctor_Name']; ?></td>
                                        <td><?php echo $f['Institution_Name']; ?></td>
                                        <td><?php echo $f['Recipe_Date']; ?></td>
                                        <td><button class="btn btn-info detail" data-toggle="modal" data-target="#details">Detail</button>
                                            <form action="delete_prescription" method="POST"><input type="hidden" value="<?php echo $f['SYS_ID']; ?>" name="id_presc" /><button class="btn btn-danger delete">Delete</button></form></td>
                                    </tr>
                                <?php endforeach; ?>



                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Presc. ID</th>
                                    <th>Patient Name</th>
                                    <th>Doctor Name</th>
                                    <th>Intitution Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>

</section>
</aside>


<div class="modal fade bs-example-modal-lg " id="details" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myLargeModalLabel">Prescription List</h4>
            </div>
            <div class="modal-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Usage</th>

                        </tr>
                    </thead>
                    <tbody>



                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Qty</th>
                            <th>Usage</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>

    </div>
</div>
<?php
echo $this->Html->css('datatables/dataTables.bootstrap');
$this->start('additional');
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
?>	

<script type="text/javascript">
    $(document).ready(function() {

        var t = $('#example1').DataTable({
            "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
            "order": [[1, 'asc']]
        });

        t.on('order.dt search.dt', function() {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        var t2 = $('#example2').DataTable({
            "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
            "order": [[1, 'asc']]
        });

        t2.on('order.dt search.dt', function() {
            t2.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();


        $('.detail').on('click', function() {

            var datas = {id: $(this).parent().parent().find('.id_presc').val()};

            $.post("<?php echo $this->Html->url(array('controller' => 'pfrontdesk', 'action' => 'detail_presc'), true) ?>",
                    datas, function(data) {
					console.log(data);
                        var obj = jQuery.parseJSON(data);
						
						
                        $ret = '';
                        var t = $('#example2').DataTable();
                        t.clear().draw();
                        $.each(obj, function(index, value) {
                            t.row.add([
                                '',
                                value['item_name'],
                                value['quantity'],
                                value['instruction']
                            ]).draw();
                        });
                        //var ret = $('#example2').children().eq(1);
                    });

        });

    });

</script>			
<?php $this->end(); ?>