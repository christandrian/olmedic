<?php $this->start('sidebar'); ?>
<ul class="sidebar-menu">
                        <li class="active">
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
                        Dashboard
						
                    </h1>
					
                </section>

				
                <section class="content">

                   
                    <div class="row">
					
                        <div class="col-lg-4 col-xs-12">
                        
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        150
                                    </h3>
                                    <p>
                                        New Member
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="registration.html" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
                        <div class="col-lg-4 col-xs-12">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <br>
                                    </h3>
                                    <p>
                                        Master Obat
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-medkit"></i>
                                </div>
                                <a href="obat.html" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-xs-12">
                     
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <br>
                                    </h3>
                                    <p>
                                        Messages
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-email"></i>
                                </div>
                                <a href="message.html" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
					
			