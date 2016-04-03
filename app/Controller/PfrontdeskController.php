<?php

App::uses('AppController', 'Controller');

class PfrontdeskController extends AppController {

	public $components = array('Cookie');
    //loading and setting time default
    public function init() {
		$sess = CakeSession::read('idStore');
		if(!isset($sess)){
			$this->redirect(array("controller" => "Pages", "action" => "logout"));
		}
        $this->loadModel('DashBoard_Pharmacy');
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->DashBoard_Pharmacy->frontdesk(CakeSession::read('username'));
        $data['username'] = CakeSession::read('username');
        $data['storeName'] = $data['data_store']['Nama'];
        $this->set('data', $data);
        $this->layout = 'p_frontdesk';
    }

    //page dashboard
    public function dashboard() {
        $this->init();
		$this->set('a', $this->Cookie->read('User'));
        $this->set('title_for_layout', 'Beranda');
    }

    //page prescription
    public function prescription() {
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');

        $data_meds = $this->DashBoard_Pharmacy->loadMedicine($id_pharmacy, false);
        $this->set('data_meds', $data_meds);
        $this->set('title_for_layout', 'Tambah Resep');
    }

    //function add new prescription
    public function add_new_prescription() {
        $this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
		
		if(strlen($this->request['data']['presc_id'])==0 || strlen($this->request['data']['presc_name'])==0 || count($this->request['data']['item_id_presc']) == 0){
		$this->redirect(array("controller" => "Pfrontdesk", "action" => "prescription"));
		}
		
        $presc_id = $this->request['data']['presc_id'];
        $patient_name = $this->request['data']['presc_name'];
        $doctor_name = $this->request['data']['presc_doctor'];
        $institution_name = $this->request['data']['presc_institution'];
        $date = $this->request['data']['presc_date'];

        $arrItem = array();
        $arrItem1 = array();
		$ctr =  0;
        if(isset($this->request['data']['item_id_presc'])){
			for ($i = 0; $i < count($this->request['data']['item_id_presc']); $i++) {
            if ($this->request['data']['checker'][$i] == 'true') {
			
                $arrItem1[$i]['Id_Product'] = $this->request['data']['item_id_presc'][$i];
                $arrItem1[$i]['Item_Name'] = $this->request['data']['item_id_name'][$i];
                $arrItem1[$i]['Quantity'] = $this->request['data']['item_qty_presc'][$i];
                $arrItem1[$i]['Instruction'] = $this->request['data']['item_id_usage'][$i];
                $arrItem1[$i]['Price'] = $this->request['data']['item_price_presc'][$i];
                $arrItem1[$i]['Disc'] = $this->request['data']['item_disc_presc'][$i];
                $arrItem1[$i]['Stock'] = $this->request['data']['item_stock'][$i];
                $arrItem1[$i]['Metric'] = $this->request['data']['item_metric'][$i];
				$ctr++;
            }

            $arrItem[$i]['Id_Product'] = $this->request['data']['item_id_presc'][$i];
            $arrItem[$i]['Item_Name'] = $this->request['data']['item_id_name'][$i];
            $arrItem[$i]['Quantity'] = $this->request['data']['item_qty_presc'][$i];
            $arrItem[$i]['Instruction'] = $this->request['data']['item_id_usage'][$i];
            $arrItem[$i]['Price'] = $this->request['data']['item_price_presc'][$i];
            $arrItem[$i]['Disc'] = $this->request['data']['item_disc_presc'][$i];
            $arrItem[$i]['Stock'] = $this->request['data']['item_stock'][$i];
            $arrItem[$i]['Metric'] = $this->request['data']['item_metric'][$i];
        }
		}

       $sys_id = $this->DashBoard_Pharmacy->addPrescription($id_pharmacy, $presc_id, $patient_name, $doctor_name, $institution_name, $arrItem);
		
		if($ctr==0){
			$this->redirect(array("controller" => "Pfrontdesk",
				"action" => "list_prescriptions"));
		}else{
			$this->set("SYS_ID", $sys_id);
			$this->set("id_pharmacy", $id_pharmacy);
			$this->set("presc_id", $presc_id);
			$this->set("patient_name", $patient_name);
			$this->set("doctor_name", $doctor_name);
			$this->set("arrItem", $arrItem1);
			$this->layout = 'p_frontdesk';

			$this->Session->write('SYS_ID', $sys_id);
			$this->Session->write('presc_id', $presc_id);
			$this->Session->write('patient_name', $patient_name);
			$this->Session->write('doctor_name', $doctor_name);
			$this->Session->write('arrItem', $arrItem1);


			$this->redirect(array("controller" => "Pfrontdesk",
				"action" => "payment"));
		
		}

    }

