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
        '<i class="fa fa-dashboard"></i> <span>Dashboard</span>',
        array('controller' => 'cdoctor',
        'action' => 'dashboard',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>

    </li>

    <li class="active">
        <?php echo $this->Html->link(
        '<i class="fa fa-calendar"></i> <span>History</span>',
        array('controller' => 'cdoctor',
        'action' => 'history',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>

    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-stack-exchange"></i> <span>Queue</span>',
        array('controller' => 'cdoctor',
        'action' => 'queue',
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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Patient Detail </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <form class="form-horizontal">
                            <div id="non-exist" >

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Name:</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="nomor" placeholder="First Name">

                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="nomor" placeholder="Last Name">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Identity Number:</label>
                                    <div class="col-sm-2">
                                        <select class="form-control">
                                            <option>KTP</option>
                                            <option>SIM</option>
                                            <option>Kartu Pelajar</option>
                                            <option>dll</option>
                                        </select>

                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="nomor" placeholder="No Identitas">

                                    </div>
                                </div>

                                <div class="form-group">

                                    <label for="nomor" class="col-sm-3 control-label">Birthdate:</label>

                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" id="tanggal" placeholder="Tgl. Lahihr">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Blood Type:</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" >
                                            <option>A</option>
                                            <option>B</option>
                                            <option>AB</option>
                                            <option>O</option>
                                        </select>
                                    </div>										

                                </div>
                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Gender:</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" >
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>										

                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Weight:</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" id="nomor" placeholder="kgs">

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Handphone</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>

                                            <input type="text" class="form-control" data-inputmask='"mask": "(+99) 99-999-999999"' data-mask/>
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

                                            <input type="text" class="form-control" data-inputmask='"mask": "(+99) 99-999-999999"' data-mask/>
                                        </div>
                                    </div><!-- /.input group -->
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Address:</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" id="message-text" rows="3" style="resize:none;"></textarea>
                                    </div>										

                                </div>
                                <div class="form-group">

                                    <div class="col-sm-2 col-md-offset-10">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>										

                                </div>

                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">History List </h3>
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
                                <tr>
                                    <td></td>
                                    <td>Dr rudi surudi</td>
                                    <td>10 June 2015</td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#show" >Detail</button></td>
                                </tr>
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
                <form class="form-horizontal">
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