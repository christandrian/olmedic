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

    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-calendar"></i> <span>History</span>',
        array('controller' => 'cdoctor',
        'action' => 'history',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>

    <li class="active">
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
        Queue

    </h1>

</section>

<section class="content">

    <div class="row">
        <div class="col-xs-12">


            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Queue List </h3>
                    <?php echo var_dump($queue);?>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="main" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Patient</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($queue as $f): ?>
                            <tr>
                                <td></td>
                                <td id="nama_lengkap"><?php echo $f['First_Name'].' '.$f['Last_Name']; ?></td>

                                <td class="status">-</td>
                                <td>
                                    <input class="id_patient" type="hidden" value="<?php echo $f['ID_Patient'] ;?>">
                                    <input class="id_visit" type="hidden" value="<?php echo $f['ID_Visit'] ;?>">
                                    <input class="queue_number" type="hidden" value="<?php echo $f['Queue_Number'] ;?>">
                                    <input id="soc_number" type="hidden" value="<?php echo $f['Social_Number'] ;?>">
                                    <input id="address" type="hidden" value="<?php echo $f['Address'] ;?>">
                                    <input id="birthdate" type="hidden" value="<?php echo $f['Birth_Date'] ;?>">

                                    <button class="btn btn-primary detail"  >Detail</button>
                                    <button type="button" class="btn btn-danger finish">Finish</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Patient</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

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
                <form class="form-horizontal" method="POST">
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
                                            <textarea class="form-control" id="keluhan" rows="8" readonly style="resize:none;"></textarea>
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
                                    <input type="hidden" id="id_diagnose"/>
                                    <input type="hidden" id="id_visit_"/>
                                    <div class="box-body table-responsive">
                                        <table id="diagnose" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID-X</th>
                                                    <th>Detail</th>
                                                    <th>Picked?</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td>123412</td>
                                                    <td>rudi subandini</td>
                                                    <td><input type="checkbox" id="check" value="pick"></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>ID-X</th>
                                                    <th>Detail</th>
                                                    <th>Picked?</th>
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
                                            <textarea class="form-control" id="penanganan" rows="8" name="penanganan" ></textarea>
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
                                                    <th>Satuan</th>
                                                    <th>Usage/Note</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Qty</th>
                                                    <th>Satuan</th>
                                                    <th>Usage/Note</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <table class="table table-hover">
                                            <tr>
                                                <td>#</td>

                                                <td><input type="text" class="form-control" id="nm_presc" value="" placeholder="Name"/></td>
                                                <td><input type="number" class="form-control" id="qty_presc" value="" placeholder="1"/>
                                                    <input type="text" id="metr_presc" class="form-control"/>
                                                </td>
                                                <td><textarea rows="1" id="usg_presc" class="form-control" cols="30" style="resize:none;" placeholder="usage/notes"></textarea></td>
                                                <td><input type="button" class="btn btn-primary" id="add" value="Add"></td>

                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Upload Image
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                                <div class="panel-body">
                                    <img src="" width="100" height="100" id="f_product_img_hidden" style="float: left;">

                                    <input type="hidden" value="f_product_img_hidden">
                                    <input type="file" class="f_pic_identity" name="image" value="" style="float: left; margin-left: 15px" accept="image/*">	
                                    <div style="margin-top: 10px; display: block; float: left; margin-left: 15px"><b>File Size:</b><span class="f_product_img_hidden "></span></div>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save">Save</button>

            </div>
            </form>
        </div>
    </div>
</div>      

<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
echo $this->Html->css('fileinput.min');
$this->start('additional'); 
echo $this->Html->script('plugins/timepicker/bootstrap-timepicker.min');
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
echo $this->Html->script('fileinput.min');
?>  

<script type="text/javascript">
    $(function() {
        var t = $('#main').DataTable({
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


        $('#add').on('click', function() {

            t3.row.add([
                '', $('#nm_presc').val(), $('#qty_presc').val(), $('#metr_presc').val(), $('#usg_presc').val(), '<input type="button" value="&times;" class="btn btn-default delete"/>'
            ]).draw();

        });



        $('.finish').on('click', function() {
            //update or insert
            //change status
            var dataf = {id_visit: $(this).siblings('.id_visit').val(), queue_number: $(this).siblings('.queue_number').val()};
            console.log(dataf);
            $.post("<?php echo $this->Html->url(array('controller' => 'cdoctor', 'action' => 'finishPatient'), true) ?>",
                    dataf, function(data) {

                        console.log(data);

                    })


        });
        $(document).on("click", ".delete", function() {
            var xx = $(this).parent().parent();
            if (xx.hasClass('selected')) {
                xx.removeClass('selected');
            }
            else {
                xx.addClass('selected');
            }

            t3.row('.selected').remove().draw(false);
        });
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
                                            presc[i + 3], '<input type="button" value="&times;" class="btn btn-default delete"/>'
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
                                                obj[i].diagnose, '<input type="checkbox" class="checkDiagnose" id="check" value="pick">'
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
                                            t.cell(i, 3).data('<input type="checkbox" class="checkDiagnose" id="check" value="pick" checked="checked">');
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
        $(document).on('click', '.checkDiagnose', function() {
            var xx = $(this).parent().parent();
            if (!$(this).is(':checked')) {
                xx.addClass('selected');
                idx = $('#diagnose').DataTable().row('.selected');
                $('#diagnose').DataTable().cell(idx[0], 3).data('<input type="checkbox" class="checkDiagnose" id="check" value="pick">');
                $('#diagnose').DataTable().draw();
                $(this).removeAttr('checked');
                xx.removeClass('selected');

            } else {
                $(this).attr('checked', 'checked');
                xx.addClass('selected');
                idx = $('#diagnose').DataTable().row('.selected');
                $('#diagnose').DataTable().cell(idx[0], 3).data('<input type="checkbox" class="checkDiagnose" id="check" value="pick" checked="checked">');
                $('#diagnose').DataTable().draw();
                xx.removeClass('selected');
            }




        });

        $('.save').on('click', function() {

            // update if exist
            //insert if not exist
            t = $('#diagnose').DataTable();

            datas = t.rows().data();

            arrDiagnose = new Array();

            for (i = 0; i < datas.length; i++) {

                if (datas[i][3] === '<input type="checkbox" class="checkDiagnose" id="check" value="pick" checked="checked">') {
                    //masukin
                    //alert(i);

                    arrDiagnose.push(datas[i][1]);
                }
            }

            var diagnose = arrDiagnose;


            var treatment = $('#penanganan').val();

            var t = $('#prescription').DataTable();
            var datas = t.rows().data();
            var str = "";
            for (i = 0; i < datas.length; i++) {
                str += t.cell(i, 1).data() + "," + t.cell(i, 2).data() + "," + t.cell(i, 3).data() + "," + t.cell(i, 4).data()
                if (i != datas.length - 1) {
                    str += ","
                }
            }

            var prescription = str;

            var image = new_product_photo;

            diagnosis = new FormData();
            diagnosis.append('id', $('#id_visit_').val());
            diagnosis.append('diagnose', diagnose);
            diagnosis.append('treatment', treatment);
            diagnosis.append('prescription', prescription);
            diagnosis.append('image', image);
            $.ajax({
                type: 'POST',
                url: "<?php echo $this->Html->url(array('controller' => 'cdoctor', 'action' => 'saveDiagnosis'), true) ?>",
                processData: false,
                contentType: false,
                data: diagnosis,
                success: function(response) {
                    if (response == "") {
                        alert(response);
                    } else {

                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });

        });


        var f_cek_image;
        var new_product_photo = '';
        $('body').on('change', '.f_pic_identity', function(evt) {
            f_cek_image = $(this).prev().val();
            var i = 0, len = this.files.length, img, reader, file;
            for (; i < len; i++) {
                file = this.files[i];
                new_product_photo = file;
                if (!!file.type.match(/image.*/)) {
                    if (window.FileReader) {
                        reader = new FileReader();
                        reader.onloadend = function(e) {
                            f_imageRawSrc(e.target.result, file.fileName);
                            f_imageRawFileSize(escape(file.size));
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        });
        function f_imageRawSrc(source) {
            $('#' + f_cek_image).attr('src', source);
        }

        function f_imageRawFileSize(source) {
            $('.' + f_cek_image).text(" " + (((source) / 1024) / 1024).toFixed(2) + " MB");
        }
    });

</script>
<?php $this->end(); ?>