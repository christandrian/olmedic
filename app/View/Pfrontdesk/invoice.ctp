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
								array('controller' => 'pfrontdesk',
										'action' => 'dashboard',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                           
                        </li>
						<li class="treeview">
                            <a href="#">
                                <i class="fa fa-file"></i>
                                <span>Prescription</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li >
								<?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>Add New Prescription</span>',
								array('controller' => 'pfrontdesk',
										'action' => 'prescription',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
								</li>
                                <li ><?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>List Prescriptions</span>',
								array('controller' => 'pfrontdesk',
										'action' => 'list_prescriptions',
										'full_base' => true
								),
								array('escape'=>false)
								);?></li>
                            </ul>
                        </li>
						<li>
							<?php echo $this->Html->link(
								'<i class="fa fa-stack-exchange"></i> <span>Stocks</span>',
								array('controller' => 'pfrontdesk',
										'action' => 'stock',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                        </li>
						<li>
							<?php echo $this->Html->link(
								'<i class="fa fa-money"></i> <span>Payment</span>',
								array('controller' => 'pfrontdesk',
										'action' => 'payment',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                           
                        </li>
						<li class="active">
							<?php echo $this->Html->link(
								'<i class="fa fa-file-text"></i> <span>Reports</span>',
								array('controller' => 'pfrontdesk',
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
                        Invoice
                        <small><?php echo $invoice['ID_Transaction'];?></small>
                        
                    </h1>
                   
                </section>
				
				<div class="pad margin no-print">
                    <div class="alert alert-info" style="margin-bottom: 0!important;">
                        <i class="fa fa-info"></i>
                        <b>Note:</b> This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>
                </div>	

                <section class="content invoice">
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> SUNWELL
                                <small class="pull-right">Date: <?php echo $invoice['Date'];?></small>
                            </h2>
                        </div>
                    </div>
                    
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong><?php echo $data_store['Nama'];?></strong><br>
                                <?php echo $data_store['Alamat'];?></strong><br>
                                Phone: <?php echo $data_store['Nomor_Telepon'];?><br/>
                            </address>
                        </div>
                        
                        <div class="col-sm-4 col-sm-offset-4 invoice-col">
                            <b>Invoice <?php echo $invoice['ID_Transaction'];?></b><br/>
                            <br/>
                            <!--<b>Order ID:</b> 4F3S8J<br/>
                            <b>Payment Due:</b> 2/22/2014<br/>
                            <b>Account:</b> 968-34567-->
                        </div>
                    </div>

                  
                    <div class="row">
					
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Product Name</th>
                                        <th>Serial #</th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php foreach( $detail_invoice as $f ): ?>
												<tr>
													<td><?php echo $f[ 'quantity' ]; ?></td>
													<td><?php echo $f[ 'item_name' ]; ?></td>
													<td><?php echo $f[ 'id_product' ]; ?></td>
													<td><?php echo $f[ 'product_type' ]; ?></td>
													<td><?php echo $f[ 'price_after' ]; ?></td>
                                            </tr>
											<?php endforeach; ?>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        
                        
                        <div class="col-xs-6 col-xs-offset-6">
                            <p class="lead">Amount Due <?php echo $invoice['Date'];?></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td><?php echo $invoice['Subtotal_Price'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Tax</th>
                                        <td><?php echo $invoice['Tax'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Discount:</th>
                                        <td><?php echo $invoice['Percentage_Discount'];?></td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td><?php echo $invoice['Total_Price'];?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-success pull-right" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                            
                        </div>
                    </div>
                </section>
            </aside>

			
			
