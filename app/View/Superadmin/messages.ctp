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
						<li class="active">
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
                        Messages
                        
                    </h1>
                    
                </section>

                <section class="content">
                   
                    <div class="mailbox row">
                        <div class="col-xs-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3">
                                            
                                            <div class="box-header">
                                                <i class="fa fa-inbox"></i>
                                                <h3 class="box-title">INBOX</h3>
                                            </div>
                                            <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> Compose Message</a>
                                           
                                        </div>
                                        <div class="col-md-9 col-sm-9">
                                            <div class="box-body table-responsive">
                                    <table id="messages" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>No</th>
												<th>FROM</th>
                                                <th>Nama</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                               <td></td>
                                                <td>123412</td>
                                                <td>rudi subandini</td>
                                                
                                                <td><button class="btn btn-primary" data-toggle="modal" data-target="#showMore">More</button>
												
												<button class="btn btn-danger" data-toggle="modal" data-target="#delete" >Delete</button></td>
                                            </tr>
											<tr>
                                                <td></td>
                                                <td>123412</td>
                                                <td>rudi subandini</td>
                                                
                                                <td>-</td>
                                            </tr>
											<tr>
                                               <td></td>
                                                <td>123412</td>
                                                <td>rudi subandini</td>
                                                
                                                <td>-</td>
                                            </tr>
											<tr>
                                                <td></td>
                                                <td>123412</td>
                                                <td>rudi subandini</td>
                                                
                                                <td>-</td>
                                            </tr>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
												<th>No</th>
												<th>FROM</th>
                                                <th>Nama</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </section>
            </aside>

			
<div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Compose New Message</h4>
                    </div>
                    <form action="#" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">TO:</span>
                                    <select class="form-control">
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <textarea name="message" id="email_message" class="form-control" placeholder="Message" style="height: 120px;"></textarea>
                            </div>
                            <div class="form-group">
                                <input id="file-0a" class="file" type="file" multiple data-min-file-count="0">
                            </div>

                        </div>
                        <div class="modal-footer clearfix">

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                            <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-envelope"></i> Send Message</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

		
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
										<label for="nomor" class="col-sm-2 control-label">FROM:</label>
										<div class="col-sm-8">
										 <p class="form-control-static">example</p>
										</div>										
                                        
										</div>
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Nama:</label>
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
										
										
										
										
										<div class="form-group">
										<label for="nomor" class="col-sm-2 control-label">Message:</label>
										<div class="col-sm-8">
										<textarea class="form-control" id="message-text" readonly >nananana </textarea>
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
        <h4 class="modal-title" id="exampleModalLabel">Queue Detail</h4>
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
echo $this->Html->css('fileinput');
$this->start('additional'); 
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
echo $this->Html->script('fileinput.min');
?>	

 <script type="text/javascript">
            $(function() {

				var t = $('#messages').DataTable( {
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