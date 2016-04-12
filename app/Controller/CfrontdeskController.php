<?php

App::uses('AppController', 'Controller');

class CfrontdeskController extends AppController {

    public $components = array('Session', 'Cookie');

    public function init() {
        $this->loadModel('DashBoard_Clinic');
        date_default_timezone_set('Asia/Jakarta');
        $data = $this->DashBoard_Clinic->frontdesk(CakeSession::read('username'));
        $data['username'] = CakeSession::read('username');
        $data['storeName'] = $data['data_store']['Nama'];
        $this->set('data', $data);
        $this->layout = 'c_frontdesk';
    }

    public function dashboard() {
        $this->init();
        $this->set('title_for_layout', 'Beranda');
    }

    //page add new patient
    public function addNewPatient() {
        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $this->set('title_for_layout', 'Tambah Pasien');
    }

    //function add new patient
    public function addPatient() {
        $this->init();
        $this->autoRender = false;
        $id_store = CakeSession::read('idStore');
        $social_number = $this->request['data']['id_type'] . '-' . $this->request['data']['id_number'];
        $first_name = $this->request['data']['first_name'];
        $last_name = $this->request['data']['last_name'];
        $birth_date = $this->request['data']['birth_date'];
        $address = $this->request['data']['address'];
        $gender = $this->request['data']['gender'];
        $blood_type = $this->request['data']['blood_type'];
        $weight = $this->request['data']['weight'];
        $handphone = $this->request['data']['handphone'];
        $emergency_contact = $this->request['data']['contact'];
        $this->DashBoard_Clinic->addPatient($social_number, $first_name, $last_name, $birth_date, $address, $gender, $blood_type, $weight, $handphone, $emergency_contact, $id_store);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "list_patients"));
    }

    //page list patients
    public function list_patients() {
        $this->init();
        $id_store = CakeSession::read('idStore');
        $result = $this->DashBoard_Clinic->loadPatientByClinic($id_store);
        $doctor = $this->DashBoard_Clinic->loadListDoctor($id_store);
        $this->set("result", $result);
        $this->set("doctor", $doctor);
        $this->set('title_for_layout', 'Daftar Pasien');
    }

    //function add to queue
    public function queuePatient() {

        $this->init();
        $id_store = CakeSession::read('idStore');
        $id_patient = $this->request['data']['id']; //Ini harus diinput dari patient
        $id_doctor = $this->request['data']['doctor']; //Ini harus diinput dari patient	
        $date_time = $this->request['data']['time'];
        $via = $this->request['data']['via'];
        $anamnesa = $this->request['data']['anamnesa'];
        $keterangan = $this->request['data']['keterangan'];

        //Create queue number
        $queueNumber = $this->DashBoard_Clinic->getQueueNumber($id_store);
        //create visit history with status 0
        $this->DashBoard_Clinic->createVisitHistory($id_patient, $id_doctor, $id_store, $date_time, $queueNumber, 0, $via, $anamnesa, $keterangan);
        //create queue with status 0
        $this->DashBoard_Clinic->createQueue($id_store, $queueNumber, $id_doctor, 0, $date_time);
        //Update queue number			
        $this->DashBoard_Clinic->updateQueueNotes($queueNumber, $id_store);
        $this->set("data", $queueNumber);
        $this->redirect(array("controller" => "cfrontdesk", "action" => "queue"));
    }

    //page patient detail
    public function patient($id) {
        $this->init();
        $id_store = CakeSession::read('idStore');
        $id_patient = $id;
        $result = $this->DashBoard_Clinic->loadPatientByID($id_store, $id_patient);
        $result2 = $this->DashBoard_Clinic->loadPatientHistory($id_store, $id_patient);
        $this->set("patient", $result);
        $this->set("history", $result2);
		$this->set('title_for_layout', 'Detail Pasien');
    }

    //function update patient
    public function updatePatient() {
        $this->init();
        $this->autoRender = false;
        $id_store = CakeSession::read('idStore');
        $social_number = $this->request['data']['soc_number'];
        $first_name = $this->request['data']['first_name'];
        $last_name = $this->request['data']['last_name'];
        $birth_date = $this->request['data']['birth_date'];
        $address = $this->request['data']['address'];
        $gender = $this->request['data']['gender'];
        $blood_type = $this->request['data']['blood_type'];
        $weight = $this->request['data']['weight'];
        $handphone = $this->request['data']['handphone'];
        $emergency_contact = $this->request['data']['contact'];
        $res = $this->DashBoard_Clinic->editPatient($social_number, $first_name, $last_name, $birth_date, $address, $gender, $blood_type, $weight, $handphone, $emergency_contact);
        $id = $res[0]["patient_clinic"]["ID_Patient"];

        $this->redirect(array("controller" => "cfrontdesk", "action" => "patient", $id));
    }

    //page queue patient
    public function queue() {
        $this->init();
        $id_store = CakeSession::read('idStore');
        $queue = $this->DashBoard_Clinic->loadPatientQueue($id_store);
        $this->set("queue", $queue);
		$this->set('title_for_layout', 'Antrian');
    }

    public function processQueue() {
        $this->autoRender = false;
        $this->init();
        $id_store = CakeSession::read('idStore');
        $id_visit = $this->request['data']['id_visit'];
        $id_doctor = $this->request['data']['id_doctor'];
        $queue_num = $this->request['data']['queue_num'];
        $status = $this->request['data']['status'];
        $proc = $this->request['data']['proc'];
        $detail = $this->request['data']['detail'];
		//echo var_dump($this->request['data']);
        if ($proc == 1) {
            $this->checkPatient($id_store, $queue_num, $id_doctor);
            //masukin pasien k dokter
			$this->redirect(array("controller" => "cfrontdesk",
            "action" => "queue"));
        } else if ($proc == 2) {
            //cancel pasien
            $this->cancelPatient($id_store, $queue_num, $id_visit, $detail);
			$this->redirect(array("controller" => "cfrontdesk",
            "action" => "queue"));
        } else if ($proc == 3) {
            //payment
            $this->patientFinishPay($id_store, $queue_num, $id_doctor, $id_visit);
        }
		
		
   
    }

    //This method is used when the front desk call the patient when the queue number is up
    public function checkPatient($id_store, $queueNumber, $id_doctor) {
        $this->init();
        $date_time = date("Y-m-d H:i:s");
        $this->DashBoard_Clinic->changeQueueStatus($id_store, $queueNumber, $id_doctor, 1, $date_time);
    }


    //This method is used when the patient have finished the payment process
    public function patientFinishPay($id_store, $queueNumber, $id_doctor, $id_visit) {
        $this->init();
        //Ini harus diinput dari patient
        //Ini harus diinput dari patient
        //Ini harus diinput dari patient
        $date_time = date("Y-m-d H:i:s");
        //Change queue status into 1
        $this->DashBoard_Clinic->changeQueueStatus($id_store, $queueNumber, $id_doctor, 3, $date_time);
        //Update visit history status to 1
        $this->DashBoard_Clinic->finishVisitHistory($id_visit);
        //Remove patient from queue
        $this->DashBoard_Clinic->removePatientFromQueue($id_store, $queueNumber);



			
			$this->Session->write('id_doctor', $id_doctor);
			$this->Session->write('id_visit', $id_visit);
        		
		$this->redirect(array("controller" => "cfrontdesk",
            "action" => "payment"));
    }

    public function cancelPatient($id_store, $queueNumber, $id_visit, $detail) {
        $this->init();
        $date_time = date("Y-m-d H:i:s");
        //Update visit history status to -1 (Canceled)
        $this->DashBoard_Clinic->cancelVisitHistory($id_visit,$detail);
        //Remove patient from queue
        $this->DashBoard_Clinic->removePatientFromQueue($id_store, $queueNumber);
    }

	
	
	public function payment() {

        $this->init();
		 $id_clinic = CakeSession::read('idStore');
        $id_visit = CakeSession::read('id_visit');
        if (isset($test)) {
            $this->set("valid", true);
        } else {
            $this->set("valid", false);
        }
        $test = CakeSession::read('id_doctor');
        if (isset($test)) {
			//cari doktor
			$doctor = $this->DashBoard_Clinic->loadDoctor($test);
			$this->set("doctor_name", $doctor['First_Name'].' '.$doctor['Last_Name']);
        }
		//cari resep
		$test = $id_visit;
        if (isset($test)) {
			$resep = $this->DashBoard_Clinic->PatientLoadDoctorPrescription($id_clinic, $test);
			//echo var_dump($id_clinic);
			//echo var_dump($resep);
            $this->set("resep", $resep[0]['ddc']['Prescription_List']);
			$this->set("penanganan", $resep[0]['ddc']['Treatment']);
			$patient = $this->DashBoard_Clinic->loadPatientByID($id_clinic, $resep[0]['iv']['ID_Patient']);
			//echo var_dump($patient);
			$this->set("patient_name", $patient[0]['First_Name'].' '.$patient[0]['First_Name']);
        }
        

       
        $data_meds = $this->DashBoard_Clinic->loadMedicine($id_clinic, false);
        $this->set("data_meds", $data_meds);

        $data_serv = $this->DashBoard_Clinic->loadService($id_clinic, false);
        $this->set("data_serv", $data_serv);

        $data_pack = $this->DashBoard_Clinic->loadPacket($id_clinic, false);
        $this->set("data_pack", $data_pack);
		$this->set('title_for_layout', 'Pembayaran');
    }
	
	public function pay() {
        $this->autoRender = false;
        $this->init();

        $id_pharmacy = CakeSession::read('idStore');
        $presc_SYS_ID = $this->Session->read('SYS_ID');
        //$presc_id = $this->request['data']['presc_id'];
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
			$this->DashBoard_Clinic->updateInventoryStock_($arrItem[$i]['Id_Product'],$arrItem[$i]['Quantity']);
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

        $pk = $this->DashBoard_Clinic->createPK('detail_product_sell_transcation_pharmacy', 'ID_Transaction', "Trans", "", $id_pharmacy);
        //Add sell transaction data, update the prescription if the prescription_SYS_ID is given
        $this->DashBoard_Clinic->addSellTransaction($id_pharmacy, $arrItem, $datetime, $item_count, $subtotal, $discount, $tax, $total, $method, $cash, $cc_no, $cc_name, $patient_name,  $doctor_name, $pk, $presc_SYS_ID);

        $this->set("pk", $pk);
        $this->Session->delete('SYS_ID');
        $this->Session->delete('presc_id');
        $this->Session->delete('patient_name');
        $this->Session->delete('doctor_name');
        $this->Session->delete('arrItem');
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "invoice", $pk));
    }
	
    public function reports() {
        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $list = $this->DashBoard_Clinic->loadListInvoice($id_clinic);
        $this->set("invoice", $list);
		$this->set('title_for_layout', 'Laporan');
    }
	
	public function delete_report($id) {
        $this->init();
        $this->autoRender = false;
        $id_invoice = $id;
        $this->DashBoard_Clinic->deleteReport($id_invoice);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "reports"));
    }

    public function invoice($id) {
        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $id_invoice = $id;

        $store = $this->DashBoard_Clinic->loadStore($id_clinic);
        $this->set("data_store", $store);
        $invoice = $this->DashBoard_Clinic->loadSellTransaction($id_clinic, $id_invoice);
        $this->set("invoice", $invoice);
        $detailInvoice = $this->DashBoard_Clinic->loadDetailInvoice($id_invoice);
        $this->set("detail_invoice", $detailInvoice);
        $this->set("id", $id_invoice);
		$this->set('title_for_layout', 'Invoice');
    }
	
	public function faq() {
        $this->init();
		$this->set('title_for_layout', 'FAQ');
    }
  /*  public function loadPatientAnamnesaList() {
        $this->init();
        $id_store = CakeSession::read('idStore');
        $id_patient = '1';
        $result = $this->DashBoard_Clinic->LoadPatientListAnamnesa($id_patient, $id_store);
        $this->set("data", $result);
    }

    //New!
    public function loadPatientDoctorDiagnose() {
        $this->init();
        $id_store = CakeSession::read('idStore');
        $id_patient = '1';
        $result = $this->DashBoard_Clinic->($id_patient, $id_store);
        $this->set("data", $result);
    }

    //New!
    public function loadPatientDetailDiagnose() {
        $this->init();
        $id_diagnose = '1';
        $result = $this->DashBoard_Clinic->LoadDetailDiagnose($id_diagnose);
        $this->set("data", $result);
    }*/

    public function stock() {
        $this->init();
        $id_clinic = CakeSession::read('idStore');

        $data_meds = $this->DashBoard_Clinic->loadMedicine($id_clinic, false);
        $this->set("data_meds", $data_meds);

        $data_serv = $this->DashBoard_Clinic->loadService($id_clinic, false);
        $this->set("data_serv", $data_serv);

        $data_pack = $this->DashBoard_Clinic->loadPacket($id_clinic, false);
        $this->set("data_pack", $data_pack);

        $cate = $this->DashBoard_Clinic->loadAllServiceCategory($id_clinic);
        $this->set("servCate", $cate);

        $cate1 = $this->DashBoard_Clinic->loadAllItemCategory($id_clinic);
        $this->set("itemCate", $cate1);

        $metric = $this->DashBoard_Clinic->loadMetric();
        $this->set("metric", $metric);
    }

