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
        '<i class="fa fa-dashboard"></i> <span>Dashboard</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'dashboard',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>

    </li>
    <li class="treeview active">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Patients</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu active">
            <li>
                <?php echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Add New Patient</span>',
                array('controller' => 'cfrontdesk',
                'action' => 'addNewPatient',
                'full_base' => true
                ),
                array('escape'=>false)
                );?>
            </li>
            <li class="active"><?php echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>List Patients</span>',
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
        '<i class="fa fa-stack-exchange"></i> <span>Queue</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'queue',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>
    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-stack-exchange"></i> <span>Stocks</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'stock',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>
    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-money"></i> <span>Payment</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'payment',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>

    </li>
    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-file-text"></i> <span>Reports</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'reports',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>

</ul>
<?php $this->end(); ?>

<section class="content-header">
    <h1>
        Patient Details

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
                        <h3 class="box-title">Patient Detail </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">

                        <div id="non-exist" >

                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">Name:</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $patient[0]['First_Name']; ?>">

                                </div>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo $patient[0]['Last_Name']; ?>">

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">Identity Number:</label>
                                <div class="col-sm-8">
                                    <input type="hidden" class="form-control" name="soc_number" value="<?php echo $patient[0]['Social_Number']; ?>">

                                    <?php echo $patient[0]['Social_Number']; ?>

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="nomor" class="col-sm-3 control-label">Birthdate:</label>

                                <div class="col-sm-4">
                                    <input type="date" class="form-control" name="birth_date" value="<?php echo $patient[0]['Birth_Date']; ?>" placeholder="Tgl. Lahir">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">Blood Type:</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="blood_type">
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
                                <label for="nomor" class="col-sm-3 control-label">Gender:</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="gender" value="<?php echo $patient[0]['Gender']; ?>" >
                                        if($patient[0]['Gender']=='Male'){
                                        echo '<option selected value="Male">Male</option>';
                                        }else{
                                        echo '<option value="Male">Male</option>';
                                        }

                                        if($patient[0]['Gender']=='Female'){
                                        echo '<option selected value="Female">Female</option>';
                                        }else{
                                        echo '<option value="Female">Female</option>';
                                        }
                                    </select>
                                </div>										

                            </div>

                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">Weight:</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="weight" value="<?php echo $patient[0]['Weight']; ?>" placeholder="kgs">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Handphone</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>

                                        <input type="text" class="form-control" name="handphone" value="<?php echo $patient[0]['Handphone_Number']; ?>" data-inputmask='"mask": "(+99) 99-999-999999"' data-mask/>
                                    </div>
                                </div><!-- /.input group -->
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Emergency contact</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>

                                        <input type="text" class="form-control" name="contact" value="<?php echo $patient[0]['Emergency_Contact']; ?>" data-inputmask='"mask": "(+99) 99-999-999999"' data-mask/>
                                    </div>
                                </div><!-- /.input group -->
                            </div>

                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">Address:</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="address" rows="3" style="resize:none;"><?php echo $patient[0]['Address']; ?></textarea>
                                </div>										

                            </div>
                            <div class="form-group">

                                <div class="col-sm-2 col-md-offset-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>										

                            </div>

                        </div>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                </form>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">History List </h3>
                        <?php //echo var_dump($history);?>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Doctor</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($history as $f): ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $f['dc']['fm_doc'].' '.$f['dc']['lm_doc']; ?></td>
                                    <td><?php echo $f['vhc']['Date_Time']; ?></td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#show" >Detail</button></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Doctor</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>




</section>
</aside>


<div class="modal fade " id="show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Pasien X</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="a" method="POST">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Anamnesa
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="nomor" class="col-sm-2 control-label">Anamnesa:</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="message-text" rows="8" name="keluhan" readonly style="resize:none;"></textarea>
                                        </div>										

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Diagnose
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">





                                    <div class="box-body table-responsive">
                                        <table id="diagnose" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID-X</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td>123412</td>
                                                    <td>skt flu</td>

                                                </tr>


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID-X</th>
                                                    <th>Detail</th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>   




                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Treatment
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="nomor" class="col-sm-2 control-label">Treatment:</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" id="message-text" rows="8" readonly></textarea>
                                        </div>										

                                    </div> </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                        PRESCRIPTION
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                    <div class="box-body table-responsive">
                                        <table id="prescription" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Qty</th>
                                                    <th>Usage/Note</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td>paramex</td>
                                                    <td>10 <small>qty</small></td>
                                                    <td>3x1</td>

                                                </tr>


                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Qty</th>
                                                    <th>Usage/Note</th>

                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Images
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-8 col-md-2-offset">
                                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="max-height: 200px !important;">

                                                <ol class="carousel-indicators">
                                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>

                                                </ol>

                                                <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="item active">
                                                        <img src="https://placehold.it/350x150" alt="...">
                                                        <div class="carousel-caption">
                                                            ...
                                                        </div>
                                                    </div>
                                                    <div class="item">
                                                        <img src="https://placehold.it/350x150" alt="...">
                                                        <div class="carousel-caption">
                                                            ...
                                                        </div>
                                                    </div>
                                                    ...
                                                </div>

                                                <!-- Controls -->
                                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
echo $this->Html->css('datatables/dfileinput');
$this->start('additional'); 
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
echo $this->Html->script('plugins/input-mask/jquery.inputmask');
echo $this->Html->script('plugins/input-mask/jquery.inputmask.date.extensions');
echo $this->Html->script('plugins/input-mask/jquery.inputmask.extensions');
echo $this->Html->script('fileinput.min');
?>	

<script src="js/AdminLTE/app.js" type="text/javascript"></script>
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

    });

    $(document).ready(function() {
        $("#test-upload").fileinput({
            'showPreview': false,
            'allowedFileExtensions': ['jpg', 'png', 'gif'],
            'elErrorContainer': '#errorBlock'
        });

        $("#file-0a").fileinput({
            'allowedFileExtensions': ['jpg', 'png', 'gif'],
        });

    });
</script>	
<?php $this->end(); ?>