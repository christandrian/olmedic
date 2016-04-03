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
        <?php echo $this->Html->link(
        '<i class="fa fa-dashboard"></i> <span>Beranda</span>',
        array('controller' => 'cdoctor',
        'action' => 'dashboard',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>

    </li>

    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-calendar"></i> <span>Riwayat</span>',
        array('controller' => 'cdoctor',
        'action' => 'history',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>
    </li>

    <li>
        <?php echo $this->Html->link(
        '<i class="fa fa-stack-exchange"></i> <span>Antrian</span>',
        array('controller' => 'cdoctor',
        'action' => 'queue',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>

    </li>
	
	<li>
        <?php echo $this->Html->link(
        '<i class="fa fa-stack-exchange"></i> <span>Petunjuk Penggunaan</span>',
        array('controller' => 'cdoctor',
        'action' => 'faq',
        'full_base' => true
        ),
        array('escape'=>false)
        );?>

    </li>

</ul>
<?php $this->end(); ?>

<section class="content-header">
    <h1>
        Beranda

    </h1>

</section>


<section class="content">

    <div class="row">


    </div><!-- ./col -->



</section>

