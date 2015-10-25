<?php $this->start('sidebar'); ?>
<ul class="sidebar-menu">
                        <li >
						<?php echo $this->Html->link(
								'<i class="fa fa-dashboard"></i> <span>Dashboard</span>',
								array('controller' => 'superadmin',
										'action' => 'dashboard',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                           
                        </li>
						<li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Member</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
								<?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>New Member</span>',
								array('controller' => 'superadmin',
										'action' => 'newMember',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
								</li>
                                <li><?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>Member List</span>',
								array('controller' => 'superadmin',
										'action' => 'memberList',
										'full_base' => true
								),
								array('escape'=>false)
								);?></li>
                            </ul>
                        </li>
						<li class="active">
							<?php echo $this->Html->link(
								'<i class="fa fa-plus-square"></i> <span>Drugs</span>',
								array('controller' => 'superadmin',
										'action' => 'drugs',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                        </li>
						<li>
							<?php echo $this->Html->link(
								'<i class="fa fa-envelope"></i> <span>Messages</span>',
								array('controller' => 'superadmin',
										'action' => 'messages',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                        </li>
                       
                    </ul>
					<?php $this->end(); ?>

					<section class="content-header">
                    <h1>
                       Drugs
                        <small>List</small>
                        
                    </h1>
                    
                </section>

                <section class="content">

	
				
                    
					<div class="row">
					<div class="col-xs-12">
                           

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Product List <button class="btn btn-primary" data-toggle="modal" data-target="#addProd" >Add Products</button></h3>
									
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="product" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>ID</th>
                                                <th>Merk</th>
                                                <th>Brand Owner</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>123412</td>
                                                <td>paramex</td>
                                                <td>sanbe</td>
                                                <td><button class="btn btn-primary" data-toggle="modal" data-target="#show" >Update</button>
												<button class="btn btn-danger" data-toggle="modal" data-target="#delete" >Delete</button></td>
                                            </tr>
											
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>No</th>
												<th>ID</th>
                                                <th>Merk</th>
                                                <th>Brand Owner</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
					</div>
                
				<div class="row">
					<div class="col-xs-12">
                           

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">New Product List </h3>
									
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="newProduct" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>ID</th>
                                                <th>Merk</th>
                                                <th>Brand Owner</th>
                                                <th>Store</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>-</td>
                                                <td>paramex</td>
                                                <td>Sanbe</td>
												<td>ID67hg</td>
                                                <td><button class="btn btn-primary" data-toggle="modal" data-target="#show2" >More</button>
												<button class="btn btn-danger" data-toggle="modal" data-target="#delete" >Delete</button>
												</td>
                                            </tr>
											
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>No</th>
												<th>ID</th>
                                                <th>Merk</th>
                                                <th>Brand Owner</th>
                                                <th>Store</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
					</div>
					
					<div class="row">
					<div class="col-xs-12">
                           

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Brand Owner <button class="btn btn-primary" data-toggle="modal" data-target="#addBrand" >Add Brand</button></h3>
									
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="brand" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>ID</th>
                                                <th>Brand Owner</th>
												<th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>idh71718</td>
                                                <td>sanbe</td>
												<td>Master</td>
                                                <td><button class="btn btn-primary" data-toggle="modal" data-target="#show3" >More</button>
												<button class="btn btn-danger" data-toggle="modal" data-target="#delete" >Delete</button>
												</td>
                                            </tr>
											
											<tr>
                                                <td></td>
                                                <td>-</td>
                                                <td>sanbe</td>
												<td>ID0292</td>
                                                <td><button class="btn btn-primary" data-toggle="modal" data-target="#show3" >More</button>
												<button class="btn btn-danger" data-toggle="modal" data-target="#delete" >Delete</button>
												</td>
                                            </tr>
											
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>No</th>
												<th>ID</th>
                                                <th>Brand Owner</th>
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

			<div class="modal fade" id="addProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Product</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
						
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">No ID:</label>
										<div class="col-sm-8">
										<input type="text" class="form-control" id="nomor" placeholder="ID Product">
										</div>
										</div>
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Merk:</label>
										<div class="col-sm-8">
										<input type="text" class="form-control" id="nomor" placeholder="Nama">
										</div>										
                                        
										</div>
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Brand Owner:</label>
										<div class="col-sm-8">
										<select class="form-control">
												<option>A</option>
                                                <option>B</option>
                                                <option>C</option>
                                                <option>D</option>
                                            </select>
										</div>										
                                        
										</div>
										
										
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Notes:</label>
										<div class="col-sm-8">
										<textarea class="form-control" id="message-text" ></textarea>
										</div>										
                                        
										</div>
										<div class="form-group">
										
										<div class="col-sm-2 col-md-offset-10">
										<button type="submit" class="btn btn-primary">Add</button>
										</div>										
                                        
										</div>
		
        </form>
      </div>
     
    </div>
  </div>
</div>

    <div class="modal fade" id="addBrand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New Brand</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
						
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Brand Owner:</label>
										<div class="col-sm-8">
										<input type="text" class="form-control" id="nomor" placeholder="Nama">
										</div>										
                                        
										</div>
										
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Notes:</label>
										<div class="col-sm-8">
										<textarea class="form-control" id="message-text" ></textarea>
										</div>										
                                        
										</div>
										<div class="form-group">
										
										<div class="col-sm-2 col-md-offset-10">
										<button type="submit" class="btn btn-primary">Add</button>
										</div>										
                                        
										</div>
		
        </form>
      </div>
     
    </div>
  </div>
</div>


<div class="modal fade" id="show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Update Product</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
						
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">No ID:</label>
										<div class="col-sm-8">
										<input type="text" class="form-control" id="nomor" placeholder="ID Product">
										</div>
										</div>
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Merk:</label>
										<div class="col-sm-8">
										<input type="text" class="form-control" id="nomor" placeholder="Nama">
										</div>										
                                        
										</div>
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Brand Owner:</label>
										<div class="col-sm-8">
										<select class="form-control">
												<option>A</option>
                                                <option>B</option>
                                                <option>C</option>
                                                <option>D</option>
                                            </select>
										</div>										
                                        
										</div>
										
										
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Notes:</label>
										<div class="col-sm-8">
										<textarea class="form-control" id="message-text" name="keluhan"></textarea>
										</div>										
                                        </div>
										<div class="form-group">
										
										<div class="col-sm-2 col-md-offset-10">
										<button type="submit" class="btn btn-primary">Update</button>
										</div>										
                                        
										</div>
		
        </form>
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade" id="show2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Link Product</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
						
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">No ID:</label>
										<div class="col-sm-8">
										<input type="text" class="form-control" id="nomor" placeholder="Put ID of master ID of product">
										</div>
										</div>
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Merk:</label>
										<div class="col-sm-8">
										<input type="text" class="form-control" id="nomor" placeholder="Nama" readonly>
										</div>										
                                        
										</div>
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Brand Owner:</label>
										<div class="col-sm-8">
										<select class="form-control" readonly>
												<option>A</option>
                                                <option>B</option>
                                                <option>C</option>
                                                <option>D</option>
                                            </select>
										</div>										
                                        
										</div>
										
										
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label" readonly>Notes:</label>
										<div class="col-sm-8">
										<textarea class="form-control" id="message-text" name="keluhan"></textarea>
										</div>										
                                        </div>
										<div class="form-group">
										
										<div class="col-sm-2 col-md-offset-10">
										<button type="submit" class="btn btn-primary">Link</button>
										</div>										
                                        
										</div>
		
        </form>
      </div>
     
    </div>
  </div>
</div>


<div class="modal fade" id="show3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Link Product</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
						
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Brand Owner:</label>
										<div class="col-sm-8">
										<input type="text" class="form-control" id="nomor" placeholder="Nama" >
										</div>										
                                        
										</div>
										
										
										
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label" >Notes:</label>
										<div class="col-sm-8">
										<textarea class="form-control" id="message-text" name="keluhan"></textarea>
										</div>										
                                        </div>
										<div class="form-group">
										
										<div class="col-sm-2 col-md-offset-10">
										<button type="submit" class="btn btn-primary">Update</button>
										</div>										
                                        
										</div>
		
        </form>
      </div>
     
    </div>
  </div>
</div>


<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">DELETE ?</h4>
      </div>
      <div class="modal-body">
			<div class="box" >
							<div class="box-body text-center">
							<button type="button" class="btn btn-info btn-lg">DELETE</button>
							<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">CANCEL</button>
							</div>
							</div>
      </div>
     
    </div>
  </div>
</div>
			
			
<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
$this->start('additional'); 
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
?>	

<script type="text/javascript">
            $(function() {
                var t2 = $('#newProduct').DataTable( {
					"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true,
        "order": [[ 1, 'asc' ]]
    } );
 
    t2.on( 'order.dt search.dt', function () {
        t2.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
	
				var t = $('#product').DataTable( {
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
	
	
	 var t3 = $('#brand').DataTable( {
					"bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true,
        "order": [[ 1, 'asc' ]]
    } );
 
    t3.on( 'order.dt search.dt', function () {
        t3.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
				
            });
			
        </script>
<?php $this->end(); ?>