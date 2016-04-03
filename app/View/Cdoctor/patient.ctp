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
        Detail Pasien

    </h1>

</section>

<section class="content">


    <!-- top row -->
    <div class="row">
        <div class="col-xs-12 connectedSortable">

        </div><!-- /.col -->
    </div>
    <!-- /.row -->

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->form->create(false,array('url'=>'/cfrontdesk/updatePatient/' , 'class'=>'form-horizontal'));?>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Detail Pasien </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">

                        <div id="non-exist" >

                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">Nama:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $patient[0]['First_Name']; ?>" readonly>
 
                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo $patient[0]['Last_Name']; ?>" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">No Identitas:</label>
                                <div class="col-sm-8">
                                    <input type="hidden" class="form-control" name="soc_number" value="<?php echo $patient[0]['Social_Number']; ?>" readonly>

                                    <?php echo $patient[0]['Social_Number']; ?>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="nomor" class="col-sm-3 control-label">Tanggal Lahir:</label>

                                <div class="col-sm-4">
                                    <input type="date" class="form-control" name="birth_date" value="<?php echo $patient[0]['Birth_Date']; ?>" placeholder="Tgl. Lahir" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">Golongan Darah:</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="blood_type" readonly>
                                        <?php

                                        if ($patient[0]['Blood_Type'] == 'A') {
                                        echo '<option selected value="A">A</option>';
                                        } else {
                                        echo '<option value="A">A</option>';
                                        }

                                        if ($patient[0]['Blood_Type'] == 'B') {
                                        echo '<option selected value="B">B</option>';
                                        } else {
                                        echo '<option value="B">B</option>';
                                        }

                                        if ($patient[0]['Blood_Type'] == 'AB') {
                                        echo '<option selected value="AB">AB</option>';
                                        } else {
                                        echo '<option value="AB">AB</option>';
                                        }

                                        if ($patient[0]['Blood_Type'] == 'O') {
                                        echo '<option selected value="O">O</option>';
                                        } else {
                                        echo '<option value="O">O</option>';
                                        }
                                        ?>
                                    </select>
                                </div>										

                            </div>
                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">Jenis Kelamin:</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="gender" value="<?php echo $patient[0]['Gender']; ?>" readonly>
                                        if($patient[0]['Gender']=='Male'){
                                        echo '<option selected value="Male">Laki-Laki</option>';
                                        }else{
                                        echo '<option value="Male">Laki-laki</option>';
                                        }

                                        if($patient[0]['Gender']=='Female'){
                                        echo '<option selected value="Female">Perempuan</option>';
                                        }else{
                                        echo '<option value="Female">Perempuan</option>';
                                        }
                                    </select>
                                </div>										

                            </div>

                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">Berat:</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="weight" value="<?php echo $patient[0]['Weight']; ?>" placeholder="kgs" readonly>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Handphone</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>

                                        <input type="text" class="form-control" name="handphone" value="<?php echo $patient[0]['Handphone_Number']; ?>" data-inputmask='"mask": "(+99) 99-999-999999"' data-mask readonly/>
                                    </div>
                                </div><!-- /.input group -->
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Kontak Darurat</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>

                                        <input type="text" class="form-control" name="contact" value="<?php echo $patient[0]['Emergency_Contact']; ?>" data-inputmask='"mask": "(+99) 99-999-999999"' data-mask readonly/>
                                    </div>
                                </div><!-- /.input group -->
                            </div>

                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">Alamat:</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="address" rows="3" style="resize:none;" readonly><?php echo $patient[0]['Address']; ?></textarea>
                                </div>										

                            </div>
                            
                        </div>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                </form>
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

        var t1 = $('#main').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true,
            "order": [[1, 'asc']]
        });

        t1.on('order.dt search.dt', function() {
            t1.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();


        var t2 = $('#diagnose').DataTable({
            "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
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

        var t3 = $('#prescription').DataTable({
            "lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true,
            "order": [[1, 'asc']]
        });

        t3.on('order.dt search.dt', function() {
            t3.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

		var datav;
        $(document).on('click', '.detail', function() {
            datav = {id_visit: $(this).siblings('.id_visit').val(), id_patient: $(this).siblings('.id_patient').val()};
            $('#id_visit_').val($(this).siblings('.id_visit').val());
            $.post("<?php echo $this->Html->url(array('controller' => 'cdoctor', 'action' => 'getAnamnesa'), true) ?>",
                    datav, function(data) {

                        var obj = jQuery.parseJSON(data);
                        //console.log(obj)
                        $('#keluhan').val(obj[0].Anamnesa);

                    })
                    .done(function() {
                        $.post("<?php echo $this->Html->url(array('controller' => 'cdoctor', 'action' => 'getTreatmentPrescription'), true) ?>",
                                datav, function(data) {

                                    var obj = jQuery.parseJSON(data);
                                    //console.log(obj)
                                    $('#penanganan').val(obj[0].Treatment);
                                    var presc = obj[0].Prescription_List.split(',');
                                    var t = $('#prescription').DataTable();
                                    t.clear().draw();
                                    for (i = 0; i < (presc.length); i = i + 4) {
                                        t.row.add([
                                            '',
                                            presc[i],
                                            presc[i + 1],
                                            presc[i + 2],
                                            presc[i + 3], '<input type="button" value="&times;" class="btn btn-default delete" disabled/>'
                                        ]).draw();
                                    }
                                    $('#id_diagnose').val(obj[0].ID_Diagnosis);
                                    var img = obj[0].Image;
                                    if (img == '') {
                                    } else {
                                        $('#f_product_img_hidden').attr('src', 'http://localhost:1000/olmedic/app/webroot/img/upload/' + img);
                                    }
                                    //image

                                }).done(function() {
                            $.post("<?php echo $this->Html->url(array('controller' => 'cdoctor', 'action' => 'getIDX'), true) ?>",
                                    datav, function(data) {

                                        var obj = jQuery.parseJSON(data);
                                        //console.log(obj)

                                        var t = $('#diagnose').DataTable();
                                        t.clear().draw();
                                        for (i = 0; i < (obj.length); i++) {
                                            t.row.add([
                                                '',
                                                obj[i].code,
                                                obj[i].diagnose, '<input type="checkbox" class="checkDiagnose" id="check" value="pick" disabled>'
                                            ]).draw();
                                        }


                                    }).done(function() {
                                $.post("<?php echo $this->Html->url(array('controller' => 'cdoctor', 'action' => 'getDetailDiagnose'), true) ?>",
                                        {id_diagnose: $('#id_diagnose').val()}, function(data) {

                                    var obj = jQuery.parseJSON(data);
                                    //console.log(obj)
                                    //checklist si obat
                                    var t = $('#diagnose').DataTable();
                                    var datas = t.rows().data();
                                    ct = 0;
                                    for (i = 0; i <= datas.length && ct < obj.length; i++) {
                                        if (datas[i][1] == obj[ct].Diagnosis) {
                                            //checklist
                                            t.cell(i, 3).data('<input type="checkbox" class="checkDiagnose" id="check" value="pick" checked="checked" disabled>');
                                            t.draw();
                                            ct++;
                                        }
                                    }


                                }).done(function() {
                                    $('#show').modal('show');

                                })
                            })
                        })

                    });

        });

    });

</script>	
<?php $this->end(); ?>