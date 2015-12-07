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
						<li class="treeview active">
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
                                <li class="active"><?php echo $this->Html->link(
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
                        List of Patients
                        
                    </h1>
                    
                </section>

                <section class="content">


                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">

                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <section class="content no-print">
                        <div class="row">
                            <div class="col-xs-12">


                                <div class="box">
                                    <div class="box-header">
                                        <h3 class="box-title">Patient List</h3>
										<?php  //print_r($result);?>
                                    </div><!-- /.box-header -->
                                    <div class="box-body table-responsive">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
													<th>Identity</th>
                                                    <th>Patient</th>
                                                    <th>Gender</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											 <?php foreach ($result as $f): ?>
                                                <tr>
													<td></td>
													<input type="hidden" value="<?php echo $f['ID_Patient']; ?>" class="id_patient"/>
													<td><?php echo $f['Social_Number']; ?></td>
													<td><?php echo $f['First_Name'].$f['Last_Name']; ?></td>
													<td><?php echo $f['Gender']; ?></td>
                                                    <td><?php echo $this->Html->link(
													'Detail',
													'/cfrontdesk/patient/'.$f['ID_Patient'],
													array('class' => 'btn btn-info')
												);?>
													 <button class="btn btn-primary add" >Add Patient</button></td>
                                                </tr>
                                                 <?php endforeach; ?>
                                               
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
													<th>Identity</th>
                                                    <th>Patient</th>
                                                    <th>Gender</th>
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

<div class="modal fade" id="addToQueue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Queue Registration</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="queuePatient">
								<input type="hidden" name="id" id="id_patient_distinct">
                                <div class="form-group">
                                        <label for="nomor" class="col-sm-2 control-label">Doctor:</label>
                                        <div class="col-sm-8">
                                        <select name="doctor" id="doctor" class="form-control">
										<option>-</option>
										<?php foreach ($doctor as $f): ?>
											<option value="<?php echo $f['ID_Doctor']; ?>"><?php echo $f['First_Name'].' '.$f['Last_Name']; ?></option>
										<?php endforeach; ?>
                                            </select>
                                        </div>                                      
                                        
                                        </div>
                                        
                                        <div class="form-group ">
                                        <label for="nomor" class="col-sm-2 control-label">Time:</label>
                                        <div class="col-sm-8">
                                        <div class="input-group bootstrap-timepicker">
                                                <input type="text" name="time" id="time" class="form-control timepicker"/>
                                            </div>
                                        </div>                                      
                                        
                                        </div>
                                        
                                        <div class="form-group">
                                        <label for="nomor" class="col-sm-2 control-label">Via:</label>
                                        <div class="col-sm-8">
                                         <select name="via" class="form-control" id="via">
                                                <option value="Langsung">Langsung</option>
                                                <option value="Phone">Phone</option>
                                            </select>
                                        </div>                                      
                                        
                                        </div>
                                        
                                        <div class="form-group">
                                        <label for="nomor" class="col-sm-2 control-label">Anamnesa:</label>
                                        <div class="col-sm-8">
                                        <textarea name="anamnesa" class="form-control" id="anamnesa"></textarea>
                                        </div>

										
                                        
                                        </div>
										
										<div class="form-group">
                                        <label for="nomor" class="col-sm-2 control-label">Keterangan:</label>
                                        <div class="col-sm-8">
                                        <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
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
			
<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
$this->start('additional'); 
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
echo $this->Html->script('plugins/timepicker/bootstrap-timepicker.min');
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
               
			    $(".timepicker").timepicker({
            showInputs: true
        });
$(document).on("click", ".add", function() {

            $('#addToQueue').modal('show');
			id=$(this).parent().parent().find('.id_patient').val();
			$('#id_patient_distinct').val(id);
        });		

		$(".timepicker").timepicker({
            showInputs: true
        });	

                                    });
								
									
        </script>			
<?php $this->end(); ?>