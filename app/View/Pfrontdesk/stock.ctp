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
        'action' => 'dashboard',
        'full_base' => true
        ), array('escape' => false)
        );
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
                'action' => 'prescription',
                'full_base' => true
                ), array('escape' => false)
                );
                ?>
            </li>
            <li><?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Daftar Resep</span>', array('controller' => 'pfrontdesk',
                'action' => 'list_prescriptions',
                'full_base' => true
                ), array('escape' => false)
                );
                ?></li>
        </ul>
    </li>
    <li class="treeview active">
        <a href="#">
            <i class="fa fa-file"></i>
            <span>Inventory</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Item</span>', array('controller' => 'pfrontdesk',
                'action' => 'addNewProduct',
                'full_base' => true
                ), array('escape' => false)
                );
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Paket</span>', array('controller' => 'pfrontdesk',
                'action' => 'addNewPacket',
                'full_base' => true
                ), array('escape' => false)
                );
                ?></li>
            <li><?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Jasa</span>', array('controller' => 'pfrontdesk',
                'action' => 'addNewService',
                'full_base' => true
                ), array('escape' => false)
                );
                ?></li>
            <li><?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Kategori</span>', array('controller' => 'pfrontdesk',
                'action' => 'addNewCategory',
                'full_base' => true
                ), array('escape' => false)
                );
                ?></li>
            <li><?php
                echo $this->Html->link(
                '<i class="fa fa-angle-double-right"></i><span>Tambah Brand</span>', array('controller' => 'pfrontdesk',
                'action' => 'addNewBrand',
                'full_base' => true
                ), array('escape' => false)
                );
                ?></li>
        </ul>
    </li>
    <li>
        <?php
        echo $this->Html->link(
        '<i class="fa fa-money"></i> <span>Pembayaran</span>', array('controller' => 'pfrontdesk',
        'action' => 'payment',
        'full_base' => true
        ), array('escape' => false)
        );
        ?>

    </li>
    <li>
        <?php
        echo $this->Html->link(
        '<i class="fa fa-file-text"></i> <span>laporan</span>', array('controller' => 'pfrontdesk',
        'action' => 'reports',
        'full_base' => true
        ), array('escape' => false)
        );
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
                        <?php //echo var_dump($data_meds[0]) ?>
                    </div>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Kuantitas</th>
                                    <th>harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_meds as $f): ?>
                                <tr>
                                    <td></td>

                                    <td class="id_med"><?php echo $f['Id_Product']; ?></td>
                                    <td class="name_med"><?php echo $f['Product_Name']; ?></td>
                            <input type="hidden" class="desc_med" value="<?php echo $f['Description']; ?>" />
                            <input type="hidden" class="category_med" value="<?php echo $f['Id_Category']; ?>" />							
                            <td class="category_name_med"><?php echo $f['Category_Name']; ?></td>
                            <td><span class="stock_med"><?php echo $f['Stock']; ?></span> <?php echo $f['Metric_Sales']; ?></td>
                            <td><span class="price_sell_med"><?php echo $f['Price']; ?></span></td>
                            <!--<input type="hidden" class="merk_med" value="<?php echo $f['Merk_Name']; ?>" />-->

                            <input type="hidden" class="price_purch_med" value="<?php echo $f['Purch_Price']; ?>" />
                            <input type="hidden" class="code_med" value="<?php echo $f['Item_Code']; ?>" />

                            <input type="hidden" class="po_name_med" value="<?php echo $f['Metric_Po']; ?>" />
                            <input type="hidden" class="sales_name_med" value="<?php echo $f['Metric_Sales']; ?>" />
                            <input type="hidden" class="inv_name_med" value="<?php echo $f['Metric_Inv']; ?>" />
                            <input type="hidden" class="packaging_med" value="<?php echo $f['Packaging']; ?>" />
                            <input type="hidden" class="indikasi_med" value="<?php echo $f['Indikasi']; ?>" />
                            <input type="hidden" class="efek_samping_med" value="<?php echo $f['Efek_Samping']; ?>" />
                            <input type="hidden" class="min_stock_med" value="<?php echo $f['Min_Stock']; ?>" />
                            <input type="hidden" class="shelf_life_med" value="<?php echo $f['Shelf_Life']; ?>" />
                            <input type="hidden" class="sku_med" value="<?php echo $f['SKU']; ?>" />
                            <input type="hidden" class="image_med" value="<?php echo $f['Image']; ?>" />
                            <input type="hidden" class="disc_med" value="<?php echo $f['Percentage_Amount']; ?>" />
                            <input type="hidden" class="disc2_med" value="<?php echo $f['Fixed_Amount']; ?>" />
                            <input type="hidden" class="desc_disc_med" value="<?php echo $f['Description_Discount']; ?>" />
                            <td>
                                <button class="btn btn-primary updateMed"  >Update Item</button>
                                <button class="btn btn-info addMed" >Restock Item</button>
                                <button class="btn btn-danger delMed">Hapus Item</button></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Kuantitas</th>
                                    <th>harga</th>
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
                        <h3 class="box-title">Daftar Jasa  </h3>

                    </div>
                    <div class="box-body table-responsive">
                        <table id="example3" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_serv as $f): ?>
                                <tr>
                                    <td></td>
                            <input type="hidden" class="desc_serv" value="<?php echo $f['Description']; ?>" />
                            <td class="id_serv"><?php echo $f['Id_Product']; ?>
                            </td>
                            <td class="name_serv"><?php echo $f['Product_Name']; ?></td>
                            <input type="hidden" class="category_serv" value="<?php echo $f['Category_Id']; ?>" />
                            <input type="hidden" class="instruction_serv" value="<?php echo $f['Service_Inst']; ?>" />
                            <input type="hidden" class="code_serv" value="<?php echo $f['Service_Code']; ?>" />
                            <input type="hidden" class="disc_serv" value="<?php echo $f['Percentage_Amount']; ?>" />
                            <input type="hidden" class="disc2_serv" value="<?php echo $f['Fixed_Amount']; ?>" />
                            <input type="hidden" class="desc_disc_serv" value="<?php echo $f['Discount_Description']; ?>" />
                            <td><?php echo $f['Category_Name']; ?></td>
                            <td class="price_serv"><?php echo $f['Price']; ?> </td>
                            <td>
                                <button class="btn btn-primary updServ">Update Jasa</button>
                                <button class="btn btn-danger delServ">Hapus Jasa</button>
                            </td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
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
                        <h3 class="box-title">Daftar Paket </h3>

                    </div>
                    <div class="box-body table-responsive">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_pack as $f): ?>
                                <tr>
                                    <td></td>
                                    <td  class="id_packet"><?php echo $f['Id_Packet']; ?></td>
                                    <td><?php echo $f['Product_Name']; ?></td>
                                    <td><?php echo $f['Price']; ?> </td>
                                    <td>
                                        <a href="update_packet?id=<?php echo $f['Id_Packet']; ?>" class="btn btn-primary">Update Packet</a>
                                        <button class="btn btn-danger delPacket">Hapus Paket</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                     <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


