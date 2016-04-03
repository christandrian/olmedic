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
                                <li><?php echo $this->Html->link(
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
						<li class="active">
							<?php echo $this->Html->link(
								'<i class="fa fa-file-text"></i> <span>Reports</span>',
								array('controller' => 'cfrontdesk',
										'action' => 'reports',
										'full_base' => true
								),
								array('escape'=>false)
								);?>
                         </li>
						<li>
        <?php echo $this->Html->link(
        '<i class="fa fa-file-text"></i> <span>Petunjuk Penggunaan</span>',
        array('controller' => 'cfrontdesk',
        'action' => 'faq',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>
                    </ul>
					<?php $this->end(); ?>

<style>
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
padding:0px!important;
padding-left:8px!important;
padding-right:8px!important;
}
</style>
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

<section class="content invoice" style="padding-top:0px;">

    <div class="row" style="height:40px;width:95%;">
        <div class="col-xs-12" style="height:42px">
            <h2 class="page-header" style="padding-bottom:3px">
                <i class="fa fa-globe"></i> <?php echo $data['storeName'];?>
                <small class="pull-right">Tanggal: <?php echo $invoice['Date'];?></small>
            </h2>
        </div>
    </div>

    <div class="row invoice-info" style="height:30px;width:95%;">
        <div class="col-sm-4 invoice-col">
            <address>
                <?php echo $data_store['Alamat'];?>. <?php echo $data_store['Nomor_Telepon'];?><br/>
            </address>
        </div>
		
		<div class="col-sm-2 invoice-col">
            Pasien: <b><?php echo $invoice['Patient_Name'];?> </b><br/>
        </div>
		
		<div class="col-sm-2 invoice-col">
            Dokter: <b><?php echo $invoice['Doctor_Name'];?></b><br/>
        </div>
		
        <div class="col-sm-4 invoice-col">
            Invoice: <b><?php echo $invoice['ID_Transaction'];?></b><br/>
            <br/>
            <!--<b>Order ID:</b> 4F3S8J<br/>
            <b>Payment Due:</b> 2/22/2014<br/>
            <b>Account:</b> 968-34567-->
        </div>
    </div>


    <div class="row" style="width:95%;">

        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Kuantitas</th>
                        <th>Nama Product</th>
                        <th>No Seri</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach( $detail_invoice as $f ): ?>
                    <tr>
                        <td><?php echo $f[ 'quantity' ]; ?></td>
                        <td><?php echo $f[ 'item_name' ]; ?></td>
                        <td><?php echo $f[ 'id_product' ]; ?></td>
                         <td><?php echo number_format($f[ 'price_after' ], 0, '.', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="row" style="width:95%;">
        <div class="col-xs-6 col-xs-offset-6">
            
            <div class="table-responsive">
                <table class="table">
                  <tr>
                        <th style="width:50%">Subtotal</th>
                        <td><?php echo number_format($invoice['Subtotal_Price'], 0, '.', '.');?></td>
                    </tr>
                    <tr>
                        <th>Pajak</th>
                        <td><?php echo number_format($invoice['Tax'], 0, '.', '.').' %';?></td>
                    </tr>
                    <tr>
                        <th>Diskon</th>
                        <td><?php echo number_format($invoice['Percentage_Discount'], 0, '.', '.').' %';?></td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td><?php echo number_format($invoice['Total_Price'], 0, '.', '.');?></td>
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
			
			
