<?php $this->start('sidebar'); ?>
<ul class="sidebar-menu">
                        <li class="active">
						<?php echo $this->Html->link(
								'<i class="fa fa-dashboard"></i> <span>Dashboard</span>',
								array('controller' => 'cdoctor',
										'action' => 'dashboard',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                           
                        </li>
						
						<li>
							<?php echo $this->Html->link(
								'<i class="fa fa-calendar"></i> <span>History</span>',
								array('controller' => 'cdoctor',
										'action' => 'history',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                        </li>
						
						<li>
							<?php echo $this->Html->link(
								'<i class="fa fa-stack-exchange"></i> <span>Queue</span>',
								array('controller' => 'cdoctor',
										'action' => 'queue',
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
					
                        <div class="col-lg-6 col-xs-12">
                   
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        Klinik Satu
                                    </h3>
                                    <p>
                                       <br> 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-home"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Enter <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-xs-12">
                            
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        Klinik Dua
                                    </h3>
                                    <p>
                                        <br>
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-home"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    Enter <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
                    </div><!-- /.row -->

             
						
                       

                </section>
					
			