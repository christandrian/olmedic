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
                                <span>Patients</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
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
                                <li><?php echo $this->Html->link(
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
						<li class="active">
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
                                    <h3 class="box-title">Invoices List</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th></th>
												<th>ID</th>
                                                <th>Patient</th>
												<th>Doctor</th>
                                                <th>Date</th>
                                                <th>Action</th>
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
													<td><?php echo $this->Html->link(
														'Detail',
														'/cfrontdesk/invoice/'.$f[ 'id_transaction' ],
														array('class' => 'btn btn-info')
													);?></td>
                                            </tr>
											<?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
												<th>ID</th>
                                                <th>Patient</th>
												<th>Doctor</th>
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

			
			
<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
$this->start('additional'); 
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
?>	

<script type="text/javascript">
            $(function() {
                 var t = $('#example1').DataTable( {
					"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true,
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
	
	$('.detail').on( 'click', function () {
				var xx = $(this).parent().parent();
				var chl = xx.children();
				var tmp = chl.eq(1).text();
				window.location = "<?php echo $this->Html->url(array('controller'=>'cfrontdesk','action'=>'invoice','?' => array('id' => '"+tmp+"')),true) ?>";
				
			
    } );
            });
        </script>	
<?php $this->end(); ?>