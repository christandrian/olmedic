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
            <li class="active">
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Add New Prescription</span>', array('controller' => 'pfrontdesk',
                'action' => 'prescription',
                'full_base' => true
                ), array('escape' => false)
                );
                ?>
            </li>
            <li><?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>List Prescriptions</span>', array('controller' => 'pfrontdesk',
                'action' => 'list_prescriptions',
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
        New Prescription
    </h1>

</section>
<form id="formPrescription" method ="post" action="add_new_prescription">
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header">

                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama">Presc. ID</label>
                            <input type="text" class="form-control" name="presc_id" placeholder="Nomor">
                        </div>
                        <div class="form-group">
                            <label for="nama">Patient</label>
                            <input type="text" class="form-control" name="presc_name" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="nama">Doctor</label>
                            <input type="text" class="form-control" name="presc_doctor" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="nama">Institution</label>
                            <input type="text" class="form-control" name="presc_institution" placeholder="Nama">
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Date</label>
                            <input type="date" class="form-control" name="presc_date" placeholder="Tanggal">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-primary">


                    <div class="box-body">
                        <h3 class="box-title">Medicine</h3>
                        <?php //print_r($data_meds);?>
                        <div class="box-body table-responsive">
                            <table id="up" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_meds as $f): ?>
                                    <tr>
                                        <td><?php echo $f['Id_Product']; ?></td>
                                        <td><?php echo $f['Product_Name']; ?></td>
                                        <td><?php echo $f['Category_Name']; ?></td>
                                <input type="hidden" value="<?php echo $f['Id_Product']; ?>" class="item_id" />
                                <input type="hidden" value="<?php echo $f['Metric_Sales']; ?>" class="item_metrics" />
                                <input type="hidden" value="<?php echo $f['Stock']; ?>" class="item_stock" />
                                <input type="hidden" value="<?php echo $f['Price']; ?>" class="item_price" />
                                <input type="hidden" value="<?php echo $f['Percentage_Amount']; ?>" class="item_disc" />
                                <td><input type="button" class="btn btn-primary add" value="Add"></td>
                                </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>

                        </div>


                    </div>


                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-primary">


                    <div class="box-body">
                        <h3 class="box-title">Prescription</h3>
                        <div class="box-body table-responsive">
                            <form id="formPrescription" >
                                <table id="down" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Stock</th>
                                            <th>Usage</th>
                                            <th>Buy?</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--<tr>
                                                                                              <td></td>
                                              <td>paramex</td>
                                              <td><input type="number" /><small> qty</small></td>
                                                                                              <td><input type="number" readonly/><small> qty</small></td>
                                              <td><textarea rows="1" cols="40" style="resize:none;"></textarea></td>
                                                                                              <td><input type="checkbox"></td>
                                              <td><input type="button" value="&times;" class="btn btn-default delete"/></td>
                                          </tr>
                                          <tr>
                                                                                              <td></td>
                                              <td>amoshaphin</td>
                                              <td><input type="number" /><small> qty</small></td>
                                                                                              <td><input type="number" readonly/><small> qty</small></td>
                                              <td><textarea rows="1" cols="40" style="resize:none;"></textarea></td>
                                                                                              <td><input type="checkbox"></td>
                                              <td><input type="button" value="&times;" class="btn btn-default delete"/></td>
                                          </tr>-->
                                    </tbody>
                                </table>
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </section>
</form>
</aside>

<?php
echo $this->Html->css('datatables/dataTables.bootstrap');
$this->start('additional');
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
?>	



<script type="text/javascript">
    $(document).ready(function() {
        var t2 = $("#up").dataTable(
                {
                    "lengthMenu": [[5, 10, -1], [5, 10, "All"]]
                }
        );



        var t = $('#down').DataTable({
            "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
            "order": [[1, 'asc']],
            "lengthMenu": [[3, 5, -1], [3, 5, "All"]]
        });

        t.on('order.dt search.dt', function() {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();



        $('.add').on('click', function() {
            var x = $(this).parent().parent();

            t.row.add([
                '',
                '<input type="hidden" value="' + x.find('.item_id').val() + '" name="item_id_presc[]">' +
                        '<input type="hidden" value="' + x.children().eq(1).text() + '" name="item_id_name[]">' + x.children().eq(1).text(),
                '<input type="number" name="item_qty_presc[]"  class="qty_presc form-control"/><small>' + x.find('.item_metrics').val() + '</small>' +
                        '<input type="hidden" name="item_metric[]" value="' + x.find('.item_metrics').val() + '">',
                '<input type="number" class="item_stock_presc form-control" name="item_stock[]" value="' + x.find('.item_stock').val() + '" readonly/><small>' + x.find('.item_metrics').val() + '</small>',
                '<textarea rows="1" class="form-control" cols="40" style="resize:none;" name="item_id_usage[]"></textarea>' +
                        '<input type="hidden" value="' + x.find('.item_price').val() + '" name="item_price_presc[]">' +
                        '<input type="hidden" value="' + x.find('.item_disc').val() + '" name="item_disc_presc[]">',
                '<select class="checks form-control" disabled  name="checker[]"><option value="false">No</option><option value="true">Yes</option></select>',
                '<input type="button" value="&times;" class="btn btn-default delete"/>'
            ]).draw();


        });


        $(document).on("click", ".delete", function() {
            var xx = $(this).parent().parent();
            if (xx.hasClass('selected')) {
                xx.removeClass('selected');
            }
            else {
                xx.addClass('selected');
            }

            t.row('.selected').remove().draw(false);
        });


        $(document).on("change", ".qty_presc", function() {

            var xx = $(this).parent().parent();
            if (xx.find('.item_stock_presc').val() * 1 > xx.find('.qty_presc').val() * 1) {
                xx.find('.checks').prop("disabled", false);
            } else {

                xx.find('.checks').prop("disabled", true);
            }

        });

    });


</script>			
<?php $this->end(); ?>