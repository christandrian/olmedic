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
                                <span>Prescription</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
								<?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>Add New Prescription</span>',
								array('controller' => 'cfrontdesk',
										'action' => 'prescription',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
								</li>
                                <li><?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>List Prescriptions</span>',
								array('controller' => 'cfrontdesk',
										'action' => 'list_prescription',
										'full_base' => true
								),
								array('escape'=>false)
								);?></li>
                            </ul>
                        </li>
						<li class="treeview active">
                            <a href="#">
                                <i class="fa fa-file"></i>
                                <span>Stocks</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li >
								<?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>Add New Product</span>',
								array('controller' => 'cfrontdesk',
										'action' => 'addNewProduct',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
								</li>
                                <li class="active">
								<?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>Add New Packet</span>',
								array('controller' => 'cfrontdesk',
										'action' => 'addNewPacket',
										'full_base' => true
								),
								array('escape'=>false)
								);?></li>
								<li><?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>Add New Service</span>',
								array('controller' => 'cfrontdesk',
										'action' => 'addNewService',
										'full_base' => true
								),
								array('escape'=>false)
								);?></li>
								<li><?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>Add New Category</span>',
								array('controller' => 'cfrontdesk',
										'action' => 'addNewCategory',
										'full_base' => true
								),
								array('escape'=>false)
								);?></li>
								<li><?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>Add New Brand</span>',
								array('controller' => 'cfrontdesk',
										'action' => 'addNewBrand',
										'full_base' => true
								),
								array('escape'=>false)
								);?></li>
								<li >
								<?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>List</span>',
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
                          Packet
                        
                    </h1>
                    
                </section>
				 <form action="add_packet" method="post">
                <section class="content">

				<div class="row">
				<div class="col-md-3">
				<div class="box box-primary">
                                <div class="box-header">
                                    
                                </div>
                                <!-- form start -->
                               
                                    <div class="box-body">
                                        
										<div class="form-group">
                                            <label >Name</label>
                                            <input type="text" class="form-control" name="packet_name" placeholder="Name">
                                        </div>
										<div class="form-group">
                                            <label>Price</label>
                                            <input type="number" class="form-control" name="packet_price" placeholder="Price">
                                        </div>
										<div class="form-group">
                                            <label >Description</label>
                                            <input type="text" class="form-control" name="packet_description" placeholder="Description">
                                        </div>
										
										<div class="form-group">
                                            <label>Discount</label>
                                            <input type="number" class="form-control" name="packet_discount" placeholder="10.5%">
                                        </div>
										
										
										<div class="form-group">
                                            <label>Discount 2</label>
                                            <input type="number" class="form-control" name="packet_discount2" placeholder="1000">
                                        </div>
										
										<div class="form-group">
                                            <label >Discount Description</label>
                                            <input type="text" class="form-control" name="packet_discount_description" placeholder="Description">
                                        </div>
										 
                                      <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
									
										
										
										
                                    </div>

                                   
                            </div>
				</div>
				<div class="col-md-9">
				<div class="box box-primary">
                               
                                
                                    <div class="box-body">
									<h3 class="box-title">Medicine</h3>
									<div class="box-body table-responsive">
									<table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>ID</th>
                                                <th>Name</th>
												<th>Brand Owner</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php foreach( $data_meds as $f ): ?>
												<tr>
													<td></td>
													<input type="hidden" class="desc_med" value="<?php echo $f[ 'Description' ]; ?>" />
													<td class="id_med"><?php echo $f[ 'Id_Product' ]; ?></td>
													<td class="name_med"><?php echo $f[ 'Product_Name' ]; ?></td>
													<input type="hidden" class="category_med" value="<?php echo $f[ 'Id_Category' ]; ?>" />
													<td><span class="merk_med"><?php echo $f[ 'Merk_Name' ]; ?></span></td>
													<td><input type="button" class="btn btn-primary add" value="Add"></td>
												</tr>
											<?php endforeach; ?>
                                            <?php foreach( $data_serv as $f ): ?>
												<tr>
													<td></td>
													<input type="hidden" class="desc_med" value="<?php echo $f[ 'Description' ]; ?>" />
													<td class="id_med"><?php echo $f[ 'Id_Product' ]; ?></td>
													<td class="name_med"><?php echo $f[ 'Product_Name' ]; ?></td>
													<input type="hidden" class="category_med" value="<?php echo $f[ 'Category_Name' ]; ?>" />
													<td><span class="merk_med"><?php //echo $f[ 'Merk_Name' ]; ?></span></td>
													<td><input type="button" class="btn btn-primary add" value="Add"></td>
												</tr>
											<?php endforeach; ?>
											
                                        </tbody>
                                    </table>
                                    
                                </div>
								
                                      
                                    </div>

                                    </form>
                            </div>
				</div>
				<div class="col-md-12">
				<div class="box box-primary">
                               
                                
                                    <div class="box-body">
									<h3 class="box-title">Packet List</h3>
									<div class="box-body table-responsive">
									
                                    <table id="example1" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
												<th></th>
												<th>ID</th>
                                                <th>Name</th>
												<th>Qty</th>
												<th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
										
											<!--
                                            <tr>
												<td></td>
                                                <td>2</td>
                                                <td>amoshaphin</td>
                                                <td><input type="button" value="&times;" class="btn btn-default delete"/></td>
                                            </tr>-->
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

	
    var t = $('#example1').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]],
		"lengthMenu": [[3, 5,  -1], [3,  5, "All"]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

	
	 var t2 = $('#example2').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]],
		"lengthMenu": [[5, 10,  -1], [5,  10, "All"]]
    } );
	
	t2.on( 'order.dt search.dt', function () {
        t2.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();			
				
	
	
$(document).on("click", ".add", function(){

					var x = $(this).parent().parent();
					
					t.row.add( [
					'',x.find('.id_med').text(),x.find('.name_med').text(),
					'<input type="hidden" value="'+x.find(".id_med").text()+'" name="packet_id[]"/><input type="number" class="form-control" name="packet_qty[]"/>'
					,'<input type="button" value="&times;" class="btn btn-default delete"/>'
				] ).draw();
				
} );


$(document).on("click", ".delete", function(){
    var xx = $(this).parent().parent();
        if ( xx.hasClass('selected') ) {
            xx.removeClass('selected');
        }
        else {
		xx.addClass('selected');
        }
		
		
		
		t.row('.selected').remove().draw( false );
});


} );

				
        </script>	
<?php $this->end(); ?>