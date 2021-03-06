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
        '<i class="fa fa-dashboard"></i> <span>Beranda</span>', array('controller' => 'pfrontdesk',
        'action' => 'dashboard',
        'full_base' => true
        ), array('escape' => false)
        );
        ?>

    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Resep</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li >
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Resep</span>', array('controller' => 'pfrontdesk',
                'action' => 'prescription',
                'full_base' => true
                ), array('escape' => false)
                );
                ?>
            </li>
            <li ><?php
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
    <li class="active">
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
        Pembayaran
    </h1>

</section>
<form method="POST" action="pay" class="form-horizontal">
    <section class="content">

        <div class="row">

            <div class="col-xs-6">

                <div class="form-group">
                    <label for="nomor" class="col-sm-3 control-label">Resep ID</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control input-sm" name="presc_id" placeholder="Presc. ID" value="<?php if ($valid) echo $presc_id; ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="nomor" class="col-sm-3 control-label">Pasien:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control input-sm" name="patient_name" value="<?php if ($valid) echo $patient_name; ?>" placeholder="Name" >
                    </div>										

                </div>


            </div>


            <div class="col-xs-6">
                <div class="form-group">
                    <label for="nomor" class="col-sm-offset-1 col-sm-3 control-label">Dokter:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control input-sm" name="doctor_name" value="<?php if ($valid) echo $doctor_name; ?>" placeholder="Name" >
                    </div>										

                </div>

                <div class="form-group ">
                    <label for="nomor" class="col-sm-offset-1 col-sm-3 control-label">Waktu:</label>
                    <div class="col-sm-7">
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" name="time" class="form-control input-sm timepicker"/>

                        </div>
                    </div>	
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Barang</h3>
                        <?php //echo var_dump($data_pack);?>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Kuantitas</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($data_meds as $f): ?>
                                <tr>
                                    <td></td>
                                    <td><input type="hidden" value="<?php echo $f['Id_Product']; ?>" class="id_prod" />
                                        <?php echo $f['Product_Name']; ?></td>
                                    <td><?php echo $f['Category_Name']; ?></td>
                                    <td><input type="hidden" value="<?php echo $f['Metric_Sales']; ?>" class="metric_prod" />
                                        <input type="hidden" value="<?php echo $f['Stock']; ?>" class="stock" />
                                        <?php echo $f['Stock']; ?></td>
                                    <td><?php echo $f['Price']; ?></td>
                                    <td><?php echo $f['Percentage_Amount']; ?></td>
                                    <td><?php if($f['canBuy']){
                                        echo '<button class="btn btn-primary add">Beli</button>';
                                        }else{
                                        echo '<button class="btn btn-primary add" disabled>Beli</button>';
                                        }?></td>
                                </tr>
                                <?php endforeach; ?>

                                <?php foreach ($data_serv as $f): ?>
                                <tr>
                                    <td></td>
                                    <td><input type="hidden" value="<?php echo $f['Id_Product']; ?>" class="id_prod" />
                                        <?php echo $f['Product_Name']; ?></td>
                                    <td><?php echo $f['Category_Name']; ?></td>
                                    <td>1<input type="hidden" value="" class="metric_prod" />
                                        <input type="hidden" value="" class="stock" />
                                    </td>
                                    <td><?php echo $f['Price']; ?></td>
                                    <td><?php echo $f['Percentage_Amount']; ?></td>
                                    <td><button class="btn btn-primary add">Buy</button></td>
                                </tr>
                                <?php endforeach; ?>


                                <?php foreach ($data_pack as $f): ?>
                                <tr>
                                    <td></td>
                                    <td><input type="hidden" value="<?php echo $f['Id_Packet']; ?>" class="id_prod" />
                                        <?php echo $f['Product_Name']; ?></td>
                                    <td>-</td>
                                    <td><input type="hidden" value="" class="metric_prod" />
                                        <input type="hidden" value="" class="stock" />
                                    </td>
                                    <td><?php echo $f['Price']; ?></td>
                                    <td><?php echo $f['Percentage_Amount']; ?></td>
                                    <td><?php if($f['canBuy']){
                                        echo '<button class="btn btn-primary add">Buy</button>';
                                        }else{
                                        echo '<button class="btn btn-primary add" disabled>Buy</button>';
                                        }?></td>
                                </tr>
                                <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Kuantitas</th>
                                    <th>Harga</th>
                                    <th>Diskon</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="box" >
                    <div class="box-header">
                        <h3 class="box-title">Cart</h3>

                    </div>
                    <div class="box-body table-responsive" style="max-height:400px;overflow:auto;" >
                        <table id="example3" class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Disc</th>
                                    <th>X</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($valid) {
                                foreach ($arrItem as $f):
                                ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $f['Item_Name']; ?>
                                        <input type="hidden" value="<?php echo $f['Id_Product']; ?>" name="id_prod[]" /></td>
                                    <td>
                                        <input type="number" name="qty[]" style="width:50px;" max="<?php echo $f['Stock']; ?>" min="1"
                                               value="<?php echo $f['Quantity']; ?>" class="qtycart" />
                                        <small><?php echo $f['Metric']; ?></small>
                                    </td>
                                    <td><input type="hidden" value="<?php echo $f['Price']; ?>" name="price[]" />
                                        <?php echo $f['Price']; ?></td>
                                    <td><?php echo $f['Disc']; ?>
                                        <input type="hidden" value="<?php echo $f['Disc']; ?>" name="disc[]" /></td>
                                    <td><input type="button" value="&times;" class="btn btn-default del"/></td>
                                </tr>
                                <?php endforeach;
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Disc.</th>
                                    <th>X</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="box box-info" >
                    <div class="box-body">
                        <table id="totaltbl" class="table table-striped table-condensed " style="margin-bottom:10px;">
                            <tbody>
                                <tr class="success">
                                    <td width="25%">Total Barang</td>
                                    <td><span id="count">0</span></td>

                                    <td width="25%">Total</td>
                                    <td class="text-right" colspan="2"><span id="total">0</span></td>
                                </tr>
                                <tr class="success">

                                    <td width="25%">Diskon</td>
                                    <td><span id="ds_con" contentEditable=true >0</span>
                                        <input type="hidden" name="disc_gen" id="disc_gen" value="0"/></td>

                                    <td width="25%">Pajak</td>
                                    <td class="text-right" ><span id="ts_con" contentEditable=true><?php echo $data['data_store']['Tax']; ?></span>
                                        <input type="hidden" name="tax_gen" id="tax_gen" value="<?php echo $data['data_store']['Tax']; ?>"/>
                                    </td>

                                </tr>
                                <tr class="success">
                                    <td colspan="2">Total Pembayaran</td>
                                    <td class="text-right" colspan="2"><span id="total-payable">0</span></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="box" >
                    <div class="box-body text-center">

                        
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#pay" data-whatever="@mdo" id="payment">BAYAR</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">PEMBAYARAN</h4>
                    </div>
                    <div class="modal-body">

                        <!--<div class="form-group">
                            <label for="nomor" class="col-sm-4 control-label text-left">INVOICE:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inv" placeholder="Invoice" name="invoice" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-4 control-label">Pasien:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="patient_" placeholder="Name" disabled>
                            </div>										

                        </div>-->

                        <div class="form-group">
                            <label for="nomor" class="col-sm-4 control-label">Kuantitas:</label>
                            <div class="col-sm-6">
                                <p class="form-control-static" id="qty_">-</p>
                            </div>										

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-4 control-label">Total:</label>
                            <div class="col-sm-6">
                                <p class="form-control-static" id="total_">-</p><input type="hidden" name="total" value="" id="total_hid">
                            </div>										

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-4 control-label">Metode Pembayaran:</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="paidby" name="paidby">
                                    <option value="0">-</option>
                                    <option value="1">Cash</option>
                                    <option value="2">Credit Card/Debit</option>
                                    <option value="3">Komplemen</option>
                                    <option value="4">Piutang/Asuransi</option>
                                </select>
                            </div>										

                        </div>

                        <div class="form-group cash" style="display:none;">
                            <label for="nomor" class="col-sm-4 control-label">Bayar:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="paid" name="paid" placeholder="" >
                            </div>
                        </div>

                        <div class="form-group cash" style="display:none;">
                            <label for="nomor" class="col-sm-4 control-label">Kembalian:</label>
                            <div class="col-sm-6">
                                <p class="form-control-static" id="change">___</p>
                            </div>										
                        </div>
                        <div class="form-group cc" style="display:none;" >
                            <label for="nomor" class="col-sm-4 control-label">Credit Card:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cc_no" name="cc_no" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group cc" style="display:none;" >
                            <label for="nomor" class="col-sm-4 control-label">Pemegang Credit Card:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cc_name" name="cc_name" placeholder="">
                            </div>
                        </div>
						<div class="form-group pt" style="display:none;" >
                            <label for="nomor" class="col-sm-4 control-label">Asuransi:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cc_name" name="cc_name" placeholder="" >
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-md-4 col-md-offset-8 col-sm-4 col-sm-offset-8">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">CANCEL</button>
                                <button type="submit" class="btn btn-primary" id="submits" disabled>PROSES</button>
                            </div>										

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
echo $this->Html->script('plugins/timepicker/bootstrap-timepicker.min');
?>	

<script type="text/javascript">
    $(document).ready(function() {

        calculate();

        $('.add').on('click', function(event) {
            event.preventDefault();
            var x = $(this).parent().parent();
            test = false;
            idTemp = 0;
            for (i = 0; i < $('#example3 tbody').children().length; i++) {
                temp = $('#example3 tbody').children().eq(i).children();
                if (temp.eq(1).find('input').val() == x.children().find('.id_prod').val()) {
                    test = true;
                    idTemp = i;
                }
            }

            if (test) {
                sumTemp = $('#example3 tbody').children().eq(idTemp).children().eq(2).find('input').val();
                sumTemp++;
                $('#example3 tbody').children().eq(idTemp).children().eq(2).find('input').val(sumTemp);
            } else {
                t2.row.add(['', x.children().eq(1).text() + '<input type="hidden" value="' + x.children().find('.id_prod').val() + '" name="id_prod[]" />', '<input type="number" style="width:50px" max="' + x.find('.stock').val() + '" min="1" name="qty[]" value="1" class="qtycart"/><small>' + x.children().find('.metric_prod').val() + '</small>', x.children().eq(4).text() + '<input type="hidden" value="' + x.children().eq(4).text() + '" name="price[]" />', x.children().eq(5).text() + '<input type="hidden" value="' + x.children().eq(5).text() + '" name="disc[]" />', '<input type="button" value="&times;" class="btn btn-default del"/>'
                ]).draw();
            }
            calculate();
        });

        $(document).on("click", ".del", function() {
            var xx = $(this).parent().parent();
            if (xx.hasClass('selected')) {
                xx.removeClass('selected');
            }
            else {
                xx.addClass('selected');
            }
            var ct = $('#example3 tbody').children().length;

            t2.row('.selected').remove().draw(false);

            if (ct == 1) {

                $('#count').text('0');
            } else {

                $('#count').text($('#example3 tbody').children().length);
            }

            if ($('#example3 tbody').children().length == 1) {
                if ($('#example3 tbody').children().eq(0).length == 1) {
                    var sum = 0;
                    for (i = 0; i < $('#example3 tbody').children().length; i++) {
                        var nx = $('#example3 tbody').children().eq(i).children();

                        sum += (nx.eq(2).find('input').val() * nx.eq(3).text()) * (100 - nx.eq(4).text()) / 100;
                    }
                    $('#total').text(sum);
                } else {

                }
            } else {

                var sum = 0;
                for (i = 0; i < $('#example3 tbody').children().length; i++) {
                    var nx = $('#example3 tbody').children().eq(i).children();
                    sum += (nx.eq(2).find('input').val() * nx.eq(3).text()) * (100 - nx.eq(4).text()) / 100;

                }
                $('#total').text(sum);
            }

            if (ct == 1) {
                $('#total').text(0);
                $('#total-payable').text(0);
                $('#count').text(0);
            } else {

                $('#count').text($('#example3 tbody').children().length);
                var sum2 = $('#total').text();
                sum2 = sum2 - $('#ds_con').text() * 1.0 / 100 * sum2;
                sum2 = sum2 + $('#ts_con').text() * 1.0 / 100 * sum2;
                $('#total-payable').text(sum2);
            }

        });

        $(document).on("change", ".qtys", function() {

            calculate();

        });

        var t = $('#example2').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "autoWidth": true,
            "order": [[1, 'asc']],
			"aoColumnDefs": [ {
   "aTargets": [4],
   "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
     var $currencyCell = $(nTd);
     var commaValue = $currencyCell.text().replace('.00000', "");
	 var commaValue2 = commaValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
     $currencyCell.text('Rp '+commaValue2);
   }
}]
        });

        t.on('order.dt search.dt', function() {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        var t2 = $('#example3').DataTable({
            "bPaginate": false,
            "bLengthChange": true,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true,
            "order": [[1, 'asc']]
        });

        t2.on('order.dt search.dt', function() {
            t2.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();


        $(".timepicker").timepicker({
            showInputs: true
        });

        $('#payment').on('click', function() {
            $('#inv').val($('#id').val());
            $('#patient_').val($('#patient').val());
            $('#qty_').text($('#count').text());
            $('#total_').text($('#total-payable').text());
            $('#total_hid').val($('#total-payable').text());
        });

        $('#paidby').on('change', function() {
            var tmp = $("#paidby option:selected").val();

            if (tmp == 0 || tmp == 3 ) {
                $(".cash").hide();
                $(".cc").hide();
				$(".pt").hide();
                $("#submits").prop('disabled', true);
                $("#cc_no").prop('required', false);
                $("#cc_name").prop('required', false);
            } else if (tmp == 1) {
                $(".cash").show();
                $(".cc").hide();
				$(".pt").hide();
                $("#cc_no").prop('required', false);
                $("#cc_name").prop('required', false);
            } else if (tmp == 2) {
                $(".cc").show();
                $(".cash").hide();
				$(".pt").hide();
                $("#submits").prop('disabled', false);
                $("#cc_no").prop('required', true);
                $("#cc_name").prop('required', true);
            } else if (tmp == 4) {
                $(".pt").show();
                $(".cash").hide();
				$(".cc").hide();
                $("#submits").prop('disabled', false);
                $("#cc_no").prop('required', false);
                $("#cc_name").prop('required', true);
            }
        });

        $('#paid').on('keyup', function() {

            var chn = $(this).val() - $('#total_').text();
            if (chn < 0) {
                $("#submits").prop('disabled', true);
            } else {
                $("#submits").prop('disabled', false);
            }
            $('#change').text(chn);
        });

        $(document).on("change , keyup", ".qtycart", function() {
            calculate();
        });

        $(document).on("keyup", "#ds_con", function() {
            $('#disc_gen').val($('#ds_con').text());
            calculate();
        });

        $(document).on("keyup", "#ts_con", function() {
            $('#tax_gen').val($('#ts_con').text());
            calculate();
        });

        function calculate() {

            $('#count').text($('#example3 tbody').children().length);

            if ($('#example3 tbody').children().length == 1) {
                if ($('#example3 tbody').children().eq(0).length == 1) {
                    var sum = 0;
                    for (i = 0; i < $('#example3 tbody').children().length; i++) {
                        var nx = $('#example3 tbody').children().eq(i).children();
                        sum += (parseInt(nx.eq(2).find('input').val()) * parseInt(nx.eq(3).text())) * (100 - parseFloat(nx.eq(4).text())) / 100;
                    }
                    $('#total').text(sum);
                } else {

                }
            } else {

                var sum = 0;
                for (i = 0; i < $('#example3 tbody').children().length; i++) {
                    var nx = $('#example3 tbody').children().eq(i).children();

                    sum += (nx.eq(2).find('input').val() * nx.eq(3).text()) * (100 - nx.eq(4).text()) / 100;

                }
                $('#total').text(sum);
            }

            var sum2 = $('#total').text();

            sum2 = sum2 - $('#ds_con').text() * 1.0 / 100 * sum2;

            sum2 = sum2 + $('#ts_con').text() * 1.0 / 100 * sum2;

            $('#total-payable').text(sum2);
        }
    });
</script>			
<?php $this->end(); ?>