//page add new product
    public function addNewProduct() {
        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $data_meds = $this->DashBoard_Clinic->loadOnlyMaster($id_clinic);
        $this->set("data_meds", $data_meds);
        $cate1 = $this->DashBoard_Clinic->loadAllItemCategory($id_clinic);
        $this->set("itemCate", $cate1);
        $data_brand_owner = $this->DashBoard_Clinic->loadBrandOwner($id_clinic);
        $this->set("data_brand_owner", $data_brand_owner);
        $data_merk = $this->DashBoard_Clinic->loadMerk($id_clinic);
        $this->set("data_merk", $data_merk);
        $metric = $this->DashBoard_Clinic->loadMetric();
        $this->set("metric", $metric);
    }

    //func add new item not form master
    public function add_item() {
        $this->autoRender = false;
        $this->init();
        //
        $id_clinic = CakeSession::read('idStore');
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
        //$arrItem['ID_Merk'] = $this->request['data']['item_merk']; //
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

        //* 0 = Product_Pharmacy; 1 = Item_Pharmacy; 2 = inventory_stock_clinic; 3 = product_purchase_transaction_clinic

        $datetime = date('Y-m-d H:i:s');
        //echo var_dump($arrItem);
        $id_product = $this->DashBoard_Clinic->addProduct($id_clinic, $arrItem);
        $this->DashBoard_Clinic->addItem($id_clinic, $id_product, $arrItem);
        $this->DashBoard_Clinic->addInventoryStock($id_clinic, $id_product, $arrItem);
        $this->DashBoard_Clinic->addProductPurchaseTransaction($id_clinic, $id_product, $arrItem, $datetime);
        $this->DashBoard_Clinic->addDiscount($id_product, $arrItem);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "stock"));
    }

    //function add item from master
    public function add_item_from_master() {
        $this->init();
        //
        $id_clinic = CakeSession::read('idStore');
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

        $data = $this->DashBoard_Clinic->loadFromMaster($arrItem['Id_Master']);
        //$arrItem['Category_Name'] = $this->DashBoard_Clinic->findCategoryName($data['ID_Category']);//*
        $arrItem['ID_Category'] = $data['ID_Category'];
        $arrItem['Description'] = $data['Description'];
        //$arrItem['Merk_Name'] =$this->DashBoard_Clinic->findMerkName($data['ID_Merk']);//*
        //$arrItem['ID_Merk'] = $data['ID_Merk'];
        //$arrItem['Brand_Owner_Name'] = $this->DashBoard_Clinic->findBrandownerName($data['ID_Brandowner']);;//*
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

        $id_product = $this->DashBoard_Clinic->addProduct($id_clinic, $arrItem);
        $this->DashBoard_Clinic->addItem($id_clinic, $id_product, $arrItem);
        $this->DashBoard_Clinic->addInventoryStock($id_clinic, $id_product, $arrItem);
        $this->DashBoard_Clinic->addProductPurchaseTransaction($id_clinic, $id_product, $arrItem, $datetime);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "stock"));
    }

    //function update Item
    public function updateItem() {

        $this->autoRender = false;
        $this->init();
        $id_clinic = CakeSession::read('idStore');
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


        $this->DashBoard_Clinic->updateItem($id_clinic, $id_prod, $arrItem);
        $this->DashBoard_Clinic->updateInventoryStock($id_prod, $arrItem);
        $this->DashBoard_Clinic->updateProductPurchasePrice($id_prod, $arrItem);
        $this->DashBoard_Clinic->updateDiscount($id_prod, $arrItem);
        $this->redirect(array("controller" => "cfrontdesk",
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


        $id_clinic = CakeSession::read('idStore');
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

        $this->DashBoard_Clinic->updateInventoryStock($arrDetail['ID_Product'], $arrDetail);
        $this->DashBoard_Clinic->addProductPurchaseTransaction($id_clinic, $arrDetail['ID_Product'], $arrDetail, $datetime);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "stock"));
    }

    //page addnewCategory
    public function addNewCategory() {


        $this->init();
        $id_clinic = CakeSession::read('idStore');

        $cate = $this->DashBoard_Clinic->loadAllServiceCategory($id_clinic);
        $this->set("servCate", $cate);
        $cate1 = $this->DashBoard_Clinic->loadAllItemCategory($id_clinic);
        $this->set("itemCate", $cate1);
    }

    //funct add new category
    public function add_category() {
        $this->autoRender = false;
        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $arrCategory = array();
        $arrCategory['Parent'] = $this->request['data']['parent'];
        $arrCategory['Name'] = $this->request['data']['category'];
        $arrCategory['Code'] = $this->request['data']['categoryCode'];
        $arrCategory['Description'] = $this->request['data']['description']; //*
        $this->DashBoard_Clinic->addCategory($id_clinic, $arrCategory);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "addNewCategory"));
    }

    //funct delete category
    public function deleteCategory() {

        $this->autoRender = false;
        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $id = $this->request['data']['id'];
        $table = $this->request['data']['type'];
        $this->DashBoard_Clinic->deleteCategory($id, $table);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "addNewCategory"));
    }

    //page add new service
    public function addNewService() {

        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $cate = $this->DashBoard_Clinic->loadAllServiceCategory($id_clinic);
        $this->set("servCate", $cate);
    }

    //function add new service
    public function add_service() {
        $this->autoRender = false;
        $this->init();
        $id_clinic = CakeSession::read('idStore');
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
        //* 0 = Product_Pharmacy; 1 = Service_Pharmacy; 2 = service_price_clinic; 3 = product_purchase_transaction_clinic

        $id_product = $this->DashBoard_Clinic->addProduct($id_clinic, $arrService);
        $this->DashBoard_Clinic->addService($id_clinic, $id_product, $arrService);
        $this->DashBoard_Clinic->addServicePrice($id_clinic, $id_product, $arrService['Buy_Price']);
        $this->DashBoard_Clinic->addProductPurchaseTransaction($id_clinic, $id_product, $arrService, $datetime);
        $this->DashBoard_Clinic->addDiscount($id_product, $arrService);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "addNewService"));
    }

    //funct update service
    public function updateService() {

        $this->autoRender = false;
        $this->init();
        $id_clinic = CakeSession::read('idStore');
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
        $this->DashBoard_Clinic->updateProduct($id_clinic, $id_prod, $arrService);
        $this->DashBoard_Clinic->updateService($id_clinic, $id_prod, $arrService);
        $this->DashBoard_Clinic->updateDiscount($id_prod, $arrService);
        $this->DashBoard_Clinic->updateProductPurchasePrice_($id_prod, $arrService);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "stock"));
        //Cara kerja update, ambil ulang semua data dari field, terus update.
    }

    //page add new BrandOwner
    public function addNewBrand() {

        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $data_brand_owner = $this->DashBoard_Clinic->loadBrandOwner($id_clinic);
        $this->set("data_brand_owner", $data_brand_owner);
    }

    //funct add new brand owner
    public function add_brand_owner() {
        $this->autoRender = false;
        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $arrBrand = array();
        $arrBrand['name'] = $this->request['data']['owner'];
        $arrBrand['memo'] = $this->request['data']['memo'];
        $this->DashBoard_Clinic->addBrandOwner($id_clinic, $arrBrand);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "addNewBrand"));
    }

    //funct delete brand owner
    public function deleteBrandOwner() {
        $this->autoRender = false;
        $this->init();
        $id_clinic = CakeSession::read('idStore');

        $id_brand_owner = $this->request['data']['id'];
		echo $id_brand_owner;
        $this->DashBoard_Clinic->deleteBrandOwner($id_brand_owner, $id_clinic);
    }

    //page add new packet
    public function addNewPacket() {

        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $data_meds = $this->DashBoard_Clinic->loadMedicine($id_clinic, false);
        $this->set("data_meds", $data_meds);
        $data_serv = $this->DashBoard_Clinic->loadService($id_clinic, false);
        $this->set("data_serv", $data_serv);
    }

    //funct add packet
    public function add_packet() {
        $this->autoRender = false;
        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $arrPacket = array();
        $arrDetailPacket = array();

        $arrPacket['Item_Name'] = $this->request['data']['packet_name']; //0,1
        $arrPacket['Description'] = $this->request['data']['packet_description']; //0 //*
        $arrPacket['Price'] = $this->request['data']['packet_price']; //1 
        $arrPacket['Percent_Amount'] = $this->request['data']['packet_discount'];
        $arrPacket['Fixed_Amount'] = $this->request['data']['packet_discount2'];
        $arrPacket['Discount_Description'] = $this->request['data']['packet_discount_description'];

		if(count($this->request['data']['packet_id'])==0){
		$this->redirect(array("controller" => "cfrontdesk",
            "action" => "addNewPacket"));
		}
        for ($i = 0; $i < count($this->request['data']['packet_id']); $i++) {
            $arrDetailPacket[$i]['ID_Product'] = $this->request['data']['packet_id'][$i];
            $arrDetailPacket[$i]['Product_Count'] = $this->request['data']['packet_qty'][$i];
        }
        $id_packet = $this->DashBoard_Clinic->addProduct($id_clinic, $arrPacket);
        $this->DashBoard_Clinic->addPacket($id_clinic, $id_packet, $arrPacket);
        $this->DashBoard_Clinic->addDetailPacket($id_packet, $arrDetailPacket);
        $this->DashBoard_Clinic->addDiscount($id_packet, $arrPacket);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "stock"));
    }

    //page update packet
    public function update_packet() {
        //	$this->autoRender = false;
        $this->init();
        $id_clinic = CakeSession::read('idStore');
        $id_prod = $this->request->query['id'];
        $this->set("id", $id_prod);
        $data_pack = $this->DashBoard_Clinic->loadPacketDistinct($id_prod);
        $this->set("data_pack", $data_pack);
        $data_detail_pack = $this->DashBoard_Clinic->loadDetailPacket($id_prod);
        $this->set("data_detail_pack", $data_detail_pack);

        $data_meds = $this->DashBoard_Clinic->loadMedicine($id_clinic, false);
        $this->set("data_meds", $data_meds);
    }

    //function update packet
    public function updatePacket() {
        $this->autoRender = false;
        $this->init();
        $id_clinic = CakeSession::read('idStore');

        $arrPacket = array();
        $arrDetailPacket = array();

        $id_prod = $this->request['data']['packet_id'];
        $arrPacket['Item_Name'] = $this->request['data']['packet_name']; //0,1
        $arrPacket['Description'] = $this->request['data']['packet_description']; //0 //*
        $arrPacket['Sell_Price'] = $this->request['data']['packet_price']; //1 
        $arrPacket['Percent_Amount'] = $this->request['data']['packet_discount'];
        $arrPacket['Fixed_Amount'] = $this->request['data']['packet_discount2'];
        $arrPacket['Discount_Description'] = $this->request['data']['packet_discount_description'];
        $this->DashBoard_Clinic->updateProduct($id_clinic, $id_prod, $arrPacket);
        $this->DashBoard_Clinic->updatePacket($id_clinic, $id_prod, $arrPacket);
        $this->DashBoard_Clinic->updateDiscount($id_prod, $arrPacket);

        for ($i = 0; $i < count($this->request['data']['packet_id']); $i++) {
            $arrDetailPacket[$i]['ID_Product'] = $this->request['data']['packet_id'][$i];
            $arrDetailPacket[$i]['Product_Count'] = $this->request['data']['packet_qty'][$i];
        }
        $this->DashBoard_Clinic->updateDetailPacket($id_prod, $arrDetailPacket);
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "update_packet"));
    }

    //funct delete
    public function delete() {
        $this->autoRender = false;
        $this->init();

        $id_prod = $this->request['data']['id_prod_del'];
        $type = $this->request['data']['type'];
        if ($type == 'item') {
            //$this->DashBoard_Clinic->deleteInventory($id_prod);
            //$this->DashBoard_Clinic->deleteItem('item_clinic', 'ID_Product', $id_prod, TRUE);
            //$this->DashBoard_Clinic->deleteProductPurchasePrice($id_prod);
            //$this->DashBoard_Clinic->deleteDiscount($id_prod);
            $this->DashBoard_Clinic->deleteProduct($id_prod);
        } else if ($type == "service") {
            //$this->DashBoard_Clinic->deleteService($id_prod);
            //$this->DashBoard_Clinic->deleteServicePrice($id_prod);
            //$this->DashBoard_Clinic->deleteProductPurchasePrice($id_prod);
            //$this->DashBoard_Clinic->deleteDiscount($id_prod);
            $this->DashBoard_Clinic->deleteProduct($id_prod);
        } else {
            //$this->DashBoard_Clinic->deleteDetailPacket($id_prod);
            //$this->DashBoard_Clinic->deletePacket($id_prod);
            //$this->DashBoard_Clinic->deleteDiscount($id_prod);
            $this->DashBoard_Clinic->deleteProduct($id_prod);
        }
        $this->redirect(array("controller" => "cfrontdesk",
            "action" => "stock"));
        //Buat table name, pake nama singkat aja, ex: item = item_phramacy; p 
		//$log = $this->Model->getDataSource()->getLog(false, false);
		//debug($log);
    }

    

}
