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
	 <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-stack-exchange"></i> <span>Antrian</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'queue',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>
    <li class="treeview active">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Inventory</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li >
                <?php echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Item</span>',
                array('controller' => 'cfrontdesk',
                'action' => 'addNewProduct',
                'full_base' => true
                ),
                array('escape'=>false)
                );?>
            </li>
            <li >
                <?php echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Paket</span>',
                array('controller' => 'cfrontdesk',
                'action' => 'addNewPacket',
                'full_base' => true
                ),
                array('escape'=>false)
                );?></li>
            <li><?php echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Jasa</span>',
                array('controller' => 'cfrontdesk',
                'action' => 'addNewService',
                'full_base' => true
                ),
                array('escape'=>false)
                );?></li>
            <li><?php echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Kategori</span>',
                array('controller' => 'cfrontdesk',
                'action' => 'addNewCategory',
                'full_base' => true
                ),
                array('escape'=>false)
                );?></li>
            <li class="active"><?php echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Brand</span>',
                array('controller' => 'cfrontdesk',
                'action' => 'addNewBrand',
                'full_base' => true
                ),
                array('escape'=>false)
                );?></li>
            <li >
                <?php echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Daftar</span>',
                array('controller' => 'cfrontdesk',
                'action' => 'stock',
                'full_base' => true
                ),
                array('escape'=>false)
                );?></li>
        </ul>
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
    <li>
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
        Brand Owner
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12 connectedSortable">
        </div>
    </div>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Brand Owner </h3>
                    </div>
                    <div class="box-body table-responsive">
                        <form class="form-horizontal" method="post" action="add_brand_owner">
                            <div id="non-exist" >
                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Nama Owner:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="owner" placeholder="Owner Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Memo:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="memo" placeholder="Memo">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-2 col-md-offset-10">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>										
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <h3 class="box-title">Daftar Brand Owner</h3>
                        <div class="box-body table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Memo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_brand_owner as $f): ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $f['ID_Brandowner']; ?></td>
                                        <td><?php echo $f['Owner_Name']; ?></td>
                                        <td><?php echo $f['Memo']; ?></td>
                                        <td><input type="button" value="&times;" class="btn btn-default delete"/></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                         <th></th>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Memo</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
</aside>



<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
$this->start('additional'); 
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
?>	

<script type="text/javascript">
    $(document).ready(function() {
    var t2 = $("#example2").dataTable(
    {
    "lengthMenu": [[5, 10, - 1], [5, 10, "All"]]
    }
);
            var t = $('#example1').DataTable({
    "columnDefs": [ {
    "searchable": false,
            "orderable": false,
            "targets": 0
    } ],
            "order": [[ 1, 'asc' ]],
            "lengthMenu": [[3, 5, - 1], [3, 5, "All"]]
    });
            t.on('order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
            });
            }).draw();
            $('.add').on('click', function () {
    var x = $(this).parent().parent();
            var counter = t2.children().length;
            t.row.add([
                    '', counter, 'name obat', '<input type="number" /><small>qty</small>', '<input type="button" value="&times;" class="btn btn-default delete"/>'
            ]).draw();
            counter++;
            });
            $(document).on("click", ".delete", function(){
    var xx = $(this).parent().parent();
            if (xx.hasClass('selected')) {
    xx.removeClass('selected');
    }
    else {
    xx.addClass('selected');
    }

    $.ajax({
    type: "DELETE",
            data: {'id': xx.children().eq(1).text()},
            url: '<?php echo Router::url(array('controller' => 'cfrontdesk','action' => 'deleteBrandOwner', 'full_base' => true)); ?> ',

            success: function (data, textStatus){
			alert(data);
            location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown){
            console.log(jqXHR);
                    alert(errorThrown);
            }
  });
            t.row('.selected').remove().draw(false);
            });
            });


</script>	
<?php $this->end(); ?>