</section>


<div class="modal fade" id="updatePr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Update Item</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method ="post" action="updateItem">


                    <input type="hidden" class="form-control" id="id_med_show" name="id_med_show" >
                    <div id="non-exist" style="display:visible;">

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Nama:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name_med_show" name="name_med_show"  placeholder="Name" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Deskripsi:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="desc_med_show" id="desc_med_show" placeholder="Description" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Kategori:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="category_med_show" name="category_med_show">
                                    <option>-</option>
                                    <?php foreach ($itemCate as $f): ?>
                                    <option value="<?php echo $f['SYS_ID']; ?>"><?php echo $f['Name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>										

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Qty:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="stock_med_show" name="stock_med_show" placeholder="Qty" required>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Harga Jual:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="price_sell_med_show" name="price_sell_med_show" placeholder="Sale Price" required>
                            </div>										
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Harga Beli:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price_purch_med_show" name="price_purch_med_show" placeholder="Purch Price" required>

                            </div>										

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Diskon:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="disc_med_show" name="discount_med_show" placeholder="10.1%" required>
                            </div>										
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Diskon 2:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="disc2_med_show" name="discount2_med_show" placeholder="1000" required>
                            </div>										
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Deskripsi Diskon:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="desc_disc_med_show" name="discount_description_med_show" placeholder="Description" required>

                            </div>										

                        </div>
                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Kode Item:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="code_med_show" name="code_med_show" placeholder="Code" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Satuan di Pembelian:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="po_name_med_show" name="po_name_med_show">
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
                                <select class="form-control" name="inv_name_med_show" id="inv_name_med_show">
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
                                <select class="form-control" name="sales_name_med_show" id="sales_name_med_show">
                                    <option>-</option>
                                    <?php foreach ($metric as $f): ?>
                                    <option value="<?php echo $f['Name']; ?>"><?php echo $f['Name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>										

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Kemasan:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="packaging_med_show" name="packaging_med_show" placeholder="Packaging" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Indikasi:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="indikasi_med_show" name="indikasi_med_show" placeholder="Indikasi" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Efek Samping:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="efek_samping_med_show" name="efek_samping_med_show" placeholder="Efek Samping" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Kuantitas Minimal:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="min_stock_med_show" name="min_stock_med_show" placeholder="Min. Stock" required>

                            </div>
                        </div>

                        <!--
<div class="form-group">
    <label for="nomor" class="col-sm-3 control-label">Shelf Life:</label>
    <div class="col-sm-8">
        <input type="date" class="form-control" id="shelf_life_med_show" name="shelf_life_med_show" placeholder="Shelf Life">

    </div>
</div>-->

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">SKU:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="sku_med_show" name="sku_med_show" placeholder="SKU" required>

                            </div>
                        </div>

                        <!--<div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Gambar:</label>
                            <div class="col-sm-4">
                                <img src="" class="img-responsive" id="image_med_show">
                            </div>
                            <div class="col-sm-4">
                                <input type="file" name="image_med_show"  class="form-control"/>

                            </div>
                        </div>-->

                        <div class="form-group">

                            <div class="col-sm-2 col-md-offset-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>										

                        </div>

                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="addPr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Restock Product</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method ="post" action="restockItem">


                    <input type="hidden" class="form-control" id="id_med_show2" name="id_med_show2" >
                    <input type="hidden" class="form-control" id="current_stock_med_show2" name="current_stock_med_show2" >
                    <div id="exist" style="display:visible;">

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Nama:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static" id="name_med_show2">paramex</p>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Deskripsi:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static" id="desc_med_show2">paramex</p>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Kategori:</label>
                            <div class="col-sm-8">
                                <p class="form-control-static" id="category_med_show2">A</p>
                            </div>										

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Qty:</label>
                            <div class="col-sm-2">
                                <p class="form-control-static" id="stock_med_show2">3</p>
                            </div>
                            <label for="nomor" class="col-sm-3 control-label">Tambah:</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" name="add_med" id="add_med" placeholder="Qty" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Satuan di Gudang:</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="current_inv_name_med_show" id="current_inv_name_med_show">
                                    <option>-</option>
                                    <?php foreach ($metric as $f): ?>
                                    <option value="<?php echo $f['Name']; ?>"><?php echo $f['Name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>										

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Harga Beli :</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="purch_price_med" name="purch_price_med" placeholder="Harga Beli" required>
                            </div>										
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Harga Jual:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="sell_price_med" name="sell_price_med" placeholder="Harga Jual" required>
                            </div>										
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Supplier:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="supplier_med" name="supplier_med" placeholder="Supplier" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Catatan:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="note_med" name="note_med" placeholder="Note" required>
                            </div>
                        </div>

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

<div class="modal fade" id="updateSc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Update Jasa</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="updateService">
                    <div id="non-exist" style="display:visible;">

                        <input type="hidden" class="form-control" id="id_serv_show" name="id_serv_show" >
                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Nama:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name_serv_show" name="name_serv_show" placeholder="Jasa" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Deskripsi:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="desc_serv_show" name="desc_serv_show" placeholder="Jasa Deskripsi" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Kategori:</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="category_serv_show" name="category_serv_show" >
                                    <option>-</option>
                                    <?php foreach ($servCate as $f): ?>
                                    <option value="<?php echo $f['SYS_ID']; ?>"><?php echo $f['Name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>										

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Kode Jasa:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="code_serv_show" name="code_serv_show" placeholder="Service Code" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Instruksi:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="instruction_serv_show" name="instruction_serv_show" placeholder="Instruction" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Harga Jual:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price_serv_show" name="price_serv_show" placeholder="Obat" required>

                            </div>										

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Diskon:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="disc_serv_show" name="discount_serv_show" placeholder="10.1%" required>

                            </div>										

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Diskon 2:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="disc2_serv_show" name="discount2_serv_show" placeholder="1000" required>

                            </div>										

                        </div>

                        <div class="form-group">
                            <label for="nomor" class="col-sm-3 control-label">Deskripsi Diskon:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="desc_disc_serv_show" name="discount_description_serv_show" placeholder="Description" required>

                            </div>										

                        </div>

                        <div class="form-group">

                            <div class="col-sm-2 col-md-offset-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>										

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
                <h4 class="modal-title" id="exampleModalLabel">Hapus ?</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" action="delete">

                    <input type="hidden" name="id_prod_del" id="id_prod_del" />
                    <input type="hidden" name="type" id="type" />

                    <div id="non-exist" style="display:visible;">


                        <div class="form-group">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-danger btn-lg">HAPUS</button>
                                <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal" aria-label="Close">BATAL</button>

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



        $(document).on("click", ".updateMed", function() {

            $('#id_med_show').val($(this).parent().parent().find('.id_med').text());
            $('#desc_med_show').val($(this).parent().parent().find('.desc_med').val());
            $('#name_med_show').val($(this).parent().parent().find('.name_med').text());
            $('#stock_med_show').val($(this).parent().parent().find('.stock_med').text());
            $('#price_sell_med_show').val($(this).parent().parent().find('.price_sell_med').text());
            $('#price_purch_med_show').val($(this).parent().parent().find('.price_purch_med').val());
            $('#code_med_show').val($(this).parent().parent().find('.code_med').val());
            $('#category_med_show').val($(this).parent().parent().find('.category_med').val());
            $('#po_name_med_show').val($(this).parent().parent().find('.po_name_med').val());
            $('#sales_name_med_show').val($(this).parent().parent().find('.sales_name_med').val());
            $('#inv_name_med_show').val($(this).parent().parent().find('.inv_name_med').val());
            $('#packaging_med_show').val($(this).parent().parent().find('.packaging_med').val());
            $('#indikasi_med_show').val($(this).parent().parent().find('.indikasi_med').val());
            $('#efek_samping_med_show').val($(this).parent().parent().find('.efek_samping_med').val());
            $('#min_stock_med_show').val($(this).parent().parent().find('.min_stock_med').val());
            $('#disc_med_show').val($(this).parent().parent().find('.disc_med').val());
            $('#disc2_med_show').val($(this).parent().parent().find('.disc2_med').val());
            $('#desc_disc_med_show').val($(this).parent().parent().find('.desc_disc_med').val());
            $('#sku_med_show').val($(this).parent().parent().find('.sku_med').val());
            $('#shelf_life_med_show').val($(this).parent().parent().find('.shelf_life_med').val());
            $('#image_med_show').attr("src", 'data:image/jpeg;base64,' + $(this).parent().parent().find('.image_med').val());
            $('#updatePr').modal('show');

        });

        $(document).on("click", ".addMed", function() {

            $('#id_med_show2').val($(this).parent().parent().find('.id_med').text());
            $('#current_stock_med_show2').val($(this).parent().parent().find('.stock_med').text());
            $('#desc_med_show2').text($(this).parent().parent().find('.desc_med').val());
            $('#name_med_show2').text($(this).parent().parent().find('.name_med').text());
            $('#stock_med_show2').text($(this).parent().parent().find('.stock_med').text());
            $('#category_med_show2').text($(this).parent().parent().find('.category_name_med').text());
            $('#sell_price_med').val($(this).parent().parent().find('.price_sell_med').text());
            $('#current_inv_name_med_show').val($(this).parent().parent().find('.inv_name_med').val());

            $('#addPr').modal('show');

        });

        $(document).on("click", ".delMed", function() {

            $('#id_prod_del').val($(this).parent().parent().find('.id_med').text());
            $('#type').val('item');

            $('#delete').modal('show');

        });

        $(document).on("click", ".updServ", function() {

            $('#id_serv_show').val($(this).parent().parent().find('.id_serv').text());
            $('#desc_serv_show').val($(this).parent().parent().find('.desc_serv').val());
            $('#name_serv_show').val($(this).parent().parent().find('.name_serv').text());
            $('#instruction_serv_show').val($(this).parent().parent().find('.instruction_serv').val());
            $('#code_serv_show').val($(this).parent().parent().find('.code_serv').val());
            $('#price_serv_show').val($(this).parent().parent().find('.price_serv').text());
            $('#category_serv_show').val($(this).parent().parent().find('.category_serv').val());
            $('#disc_serv_show').val($(this).parent().parent().find('.disc_serv').val());
            $('#disc2_serv_show').val($(this).parent().parent().find('.disc2_serv').val());
            $('#desc_disc_serv_show').val($(this).parent().parent().find('.desc_disc_serv').val());
            $('#updateSc').modal('show');

        });

        $(document).on("click", ".delServ", function() {

            $('#id_prod_del').val($(this).parent().parent().find('.id_serv').text());
            $('#type').val('service');

            $('#delete').modal('show');

        });

        $(document).on("click", ".delPacket", function() {

            $('#id_prod_del').val($(this).parent().parent().find('.id_packet').text());
            $('#type').val('packet');

            $('#delete').modal('show');

        });
    });


</script>	
<?php $this->end(); ?>