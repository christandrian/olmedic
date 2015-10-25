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
                            <ul class="treeview-menu ">
                                <li class="active">
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
                        Registration
                        
                    </h1>
                    
                </section>

                <section class="content">

				<div class="row">
					<div class="col-xs-12">
                           

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">New Member </h3>
									
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="member" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>ID</th>
                                                <th>Nama</th>
                                                <th>Email</th>
												<th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td>123412</td>
                                                <td>rudi subandini</td>
                                                <td>dr. budi</td>
												<td>-</td>
                                                <td><button class="btn btn-primary" data-toggle="modal" data-target="#showMore" data-whatever="@mdo">More</button></td>
                                            </tr>
											<tr>
                                                <td></td>
                                                <td>123412</td>
                                                <td>rudi subandini</td>
                                                <td>dr. budi</td>
												<td>-</td>
                                                <td>-</td>
                                            </tr>
											<tr>
                                                <td></td>
                                                <td>123412</td>
                                                <td>rudi subandini</td>
                                                <td>dr. budi</td>
												<td>-</td>
                                                <td>-</td>
                                            </tr>
											
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>No</th>
												<th>ID</th>
                                                <th>Pasien</th>
                                                <th>Dokter</th>
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

<div class="modal fade" id="showMore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Registration</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
						
										
                                        
										
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Nama:</label>
										<div class="col-sm-8">
										 <p class="form-control-static">example</p>
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
										 <p class="form-control-static">Sabtu, 24 Juni 2015</p>
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
										<label for="nomor" class="col-sm-2 control-label">Message:</label>
										<div class="col-sm-8">
										<textarea class="form-control" id="message-text" ></textarea>
										</div>										
                                        
										</div>
										<div class="form-group">
										
										<div class="col-sm-2 col-md-offset-10">
										<button type="submit" class="btn btn-primary">Approve</button>
										</div>										
                                        
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
echo $this->Html->script('plugins/input-mask/jquery.inputmask');
echo $this->Html->script('plugins/input-mask/jquery.inputmask.date.extensions');
echo $this->Html->script('plugins/input-mask/jquery.inputmask.extensions');
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