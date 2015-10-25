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
    <li class="active">
        <?php
        echo $this->Html->link(
                '<i class="fa fa-dashboard"></i> <span>Dashboard</span>', array('controller' => 'pfrontdesk',
            'action' => 'dashboard',
            'full_base' => true
                ), array('escape' => false)
        );
        ?>

    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Prescription</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <?php
                echo $this->Html->link(
                        '<i class="fa fa-angle-double-right"></i><span>Add New Prescription</span>', array('controller' => 'pfrontdesk',
                    'action' => 'prescription',
                    'full_base' => true
                        ), array('escape' => false)
                );
                ?>
            </li>
            <li><?php
                echo $this->Html->link(
                        '<i class="fa fa-angle-double-right"></i><span>List Prescriptions</span>', array('controller' => 'pfrontdesk',
                    'action' => 'list_prescriptions',
                    'full_base' => true
                        ), array('escape' => false)
                );
                ?></li>
        </ul>
    </li>
    <li>
        <?php
        echo $this->Html->link(
                '<i class="fa fa-stack-exchange"></i> <span>Stocks</span>', array('controller' => 'pfrontdesk',
            'action' => 'stock',
            'full_base' => true
                ), array('escape' => false)
        );
        ?>
    </li>
    <li>
        <?php
        echo $this->Html->link(
                '<i class="fa fa-money"></i> <span>Payment</span>', array('controller' => 'pfrontdesk',
            'action' => 'payment',
            'full_base' => true
                ), array('escape' => false)
        );
        ?>

    </li>
    <li>
        <?php
        echo $this->Html->link(
                '<i class="fa fa-file-text"></i> <span>Reports</span>', array('controller' => 'pfrontdesk',
            'action' => 'reports',
            'full_base' => true
                ), array('escape' => false)
        );
        ?>
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
    
	</div>
</section>
