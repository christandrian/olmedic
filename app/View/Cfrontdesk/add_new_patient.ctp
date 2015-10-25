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
                                <li class="active">
								<?php echo $this->Html->link(
								'<i class="fa fa-angle-double-right"></i><span>Add New Patient</span>',
								array('controller' => 'cfrontdesk',
										'action' => 'addNewPatient',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
								</li>
                                <li ><?php echo $this->Html->link(
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
                        Registration
                    </h1>
                    
                </section>

                <section class="content">

				<div class="row">
				<div class="col-md-6">
				<div class="box box-primary">
                                <div class="box-header">
                                    
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form id="formPatient" method ="post" action="addPatient">
                                    <div class="box-body">
									
									<div class="form-group">
                                            <label for="nama">First Name</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
											
                                        </div>
                                        
										<div class="form-group">
                                            <label for="nama">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
											
                                        </div>
                                        
										<label for="nomor">Identity Number</label>
										<div class="form-inline">
											
                                        <div class="form-group">
                                            <select class="form-control" name="id_type">
                                                <option value="KTP">KTP</option>
                                                <option value="SIM">SIM</option>
                                                <option value="KP">Kartu Pelajar</option>
                                                <option value="Other">dll</option>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <input type="text" class="form-control" name="id_number" placeholder="Identity Number">
                                        </div>
										</div>
										<div class="form-group">
                                            <label for="tanggal">Birthdate</label>
                                            <input type="date" class="form-control" name="birth_date" placeholder="Birth Date">
                                        </div>
										<div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>                                                
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label>Blood Type</label>
                                            <select name="blood_type" class="form-control">
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                        </div>
										<div class="form-group">
                                            <label for="nama">Weight</label>
                                            <input type="number" class="form-control" name="weight" placeholder="kgs">
											
                                        </div>
                                    </div><!-- /.box-body -->

                                    
                            </div><!-- /.box -->
				</div>
				<div class="col-md-6">
				<div class="box box-primary">
                                <div class="box-header">
                                    
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                
                                    <div class="box-body">
									 <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                        </div>
                                       
									<div class="form-group">
                                        <label>Handphone</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" name="handphone" class="form-control" data-inputmask='"mask": "(+99) 99-999-999999"' data-mask/>
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                      
									   
                                        <div class="form-group">
                                        <label>Emergency contact</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            <input type="text" name="contact" class="form-control" data-inputmask='"mask": "(+99) 99-999-999999"' data-mask/>
                                        </div><!-- /.input group -->
                                    </div><!-- /.form group -->
                                    </div><!-- /.box-body -->
 <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    </form>
                            </div><!-- /.box -->
				</div>
				</div>
                </section>
            </aside>

			
			
<?php 
echo $this->Html->css('datatables/dataTables.bootstrap');
$this->start('additional'); 
echo $this->Html->script('plugins/datatables/jquery.dataTables');
echo $this->Html->script('plugins/datatables/dataTables.bootstrap');
echo $this->Html->script('plugins/input-mask/jquery.inputmask');
echo $this->Html->script('plugins/input-mask/jquery.inputmask.date.extensions');
echo $this->Html->script('plugins/input-mask/jquery.inputmask.extensions');
?>	
<script>
		$("[data-mask]").inputmask();
		</script>		
<?php $this->end(); ?>