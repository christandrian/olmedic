<?php
$this->start('store');
echo $data['storeName'];
$this->end();
?>


<?php
$this->start('user');
echo '<p>' . $data['username'] . '- ' . $data['storeName'] . '<small>Frontdesk</small></p>';
$this->end();
?>
<?php $this->start('sidebar'); ?>
<ul class="sidebar-menu">
    <li>
        <?php
        echo $this->Html->link(
        '<i class="fa fa-dashboard"></i> <span>Beranda</span>', array('controller' => 'pfrontdesk',
        'action' => 'dashboard', 'full_base' => true), array('escape' => false));
        ?>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Resep</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Resep</span>', array('controller' => 'pfrontdesk',
                'action' => 'prescription', 'full_base' => true), array('escape' => false));
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Daftar Resep</span>', array('controller' => 'pfrontdesk',
                'action' => 'list_prescriptions', 'full_base' => true), array('escape' => false));
                ?>
            </li>
        </ul>
    </li>
    <li class="treeview active">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Inventory</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li  class="active">
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Item</span>', array('controller' => 'pfrontdesk',
                'action' => 'addNewProduct', 'full_base' => true), array('escape' => false));
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Paket</span>', array('controller' => 'pfrontdesk',
                'action' => 'addNewPacket', 'full_base' => true), array('escape' => false));
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Jasa</span>', array('controller' => 'pfrontdesk',
                'action' => 'addNewService', 'full_base' => true), array('escape' => false));
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Kategori</span>', array('controller' => 'pfrontdesk',
                'action' => 'addNewCategory', 'full_base' => true), array('escape' => false));
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Brand</span>', array('controller' => 'pfrontdesk',
                'action' => 'addNewBrand', 'full_base' => true), array('escape' => false));
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Daftar</span>', array('controller' => 'pfrontdesk',
                'action' => 'stock', 'full_base' => true), array('escape' => false));
                ?>
            </li>
        </ul>
    </li>
    <li>
        <?php
        echo $this->Html->link(
        '<i class="fa fa-money"></i> <span>Pembayaran</span>', array('controller' => 'pfrontdesk',
        'action' => 'payment', 'full_base' => true), array('escape' => false));
        ?>
    </li>
    <li>
        <?php
        echo $this->Html->link(
        '<i class="fa fa-file-text"></i> <span>Laporan</span>', array('controller' => 'pfrontdesk',
        'action' => 'reports', 'full_base' => true), array('escape' => false));
        ?>
    </li>
	
	<li>
        <?php
        echo $this->Html->link(
        '<i class="fa fa-file-text"></i> <span>Petunjuk Pemakaian</span>', array('controller' => 'pfrontdesk',
        'action' => 'faq',
        'full_base' => true
        ), array('escape' => false)
        );
        ?>
    </li>
</ul>
<?php $this->end(); ?>

<section class="content-header">
    <h1>
        Inventory

    </h1>

</section>