    //page list prescription
    public function list_prescriptions() {
        $this->init();
		$id_pharmacy = CakeSession::read('idStore');
        $dataPresc = $this->DashBoard_Pharmacy->loadListPrescription($id_pharmacy );
        $this->set("dataPresc", $dataPresc);
		$this->set('title_for_layout', 'Daftar Resep');
    }

    //function detail prescription
    public function detail_presc() {
        $this->init();
        $presc_id = $this->request['data']['id'];
        $this->autoRender = false;
        $data = $this->DashBoard_Pharmacy->loadDetailListPrescription($presc_id);
        return json_encode($data);
    }

    //funct delete_prescription
    public function delete_prescription() {
        $this->init();
        $this->autoRender = false;
        $presc_id = $this->request['data']['id_presc'];
        //$this->DashBoard_Pharmacy->deleteDetailDoctorPrescription($presc_id);
        $this->DashBoard_Pharmacy->deleteDoctorPrescription($presc_id);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "list_prescriptions"));
    }

	//page update packet
    public function edit_prescription($id) {
        //	$this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        
        $this->set("id", $id);
		$dataPresc = $this->DashBoard_Pharmacy->loadListPrescription_($id_pharmacy,$id);
		
		//echo var_dump($dataPresc);
		$this->set("presc_name", $dataPresc[0]['ID_Prescription']);
		$this->set("patient_name", $dataPresc[0]['Pasient_Name']);
		$this->set("doctor_name", $dataPresc[0]['Doctor_Name']);
		$this->set("institution", $dataPresc[0]['Institution_Name']);
		
		$this->set("tanggal", substr($dataPresc[0]['Recipe_Date'],0,10));

        $data = $this->DashBoard_Pharmacy->loadDetailListPrescription_($id);
		//echo var_dump($data);
        $this->set("data_detail_presc", $data);

        $data_meds = $this->DashBoard_Pharmacy->loadMedicine($id_pharmacy, false);
        $this->set("data_meds", $data_meds);
    }
	
	public function editPrescription() {
        $this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');

        $arrPresc = array();
        $arrDetailPresc = array();

        $id = $this->request['data']['id'];
        $arrPresc['presc_id'] = $this->request['data']['presc_id']; //0,1
        $arrPresc['presc_name'] = $this->request['data']['presc_name']; 
        $arrPresc['presc_doctor'] = $this->request['data']['presc_doctor']; //1 
        $arrPresc['presc_institution'] = $this->request['data']['presc_institution'];
        $arrPacket['presc_date'] = $this->request['data']['presc_date'];
        
		$this->DashBoard_Pharmacy->updatePrescription($id_pharmacy, $id, $arrPresc);

        if(isset($this->request['data']['item_id_presc'])){
			for ($i = 0; $i < count($this->request['data']['item_id_presc']); $i++) {
				$arrDetailPresc[$i]['Id_Product'] = $this->request['data']['item_id_presc'][$i];
				$arrDetailPresc[$i]['Quantity'] = $this->request['data']['item_qty_presc'][$i];
				$arrDetailPresc[$i]['Instruction'] = $this->request['data']['item_id_usage'][$i];
        }
		}

        $this->DashBoard_Pharmacy->updateDetailPresc($id_prod, $arrDetailPresc);
       
	   $this->redirect(array("controller" => "pfrontdesk",
            "action" => "edit_prescription"));
    }

	
    //page payment
    public function payment() {
        $this->init();

        $test = CakeSession::read('SYS_ID');
        if (isset($test)) {
            $this->set("SYS_ID", $this->Session->read('SYS_ID'));
            $this->set("valid", true);
        } else {
            $this->set("valid", false);
        }

        $test = CakeSession::read('presc_id');
        if (isset($test)) {
            $this->set("presc_id", $this->Session->read('presc_id'));
        }
        $test = CakeSession::read('patient_name');
        if (isset($test)) {
            $this->set("patient_name", $this->Session->read('patient_name'));
        }
        $test = CakeSession::read('doctor_name');
        if (isset($test)) {
            $this->set("doctor_name", $this->Session->read('doctor_name'));
        }
        $test = CakeSession::read('arrItem');

        if (isset($test)) {
            $this->set("arrItem", $test);
        }

        $id_pharmacy = CakeSession::read('idStore');
        $data_meds = $this->DashBoard_Pharmacy->loadMedicine($id_pharmacy, false);
        $this->set("data_meds", $data_meds);

        $data_serv = $this->DashBoard_Pharmacy->loadService($id_pharmacy, false);
        $this->set("data_serv", $data_serv);

        $data_pack = $this->DashBoard_Pharmacy->loadPacket($id_pharmacy, false);
        $this->set("data_pack", $data_pack);
		$this->set('title_for_layout', 'Pembayaran');
    }

    //funct pay
    /* add payment kalo pake kartu kredit */
    public function pay() {
        $this->autoRender = false;
        $this->init();

        $id_pharmacy = CakeSession::read('idStore');
        $presc_SYS_ID = $this->Session->read('SYS_ID');
        $presc_id = $this->request['data']['presc_id'];
        $patient_name = $this->request['data']['patient_name'];
        $doctor_name = $this->request['data']['doctor_name'];
        $time = $this->request['data']['time'];
        $arrItem = array();
        $subtotal = 0;
        for ($i = 0; $i < count($this->request['data']['id_prod']); $i++) {

            $arrItem[$i]['Id_Product'] = $this->request['data']['id_prod'][$i];
            $arrItem[$i]['Quantity'] = $this->request['data']['qty'][$i];
            $arrItem[$i]['Price'] = $this->request['data']['price'][$i];
            $arrItem[$i]['Percentage_Discount'] = $this->request['data']['disc'][$i];
            $arrItem[$i]['Fixed_Discount'] = $arrItem[$i]['Price'] * $arrItem[$i]['Percentage_Discount'] / 100;
            $subtotal+= $arrItem[$i]['Quantity']*($arrItem[$i]['Price'] - $arrItem[$i]['Fixed_Discount']);
			$this->DashBoard_Pharmacy->updateInventoryStock_($arrItem[$i]['Id_Product'],$arrItem[$i]['Quantity']);
        }

        $datetime = date('Y-m-d H:i:s');
        $item_count = sizeof($arrItem); // bisa diganti sama get dari parameter
        //paid by

        if ($this->request['data']['paidby'] == '1') {
            $method = "Cash";
            $cash = $this->request['data']['paid'];

            $cc_no = "-";
            $cc_name = "-";
        } else if($this->request['data']['paidby'] == '2'){
            $method = "Credit Card/Debit";
            $cash = $this->request['data']['total'];

            $cc_no = $this->request['data']['cc_no'];
            $cc_name = $this->request['data']['cc_name'];
        }else if($this->request['data']['paidby'] == '3'){
			$method = "Komplemen";
			$cash = 0;

            $cc_no = "-";
            $cc_name = "-";
		}else{
			$method = "Piutang/Asuransi";
			$cash = $this->request['data']['total'];

            $cc_no = "-";
            $cc_name = $this->request['data']['cc_name'];
		}

        $discount = $this->request['data']['disc_gen'];
        $tax = $this->request['data']['tax_gen'];
        $total = $this->request['data']['total'];

        $pk = $this->DashBoard_Pharmacy->createPK('detail_product_sell_transcation_pharmacy', 'ID_Transaction', "Trans", "", $id_pharmacy);
        //Add sell transaction data, update the prescription if the prescription_SYS_ID is given
        $this->DashBoard_Pharmacy->addSellTransaction($id_pharmacy, $arrItem, $datetime, $item_count, $subtotal, $discount, $tax, $total, $method, $cash, $cc_no, $cc_name, $patient_name,  $doctor_name, $pk, $presc_SYS_ID);

        $this->set("pk", $pk);
        $this->Session->delete('SYS_ID');
        $this->Session->delete('presc_id');
        $this->Session->delete('patient_name');
        $this->Session->delete('doctor_name');
        $this->Session->delete('arrItem');
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "invoice", $pk));
    }

    //page reports
    public function reports() {
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $list = $this->DashBoard_Pharmacy->loadListInvoice($id_pharmacy);
        $this->set("invoice", $list);
		$this->set('title_for_layout', 'Laporan');
    }
	
	public function delete_report($id) {
        $this->init();
        $this->autoRender = false;
        $id_invoice = $id;
        $this->DashBoard_Pharmacy->deleteReport($id_invoice);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "reports"));
    }

    //page invoice
    public function invoice($id) {
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $id_invoice = $id;

        $store = $this->DashBoard_Pharmacy->loadStore($id_pharmacy);
        $this->set("data_store", $store);
        $invoice = $this->DashBoard_Pharmacy->loadSellTransaction($id_pharmacy, $id_invoice);
        $this->set("invoice", $invoice);
        $detailInvoice = $this->DashBoard_Pharmacy->loadDetailInvoice($id_invoice);
        $this->set("detail_invoice", $detailInvoice);
        $this->set("id", $id_invoice);
		$this->set('title_for_layout', 'Invoice');
    }

	public function faq() {
        $this->init();
		$this->set('title_for_layout', 'FAQ');
    }
	
    //page stock/list
    public function stock() {
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');

        $data_meds = $this->DashBoard_Pharmacy->loadMedicine($id_pharmacy, false);
        $this->set("data_meds", $data_meds);

        $data_serv = $this->DashBoard_Pharmacy->loadService($id_pharmacy, false);
        $this->set("data_serv", $data_serv);

        $data_pack = $this->DashBoard_Pharmacy->loadPacket($id_pharmacy, false);
        $this->set("data_pack", $data_pack);

        $cate = $this->DashBoard_Pharmacy->loadAllServiceCategory($id_pharmacy);
        $this->set("servCate", $cate);

        $cate1 = $this->DashBoard_Pharmacy->loadAllItemCategory($id_pharmacy);
        $this->set("itemCate", $cate1);

        $metric = $this->DashBoard_Pharmacy->loadMetric();
        $this->set("metric", $metric);
		$this->set('title_for_layout', 'Inventory');
    }

    //page add new product
    public function addNewProduct() {
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $data_meds = $this->DashBoard_Pharmacy->loadOnlyMaster($id_pharmacy);
        $this->set("data_meds", $data_meds);
        $cate1 = $this->DashBoard_Pharmacy->loadAllItemCategory($id_pharmacy);
        $this->set("itemCate", $cate1);
        $data_brand_owner = $this->DashBoard_Pharmacy->loadBrandOwner($id_pharmacy);
        $this->set("data_brand_owner", $data_brand_owner);
        $data_merk = $this->DashBoard_Pharmacy->loadMerk($id_pharmacy);
        $this->set("data_merk", $data_merk);
        $metric = $this->DashBoard_Pharmacy->loadMetric();
        $this->set("metric", $metric);
		$this->set('title_for_layout', 'Tambah Produk');
    }

    //func add new item not from master
    public function add_item() {
        $this->autoRender = false;
        $this->init();
        //
        $id_pharmacy = CakeSession::read('idStore');
        $arrItem = array();
        //Item
        //$arrItem['Id_Product'] = "1"; //Generate (Auto Increment)
        $arrItem['Item_Name'] = $this->request['data']['item_name']; //0
        $arrItem['Description'] = $this->request['data']['item_description']; //* //0

        $arrItem['Generic_Name'] = $this->request['data']['item_generic_name'];
        $arrItem['Name_PO'] = $this->request['data']['item_po_name']; //* //1 (Metric_Name)
        $arrItem['Name_Inv'] = $this->request['data']['item_inventory_name']; //* //1 (Metric_Name)
        $arrItem['Name_Sales'] = $this->request['data']['item_sales_name']; //* //1 (Metric_Name)
        $arrItem['ID_Brandowner'] = $this->request['data']['item_brand_owner']; //1
        $arrItem['ID_Merk'] = $this->request['data']['item_merk']; //
        $arrItem['Code_Item'] = $this->request['data']['item_code']; //* //1
        $arrItem['ID_Category'] = $this->request['data']['item_category'];
        $arrItem['Packaging'] = $this->request['data']['item_packaging'];
        $arrItem['Indikasi'] = $this->request['data']['item_indikasi'];
        $arrItem['Efek_Samping'] = $this->request['data']['item_efek_samping'];
        $arrItem['Min_Stock'] = $this->request['data']['item_min_stock']; //* //1
        $arrItem['Shelf_Life'] = ''; //$this->request['data']['item_shelf_life']; //* //1
        $arrItem['SKU'] = $this->request['data']['item_sku']; //* //1
        if ($this->request['data']['item_is_meds'] == 0) {
            $arrItem['is_med'] = FALSE;
        } else {
            $arrItem['is_med'] = TRUE;
        }
        $arrItem['Memo'] = $this->request['data']['item_note']; //1
        //belum sempurna uplod image nya
        $arrItem['Image'] = $this->request['form']['item_image']['name']; //* //1

        $arrItem['Stock'] = $this->request['data']['item_stock']; //* //2
        $arrItem['Sell_Price'] = $this->request['data']['item_sell_price']; //2

        $arrItem['Buy_Price'] = $this->request['data']['item_buy_price']; //3
        $arrItem['Supplier'] = $this->request['data']['item_supplier']; //*//3

        $arrItem['Percent_Amount'] = $this->request['data']['item_discount'];
        $arrItem['Fixed_Amount'] = $this->request['data']['item_discount2'];
        $arrItem['Discount_Description'] = $this->request['data']['item_discount_description'];

        //* 0 = Product_Pharmacy; 1 = Item_Pharmacy; 2 = inventory_stock_pharmacy; 3 = product_purchase_transaction_pharmacy

        $datetime = date('Y-m-d H:i:s');

        $id_product = $this->DashBoard_Pharmacy->addProduct($id_pharmacy, $arrItem);
        $this->DashBoard_Pharmacy->addItem($id_pharmacy, $id_product, $arrItem);
        $this->DashBoard_Pharmacy->addInventoryStock($id_pharmacy, $id_product, $arrItem);
        $this->DashBoard_Pharmacy->addProductPurchaseTransaction($id_pharmacy, $id_product, $arrItem, $datetime);
        $this->DashBoard_Pharmacy->addDiscount($id_product, $arrItem);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "stock"));
    }

    //function add item from master
    public function add_item_from_master() {
        $this->init();
        //
        $id_pharmacy = CakeSession::read('idStore');
        $arrItem = array();
        //Item
        $arrItem['Id_Master'] = $this->request['data']['item_id_master']; //Input
        $arrItem['Item_Name'] = $this->request['data']['item_name']; //Input
        $arrItem['Min_Stock'] = $this->request['data']['item_min_stock']; //* //Input
        $arrItem['Shelf_Life'] = ''; //$this->request['data']['item_shelf_life'];//* //Input
        $arrItem['SKU'] = $this->request['data']['item_sku']; //Input
        if ($this->request['data']['item_is_meds'] == 0) {
            $is_meds = FALSE;
        } else {
            $is_meds = TRUE;
        }
        $arrItem['is_med'] = $is_meds; //Input
        $arrItem['Stock'] = $this->request['data']['item_stock']; //Input
        $arrItem['Buy_Price'] = $this->request['data']['item_buy_price']; //input
        $arrItem['Sell_Price'] = $this->request['data']['item_sell_price']; //input
        $arrItem['Code_Item'] = $this->request['data']['item_code']; //Input
        $arrItem['Supplier'] = $this->request['data']['item_supplier']; //Input
        $arrItem['Note'] = $this->request['data']['item_note']; //Input
        //belum sempurna uplod image nya
        $arrItem['Image'] = $this->request['form']['item_image']['name']; //* //Input

        $data = $this->DashBoard_Pharmacy->loadFromMaster($arrItem['Id_Master']);
        //$arrItem['Category_Name'] = $this->DashBoard_Pharmacy->findCategoryName($data['ID_Category']);//*
        $arrItem['ID_Category'] = $data['ID_Category'];
        $arrItem['Description'] = $data['Description'];
        //$arrItem['Merk_Name'] =$this->DashBoard_Pharmacy->findMerkName($data['ID_Merk']);//*
        $arrItem['ID_Merk'] = $data['ID_Merk'];
        //$arrItem['Brand_Owner_Name'] = $this->DashBoard_Pharmacy->findBrandownerName($data['ID_Brandowner']);;//*
        $arrItem['ID_Brandowner'] = $data['ID_Brandowner'];
        $arrItem['Name_PO'] = $data['Name_s50_po'];
        $arrItem['Name_Inv'] = $data['Name_s50_inv'];
        $arrItem['Name_Sales'] = $data['Name_s50_sales'];
        $arrItem['Generic_Name'] = $data['Generic_Name'];
        $arrItem['Memo'] = $data['Description'];
        $arrItem['Packaging'] = $data['Packaging'];
        $arrItem['Indikasi'] = $data['Indikasi'];
        $arrItem['Efek_Samping'] = $data['Efek_Samping'];
        //* find, bkin methodnya
        $arrItem['Percent_Amount'] = $this->request['data']['item_discount'];
        $arrItem['Fixed_Amount'] = $this->request['data']['item_discount2'];
        $arrItem['Discount_Description'] = $this->request['data']['item_discount_description'];

        $datetime = date('Y-m-d H:i:s'); //Server Time

        $id_product = $this->DashBoard_Pharmacy->addProduct($id_pharmacy, $arrItem);
        $this->DashBoard_Pharmacy->addItem($id_pharmacy, $id_product, $arrItem);
        $this->DashBoard_Pharmacy->addInventoryStock($id_pharmacy, $id_product, $arrItem);
        $this->DashBoard_Pharmacy->addProductPurchaseTransaction($id_pharmacy, $id_product, $arrItem, $datetime);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "stock"));
    }

    //function update Item
    public function updateItem() {

        $this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $id_prod = $this->request['data']['id_med_show'];
        $arrItem['Generic_Name'] = $this->request['data']['name_med_show'];
        $arrItem['Notes'] = $this->request['data']['desc_med_show'];
        $arrItem['Id_Category'] = $this->request['data']['category_med_show'];
        $arrItem['Stock'] = $this->request['data']['stock_med_show'];
        $arrItem['Buy_Price'] = $this->request['data']['price_purch_med_show'];
        $arrItem['Sell_Price'] = $this->request['data']['price_sell_med_show'];

        $arrItem['Packaging'] = $this->request['data']['packaging_med_show'];
        $arrItem['Indikasi'] = $this->request['data']['indikasi_med_show'];
        $arrItem['Efek_Samping'] = $this->request['data']['efek_samping_med_show'];
        $arrItem['Percent_Amount'] = $this->request['data']['discount_med_show'];
        $arrItem['Fixed_Amount'] = $this->request['data']['discount2_med_show'];
        $arrItem['Discount_Description'] = $this->request['data']['discount_description_med_show'];
        $arrItem['Code_Item'] = $this->request['data']['code_med_show'];
        $arrItem['Metrics_PO'] = $this->request['data']['po_name_med_show'];
        $arrItem['Metrics_inv'] = $this->request['data']['inv_name_med_show'];
        $arrItem['Metrics_Sales'] = $this->request['data']['sales_name_med_show'];
        $arrItem['Min_Stock'] = $this->request['data']['min_stock_med_show'];
        $arrItem['Shelf_Life'] = ''; //$this->request['data']['shelf_life_med_show'];
        $arrItem['SKU'] = $this->request['data']['sku_med_show'];
        $arrItem['Image'] = $this->request['form']['image_med_show']['name'];


        $this->DashBoard_Pharmacy->updateItem($id_pharmacy, $id_prod, $arrItem);
        $this->DashBoard_Pharmacy->updateInventoryStock($id_prod, $arrItem);
        $this->DashBoard_Pharmacy->updateProductPurchasePrice($id_prod, $arrItem);
        $this->DashBoard_Pharmacy->updateDiscount($id_prod, $arrItem);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "stock"));
        //Cara kerja update, ambil ulang semua data dari field, terus update.
    }

    //function restock, add new stock
    public function restockItem() {

        $this->autoRender = false;
        $this->init();

        $id_prod = $this->request['data']['id_med_show2'];
        $add_prod = $this->request['data']['add_med'];
        $purch_price_prod = $this->request['data']['purch_price_med'];
        $sell_price_prod = $this->request['data']['sell_price_med'];
        $supplier_prod = $this->request['data']['supplier_med'];
        $note_prod = $this->request['data']['note_med'];
        //Pake update


        $id_pharmacy = CakeSession::read('idStore');
        $arrDetail = array();
        $arrDetail['ID_Product'] = $add_prod;
        $arrDetail['Metrics_inv'] = $this->request['data']['current_inv_name_med_show'];
        $arrDetail['Old_Value'] = $this->request['data']['current_stock_med_show2'];
        $arrDetail['Increment'] = $add_prod;
        $arrDetail['Stock'] = intval($arrDetail['Old_Value']) + intval($arrDetail['Increment']);
        $arrDetail['New_Purchase_Price'] = $purch_price_prod; //Terserah u mau pake buat catch value dari sender apa ga
        $arrDetail['New_Sell_Price'] = $sell_price_prod; // Terserah u mau pake buat catch value dari sender apa ga
        $arrDetail['Supplier'] = $supplier_prod;
        $arrDetail['Memo'] = $note_prod;
        $arrDetail['Buy_Price'] = $arrDetail['New_Purchase_Price'];
        $arrDetail['Sell_Price'] = $arrDetail['New_Sell_Price'];

        $datetime = date('Y-m-d H:i:s'); //Server Time

        $this->DashBoard_Pharmacy->updateInventoryStock($arrDetail['ID_Product'], $arrDetail);
        $this->DashBoard_Pharmacy->addProductPurchaseTransaction($id_pharmacy, $arrDetail['ID_Product'], $arrDetail, $datetime);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "stock"));
    }

    //page addnewCategory
    public function addNewCategory() {


        $this->init();
        $id_pharmacy = CakeSession::read('idStore');

        $cate = $this->DashBoard_Pharmacy->loadAllServiceCategory($id_pharmacy);
        $this->set("servCate", $cate);
        $cate1 = $this->DashBoard_Pharmacy->loadAllItemCategory($id_pharmacy);
        $this->set("itemCate", $cate1);
		$this->set('title_for_layout', 'Tambah Kategori');
    }

    //funct add new category
    public function add_category() {
        $this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $arrCategory = array();
        $arrCategory['Parent'] = $this->request['data']['parent'];
        $arrCategory['Name'] = $this->request['data']['category'];
        $arrCategory['Code'] = $this->request['data']['categoryCode'];
        $arrCategory['Description'] = $this->request['data']['description']; //*
        $this->DashBoard_Pharmacy->addCategory($id_pharmacy, $arrCategory);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "addNewCategory"));
    }

    //funct delete category
    public function deleteCategory() {

        $this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $id = $this->request['data']['id'];
        $table = $this->request['data']['type'];
        $this->DashBoard_Pharmacy->deleteCategory($id, $table);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "addNewCategory"));
    }

    //page add new service
    public function addNewService() {

        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $cate = $this->DashBoard_Pharmacy->loadAllServiceCategory($id_pharmacy);
        $this->set("servCate", $cate);
		$this->set('title_for_layout', 'Tambah Servis');
    }

    //function add new service
    public function add_service() {
        $this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $datetime = date('Y-m-d H:i:s');
        $arrService = array();

        $arrService['Item_Name'] = $this->request['data']['serv_name']; //0
        $arrService['Description'] = $this->request['data']['serv_desc']; //0 (Notes)
        $arrService['ID_Category'] = $this->request['data']['serv_category']; //1
        $arrService['Code_Area'] = $this->request['data']['serv_code']; //1
        $arrService['Instruction'] = $this->request['data']['serv_instruction']; //1 //*
        $arrService['Sell_Price'] = $this->request['data']['serv_price']; //2
        $arrService['Buy_Price'] = $this->request['data']['serv_price']; //3 //*
        $arrService['Percent_Amount'] = $this->request['data']['serv_discount'];
        $arrService['Fixed_Amount'] = $this->request['data']['serv_discount2'];
        $arrService['Discount_Description'] = $this->request['data']['serv_discount_description'];
        $arrService['Supplier'] = $data['storeName']; //3 //*ganti jdi nama klinik
        //* 0 = Product_Pharmacy; 1 = Service_Pharmacy; 2 = service_price_pharmacy; 3 = product_purchase_transaction_pharmacy

        $id_product = $this->DashBoard_Pharmacy->addProduct($id_pharmacy, $arrService);
        $this->DashBoard_Pharmacy->addService($id_pharmacy, $id_product, $arrService);
        $this->DashBoard_Pharmacy->addServicePrice($id_pharmacy, $id_product, $arrService['Buy_Price']);
        $this->DashBoard_Pharmacy->addProductPurchaseTransaction($id_pharmacy, $id_product, $arrService, $datetime);
        $this->DashBoard_Pharmacy->addDiscount($id_product, $arrService);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "addNewService"));
    }

    //funct update service
    public function updateService() {

        $this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $id_prod = $this->request['data']['id_serv_show'];
        $arrService['Item_Name'] = $this->request['data']['name_serv_show'];
        $arrService['Description'] = $this->request['data']['desc_serv_show'];
        $arrService['ID_Category'] = $this->request['data']['category_serv_show'];
        $arrService['Sell_Price'] = $this->request['data']['price_serv_show'];
        $arrService['Buy_Price'] = $arrService['Sell_Price'];
        $arrService['Code_Area'] = $this->request['data']['code_serv_show'];
        $arrService['Instruction'] = $this->request['data']['instruction_serv_show'];

        $arrService['Percent_Amount'] = $this->request['data']['discount_serv_show'];
        $arrService['Fixed_Amount'] = $this->request['data']['discount2_serv_show'];
        $arrService['Discount_Description'] = $this->request['data']['discount_description_serv_show'];
        $this->DashBoard_Pharmacy->updateProduct($id_pharmacy, $id_prod, $arrService);
        $this->DashBoard_Pharmacy->updateService($id_pharmacy, $id_prod, $arrService);
        $this->DashBoard_Pharmacy->updateDiscount($id_prod, $arrService);
        $this->DashBoard_Pharmacy->updateProductPurchasePrice_($id_prod, $arrService);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "stock"));
        //Cara kerja update, ambil ulang semua data dari field, terus update.
    }

    //page add new BrandOwner
    public function addNewBrand() {

        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $data_brand_owner = $this->DashBoard_Pharmacy->loadBrandOwner($id_pharmacy);
        $this->set("data_brand_owner", $data_brand_owner);
		$this->set('title_for_layout', 'Tambah Brand Owner');
    }

    //funct add new brand owner
    public function add_brand_owner() {
        $this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $arrBrand = array();
        $arrBrand['name'] = $this->request['data']['owner'];
        $arrBrand['memo'] = $this->request['data']['memo'];
        $this->DashBoard_Pharmacy->addBrandOwner($id_pharmacy, $arrBrand);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "addNewBrand"));
    }

    //funct delete brand owner
    public function deleteBrandOwner() {
        $this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $id_brand_owner = $this->request['data']['id'];
        $this->DashBoard_Pharmacy->deleteBrandOwner($id_brand_owner, $id_pharmacy);
    }

    //page add new packet
    public function addNewPacket() {

        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $data_meds = $this->DashBoard_Pharmacy->loadMedicine($id_pharmacy, false);
        $this->set("data_meds", $data_meds);
        $data_serv = $this->DashBoard_Pharmacy->loadService($id_pharmacy, false);
        $this->set("data_serv", $data_serv);
		
		$this->set('title_for_layout', 'Tambah Paket');
    }

    //funct add packet
    public function add_packet() {
        $this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $arrPacket = array();
        $arrDetailPacket = array();

        $arrPacket['Item_Name'] = $this->request['data']['packet_name']; //0,1
        $arrPacket['Description'] = $this->request['data']['packet_description']; //0 //*
        $arrPacket['Price'] = $this->request['data']['packet_price']; //1 
        $arrPacket['Percent_Amount'] = $this->request['data']['packet_discount'];
        $arrPacket['Fixed_Amount'] = $this->request['data']['packet_discount2'];
        $arrPacket['Discount_Description'] = $this->request['data']['packet_discount_description'];

        for ($i = 0; $i < count($this->request['data']['packet_id']); $i++) {
            $arrDetailPacket[$i]['ID_Product'] = $this->request['data']['packet_id'][$i];
            $arrDetailPacket[$i]['Product_Count'] = $this->request['data']['packet_qty'][$i];
        }
        $id_packet = $this->DashBoard_Pharmacy->addProduct($id_pharmacy, $arrPacket);
        $this->DashBoard_Pharmacy->addPacket($id_pharmacy, $id_packet, $arrPacket);
        $this->DashBoard_Pharmacy->addDetailPacket($id_packet, $arrDetailPacket);
        $this->DashBoard_Pharmacy->addDiscount($id_packet, $arrPacket);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "stock"));
    }

    //page update packet
    public function update_packet() {
        //	$this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');
        $id_prod = $this->request->query['id'];
        $this->set("id", $id_prod);
        $data_pack = $this->DashBoard_Pharmacy->loadPacketDistinct($id_prod);
        $this->set("data_pack", $data_pack);
        $data_detail_pack = $this->DashBoard_Pharmacy->loadDetailPacket($id_prod);
        $this->set("data_detail_pack", $data_detail_pack);

        $data_meds = $this->DashBoard_Pharmacy->loadMedicine($id_pharmacy, false);
        $this->set("data_meds", $data_meds);
    }

    //function update packet
    public function updatePacket() {
        $this->autoRender = false;
        $this->init();
        $id_pharmacy = CakeSession::read('idStore');

        $arrPacket = array();
        $arrDetailPacket = array();

        $id_prod = $this->request['data']['packet_id'];
        $arrPacket['Item_Name'] = $this->request['data']['packet_name']; //0,1
        $arrPacket['Description'] = $this->request['data']['packet_description']; //0 //*
        $arrPacket['Sell_Price'] = $this->request['data']['packet_price']; //1 
        $arrPacket['Percent_Amount'] = $this->request['data']['packet_discount'];
        $arrPacket['Fixed_Amount'] = $this->request['data']['packet_discount2'];
        $arrPacket['Discount_Description'] = $this->request['data']['packet_discount_description'];
        $this->DashBoard_Pharmacy->updateProduct($id_pharmacy, $id_prod, $arrPacket);
        $this->DashBoard_Pharmacy->updatePacket($id_pharmacy, $id_prod, $arrPacket);
        $this->DashBoard_Pharmacy->updateDiscount($id_prod, $arrPacket);

        for ($i = 0; $i < count($this->request['data']['packet_ids']); $i++) {
            $arrDetailPacket[$i]['ID_Product'] = $this->request['data']['packet_ids'][$i];
            $arrDetailPacket[$i]['Product_Count'] = $this->request['data']['packet_qty'][$i];
        }
        $this->DashBoard_Pharmacy->updateDetailPacket($id_prod, $arrDetailPacket);
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "update_packet"));
    }

    //funct delete
    public function delete() {
        $this->autoRender = false;
        $this->init();

        $id_prod = $this->request['data']['id_prod_del'];
        $type = $this->request['data']['type'];
        if ($type == 'item') {
           // $this->DashBoard_Pharmacy->deleteInventory($id_prod);
            //$this->DashBoard_Pharmacy->deleteItem('item_pharmacy', 'ID_Product', $id_prod, TRUE);
            //$this->DashBoard_Pharmacy->deleteProductPurchasePrice($id_prod);
            //$this->DashBoard_Pharmacy->deleteDiscount($id_prod);
            $this->DashBoard_Pharmacy->deleteProduct($id_prod);
        } else if ($type == "service") {
            //$this->DashBoard_Pharmacy->deleteService($id_prod);
            //$this->DashBoard_Pharmacy->deleteServicePrice($id_prod);
            //$this->DashBoard_Pharmacy->deleteProductPurchasePrice($id_prod);
           // $this->DashBoard_Pharmacy->deleteDiscount($id_prod);
            $this->DashBoard_Pharmacy->deleteProduct($id_prod);
        } else {
			//$this->DashBoard_Pharmacy->deleteDetailPacket($id_prod);
            //$this->DashBoard_Pharmacy->deletePacket($id_prod);
            //$this->DashBoard_Pharmacy->deleteDiscount($id_prod);
            $this->DashBoard_Pharmacy->deleteProduct($id_prod);
        }
        $this->redirect(array("controller" => "pfrontdesk",
            "action" => "stock"));
    }

}
?>