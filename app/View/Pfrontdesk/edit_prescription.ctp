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
        '<i class="fa fa-dashboard"></i> <span>Beranda</span>', array('controller' => 'pfrontdesk',
        'action' => 'dashboard',
        'full_base' => true
        ), array('escape' => false)
        );
        ?>

    </li>
    <li class="treeview active">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Resep</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="active">
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Resep</span>', array('controller' => 'pfrontdesk',
                'action' => 'prescription',
                'full_base' => true
                ), array('escape' => false)
                );
                ?>
            </li>
            <li><?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Daftar Resep</span>', array('controller' => 'pfrontdesk',
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
        '<i class="fa fa-stack-exchange"></i> <span>Inventory</span>', array('controller' => 'pfrontdesk',
        'action' => 'stock',
        'full_base' => true
        ), array('escape' => false)
        );
        ?>
    </li>
    <li>
        <?php
        echo $this->Html->link(
        '<i class="fa fa-money"></i> <span>Pembayaran</span>', array('controller' => 'pfrontdesk',
        'action' => 'payment',
        'full_base' => true
        ), array('escape' => false)
        );
        ?>

    </li>
    <li>
        <?php
        echo $this->Html->link(
        '<i class="fa fa-file-text"></i> <span>Laporan</span>', array('controller' => 'pfrontdesk',
        'action' => 'reports',
        'full_base' => true
        ), array('escape' => false)
        );
        ?>
    </li>
	<li>
        <?php
        echo $this->Html->link(
        '<i class="fa fa-file-text"></i> <span>Petunjuk Pemakaian</span>', array('controller' => 'pfrontdesk',
        'action' => 'faq',
        'full_base' => true
        ), array('escape' => false)
        );
        ?>
    </li>

</ul>
<?php $this->end(); ?>

<section class="content-header">
    <h1>
        Resep Baru
    </h1>

</section>
<form id="formPrescription" method ="post" action="editPrescription">
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header">

                    </div>
					
                    <div class="box-body">
                        <div class="form-group">
							
                            <label for="nama">ID Resep</label>
                            <input type="text" class="form-control" name="presc_id" value="<?php echo $presc_name;?>" placeholder="Nomor" required>
							<input type="hidden" class="form-control" name="id" value="<?php echo $id;?>"> 
                        </div>
                        <div class="form-group">
                            <label for="nama">Pasien</label>
                            <input type="text" class="form-control" name="presc_name" value="<?php echo $patient_name;?>" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Dokter</label>
                            <input type="text" class="form-control" name="presc_doctor" value="<?php echo $doctor_name;?>" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Klinik</label>
                            <input type="text" class="form-control" name="presc_institution" value="<?php echo $institution;?>" placeholder="Nama" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="presc_date" placeholder="Tanggal" value="<?php echo $tanggal;?>" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-primary">


                    <div class="box-body">
                        <h3 class="box-title">Obat</h3>
                        <?php //print_r($data_meds);?>
                        <div class="box-body table-responsive">
                            <table id="up" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Aksi</th>
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
                                <td><input type="button" class="btn btn-primary add" value="Tambah"></td>
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
                        <h3 class="box-title">Detail Resep</h3>
                        <div class="box-body table-responsive">
                            <form id="formPrescription" >
                                <table id="down" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Qty</th>
                                            <th>Stock</th>
                                            <th>Penggunaan</th>
                                            <th>Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										//echo var_dump($data_detail_presc);
										foreach( $data_detail_presc as $f ): ?>
												<tr>
													
													<td class="id_med"></td>
													<td class="name_med">
													<input type="hidden" value="<?php echo $f[ 'id_product' ]; ?>" name="item_id_presc[]">
													<?php echo $f[ 'item_name' ]; ?></td>
													<td class="qty_med">
													<input type="number" name="item_qty_presc[]" value="<?php echo $f['quantity'];?>"  class="qty_presc form-control"/><small><?php echo $f['metric'];?></small>
													
													</td>
													<td class="stock_med">
													<input type="number" class="item_stock_presc form-control" value="<?php echo $f['stock'];?>" readonly/><small><?php echo $f['metric'];?></small></td>
													<td class="usage_med">
													<textarea rows="1" class="form-control" cols="40" style="resize:none;" name="item_id_usage[]"><?php echo $f['instruction'];?></textarea>
													
													</td>
													
													
													<td><input type="button" value="&times;" class="btn btn-default delete"/></td>
												</tr>
											<?php endforeach; ?>
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
                '<input type="hidden" value="' + x.find('.item_id').val() + '" name="item_id_presc[]">' + x.children().eq(1).text(),
                '<input type="number" name="item_qty_presc[]"  class="qty_presc form-control"/><small>' + x.find('.item_metrics').val() + '</small>',
                '<input type="number" class="item_stock_presc form-control" name="item_stock[]" value="' + x.find('.item_stock').val() + '" readonly/><small>' + x.find('.item_metrics').val() + '</small>',
                '<textarea rows="1" class="form-control" cols="40" style="resize:none;" name="item_id_usage[]"></textarea>',
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

    });


</script>			
<?php $this->end(); ?>