<section class="content">

    <div class="row">
        <div class="col-xs-12 connectedSortable">

        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Item </h3>
                        <?php //echo var_dump($data_meds); ?>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Brand Owner</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_meds as $f): ?>
                                <tr>
                                    <td></td>
                            <input type="hidden" class="desc_med" value="<?php //echo $f[ 'Description' ];  ?>" />
                            <td class="id_med"><?php echo $f['im']["ID_Product_Master"]; ?></td>
                            <td class="name_med"><?php echo $f['im']['Generic_Name']; ?></td>
                            <input type="hidden" class="category_med" value="<?php echo $f['im']['ID_Category']; ?>" />
                            <td><span class="merk_med"><?php echo $f['im']['ID_Merk']; ?></span></td>
                            <input type="hidden" class="category_med" value="<?php echo $f['im']['ID_Category']; ?>" />
                            <input type="hidden" class="description_med" value="<?php echo $f['im']['Description']; ?>" />
                            <input type="hidden" class="brandowner_med" value="<?php echo $f['im']['ID_Brandowner']; ?>" />
                            <input type="hidden" class="po_med" value="<?php echo $f['im']['Name_s50_po']; ?>" />
                            <input type="hidden" class="sales_med" value="<?php echo $f['im']['Name_s50_sales']; ?>" />
                            <input type="hidden" class="inventory_med" value="<?php echo $f['im']['Name_s50_inv']; ?>" />
                            <input type="hidden" class="packaging_med" value="<?php echo $f['im']['Packaging']; ?>" />
                            <input type="hidden" class="indikasi_med" value="<?php echo $f['im']['Indikasi']; ?>" />
                            <input type="hidden" class="efek_samping_med" value="<?php echo $f['im']['Efek_Samping']; ?>" />
                            <input type="hidden" class="category_name_med" value="<?php echo $f['ic']['Name']; ?>" />
                            <input type="hidden" class="merk_name_med" value="<?php echo $f['merk']['Name']; ?>" />
                            <input type="hidden" class="owner_name_med" value="<?php echo $f['brand']['Owner_name']; ?>" />

                            <td>
                                <button class="btn btn-primary getThis" data-toggle="modal" data-target="#getPr" >Ambil Data Item</button></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Brand Owner</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Tambah Item Baru </h3>
                    </div>
                    <div class="box-body table-responsive">
                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="add_item">
                            <div id="non-exist" >

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Nama:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_name" placeholder="Name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Nama Generik:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_generic_name" placeholder="Generic Name" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Kategori:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="item_category">
                                            <option>-</option>
                                            <?php foreach ($itemCate as $f): ?>
                                            <option value="<?php echo $f['SYS_ID']; ?>"><?php echo $f['Name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>                                      
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Deskripsi/Catatan:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_description" placeholder="Description/Note" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Kuantitas:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="item_stock" placeholder="Quantity" required>
                                    </div>
                                </div>
<!--
                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Merk:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="item_merk">
                                            <option>-</option>
                                            <?php foreach ($data_merk as $f): ?>
                                            <option value="<?php echo $f['ID_Merk']; ?>"><?php echo $f['Name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
-->
                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Brand Owner:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="item_brand_owner">
                                            <option>-</option>
                                            <?php foreach ($data_brand_owner as $f): ?>
                                            <option value="<?php echo $f['ID_Brandowner']; ?>"><?php echo $f['Owner_Name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>                                      
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Kode Item:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_code" placeholder="Code" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Harga Beli:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_buy_price" placeholder="Purch Price" required>
                                    </div>                                      
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Harga Jual:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_sell_price" placeholder="Sell Price" required>
                                    </div>                                      
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Diskon:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="item_discount" placeholder="10.1%" required>
                                    </div>                                      
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Diskon 2:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="item_discount2" placeholder="1000" required>
                                    </div>                                      
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Deskripsi Diskon:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_discount_description" placeholder="Description" required>
                                    </div>                                      
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Supplier:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_supplier" placeholder="Supplier" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Kemasan:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_packaging" placeholder="Packaging" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Indikasi:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_indikasi" placeholder="Indikasi" required>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Efek Samping:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_efek_samping" placeholder="Efek_Samping" required>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Catatan:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_note" placeholder="Note" required>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Satuan di Pembelian:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="item_po_name">
                                            <option>-</option>
                                            <?php foreach ($metric as $f): ?>
                                            <option value="<?php echo $f['Name']; ?>"><?php echo $f['Name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>                                      

                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Satuan di Gudang:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="item_inventory_name">
                                            <option>-</option>
                                            <?php foreach ($metric as $f): ?>
                                            <option value="<?php echo $f['Name']; ?>"><?php echo $f['Name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>                                      

                                </div>

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Satuan di Penjualan:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="item_sales_name">
                                            <option>-</option>
                                            <?php foreach ($metric as $f): ?>
                                            <option value="<?php echo $f['Name']; ?>"><?php echo $f['Name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>                                      

                                </div>


                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Min. Stock:</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="item_min_stock" placeholder="Min. Stock" required>

                                    </div>
                                </div>

                                <!--
<div class="form-group">
    <label for="nomor" class="col-sm-3 control-label">Shelf Life:</label>
    <div class="col-sm-8">
        <input type="date" class="form-control" name="item_shelf_life" placeholder="Shelf Life">
    </div>
</div>-->

                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">SKU:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="item_sku" placeholder="SKU" required>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Obat ?:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="item_is_meds" >
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>

                                    </div>
                                </div>

                                <!--<div class="form-group">
                                    <label for="nomor" class="col-sm-3 control-label">Gambar:</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="item_image" class="form-control"/>

                                    </div>
                                </div>-->

                                <!-- image-->
                                <div class="form-group">

                                    <div class="col-sm-2 col-md-offset-10">
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                    </div>                                      
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


</section>
</aside>


<div class="modal fade" id="getPr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Tambah Item Baru</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="add_item_from_master">
                    <div id="non-exist" >

                        <input type="hidden" class="form-control" name="item_id_master" id="item_id_master">

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Nama Generik:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static" id="generic_name_show2"></p>

                            </div>
                        </div>
<!--
                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Merk:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static" id="merk_med_show2"></p>

                            </div>
                        </div>
-->
                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Brand Owner:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static" id="brand_owner_med_show2"></p>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Nama:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="item_name" placeholder="Name" required>
                            </div>
                        </div>

                        <!--
                        <div class="form-group">
                        <label for="nomor" class="col-sm-3 control-label">Kategori:</label>
                        <div class="col-sm-8">
                        <select class="form-control" name="item_category" >
                                        <option>-</option>
                        <?php foreach ($itemCate as $f): ?>
                                            <option value="<?php echo $f['SYS_ID']; ?>"><?php echo $f['Name']; ?></option>
                        <?php endforeach; ?>
                                                </select>
                        </div>                                      

                        </div>
                        
                        <div class="form-group">
                        <label for="nomor" class="col-sm-3 control-label">Deskripsi:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" name="item_description" placeholder="Description" required>
                        
                        </div>
                        </div>
                        -->

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Kuantitas:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="item_stock" placeholder="Quantity" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Satuan di Pembelian:</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="item_po_name" id="item_po_name">
                                    <option>-</option>
                                    <?php foreach ($metric as $f): ?>
                                    <option value="<?php echo $f['Name']; ?>"><?php echo $f['Name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>                                      

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Satuan di Gudang:</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="item_inventory_name" id="item_inventory_name">
                                    <option>-</option>
                                    <?php foreach ($metric as $f): ?>
                                    <option value="<?php echo $f['Name']; ?>"><?php echo $f['Name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>                                      

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Satuan di Penjualan</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="item_sales_name" id="item_sales_name">
                                    <option>-</option>
                                    <?php foreach ($metric as $f): ?>
                                    <option value="<?php echo $f['Name']; ?>"><?php echo $f['Name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>                                      

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Harga Beli:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="item_buy_price" placeholder="Purch. Price" required>

                            </div>                                      

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Harga Jual:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="item_sell_price" placeholder="Sell Price" required>

                            </div>                                      

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Diskon:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="item_discount" placeholder="10%" required>

                            </div>                                      

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Diskon 2:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="item_discount2" placeholder="1000" required>

                            </div>                                      

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Deskripsi Diskon:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="item_discount_description" placeholder="Description">
                            </div>                                      
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Kode:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="item_code" placeholder="Code" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Supplier:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="item_supplier" placeholder="Supplier" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Catatan:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="item_note" placeholder="Note" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Kemasan:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="item_packaging" name="item_packaging" placeholder="Packaging" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Indikasi:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="item_indikasi" name="item_indikasi" placeholder="Indikasi" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Efek Samping:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="item_efek_samping" name="item_efek_samping" placeholder="Efek Samping" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Stok minimum:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="item_min_stock" placeholder="Min. Stock" required>

                            </div>
                        </div>

                        <!--
<div class="form-group">
    <label for="nomor" class="col-sm-3 control-label">Shelf Life:</label>
    <div class="col-sm-8">
        <input type="date" class="form-control" name="item_shelf_life" placeholder="Shelf Life">

    </div>
</div>-->

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">SKU:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="item_sku" placeholder="SKU" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Obat ?:</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="item_is_meds" >
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>

                            </div>
                        </div>


                        <!--<div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Image:</label>
                            <div class="col-sm-8">
                                <input type="file" name="item_image" class="form-control"/>

                            </div>
                        </div>-->

                        <!-- image-->
                        <div class="form-group">

                            <div class="col-sm-2 col-md-offset-10">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>                                      

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
?>	

<script type="text/javascript">
    $(function() {
        var t = $('#example1').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true,
            "order": [[1, 'asc']]
        });

        t.on('order.dt search.dt', function() {
            t.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        var t2 = $('#example2').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true,
            "order": [[1, 'asc']]
        });

        t2.on('order.dt search.dt', function() {
            t2.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        var t3 = $('#example3').DataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true,
            "order": [[1, 'asc']]
        });

        t3.on('order.dt search.dt', function() {
            t3.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

    });

    $('.getThis').on('click', function() {
        var tmp = $(this).parent().parent().find('.id_med').text();
        $('#item_id_master').val(tmp);
        $('#generic_name_show2').text($('.name_med').text());
        $('#merk_med_show2').text($('.merk_name_med').val());
        $('#brand_owner_med_show2').text($('.owner_name_med').val());
        $('#item_packaging').val($('.packaging_med').val());
        $('#item_indikasi').val($('.indikasi_med').val());
        $('#item_efek_samping').val($('.efek_samping_med').val());
        $('#item_inventory_name').val($('.inventory_med').val());
        $('#item_sales_name').val($('.sales_med').val());
        $('#item_po_name').val($('.po_med').val());
    });
</script>	
<?php $this->end(); ?>