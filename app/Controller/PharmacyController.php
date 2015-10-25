<?php
	class PharmacyController extends AppController {
			
		public function index()	{
		
		}		
			
		public function init()	{			
			$this->loadModel('DashBoard_Pharmacy');
			date_default_timezone_set('Asia/Jakarta');
		}		
		public function frontdesk()	{		
			$this->init();
			$data = $this->DashBoard_Pharmacy->frontdesk('Admin');
			$this->set('data',$data);
		}
		
		
		
		public function new_prescription()	{	
			$this->init();
			//dummy input
			$username = "";
			$id_pharmacy ="Phar000";
			////
			$data_meds = $this->DashBoard_Pharmacy->loadMedicine($id_pharmacy,false);
			$this->set('data_meds',$data_meds);
		}
		
		public function add_new_prescription()	{
			$this->init();
			//dummy input
			$id_pharmacy = "Phar000";
			$presc_id = "Prescription ID test 01";
			$patient_name = "Patient 01";
			$doctor_name = "Doctor 01";
			$institution_name = "Institution 01";
			$arrItem = array();
			//arr 2d of item
			$arrItem[0]['Id_Product'] = "1";
			$arrItem[0]['Item_Name'] = "Test Item 1";
			$arrItem[0]['Quantity'] = "2";
			$arrItem[0]['Instruction'] = "Ins 1";
			//$arrItem[0]['Stock'] = "10";
			//$arrItem[0]['Price'] = "10000";
			//$arrItem[0]['Percentage_Discount'] = "10.1";
			//$arrItem[0]['Fixed_Discount'] = "0";
			//$arrItem[0]['Metric_Name'] = "Test";
			//$arrItem[0]['Checker'] = "1";
			
			$arrItem[1]['Id_Product'] = "2";
			$arrItem[1]['Item_Name'] = "Test Item 2";
			$arrItem[1]['Quantity'] = "4";
			$arrItem[1]['Instruction'] = "Ins 2";
			//$arrItem[1]['Stock'] = "20";
			//$arrItem[1]['Price'] = "20000";
			//$arrItem[1]['Percentage_Discount'] = "2.2";
			//$arrItem[1]['Fixed_Discount'] = "2000";
			//$arrItem[1]['Metric_Name'] = "Test";
			//$arrItem[1]['Checker'] = "1";
			////
			$sys_id = $this->DashBoard_Pharmacy->addPrescription($id_pharmacy,$presc_id,$patient_name,$doctor_name,$institution_name,$arrItem);		
			$this->set("SYS_ID",$sys_id);
			$this->set("id_pharmacy",$id_pharmacy);
			$this->set("presc_id",$presc_id);
			$this->set("patient_name",$patient_name);
			$this->set("doctor_name",$doctor_name);
			$this->set("arrItem",$arrItem);
		}
	
	
		public function list_prescription()	{
			$this->init();
			$data = $this->DashBoard_Pharmacy->loadListPrescription();
			$this->set("data",$data);
		}
		
		public function detail_list_prescription()	{
			$this->init();
			//dummy data
			$presc_id = "7";
			////
			$data = $this->DashBoard_Pharmacy->loadDetailListPrescription($presc_id);
			$this->set("data",$data);
		}
		

		public function payment()	{
			$this->init();
			//dummy input
			$id_pharmacy = "Phar000";
			$presc_id = "Prescription ID test 01";
			$patient_name = "Patient 01";
			$doctor_name = "Doctor 01";
			$institution_name = "Institution 01";
			$arrItem = array();
			//arr 2d of item
			$arrItem[0]['Id_Product'] = "1";
			$arrItem[0]['Item_Name'] = "Test Item 1";
			$arrItem[0]['Quantity'] = "2";
			$arrItem[0]['Instruction'] = "Ins 1";
			//$arrItem[0]['Stock'] = "10";
			//$arrItem[0]['Price'] = "10000";
			//$arrItem[0]['Percentage_Discount'] = "10.1";
			//$arrItem[0]['Fixed_Discount'] = "0";
			//$arrItem[0]['Metric_Name'] = "Test";
			//$arrItem[0]['Checker'] = "1";
			
			$arrItem[1]['Id_Product'] = "2";
			$arrItem[1]['Item_Name'] = "Test Item 2";
			$arrItem[1]['Quantity'] = "4";
			$arrItem[1]['Instruction'] = "Ins 2";
			//$arrItem[1]['Stock'] = "20";
			//$arrItem[1]['Price'] = "20000";
			//$arrItem[1]['Percentage_Discount'] = "2.2";
			//$arrItem[1]['Fixed_Discount'] = "2000";
			//$arrItem[1]['Metric_Name'] = "Test";
			//$arrItem[1]['Checker'] = "1";
			////
			//Loading meds
			$data_meds = $this->DashBoard_Pharmacy->loadMedicine($id_pharmacy,false);
			$this->set('data_meds',$data_meds);
			//Checking for extra input (from page "add new prescription")
			if(!is_null($presc_id))	{
				$this->set("valid",True);
				$this->set("presc_id",$presc_id);
				$this->set("patient_name",$patient_name);
				$this->set("doctor_name",$doctor_name);
				$this->set("institution_name",$institution_name);
				$arr = array();
				foreach($arrItem as $dat)	{
					//check checker boolean 
					if($dat['Checker'] == "1")	{
						$arr[] = $dat;
					}
				}
				$this->set("arrItem",$arr);
			}	else	{
				$this->set("valid",False);
			}
		}
		
		public function add_payment()	{
			$this->init();
			//dummy input
			$id_pharmacy = "Phar000";
			$presc_SYS_ID = "0";			
			$presc_id = "Prescription ID test 01";
			//$patient_name = "Patient 01";
			//$doctor_name = "Doctor 01";
			//$institution_name = "Institution 01";
			$arrItem = array();
			//arr 2d of item
			$arrItem[0]['Id_Product'] = "1";
			//$arrItem[0]['Item_Name'] = "Test Item 1";
			$arrItem[0]['Quantity'] = "2";
			//$arrItem[0]['Instruction'] = "Ins 1";
			//$arrItem[0]['Stock'] = "10";
			$arrItem[0]['Price'] = "10000";
			$arrItem[0]['Percentage_Discount'] = "10.1";
			$arrItem[0]['Fixed_Discount'] = "0";
			//$arrItem[0]['Metric_Name'] = "Test";
			//$arrItem[0]['Checker'] = "1";
			
			$arrItem[1]['Id_Product'] = "2";
			//$arrItem[1]['Item_Name'] = "Test Item 2";
			$arrItem[1]['Quantity'] = "4";
			//$arrItem[1]['Instruction'] = "Ins 2";
			//$arrItem[1]['Stock'] = "20";
			$arrItem[1]['Price'] = "20000";
			$arrItem[1]['Percentage_Discount'] = "2.2";
			$arrItem[1]['Fixed_Discount'] = "2000";
			//$arrItem[1]['Metric_Name'] = "Test";
			//$arrItem[1]['Checker'] = "1";
			$datetime = date('Y-m-d H:i:s');
			$item_count = sizeof($arrItem); // bisa diganti sama get dari parameter
			$subtotal = 300000;
			$discount = 2;
			$tax = 4.8;
			$total = ($subtotal*(1-$discount/100))+($tax*$subtotal/100);//bisa diganti sama get dari parameter			
			////
			$pk = $this->DashBoard_Pharmacy->createPK('detail_product_sell_transcation_pharmacy',"Trans","");
			//Add sell transaction data, update the prescription if the prescription_SYS_ID is given
			$this->DashBoard_Pharmacy->addSellTransaction($id_pharmacy,$arrItem,$datetime,$item_count,$subtotal,$discount,$tax,$total,$pk,$presc_SYS_ID);	
			$this->set("pk",$pk);			
		}
		
		public function list_invoice()	{
			$this->init();
			//dummy input
			$id_pharmacy = "Phar000";
			////
			$list = $this->DashBoard_Pharmacy->loadListInvoice($id_pharmacy);
			$this->set("invoice",$list);
		}
		
		public function detail_invoice()	{
			$this->init();
			//dummy input
			$id_pharmacy = "Phar000";
			$id_invoice = "Trans004";
			////
			$store = $this->DashBoard_Pharmacy->loadStore($id_pharmacy);
			$this->set("data_store",$store);
			$invoice = $this->DashBoard_Pharmacy->loadSellTransaction($id_pharmacy, $id_invoice);			
			$this->set("invoice",$invoice);
			$detailInvoice = $this->DashBoard_Pharmacy->loadDetailInvoice($id_invoice);
			$this->set("detail_invoice",$detailInvoice);
		}
		
		//list or page front of stock page
		public function stock_front()	{
			$this->init();
			//dummy input
			$id_pharmacy = "Phar000";
			$id_packet = 4;
			////
			$data_meds = $this->DashBoard_Pharmacy->loadMedicine($id_pharmacy,true);
			$this->set("data_meds",$data_meds);
			$data_serv = $this->DashBoard_Pharmacy->loadService($id_pharmacy,true);
			$this->set("data_serv",$data_serv);
			$data_pack = $this->DashBoard_Pharmacy->loadPacket($id_pharmacy,true);
			$this->set("data_pack",$data_pack);
			$data_detail_pack = $this->DashBoard_Pharmacy->loadDetailPacket($id_packet);
			$this->set("data_detail_pack",$data_detail_pack);
		}
		
		//!!!!!!!!!!!!!!!!!!!!!!!BARU!!!!!!!!!!!!!!!!!!!!!!!// Dari line 228 dan kebawah (difile yang lama kalo ada nama fungsi sama pake yang baru)
				
		public function add_product()	{
			$this->init();
			//
			$id_pharmacy = "Phar000";
			$arrItem = array();
			//Item
			//$arrItem['Id_Product'] = "1"; //Generate (Auto Increment)
			$arrItem['Item_Name'] = "Test Item 1";	//0
			$arrItem['Category_Name'] = "Test";
			$arrItem['ID_Category'] = $this->DashBoard_Pharmacy->findCategoryID($id_pharmacy,$arrItem['Category_Name'],"item");//1
			$arrItem['Description'] = "Random DESC";//* //0
			$arrItem['Quantity'] = "2";//2
			$arrItem['Buy_Price'] = "10000";//3
			$arrItem['Sell_Price'] = "12000";//2
			$arrItem['Merk_Name'] ="Test";//1
			$arrItem['ID_Merk'] = $this->DashBoard_Pharmacy->findMerkID($id_pharmacy,$arrService['Merk_Name']);
			$arrItem['Brand_Owner_Name'] = "0";//1
			$arrItem['ID_Brandowner'] = "0";//1
			$arrItem['Code_Item'] = "CODE";//* //1
			$arrItem['Supplier'] = "SAHA BAE";//*//3
			$arrItem['Note'] = "Bla Bla...";//1
			$arrItem['Stock'] = "";//* //2
			$arrItem['Name_PO'] = "Test";//* //1 (Metric_Name)
			$arrItem['Name_Inv'] = "Test";//* //1 (Metric_Name)
			$arrItem['Name_Sales'] = "Test";//* //1 (Metric_Name)
			$arrItem['Min_Stock'] = NULL;//* //1
			$arrItem['Shelf_Life'] = NULL;//* //1
			$arrItem['SKU'] = "A";//* //1
			$arrItem['isMeds'] = True;//* //1
			$arrItem['Image'] = NULL;//* //1
			//* 0 = Product_Pharmacy; 1 = Item_Pharmacy; 2 = inventory_stock_pharmacy; 3 = product_purchase_transaction_pharmacy
			
			$datetime = date('Y-m-d H:i:s');
			
			$id_product = $this->DashBoard_Pharmacy->addProduct($id_pharmacy,$arrItem);
			$this->DashBoard_Pharmacy->addItem($id_pharmacy, $id_product, $arrItem);
			$this->DashBoard_Pharmacy->addInventoryStock($id_pharmacy, $id_product, $arrItem);
			$this->DashBoard_Pharmacy->addProductPurchaseTransaction($id_pharmacy, $id_product, $arrItem,$datetime);			
		}
		
		public function add_category()	{
			$this->init();
			
			$id_pharmacy = "Phar000";
			$arrCategory = array();
			$arrCategory['Parent'] = 'Item';
			$arrCategory['Name'] = 'Dummy System';
			$arrCategory['Code'] = 'Code01';//*
			$arrCategory['Description'] = 'Obat Desc';//*
			$this->DashBoard_Pharmacy->addCategory($id_pharmacy, $arrCategory);
			
		}
		
		public function add_service()	{
			$this->init();
			
			$id_pharmacy = "Phar000";
			$datetime = date('Y-m-d H:i:s');
			$arrService = array();
			$arrService['Item_Name'] = "Service Name";//0
			$arrService['Description'] = "Service Desc";//0 (Notes)
			$arrService['Category_Name'] = "Test";//For lookup value 
			$arrService['ID_Category'] = $this->DashBoard_Pharmacy->findCategoryID($id_pharmacy,$arrService['Category_Name'],"service");//1
			$arrService['Code_Area'] = "0";//1
			$arrService['Instruction'] = "INS";//1 //*
			$arrService['Sell_Price'] = "12000";//2
			$arrService['Buy_Price'] = "10000";//3 //*
			$arrService['Supplier'] = "SAHA BAE";//3 //*
			//* 0 = Product_Pharmacy; 1 = Service_Pharmacy; 2 = service_price_pharmacy; 3 = product_purchase_transaction_pharmacy
			
			$id_product = $this->DashBoard_Pharmacy->addProduct($id_pharmacy,$arrItem);
			$this->DashBoard_Pharmacy->addService($id_pharmacy, $id_product, $arrService);
			$this->DashBoard_Pharmacy->addProductPurchaseTransaction($id_pharmacy, $id_product, $arrService, $datetime);
		}
		
		public function add_packet()	{
			$this->init();
			
			$id_pharmacy = "Phar000";
			$arrPacket = array();
			$arrDetailPacket = array();
			
			$arrPacket['Item_Name'] = "Test Packet";//0,1
			$arrPacket['Description'] = "Packet Desc";//0 //*
			$arrPacket['Price'] = "30000";//1 
			
			$arrDetailPacket[0]['ID_Product']= 3;
			$arrDetailPacket[0]['Product_Count']= 3;
			$arrDetailPacket[1]['ID_Product']= 4;
			$arrDetailPacket[1]['Product_Count']= 2;
			
			$id_packet = $this->DashBoard_Pharmacy->addProduct($id_pharmacy, $arrPacket);
			$this->DashBoard_Pharmacy->addPacket($id_pharmacy, $id_packet, $arrPacket);
			$this->DashBoard_Pharmacy->addDetailPacket($id_packet, $arrDetailPacket);
		}
		public function update()	{
		
		
			//Cara kerja update, ambil ulang semua data dari field, terus update.
		}

		public function restock()	{
			//Pake update
		}
		
		public function delete()	{
			//Buat table name, pake nama singkat aja, ex: item = item_phramacy; p 
		}
		public function test()	{
			$this->init();
			
			$id_pharmacy = "Phar000";
			$datetime = date('Y-m-d H:i:s');
			
			$arr['Merk_Name'] = "Test";//For lookup value 
			$data = $this->DashBoard_Pharmacy->findMerkID($id_pharmacy, $arr['Merk_Name']);
			
			$this->set("data",$data);
		}
	}
?>