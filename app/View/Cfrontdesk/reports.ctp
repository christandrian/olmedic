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
        '<i class="fa fa-dashboard"></i> <span>Beranda</span>',
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
    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-stack-exchange"></i> <span>Inventory</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'stock',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
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
    <li class="active">
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
        Invoices

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
                        <h3 class="box-title">Daftar Invoices</h3>
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<div class="col-md-3">
									<label>Pasien</label>
									<input type="text" class="form-control" placeholder="Pasien" id="pasien"/>
								</div>
								<div class="col-md-3">
									<label>Dokter</label>
									<input type="text" class="form-control" placeholder="Dokter" id="dokter"/>
								</div>
								<div class="col-md-3">
									<label>From</label>
									<input class="form-control" type="date" id="min"/>
								</div>
								<div class="col-md-3">
									<label>To</label>
									<input class="form-control" type="date" id="maximal"/>
								</div>
					
							</div>
					</div>
                    </div>
					
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Pasien</th>
                                    <th>Dokter</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
									<th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach( $invoice as $f ): ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $f[ 'id_transaction' ]; ?></td>
                                    <td><?php echo $f[ 'pasient_name' ]; ?></td>
                                    <td><?php echo $f[ 'doctor_name' ]; ?></td>
                                    <td><?php echo $f[ 'recipe_date' ]; ?></td>
									 <td><?php echo $f[ 'total_price' ]; ?></td>
                                    <td><?php echo $this->Html->link(
                                        'Detail',
                                        '/pfrontdesk/invoice/'.$f[ 'id_transaction' ],
                                        array('class' => 'btn btn-info')
                                        );?>
										<?php echo $this->Html->link(
                                        'Delete',
                                        '/cfrontdesk/delete_report/'.$f[ 'id_transaction' ],
                                        array('class' => 'btn btn-danger')
                                        );?>
										</td>
                                </tr>
                                <?php endforeach; ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
									<th>Total</th>
                                    <th>Aksi</th>
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



<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
$this->start('additional'); 
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
echo $this->Html->script('plugins/datatables/range_dates');
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
            "order": [[1, 'asc']],
			"aoColumnDefs": [ {
   "aTargets": [5],
   "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
     var $currencyCell = $(nTd);
     var commaValue = $currencyCell.text().replace('.00000', "");
	 var commaValue2 = commaValue.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
     $currencyCell.text('Rp '+commaValue2);
   }
}],
			"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
           var total2 = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            $( api.column( 5 ).footer() ).html(
                'Rp '+total2
            );
        }
        });

        t.on('order.dt search.dt', function() {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

  $( '#pasien' ).on( 'keyup change', function () {
            
                t.column(2)
                    .search( this.value )
                    .draw();
            
        } );
		
		$( '#dokter' ).on( 'keyup change', function () {
            
                t.column(3)
                    .search( this.value )
                    .draw();
            
        } );
		
		$('body').on('change keyup','#min, #maximal', function() { 
			t.draw();
			//alert(this.value);
		} );

        $('.detail').on('click', function() {
            var xx = $(this).parent().parent();
            var chl = xx.children();
            var tmp = chl.eq(1).text();
            window.location = "<?php echo $this->Html->url(array('controller'=>'cfrontdesk','action'=>'invoice','?' => array('id' => '" + tmp + "')),true) ?>";


        });
    });
</script>	
<?php $this->end(); ?>