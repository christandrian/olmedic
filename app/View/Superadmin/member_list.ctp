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
						<li class="treeview active">
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
                                <li class="active"><?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>Member List</span>',
								array('controller' => 'superadmin',
										'action' => 'memberList',
										'full_base' => true
								),
								array('escape'=>false)
								);?></li>
                            </ul>
                        </li>
						<li>
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
                        Member List
                        
                    </h1>
                    
                </section>

                <section class="content">


                   
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">

                        </div>
                    </div>
                    <section class="content no-print">
                        <div class="row">
                            <div class="col-xs-12">


                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Member List</h3>
                                    </div>
                                    <div class="box-body table-responsive">
                                        <table id="member" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
													<th>No</th>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>Paket</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
													<td></td>
                                                    <td>a</td>
                                                    <td>Internet
                                                        Explorer 4.0</td>
                                                    <td>Win 95+</td>
                                                    <td> 4</td>
                                                    <td>
													<button class="btn btn-danger" data-toggle="modal" data-target="#block" data-whatever="@mdo">BLOCK</button>
													<button class="btn btn-info" data-toggle="modal" data-target="#show" data-whatever="@mdo">SHOW</button>
													<button class="btn btn-primary" data-toggle="modal" data-target="#upgrade" data-whatever="@mdo">UPGRADE</button></td>
                                                </tr>
                                                <tr>
													<td></td>
                                                    <td>Trident</td>
                                                    <td>Internet
                                                        Explorer 5.0</td>
                                                    <td>Win 95+</td>
                                                    <td>5</td>
                                                    <td>C</td>
                                                </tr>
                                                <tr>
													<td></td>
                                                    <td>Trident</td>
                                                    <td>Internet
                                                        Explorer 5.5</td>
                                                    <td>Win 95+</td>
                                                    <td>5.5</td>
                                                    <td>A</td>
                                                </tr>
                                               
                                                <tr>
													<td></td>
                                                    <td>Other browsers</td>
                                                    <td>All others</td>
                                                    <td>-</td>
                                                    <td>-</td>
                                                    <td>U</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
													<th>No</th>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>Paket</th>
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
                   
                </section>
            </aside>


<div class="modal fade" id="show" tabindex="-1" role="dialog" style="overflow: hidden; " aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header no-print">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title no-print" id="exampleModalLabel">Pendaftaran Antrian</h4>
                    </div>
                    <div class="modal-body">
					<form class="form-horizontal">
						
										
                                        
										
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Nama:</label>
										<div class="col-sm-8">
										 <p class="form-control-static">example.com</p>
										</div>										
                                        
										</div>
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Email:</label>
										<div class="col-sm-8">
										 <p class="form-control-static">email@example.com</p>
										</div>										
                                        
										</div>
										
										
										<div class="form-group ">
										<label for="nomor" class="col-sm-2 control-label">Waktu:</label>
										<div class="col-sm-8">
										 <p class="form-control-static">hh</p>
										</div>										
                                        
										</div>
										
										<!--<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Via:</label>
										<div class="col-sm-8">
										 <select class="form-control">
                                                <option>Langsung</option>
                                                <option>Phone</option>
                                            </select>
										</div>										
                                        
										</div>-->
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Paket:</label>
										<div class="col-sm-8">
										 <p class="form-control-static">B</p>
										</div>										
                                        
										</div>
										
										<div class="form-group">
										
										<div class="col-sm-2 col-md-offset-10">
										<button type="submit" class="btn btn-primary">More</button>
										</div>										
                                        
										</div>
									
		
        </form>
                    </div>

                </div>
            </div>
        </div>
		
		<div class="modal fade" id="block" tabindex="-1" role="dialog" style="overflow: hidden; " aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header no-print">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title no-print" id="exampleModalLabel">BLOCK</h4>
                    </div>
                    <div class="modal-body">
					<form class="form-horizontal">
										
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Message:</label>
										<div class="col-sm-8">
										<textarea class="form-control" id="message-text" name="keluhan"></textarea>
										</div>										
                                        
										</div>
									<div class="form-group">
										
										<div class="col-sm-2 col-md-offset-10">
										<button type="submit" class="btn btn-primary">Block</button>
										</div>										
                                        
										</div>
		
        </form>
                    </div>

                </div>
            </div>
        </div>
		
		<div class="modal fade" id="upgrade" tabindex="-1" role="dialog" style="overflow: hidden; " aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title no-print" id="exampleModalLabel">Upgrade/Extension</h4>
                    </div>
                    <div class="modal-body">
					 <form class="form-horizontal">
						
					<div role="tabpanel">

  
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#upg" aria-controls="home" role="tab" data-toggle="tab">Upgrade</a></li>
    <li role="presentation"><a href="#ext" aria-controls="profile" role="tab" data-toggle="tab">Extension</a></li>
  </ul>

  
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="upg">
	<br>
	<div class="form-group">
	<label for="nomor" class="col-sm-3 control-label">Paket:</label>
	<div class="col-sm-8">
	<p class="form-control-static">A</p>
	</div>	
	</div>
	
	<div class="form-group">
	<label for="nomor" class="col-sm-3 control-label">Upgrade to:</label>
										<div class="col-sm-8">
										 <select class="form-control">
                                                <option>A</option>
                                                <option>B</option>
                                            </select>
										</div>										
                                        
										</div>
	</div>
    <div role="tabpanel" class="tab-pane" id="ext">
	<br>
	<div class="form-group">
	<label for="nomor" class="col-sm-3 control-label">Left Time:</label>
	<div class="col-sm-8">
	<p class="form-control-static">10 days</p>
	</div>	
	</div>
	
	<div class="form-group">
	<label for="nomor" class="col-sm-3 control-label">Extend Time:</label>
	<div class="col-sm-8">
	<input type="number"class="form-control" />
	</div>	
	</div>
	</div>
   

  </div>

</div>	
										
		
        
      </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button type="button" class="btn btn-danger">Finish</button>
      </div>
	  </form>
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
                var t = $('#member').DataTable( {
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
	
	
	
	
	
	});
        </script>
<?php $this->end(); ?>