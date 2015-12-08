<?php

App::uses('AppModel', 'Model');

class DashBoard_Clinic extends AppModel {

    public $useTable = 'store';

    //GENERAL FUNCTION//
    public function createPK($tableName, $columnName, $frontAdder, $backAdder, $id_store) {
        //Create PK
        $sql = "SELECT `Value`  FROM `notes_clinic` WHERE `Table_Name` = '$tableName' AND `Column_Name` = '$columnName' AND `ID_Store` = '$id_store'";
        $result = $this->query($sql);
        $number = $result[0]['notes_clinic']['Value'];
        $result = $frontAdder . str_pad($number, 3, "0", STR_PAD_LEFT) . $backAdder;
        //Update the notes
        $number = intval($number) + 1;
        $sql = "UPDATE `ol_medic`.`notes_clinic` SET `Value` = '$number' WHERE `Table_Name` = '$tableName' AND `Column_Name` = '$columnName' AND `ID_Store` = '$id_store';";
        $this->query($sql);
        return $result;
    }

    public function findAll($tableName) {
        $sql = "SELECT * FROM $tableName;";
        $result = $this->query($sql);
        return $result;
    }

    public function findWhere($tableName, $condition) {
        $sql = "SELECT * FROM $tableName WHERE $condition;";
        $result = $this->query($sql);
        return $result;
    }

    public function getByColumn($array, $column) {
        foreach ($array as $item) {
            $result[] = $item[$column];
        }
        return $result;
    }

    //SPESIFIC FUNCTION//

    public function addPrescription($id_clinic, $presc_id, $patient_name, $doctor_name, $institution_name, $arrItem) {

        $date = date('Y-m-d H:i:s');
        $meds_count = sizeof($arrItem);
        //Add to doctor_prescription_pharmachy
        $sql = "
			INSERT INTO `doctor_prescription_pharmachy` 
			(`SYS_ID`, `ID_Prescription`, `Pasient_Name`, `Doctor_Name`, `Institution_Name`, `Recipe_Date`, `Meds_Count`, `ID_Store`, `Payment_Status`, `ID_Transaction`) 
			VALUES (NULL, '$presc_id', '$patient_name', '$doctor_name', '$institution_name', '$date', '$meds_count', '$id_clinic', 'Unpaid', NULL);";
        $this->query($sql);
        //Add to detail_doctor_prescription_pharmachy
        $sql = "SELECT MAX(`SYS_ID`) as 'Max' FROM `doctor_prescription_pharmachy`";
        $sys_id = $this->query($sql);
        $sys_id = $sys_id[0][0]['Max'];
        foreach ($arrItem as $item) {
            $id_product = $item['Id_Product'];
            $item_name = $item['Item_Name'];
            $quantity = $item['Quantity'];
            $instruction = $item['Instruction'];
            $sql = "INSERT INTO `detail_doctor_prescription_clinic` (`ID_Receipt`, `ID_Product`, `Quantity`, `Instruction`) 
			VALUES ('$sys_id', '$id_product', '$quantity', '$instruction');";
            ($this->query($sql));
        }
        return $sys_id;
    }

    public function addSellTransaction($id_clinic, $arrItem, $datetime, $item_count, $subtotal, $discount, $tax, $total, $pk, $presc_sys_id) {
        //Insert to product_sell_transaction_clinic
        $sql = "INSERT INTO `product_sell_transaction_clinic` (`ID_Transaction`, `Date`, `Total_Product_Count`, `Percentage_Discount`, `Tax`, `Subtotal_Price`, `Total_Price`, `Payment_Method`, `ID_Store`) VALUES ('$pk', '$datetime', '$item_count', '$discount', '$tax', '$subtotal', '$total', 'Cash', '$id_clinic');";
        $this->query($sql);
        //insert to detail_product_sell_transaction_clinic
        foreach ($arrItem as $item) {
            $sql = "INSERT INTO `detail_product_sell_transaction_clinic` (`ID_Transaction`, `ID_Product`, `Product_Type`, `Quantity`, `Percentage_Discount`, `Fixed_Discount`, `Price_Before_Disc`) VALUES ('$pk', '$item[Id_Product]', 'Medicine', '$item[Quantity]', '$item[Percentage_Discount]', '$item[Fixed_Discount]', '$item[Price]');";
            $this->query($sql);
        }
        //Update status of prescription if presc_id is given
        if (!is_null($presc_sys_id)) {
            $sql = "UPDATE `doctor_prescription_pharmachy` SET `Payment_Status` = 'Paid', `ID_Transaction` = '$pk' WHERE `doctor_prescription_pharmachy`.`SYS_ID` = '$presc_sys_id';";
            $this->query($sql);
        }
    }

    //Count the new quantity of item if the value of its metric (supposed to be inventory only) change
    public function countNewStock($old_stock, $old_metric, $new_metric) {
        $sql = "SELECT *  FROM `metrics_conversion` WHERE `From_Metric` as fm LIKE '$old_metric' AND `To_Metric` LIKE '$new_metric'";
        $metric = $this->query($sql);
        $res = round($old_stock * $metric[0]['fm']['Factor'], $metric[0]['fm']['Rounding_Number']);
        return $res;
    }

    public function frontdesk($user) {
        $sql = "SELECT * FROM `user_id_store_list` WHERE `Username` LIKE '$user'";
        $data = $this->query($sql);
        $result = array();
        if (sizeof($data) >= 1 && sizeof($data[0]) == 1) {
            $result['id_clinic'] = $data[0]['user_id_store_list']['ID_Clinic'];
            $id_clinic = $result['id_clinic'];
            $sql = "SELECT * FROM `store` WHERE `ID_Store` LIKE '$id_clinic'";
            $data = $this->query($sql);
            $result['data_store'] = $data[0]['store'];
        } else {
            
        }
        return $result;
    }

    public function loadDetailInvoice($id_invoice) {
        $sql = "SELECT dpstp.`Quantity`, pp.Name, dpstp.`ID_Product`, dpstp.`Product_Type`,  dpstp.`Percentage_Discount`, dpstp.`Fixed_Discount`, dpstp.`Price_Before_Disc`  FROM `detail_product_sell_transaction_clinic` as dpstp LEFT JOIN `product_clinic` as pp on pp.ID_Product = dpstp.ID_Product WHERE `ID_Transaction` LIKE '$id_invoice';";
        $tempRes = $this->query($sql);
        $result = array();
        $count = 0;
        foreach ($tempRes as $temp) {
            $result[$count]['quantity'] = $temp['dpstp']['Quantity'];
            $result[$count]['item_name'] = $temp['pp']['Name'];
            $result[$count]['id_product'] = $temp['dpstp']['ID_Product'];
            $result[$count]['product_type'] = $temp['dpstp']['Product_Type'];
            $result[$count]['percentage_discount'] = $temp['dpstp']['Percentage_Discount'];
            $result[$count]['fixed_discount'] = $temp['dpstp']['Fixed_Discount'];
            $result[$count]['price_before'] = $temp['dpstp']['Price_Before_Disc'];
            $result[$count]['price_after'] = ($result[$count]['price_before'] - $result[$count]['fixed_discount']);
            $count++;
        }
        return $result;
    }

    public function loadDetailListPrescription($presc_id) {
        $sql = "
			SELECT 
				ddpp.ID_Product as id_product,
				pp.name as 'item_name',
				ddpp.Quantity as 'quantity',
				ip.Name_s50_inv as 'metric',
				ddpp.Instruction as 'instruction'
			FROM `detail_doctor_prescription_clinic` as ddpp
			JOIN `product_clinic` as pp ON ddpp.ID_Product = pp.ID_Product
			JOIN `item_clinic` as ip ON ip.ID_Product = pp.ID_Product
			WHERE ddpp.`ID_Receipt` = $presc_id
			";
        $tempRes = $this->query($sql);
        $result = array();
        $count = 0;
        foreach ($tempRes as $temp) {
            $result[$count]['id_product'] = $temp['ddpp']['id_product'];
            $result[$count]['item_name'] = $temp['pp']['item_name'];
            $result[$count]['quantity'] = $temp['ddpp']['quantity'];
            $result[$count]['metric'] = $temp['ip']['metric'];
            $result[$count]['instruction'] = $temp['ddpp']['instruction'];
            $count++;
        }
        return $result;
    }

    public function loadDetailPacket($id_packet) {
        $sql = "
		SELECT dpp.`ID_Packet` as 'Id_Packet', dpp.`ID_Product` as 'ID_Product', `Product_Count`, `Name`, `isMeds` FROM `detail_packet_clinic` as dpp 
		JOIN `product_clinic` as pp ON pp.ID_Product = dpp.ID_Product
		WHERE dpp.`ID_Packet` = '$id_packet' ";
        $data = $this->query($sql);
        $result = array();
        $count = 0;
        foreach ($data as $res) {
            $result[$count]['Id_Packet'] = $res['dpp']['Id_Packet'];
            $result[$count]['Name'] = $res['pp']['Name'];
            $result[$count]['Id_Product'] = $res['dpp']['ID_Product'];
            $result[$count]['Product_Count'] = $res['dpp']['Product_Count'];
            $result[$count]['isMeds'] = $res['dpp']['isMeds'];
            $count++;
        }
        return $result;
    }

    public function loadItemCategory($category_id, $id_clinic) {
        $sql = "SELECT *  FROM `item_category_clinic` as icp WHERE `SYS_ID` = $category_id AND `ID_Store` LIKE '$id_clinic' OR `ID_Store` LIKE 'MstPhr'";
        $temp = $this->query($sql);
        $result = array();
        foreach ($temp as $tem) {
            $result[] = $tem['icp'];
        }
        return $result;
    }

    public function loadAllItemCategory($id_clinic) {
        $sql = "SELECT *  FROM `item_category_clinic` as icp WHERE `ID_Store` LIKE '$id_clinic' OR `ID_Store` LIKE 'MstPhr'";
        $temp = $this->query($sql);
        $result = array();
        foreach ($temp as $tem) {
            $result[] = $tem['icp'];
        }
        return $result;
    }

    public function loadListInvoice($id_clinic) {
        $sql = "
			SELECT pstp.`ID_Transaction`, 
					dpp.`SYS_ID`, 
					dpp.`ID_Prescription`, 
					dpp.`Pasient_Name`, 
					dpp.`Doctor_Name`, 
					dpp.`Institution_Name`, 
					dpp.`Recipe_Date`, 
					dpp.`Meds_Count`, 
					dpp.`ID_Store`, 
					dpp.`Payment_Status`
			FROM `product_sell_transaction_clinic` as pstp
			LEFT JOIN `doctor_prescription_pharmachy` as dpp ON dpp.ID_Transaction = pstp.ID_Transaction AND dpp.ID_Store = pstp.ID_Store
			WHERE pstp.ID_Store like '$id_clinic'";
        $tempRes = $this->query($sql);
        $result = array();
        $count = 0;
        foreach ($tempRes as $temp) {
            $result[$count]['id_transaction'] = $temp['pstp']['ID_Transaction'];
            $result[$count]['sys_id'] = $temp['dpp']['SYS_ID'];
            $result[$count]['id_prescription'] = $temp['dpp']['ID_Prescription'];
            $result[$count]['pasient_name'] = $temp['dpp']['Pasient_Name'];
            $result[$count]['doctor_name'] = $temp['dpp']['Doctor_Name'];
            $result[$count]['institution_name'] = $temp['dpp']['Institution_Name'];
            $result[$count]['recipe_date'] = $temp['dpp']['Recipe_Date'];
            //$result[$count]['meds_count'] = $temp['dpp']['Meds_Count'];
            //$result[$count]['id_store'] = $temp['dpp']['ID_Store'];
            //$result[$count]['payment_status'] = $temp['dpp']['Payment_Status'];
            $count++;
        }
        return $result;
    }

    public function loadListPrescription() {
        $tempRes = $this->findAll('doctor_prescription_pharmachy');
        $result = array();
        foreach ($tempRes as $res) {
            $result[] = $res['doctor_prescription_pharmachy'];
        }
        return $result;
    }

    public function loadBrandOwner($id_clinic) {

        $sql = "SELECT *  FROM `brand_owner` as bo WHERE `ID_Store` LIKE '$id_clinic' OR `ID_Store` LIKE 'MstPhr' ";
        $temp = $this->query($sql);
        $result = array();
        foreach ($temp as $tem) {
            $result[] = $tem['bo'];
        }
        return $result;
    }

    public function deleteBrandOwner($id_owner, $id_store) {
        $sql = "DELETE FROM `brand_owner` WHERE `ID_Brandowner` = $id_brandowner AND `ID_Store` = $id_store;";
        $this->query($sql);
    }

    public function loadMedicine($id_clinic, $booleanViewAll) {
        $sql = "
			SELECT  
				ip.`ID_Product` as 'Id_Product',
				pp.name as 'Product_Name',
				pp.Description as 'Description',
				ip.`Code_Item_s50` as 'Item_Code',
				ip.`Name_s50_po` as 'Metric_Po',
				ip.`Name_s50_inv`as 'Metric_Inv',
				ip.`Name_s50_sales`as 'Metric_Sales',
				ip.`ID_Merk` as 'Id_Merk',
				ip.`Min_Stock` as 'Min_Stock', 
				ip.`Shelf_Life` as 'Shelf_Life',
				ip.`SKU` as 'SKU',
				ip.`Memo` as 'Memo',
				ip.`Image` as 'Image',
				merk.`Name` as 'Merk_Name',
				ip.`ID_Category` as 'Id_Category',
				ic.name as 'Category_Name',
				ip.Packaging as 'Packaging',
				ip.Indikasi as 'Indikasi',
				ip.Efek_Samping as 'Efek_Samping',
				isc.Stock as 'Stock',
				isc.Price as 'Price',
				isc.Purchase_Price as 'Purch_Price',
				pdp.Description as 'Description_Discount',
				pdp.Percent_Amount as 'Percentage_Amount',
				pdp.Fixed_Amount as 'Fixed_Amount'
			FROM `product_clinic` as pp
			JOIN `item_clinic` as ip on ip.id_product = pp.ID_Product 
			JOIN `inventory_stock_clinic` as isc on isc.ID_Product = ip.id_product
			JOIN `item_category_clinic` as ic on ic.SYS_ID = ip.`ID_Category`
			JOIN `merk` as merk on merk.id_merk = ip.id_merk
			LEFT JOIN `product_discount_clinic` as pdp on pdp.ID_Product = isc.ID_Product
			WHERE ";
        if (!$booleanViewAll) {
            $sql = $sql . "`Active` = 1
				AND ";
        }
        $sql = $sql . "pp.`ID_Store` LIKE '$id_clinic' 
				AND ip.`isMeds`= 1
				AND isc.ID_Store = '$id_clinic';";
        $data = $this->query($sql);
        $result = array();
        $count = 0;
        foreach ($data as $res) {
            $result[$count]['Id_Product'] = $res['ip']['Id_Product'];
            $result[$count]['Product_Name'] = $res['pp']['Product_Name'];
            $result[$count]['Description'] = $res['pp']['Description'];
            $result[$count]['Item_Code'] = $res['ip']['Item_Code'];
            $result[$count]['Metric_Po'] = $res['ip']['Metric_Po'];
            $result[$count]['Metric_Inv'] = $res['ip']['Metric_Inv'];
            $result[$count]['Metric_Sales'] = $res['ip']['Metric_Sales'];
            $result[$count]['Id_Category'] = $res['ip']['Id_Category'];
            $result[$count]['Category_Name'] = $res['ic']['Category_Name'];
            $result[$count]['Packaging'] = $res['ip']['Packaging'];
            $result[$count]['Indikasi'] = $res['ip']['Indikasi'];
            $result[$count]['Efek_Samping'] = $res['ip']['Efek_Samping'];
            $result[$count]['Id_Merk'] = $res['ip']['Id_Merk'];
            $result[$count]['Merk_Name'] = $res['merk']['Merk_Name'];
            $result[$count]['Min_Stock'] = $res['ip']['Min_Stock'];
            $result[$count]['Shelf_Life'] = $res['ip']['Shelf_Life'];
            $result[$count]['Image'] = base64_encode($res['ip']['Image']);
            $result[$count]['SKU'] = $res['ip']['SKU'];
            $result[$count]['Memo'] = $res['ip']['Memo'];
            $result[$count]['Stock'] = $res['isc']['Stock'];
            $result[$count]['Price'] = $res['isc']['Price'];
            $result[$count]['Purch_Price'] = $res['isc']['Purch_Price'];
            $result[$count]['Description_Discount'] = $res['pdp']['Description_Discount'];
            $result[$count]['Percentage_Amount'] = $res['pdp']['Percentage_Amount'];
            $result[$count]['Fixed_Amount'] = $res['pdp']['Fixed_Amount'];
            if ($result[$count]['Stock'] == 0) {
                $result[$count]['canBuy'] = false;
            } else {
                $result[$count]['canBuy'] = true;
            }
            $count++;
        }
        return $result;
    }

    public function loadMerk($id_store) {
        $sql = "SELECT `ID_Merk`, `ID_Brandowner`, `Name`, `Manufacturer`, `Description`, `ID_Store` FROM `merk` WHERE `ID_Store` = '$id_store'";
        $temp = $this->query($sql);
        $result = array();
        foreach ($temp as $tem) {
            $result[] = $tem['merk'];
        }
        return $result;
    }

    public function loadMetric() {
        $sql = "SELECT * FROM `metrics`";
        $temp = $this->query($sql);
        $result = array();
        foreach ($temp as $tem) {
            $result[] = $tem['metrics'];
        }
        return $result;
    }

    public function loadPacket($id_clinic, $booleanViewAll) {
        $sql = "
		SELECT `ID_Packet` as 'Id_Packet', `Packet_Name`, `Status`, `Price`, `ID_Store` as 'Id_Store' , pdp.*FROM `packet_clinic` as pp
		LEFT JOIN `product_discount_clinic` as pdp on pdp.ID_Product = pp.ID_Packet WHERE ";
        if (!$booleanViewAll) {
            $sql = $sql . "`Status` = 1 AND ";
        }
        $sql = $sql . "pp.`ID_Store` = '$id_clinic';";
        $data = $this->query($sql);
        $result = array();
        $count = 0;
        foreach ($data as $res) {
            //echo $res['pp']['Id_Packet'];
            $result[$count]['Id_Packet'] = $res['pp']['Id_Packet'];
            $result[$count]['Product_Name'] = $res['pp']['Packet_Name'];
            $result[$count]['Price'] = $res['pp']['Price'];
            $result[$count]['Id_Store'] = $res['pp']['Id_Store'];
            $result[$count]['Percentage_Amount'] = $res['pdp']['Percent_Amount'];
            $result[$count]['Fixed_Amount'] = $res['pdp']['Fixed_Amount'];
            if ($this->checkPacketAvailable($result[$count]['Id_Packet']) != 0) {
                $result[$count]['canBuy'] = true;
            } else {
                $result[$count]['canBuy'] = false;
            }
            $count++;
        }
        return $result;
    }

    public function loadPacketDistinct($id_packet) {
        $sql = "
		SELECT `ID_Packet` as 'Id_Packet', `Packet_Name`, `Status`, `Price`, pp.`ID_Store` as 'Id_Store' , pph.`Description` as `Description` ,
		pdp.Description as 'Description_Discount',
		pdp.Percent_Amount as 'Percentage_Amount',
		pdp.Fixed_Amount as 'Fixed_Amount'
		FROM `packet_clinic` as pp
		JOIN `product_clinic` as pph on pph.ID_Product = pp.Id_Packet
		LEFT JOIN `product_discount_clinic` as pdp on pdp.ID_Product = pp.Id_Packet
		WHERE `Id_Packet` = '$id_packet';";
        $data = $this->query($sql);
        $result = array();
        $count = 0;
        foreach ($data as $res) {
            $result[$count]['Id_Packet'] = $res['pp']['Id_Packet'];
            $result[$count]['Product_Name'] = $res['pp']['Packet_Name'];
            $result[$count]['Price'] = $res['pp']['Price'];
            $result[$count]['Id_Store'] = $res['pp']['Id_Store'];
            $result[$count]['Description'] = $res['pph']['Description'];

            $result[$count]['Description_Discount'] = $res['pdp']['Description_Discount'];
            $result[$count]['Percentage_Amount'] = $res['pdp']['Percentage_Amount'];
            $result[$count]['Fixed_Amount'] = $res['pdp']['Fixed_Amount'];
            $count++;
        }
        return $result;
    }

    public function loadPrescription($id_clinic, $presc_id) {
        $sql = "SELECT *  FROM `doctor_prescription_pharmachy` WHERE `SYS_ID` = $presc_id and `ID_Store` = '$id_clinic'";
        $result = $this->query($sql);
        return $result[0]['doctor_prescription_pharmachy'];
    }

    public function loadSellTransaction($id_clinic, $id_invoice) {
        $sql = "SELECT *  FROM `product_sell_transaction_clinic` WHERE `ID_Transaction` LIKE '$id_invoice' AND `ID_Store` LIKE '$id_clinic';";
        $result = $this->query($sql);
        $result = $result[0]['product_sell_transaction_clinic'];
        return $result;
    }

    public function loadService($id_clinic, $booleanViewAll) {
        $sql = "
		select 	pp.`ID_Product` as 'Id_Product', pp.`Name` as 'Product_Name', pp.`Description`, 
				sp.`Service_Code` as 'Service_Code', sp.`Instruction` as 'Service_Inst', 
				scp.`SYS_ID` as 'Category_Id', scp.`Name`as 'Category_Name', 
				spp.`Sell_Price` as 'Price', 
				pdp.`Description` as 'Discount_Description',pdp.`Percent_Amount` as 'Percentage_Amount', pdp.`Fixed_Amount`, pp.`ID_Store` as 'Id_Store'
		FROM `product_clinic` as pp
			JOIN `service_clinic` as sp on sp.id_product = pp.ID_Product   
			JOIN `service_category_clinic` as scp on scp.SYS_ID = sp.id_category
			JOIN `service_price_clinic` as spp on spp.ID_Product = sp.id_product
			JOIN `product_discount_clinic` as pdp on pdp.ID_Product = spp.ID_Product
			WHERE ";
        if (!$booleanViewAll) {
            $sql = $sql . "`Active` = 1 AND ";
        }
        $sql = $sql . " pp.`ID_Store` = '$id_clinic';";
        $data = $this->query($sql);
        $result = array();
        $count = 0;
        foreach ($data as $res) {
            $result[$count]['Id_Product'] = $res['pp']['Id_Product'];
            $result[$count]['Product_Name'] = $res['pp']['Product_Name'];
            $result[$count]['Description'] = $res['pp']['Description'];
            $result[$count]['Service_Code'] = $res['sp']['Service_Code'];
            $result[$count]['Service_Inst'] = $res['sp']['Service_Inst'];
            $result[$count]['Category_Id'] = $res['scp']['Category_Id'];
            $result[$count]['Category_Name'] = $res['scp']['Category_Name'];
            $result[$count]['Price'] = $res['spp']['Price'];
            $result[$count]['Percentage_Amount'] = $res['pdp']['Percentage_Amount'];
            $result[$count]['Discount_Description'] = $res['pdp']['Discount_Description'];
            $result[$count]['Fixed_Amount'] = $res['pdp']['Fixed_Amount'];
            $result[$count]['Id_Store'] = $res['pp']['Id_Store'];
            $count++;
        }
        return $result;
    }

    public function loadServiceCategory($category_id, $id_clinic) {
        $sql = "SELECT *  FROM `service_category_clinic` as scp WHERE `SYS_ID` = $category_id AND `ID_Store` LIKE '$id_clinic' OR `ID_Store` LIKE 'MstPhr'";
        $temp = $this->query($sql);
        $result = array();
        foreach ($temp as $tem) {
            $result[] = $tem['scp'];
        }
        return $result;
    }

    public function loadAllServiceCategory($id_clinic) {
        $sql = "SELECT *  FROM `service_category_clinic` as scp WHERE `ID_Store` LIKE '$id_clinic' OR `ID_Store` LIKE 'MstPhr'";
        $temp = $this->query($sql);
        $result = array();
        foreach ($temp as $tem) {
            $result[] = $tem['scp'];
        }
        return $result;
    }

    public function loadStore($id_clinic) {
        $sql = "SELECT * FROM `store` WHERE `ID_Store` LIKE '$id_clinic';";
        $result = $this->query($sql);
        $result = $result[0]['store'];
        return $result;
    }

    public function addProduct($id_store, $arr_detail) {
        if (isset($arr_detail['Id_Master'])) {
            $sql = "
		INSERT INTO `product_clinic` (`ID_Product`, `Name`, `Description`, `Active`, `ID_Master`, `ID_Store`) 
		VALUES (NULL, '$arr_detail[Item_Name]', '$arr_detail[Description]', '1', '$arr_detail[Id_Master]', '$id_store');";
        } else {
            $sql = "
		INSERT INTO `product_clinic` (`ID_Product`, `Name`, `Description`, `Active`, `ID_Store`) 
		VALUES (NULL, '$arr_detail[Item_Name]', '$arr_detail[Description]', '1', '$id_store');";
        }

        $this->query($sql);
        $sql = "SELECT MAX(`ID_Product`) as 'Max' FROM `product_clinic`";
        $result = $this->query($sql);
        return $result[0][0]['Max'];
    }

    public function addItem($id_store, $id_item, $arr_detail) {
        //Old SQL
        $sql = "
		INSERT INTO `item_clinic`(`ID_Product`, `Name_s50_po`, `Name_s50_inv`, `Name_s50_sales`, 
		`ID_Merk`, `ID_Brandowner`, `Code_Item_s50`, `ID_Category`, `Min_Stock`, `Shelf_Life`, `SKU`, 
		`Memo`, `isMeds`, `Image`) 
		VALUES ('$id_item','$arr_detail[Name_PO]','$arr_detail[Name_Inv]','$arr_detail[Name_Sales]',
		'$arr_detail[ID_Merk]','$arr_detail[ID_Brandowner]','$arr_detail[Code_Item]','$arr_detail[ID_Category]',
		";
        //New SQL
        $sql = "
		INSERT INTO `item_clinic`(`ID_Product`, `Generic_Name`, `Name_s50_po`, `Name_s50_inv`, `Name_s50_sales`, 
		`ID_Merk`, `ID_Brandowner`, `Code_Item_s50`, `ID_Category`, 
		`Packaging`, `Indikasi`, `Efek_Samping`, 
		`Min_Stock`, `Shelf_Life`, `SKU`, `Memo`, `isMeds`, `Image`)
		VALUES ('$id_item','$arr_detail[Generic_Name]','$arr_detail[Name_PO]','$arr_detail[Name_Inv]','$arr_detail[Name_Sales]',
		'$arr_detail[ID_Merk]','$arr_detail[ID_Brandowner]','$arr_detail[Code_Item]','$arr_detail[ID_Category]',
		'$arr_detail[Packaging]','$arr_detail[Indikasi]','$arr_detail[Efek_Samping]',
		";
        if ($arr_detail['Min_Stock'] == '') {
            $sql = $sql . "NULL" . ",";
        } else {
            $sql = $sql . "'$arr_detail[Min_Stock]',";
        }
        if ($arr_detail['Shelf_Life'] == '') {
            $sql = $sql . "NULL" . ",'$arr_detail[SKU]','$arr_detail[Memo]','$arr_detail[is_med]',";
        } else {
            $sql = $sql . "'$arr_detail[Shelf_Life]','$arr_detail[SKU]','$arr_detail[Memo]','$arr_detail[is_med]',";
        }
        if ($arr_detail['Image'] == '') {
            $sql = $sql . "NULL" . ")";
        } else {
            $sql = $sql . "'$arr_detail[Image]')";
        }
        $this->query($sql);
    }

    public function addInventoryStock($id_store, $id_item, $arr_detail) {
        $sql = "
		INSERT INTO `inventory_stock_clinic` (`SYS_ID`, `ID_Product`, `ID_Store`, `Stock`, `Price`, `Metric`) 
		VALUES (NULL, '$id_item', '$id_store', '$arr_detail[Stock]', '$arr_detail[Sell_Price]', '$arr_detail[Name_Inv]');
		";
        $this->query($sql);
    }

    public function addProductPurchaseTransaction($id_store, $id_item, $arr_detail, $date) {
        $sql = "
		INSERT INTO `product_purchase_transaction_clinic` (`SYS_ID`, `ID_Product`, `Price`, `Supplier`, `Memo_s100`, `Date`) 
		VALUES (NULL, '$id_item', '$arr_detail[Buy_Price]', '$arr_detail[Supplier]', NULL, '$date');
		";
        $this->query($sql);
    }

    //Category
    public function addCategory($id_store, $arr_detail) {
        $store = "";
        if (strtolower($arr_detail['Parent']) == 'item') {
            $store = "item_category_clinic";
        }
        if (strtolower($arr_detail['Parent']) == 'service') {
            $store = "service_category_clinic";
        }
        $sql = "INSERT INTO `$store` (`SYS_ID`, `Code_Category`, `Name`, `Description`, `ID_Store`) VALUES (NULL, '$arr_detail[Code]', '$arr_detail[Name]', '$arr_detail[Description]', '$id_store');";
        $this->query($sql);
    }

    //Brand
    public function addBrandOwner($id_store, $arr_detail) {
        $store = "";

        $sql = "INSERT INTO `brand_owner` (`ID_Brandowner`, `Owner_Name`, `Memo`, `ID_Store`) VALUES (NULL, '$arr_detail[name]', '$arr_detail[memo]', '$id_store');";
        $this->query($sql);
    }

    //Service
    public function addService($id_store, $id_service, $arr_detail) {
        $sql = "INSERT INTO `service_clinic` (`ID_Product`, `ID_Category`, `Service_Code`, `Instruction`) VALUES ('$id_service', '$arr_detail[ID_Category]', '$arr_detail[Code_Area]', '$arr_detail[Instruction]');";
        $this->query($sql);
    }

    public function addServicePrice($id_store, $id_service, $price) {
        $sql = "INSERT INTO `service_price_clinic`(`SYS_ID`, `ID_Product`, `ID_Store`, `Sell_Price`) VALUES (NULL,'$id_service','$id_store','$price')";
        $this->query($sql);
    }

    //Packet
    public function addPacket($id_store, $id_packet, $arr_detail) {
        $sql = "INSERT INTO `packet_clinic` (`ID_Packet`, `Packet_Name`, `Status`, `Price`, `ID_Store`) VALUES ('$id_packet', '$arr_detail[Item_Name]', '1', '$arr_detail[Price]', '$id_store');";
        $this->query($sql);
    }

    //only add if the array got any content
    public function addDetailPacket($id_packet, $arr_packet_detail) {
        //Add new data (if arr_detail exist && bigger than 0)
        if (isset($arr_packet_detail)) {
            if (sizeof($arr_packet_detail) > 0) {
                $sql = "INSERT INTO `detail_packet_clinic` (`ID_Packet`, `ID_Product`, `Product_Count`) VALUES 
				";
                foreach ($arr_packet_detail as $pd) {
                    $sql = $sql . "('$id_packet', '$pd[ID_Product]', '$pd[Product_Count]'),";
                }
                $sql = substr($sql, 0, -1) . ";";
                $this->query($sql);
            }
        }
    }

    //DELETE (Ganti jadi 6)
    public function deleteItem($table_name, $column_identifier, $condition, $isNumber) {
        $sql = "";
        if ($isNumber) {
            $sql = "DELETE FROM `$table_name` WHERE `$column_identifier` = $condition";
        } else {
            $sql = "DELETE FROM `$table_name` WHERE `$column_identifier` LIKE '$condition'";
        }
        $this->query($sql);
    }

    public function deleteProduct($id_product) {
        $sql = "DELETE FROM `product_clinic` WHERE `product_clinic`.`ID_Product` = $id_product;";
        $this->query($sql);
    }

    public function deleteProductPurchasePrice($id_ppp) {
        $sql = "DELETE FROM `product_purchase_transaction_clinic` WHERE `product_purchase_transaction_clinic`.`ID_Product` = $id_ppp";
        $this->query($sql);
    }

    public function deleteInventory($id_inv) {
        $sql = "DELETE FROM `inventory_stock_clinic` WHERE `ID_Product` = $id_inv";
        $this->query($sql);
    }

    public function deleteService($id_service) {
        $sql = "DELETE FROM `service_clinic` WHERE `service_clinic`.`ID_Product` = $id_service";
        $this->query($sql);
    }

    public function deleteServicePrice($id_service) {
        $sql = "DELETE FROM `service_price_clinic` WHERE `ID_Product` = $id_service";
        $this->query($sql);
    }

    public function deletePacket($id_packet) {
        $sql = "DELETE FROM `packet_clinic` WHERE `packet_clinic`.`ID_Packet` = $id_paclet";
        $this->query($sql);
    }

    public function deleteDetailPacket($id_packet) {
        $sql = "DELETE FROM `detail_packet_clinic` WHERE `ID_Packet`= $id_packet";
        $this->query($sql);
    }

    public function deleteCategory($id_category, $table) {
        $store = "";
        if (strtolower(strtolower($table)) == 'item') {
            $store = "item_category_clinic";
        }
        if (strtolower(strtolower($table)) == 'service') {
            $store = "service_category_clinic";
        }
        $sql = "DELETE FROM `$store` WHERE `SYS_ID`= $id_category";
        $this->query($sql);
    }

    //UPDATE
    public function updateProduct($id_store, $id_item, $arr_detail) {
        //$arr_detail index ==> Name => Product, 
        // New_Metrics_inv => item, Code_Item=>item,  
        //Min_Stock =>item, Shelf_Life=> item, SKU=>item, Id_Merk => item, Notes => Item, Image=> item, Id_Category => item, boolean::Image_Change, 
        //Quantity (in new_metric if metric was changed) => inventory_stock, Price => inventory_stock
        $sql = "UPDATE `product_clinic` SET `Name` = '$arr_detail[Item_Name]',`Description`='$arr_detail[Description]',`Active`='1' WHERE `product_clinic`.`ID_Product` = $id_item;";
        $this->query($sql);
    }

    //Date is un-update-able
    public function updateProductPurchasePrice($id_item, $arr_detail) {
        //update product_purchase_transaction_clinic
        $sql = "UPDATE `product_purchase_transaction_clinic` SET `Price`='$arr_detail[Buy_Price]' WHERE `ID_Product` = $id_item;";
        $this->query($sql);
    }

    public function updateProductPurchasePrice_($id_item, $arr_detail) {
        //update product_purchase_transaction_clinic
        $sql = "UPDATE `product_purchase_transaction_clinic` SET `Price`='$arr_detail[Buy_Price]' WHERE `ID_Product` = $id_item;";
        $this->query($sql);
    }

    public function updateItem($id_store, $id_item, $arr_detail) {
        //update item_clinic
        //Old SQL
        $sql = "UPDATE `item_clinic` SET `Name_s50_po` = '$arr_detail[Metrics_PO]',`Name_s50_inv` = '$arr_detail[Metrics_inv]',`Name_s50_sales` = '$arr_detail[Metrics_Sales]',`Code_Item_s50` = '$arr_detail[Code_Item]', `ID_Category` = '$arr_detail[Id_Category]',`Min_Stock` = '$arr_detail[Min_Stock]', `Shelf_Life` = '$arr_detail[Shelf_Life]', `SKU` = '$arr_detail[SKU]', `Memo` = '$arr_detail[Notes]', `Image` = '$arr_detail[Image]' WHERE `item_clinic`.`ID_Product` = $id_item;";
        //New SQL
        $sql = "UPDATE `item_clinic` SET `Generic_Name` = '$arr_detail[Generic_Name]', `Name_s50_po` = '$arr_detail[Metrics_PO]',`Name_s50_inv` = '$arr_detail[Metrics_inv]',`Name_s50_sales` = '$arr_detail[Metrics_Sales]',`Code_Item_s50` = '$arr_detail[Code_Item]', `ID_Category` = '$arr_detail[Id_Category]', `Packaging` = '$arr_detail[Packaging]', `Indikasi` = '$arr_detail[Indikasi]', `Efek_Samping` = '$arr_detail[Efek_Samping]',`Min_Stock` = '$arr_detail[Min_Stock]', `Shelf_Life` = '$arr_detail[Shelf_Life]', `SKU` = '$arr_detail[SKU]', `Memo` = '$arr_detail[Notes]', `Image` = '$arr_detail[Image]' WHERE `item_clinic`.`ID_Product` = $id_item;";
        $this->query($sql);

        //update inventory_stock_clinic
    }

    public function updateInventoryStock($id_item, $arr_detail) {
        $sql = "UPDATE `inventory_stock_clinic` SET `Stock` = '$arr_detail[Stock]', `Price` = '$arr_detail[Sell_Price]', `Purchase_Price` = '$arr_detail[Buy_Price]',  `Metric` = '$arr_detail[Metrics_inv]' WHERE `inventory_stock_clinic`.`ID_Product` = $id_item;";
        $this->query($sql);
    }

    public function updateService($id_store, $id_service, $arr_detail) {
        //$arr_detail index ==> Name => Product, Description => Product
        //Service_Code=>Service,  Instruction => Service, Id_Category =>service,
        //Price => service_price
        //Update `service_clinic`
        $sql = "UPDATE `service_clinic` SET `Service_Code` = '$arr_detail[Service_Code]', `Instruction` = $arr_detail[Instruction], `ID_Category` = $arr_detail[Id_Category] WHERE `service_clinic`.`ID_Product` = $id_service; ";
        $this->query($sql);
        //Update `service_price_clinic`
        $sql = "UPDATE `service_price_clinic` SET `Sell_Price` = '$arr_detail[price]' WHERE `service_price_clinic`.`ID_Product` = $id_service; ";
        $this->query($sql);
    }

    public function updateDetailPacket($id_packet, $arr_packet_detail) {
        //arr_packet_detail index ==> Id_Product, Item_Count
        //Delete prev detail data
        $this->deleteDetailPacket($id_packet);
        //Add new detail data
        $this->addDetailPacket($id_packet, $arr_packet_detail);
    }

    public function updatePacket($id_store, $id_packet, $arr_detail) {
        //$arr_detail index ==> Name => Product, Description => Product
        //Price => Packet, Activation Status => Packet
        //Update `packet_clinic`
        $sql = "UPDATE `packet_clinic` SET `Packet_Name`= '$arr_detail[Item_Name]',`Status`='1',`Price`= '$arr_detail[Sell_Price]'  WHERE `ID_Packet`= '$id_packet'";
        $this->query($sql);
    }

    public function updateCategory($id_sys, $arr_detail, $table) {
        $store = "";
        if (strtolower(strtolower($table)) == 'item') {
            $store = "item_category_clinic";
        }
        if (strtolower(strtolower($table)) == 'service') {
            $store = "service_category_clinic";
        }
        $sql = "UPDATE `$store` SET `Code_Category`='$arr_detail[Code]',`Name`='$arr_detail[Name]',`Description`='$arr_detail[Description]' WHERE `SYS_ID`='$id_sys'";
        $this->query($sql);
    }

    //Other
    public function findMerkID($id_store, $merk_name) {
        $sql = "SELECT *  FROM `merk` WHERE `Name` LIKE '%$merk_name%' AND `ID_Store` LIKE '$id_store'";
        $result = $this->query($sql);
        return $result[0]['merk']['ID_Merk'];
    }

    //table can be service or item
    public function findCategoryID($id_store, $category_name, $table) {
        $store = "";
        if (strtolower($table) == 'item') {
            $store = "item_category_clinic";
        }
        if (strtolower($table) == 'service') {
            $store = "service_category_clinic";
        }
        $sql = "SELECT *  FROM `$store` WHERE `Name` LIKE '%$category_name%' AND `ID_Store` LIKE '$id_store'";
        $result = $this->query($sql);
        return $result[0][$store]['SYS_ID'];
    }

    //Discount (STOCK)//
    public function addDiscount($id_product, $arr_detail) {
        $sql = "INSERT INTO `product_discount_clinic`(`ID_Product`, `Description`, `Percent_Amount`, `Fixed_Amount`)
		VALUES ('$id_product','$arr_detail[Discount_Description]','$arr_detail[Percent_Amount]','$arr_detail[Fixed_Amount]')";
        $this->query($sql);
    }

    public function deleteDiscount($id_product) {
        $sql = "DELETE FROM `product_discount_clinic` WHERE `ID_Product` = '$id_product'";
        $this->query($sql);
    }

    public function updateDiscount($id_product, $arr_detail) {
        $sql = "UPDATE `product_discount_clinic` SET `Description`='$arr_detail[Notes]',`Percent_Amount`='$arr_detail[Percent_Amount]',`Fixed_Amount`='$arr_detail[Fixed_Amount]' WHERE `ID_Product` = '$id_product'";
        $this->query($sql);
    }

    //Update 2 September
    //Bakal dipake pas potong si check packet
    public function getStockItem($id_item) {
        //echo $id_item;
        $sql = "SELECT `Stock` FROM `inventory_stock_clinic` WHERE `ID_Product` = '$id_item'";
        $result = $this->query($sql);
        if (count($result) == 0) {
            return 0;
        }
        //echo var_dump($result);
        return $result[0]['inventory_stock_clinic']['Stock'];
    }

    public function checkPacketAvailable($id_packet) {
        $arrItem = $this->loadDetailPacket($id_packet);
        //echo var_dump($arrItem);
        //foreach arr_item dipacket do getStockItem() 
        foreach ($arrItem as $item) {

            $id_product = $item['Id_Product'];
            //echo $id_product ;
            $stock = $this->getStockItem($id_product);
            //$stock =0;
            if (intval($stock) < $item['Product_Count']) {
                return 0;
            }
        }
        //Cek buat setiap item_stock kalo cukup semua return true
        return 1;
    }

    //Update 9 September
    public function deleteDoctorPrescription($id_presc) {
        $sql = "DELETE FROM `doctor_prescription_pharmachy` WHERE `SYS_ID` = '$id_presc'";
        $this->query($sql);
    }

    public function deleteDetailDoctorPrescription($id_presc) {
        $sql = "DELETE FROM `detail_doctor_prescription_clinic` WHERE `ID_Receipt` = '$id_presc'";
        $this->query($sql);
    }

    //Update 10 September
    public function loadFromMaster($id_master) {
        $sql = "SELECT `ID_Product_Master`, `Generic_Name`, `Description`, `Name_s50_po`, `Name_s50_inv`, `Name_s50_sales`, `ID_Merk`, `ID_Brandowner`, `ID_Category`, `Packaging`, `Indikasi`, `Efek_Samping` FROM `item_master` WHERE `ID_Product_Master` = '$id_master'";
        $result = $this->query($sql);
        $result = $result[0]['item_master'];
        return $result;
    }

    public function findCategoryName($id_category) {
        $sql = "SELECT 'Name'  FROM `item_category_clinic` WHERE `SYS_ID` = '$id_category'";
        $result = $this->query($sql);
        $result2 = $result[0][0]['Name'];
        return $result2;
    }

    public function findMerkName($id_merk) {
        $sql = "SELECT `Name`  FROM `merk` WHERE `ID_Merk` = '$id_merk'";
        $result = $this->query($sql);
        $result2 = $result[0]['merk']['Name'];
        return $result2;
    }

    public function findBrandownerName($id_bo) {
        $sql = "SELECT `Owner_Name`  FROM `brand_owner` WHERE `ID_Brandowner` = '$id_bo'";
        $result = $this->query($sql);
        $result2 = $result[0]['brand_owner']['Owner_Name'];
        return $result2;
    }

    public function loadOnlyMaster($id_clinic) {
        $sql = "SELECT im.`ID_Product_Master`, 
		im.`Generic_Name`, im.`Description`, 
		im.`Name_s50_po`, im.`Name_s50_inv`, im.`Name_s50_sales`, 
		im.`ID_Merk`, im.`ID_Brandowner`, im.`ID_Category`, 
		im.`Packaging`, im.`Indikasi`, im.`Efek_Samping`,
		ic.Name, merk.Name, brand.Owner_name
		FROM `item_master` as im
		JOIN `product_clinic` as pc ON pc.ID_Master != im.ID_Product_Master 
		JOIN `item_category_clinic` as ic on ic.SYS_ID = im.`ID_Category`
		JOIN `merk` as merk on merk.id_merk = im.id_merk
		JOIN `brand_owner` as brand on brand.ID_Brandowner = im.ID_Brandowner
		WHERE pc.`ID_Store` = '$id_clinic' ";
        $result = $this->query($sql);
        if (count($result) == 0) {
            $sql = "SELECT im.`ID_Product_Master`, 
		im.`Generic_Name`, im.`Description`, 
		im.`Name_s50_po`, im.`Name_s50_inv`, im.`Name_s50_sales`, 
		im.`ID_Merk`, im.`ID_Brandowner`, im.`ID_Category`, 
		im.`Packaging`, im.`Indikasi`, im.`Efek_Samping`,
		ic.Name, merk.Name, brand.Owner_name
		FROM `item_master` as im
		JOIN `item_category_clinic` as ic on ic.SYS_ID = im.`ID_Category`
		JOIN `merk` as merk on merk.id_merk = im.id_merk
		JOIN `brand_owner` as brand on brand.ID_Brandowner = im.ID_Brandowner";
            $result = $this->query($sql);
        }

        return $result;
    }

    public function getQueueNumber($id_store) {
        $table_name = "Queue_Clinic";
        $column_name = "Queue_Number";
        $sql = "SELECT `Value`  FROM `notes_clinic` WHERE `Table_Name` = '$table_name' AND `Column_Name` = '$column_name' AND `ID_Store` = '$id_store' limit 1";
        $res = $this->query($sql);
        return $res[0]['notes_clinic']['Value'];
    }

    public function updateQueueNotes($last_value, $id_store) {
        $table_name = "Queue_Clinic";
        $column_name = "Queue_Number";
        $new_value = intval($last_value) + 1;
        $sql = "UPDATE `notes_clinic` SET `Value`= '$new_value'  WHERE `Table_Name` = '$table_name' AND `Column_Name` = '$column_name' AND `ID_Store` = '$id_store' limit 1";
        $res = $this->query($sql);
        return $res;
    }

    //QUEUE
    public function createQueue($id_store, $queue_number, $id_doctor, $status, $date_time) {
        $sql = "INSERT INTO `ol_medic`.`queue_clinic` (`ID_Store`, `Queue_Number`, `ID_Doctor`, `Status`, `Time_Modified`) VALUES ('$id_store', '$queue_number', '$id_doctor', '$status', '$date_time');";
        $res = $this->query($sql);
        return $res;
    }

    public function changeQueueStatus($id_store, $queue_number, $id_doctor, $new_status, $date_time) {
        $sql = "UPDATE `ol_medic`.`queue_clinic` SET `Status` = '$new_status', `Time_Modified` = '$date_time' WHERE `queue_clinic`.`ID_Store` = '$id_store' AND `queue_clinic`.`Queue_Number` = $queue_number AND `queue_clinic`.`ID_Doctor` = $id_doctor;";
        $res = $this->query($sql);
        return $res;
    }

    public function removePatientFromQueue($id_store, $queue_number) {
        $sql = "DELETE FROM `visit_history_clinic` WHERE `ID_Store`= '$id_store' AND `Queue_Number` = $queue_number;";
        $res = $this->query($sql);
        return $res;
    }

    public function getCurrentQueue($id_store) {
        $sql = "SELECT dc.First_Name as fm_doc ,dc.Last_Name as lm_doc , pc.First_Name as fm_pat , pc.Last_Name as lm_pat, pc.Birth_Date as bd_pat,
				pc.Address as add_pat, pc.Social_Number as sn_pat,
			vhc.Status, vhc.ID_Visit, vhc.Queue_Number, vhc.ID_Doc
			FROM `visit_history_clinic` as vhc
			JOIN `doctor_clinic` as dc ON dc.ID_Doctor = vhc.ID_Doc
			JOIN `patient_clinic` as pc on pc.ID_Patient = vhc.ID_Patient
			JOIN `queue_clinic` as qc on qc.Queue_Number = vhc.Queue_Number
		WHERE vhc.`ID_Store`= '$id_store' AND (qc.`Status` = '0' OR qc.`Status` = '1' OR qc.`Status` = '2') ";
        $res = $this->query($sql);
        return $res;
    }

    public function loadPatientForFrontDeskClinic($id_clinic) {
        $sql = "SELECT `patient_clinic`.`ID_Patient`, `Social_Number`, `First_Name`, `Last_Name`, `Birth_Date`, `Address`, `Gender`, `Blood_Type`, `Weight`, `Handphone_Number`, `Emergency_Contact` 
FROM `patient_clinic`  
JOIN (SELECT `ID_Patient` FROM `visit_history_clinic` WHERE `ID_Store` = '$id_clinic' AND `Status` = '0') as `Temp`
ON `patient_clinic`.`ID_Patient`= `Temp`.`ID_Patient`";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['patient_clinic'];
        }
        return $result;
    }

    public function loadPatientHistory($id_store, $id_patient) {
        $sql = "SELECT dc.First_Name as fm_doc ,dc.Last_Name as lm_doc , pc.First_Name as fm_pat , pc.Last_Name as lm_pat,
			vhc.Status, vhc.ID_Visit, vhc.Queue_Number, vhc.ID_Doc, vhc.Date_Time
			FROM `visit_history_clinic` as vhc
			JOIN `doctor_clinic` as dc ON dc.ID_Doctor = vhc.ID_Doc
			JOIN `patient_clinic` as pc on pc.ID_Patient = vhc.ID_Patient 
		WHERE vhc.`ID_Store`= '$id_store' AND vhc.`ID_Patient` = '$id_patient';";
        $res = $this->query($sql);
        return $res;
    }

    //PATIENT
    public function addPatient($social_number, $first_name, $last_name, $birth_date, $address, $gender, $blood_type, $weight, $handphone, $emergency_contact, $id_store) {
        $sql = "INSERT INTO `ol_medic`.`patient_clinic` (`ID_Patient`, `Social_Number`, `First_Name`, `Last_Name`, `Birth_Date`, `Address`, `Gender`, `Blood_Type`, `Weight`, `Handphone_Number`, `Emergency_Contact`, `ID_Store`) VALUES (NULL, '$social_number', '$first_name', '$last_name', '$birth_date', '$address', '$gender', '$blood_type', '$weight', '$handphone', '$emergency_contact', '$id_store');";
        $res = $this->query($sql);
        return $res;
    }

    //Change everything except id_patient and social number
    public function editPatient($social_number, $first_name, $last_name, $birth_date, $address, $gender, $blood_type, $weight, $handphone, $emergency_contact) {
        $sql = "UPDATE `patient_clinic` SET `First_Name`='$first_name',`Last_Name`='$last_name',`Birth_Date`='$birth_date',`Address`='$address',`Gender`='$gender',`Blood_Type`='$blood_type',`Weight`='$weight',`Handphone_Number`='$handphone',`Emergency_Contact`='$emergency_contact' WHERE `Social_Number` = '$social_number'";
        $res = $this->query($sql);
        if ($res) {
            $sql = "SELECT ID_Patient from `patient_clinic`  WHERE `Social_Number` = '$social_number'";
            $res = $this->query($sql);
        }
        return $res;
    }

    public function loadPatientByClinic($id_clinic) {
        $sql = "SELECT `ID_Patient`, `Social_Number`, `First_Name`, `Last_Name`, `Birth_Date`, `Address`, `Gender`, `Blood_Type`, `Weight`, `Handphone_Number`, `Emergency_Contact` FROM `patient_clinic` WHERE `ID_Store` = '$id_clinic'";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['patient_clinic'];
        }
        return $result;
    }

    public function loadPatientByID($id_clinic, $id_patient) {
        $sql = "SELECT `ID_Patient`, `Social_Number`, `First_Name`, `Last_Name`, `Birth_Date`, `Address`, `Gender`, `Blood_Type`, `Weight`, `Handphone_Number`, `Emergency_Contact` FROM `patient_clinic` WHERE `ID_Store` = '$id_clinic' AND `ID_Patient` = '$id_patient'";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['patient_clinic'];
        }
        return $result;
    }

    //buat di dokter
    public function loadPatientByDoctor($id_clinic, $id_doctor, $status) {
        $sql = "SELECT `ID_Visit`,`patient_clinic`.`ID_Patient`, `Social_Number`, `First_Name`, 
			`Last_Name`, `Birth_Date`, `Address`, `Gender`, `Blood_Type`, `Weight`, 
			`Handphone_Number`, `Emergency_Contact`
		FROM `patient_clinic`  
		JOIN 
			(
				SELECT `ID_Patient`, `ID_Visit`
				FROM `visit_history_clinic` 
				JOIN (
					SELECT `Queue_Number`
					FROM `queue_clinic`
					Where `ID_Store` = '$id_clinic' AND `ID_Doctor` = '$id_doctor' AND `Status` = '$status'
				) as `Inner_Temp`
				ON `visit_history_clinic`.`Queue_Number` = `Inner_Temp`.`Queue_Number`
				WHERE `visit_history_clinic`.`Status` = '0' AND `visit_history_clinic`.`ID_Store` = '$id_clinic'
			) as `Temp`
		ON `patient_clinic`.`ID_Patient`= `Temp`.`ID_Patient`";
        $res = $this->query($sql);
        $result = array();
        $counter = 0;
        foreach ($res as $r) {
            $result[$counter] = $r['patient_clinic'];
            $result[$counter]['ID_Visit'] = $r['Temp']['ID_Visit'];
            $counter++;
        }
        return $result;
    }

    //New!
    public function loadPatientVisitHistoryByDoctor($id_doctor, $id_store) {
        $sql = "SELECT `pc`.`ID_Patient`, `Social_Number`, `First_Name`, `Last_Name`, `Birth_Date`, `Address`, `Gender`, `Blood_Type`, `Weight`, `Handphone_Number`, `Emergency_Contact`, `vhc`.`anamnesa`, `vhc`.`Time`
		FROM `patient_clinic` as `pc`
		JOIN (SELECT `ID_Patient`,`Status`,`Date_Time` as `Time`, `anamnesa` FROM `visit_history_clinic` WHERE `ID_Store` = '$id_store' AND `ID_Doc`='$id_doctor') AS `vhc`
		ON `pc`.`ID_Patient` = `vhc`.`ID_Patient`";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['patient_clinic'];
        }
        return $result;
    }

    //New!
    public function LoadPatientListAnamnesa($id_patient, $id_store) {
        $sql = "SELECT `ID_Visit`, `Anamnesa` 
		FROM `visit_history_clinic` 
		WHERE `ID_Patient` = '$id_patient' AND `ID_Store` = '$id_store';";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['visit_history_clinic'];
        }
        return $result;
    }

    //New!
    public function PatientLoadDoctorDiagnose($id_patient, $id_store) {
        $sql = "SELECT `ddc`.`ID_Visit`, `ID_Diagnosis`, `Treatment`, `Prescription_List`, `Image`, `Memo`, `Time_Created` 
		FROM `doctor_diagnosis_clinic` as `ddc` 
		JOIN (
			SELECT `ID_Visit`,`ID_Patient` 
			FROM `visit_history_clinic` 
			WHERE `ID_Patient` = '$id_patient' AND `ID_Store` = '$id_store'
		) as `iv` 
		ON `iv`.`ID_Visit` = `ddc`.`ID_Visit`;";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['ddc'];
        }
        return $result;
    }

    //New!
    public function LoadDetailDiagnose($id_diagnosis) {
        $sql = "SELECT `ID_Detail`, `Diagnosis`, `Memo` 
		FROM `detail_doctor_diagnosis_clinic`  as `dddc`
		WHERE `ID_Diagnosis` = '$id_diagnosis'";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['dddc'];
        }
        return $result;
    }

    //VISIT_HISTORY
    public function createVisitHistory($id_patient, $id_doctor, $id_store, $date_time, $queue_number, $status, $via, $anamnesa, $keterangan) {
        $sql = "INSERT INTO `ol_medic`.`visit_history_clinic` (`ID_Visit`, `ID_Patient`, `ID_Doc`, `ID_Store`, `Date_Time`, `Queue_Number`, `Status`, `Via`, `Keterangan`, `Anamnesa`) VALUES (NULL, '$id_patient', '$id_doctor', '$id_store', '$date_time', '$queue_number', '$status', '$via', '$keterangan', '$anamnesa');";
        $res = $this->query($sql);
        return $res;
    }

    public function finishVisitHistory($id_visit) {
        $sql = "UPDATE `ol_medic`.`visit_history_clinic` SET `Status` = '1' WHERE `visit_history_clinic`.`ID_Visit` = $id_visit;";
        $res = $this->query($sql);
        return $res;
    }

    public function cancelVisitHistory($id_visit, $detail) {
        $sql = "UPDATE `ol_medic`.`visit_history_clinic` SET `Status` = '-1' , `Keterangan` = '$detail' WHERE `visit_history_clinic`.`ID_Visit` = $id_visit;";
        $res = $this->query($sql);
        return $res;
    }

    //DOCTOR
    public function addDoctor($social_number, $first_name, $last_name, $birth_date, $address, $gender, $blood_type, $handphone) {
        $sql = "INSERT INTO `ol_medic`.`doctor_clinic` (`ID_Doctor`, `Address`, `Gender`, `First_Name`, `Last_Name`, `Social_Number`, `Birth_Date`, `Blood_Type`, `Handphone_Number`) VALUES (NULL, '$address', '$gender', '$first_name', '$last_name', '$social_number', '$birth_date', '$blood_type', '$handphone');";
        $res = $this->query($sql);
        return $res;
    }

    public function editDoctor($id_doctor, $address, $gender, $first_name, $last_name, $birth_date, $blood_type, $handphone) {
        $sql = "UPDATE `doctor_clinic` SET `Address`='$address',`Gender`='$gender',`First_Name`='$first_name',`Last_Name`='$last_name',`Birth_Date`='$birth_date',`Blood_Type`='$blood_type',`Handphone_Number`='$handphone' WHERE `ID_Doctor`='$id_doctor'";
        $res = $this->query($sql);
        return $res;
    }

    public function loadDoctor($id_doctor) {
        $sql = "SELECT `ID_Doctor`, `Address`, `Gender`, `First_Name`, `Last_Name`, `Social_Number`, `Birth_Date`, `Blood_Type`, `Handphone_Number` FROM `doctor_clinic` WHERE `ID_Doctor` = $id_doctor";
        $res = $this->query($sql);
        return $res[0]['doctor_clinic'];
    }

    public function loadListDoctor($id_clinic) {
        $sql = "SELECT `ID_Doctor`, `Address`, `Gender`, `First_Name`, `Last_Name`, `Social_Number`, `Birth_Date`, `Blood_Type`, `Handphone_Number` FROM `doctor_clinic`  WHERE `ID_Clinic` = '$id_clinic'";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['doctor_clinic'];
        }
        return $result;
    }

    public function loadListDoctorAnamnesa($id_doctor, $id_store) {
        $sql = "SELECT `vhc`.`ID_Visit`, `vhc`.`ID_Patient`, `pc`.`First_Name`, `pc`.`Last_Name`, `pc`.`Birth_Date`, `pc`.`Gender`, `pc`.`Blood_Type`,`vhc`.`Date_Time`, `vhc`.`Anamnesa`
		FROM `visit_history_clinic` as `vhc`
		JOIN (
			SELECT `ID_Patient`, `First_Name`, `Last_Name`, `Birth_Date`, `Gender`, `Blood_Type`
			FROM `patient_clinic` 
			WHERE `ID_Store` = '$id_store'
		) AS `pc`
		ON `pc`.`ID_Patient` = `vhc`.`ID_Patient`
		WHERE `ID_Doc` = '1' AND `vhc`.`ID_Store`= '$id_store'";
        $res = $this->query($sql);
        $result = array();
        $counter = 0;
        foreach ($res as $r) {
            $result[$counter]['ID_Visit'] = $r['vhc']['ID_Visit'];
            $result[$counter]['ID_Patient'] = $r['vhc']['ID_Patient'];
            $result[$counter]['First_Name'] = $r['pc']['First_Name'];
            $result[$counter]['Last_Name'] = $r['pc']['Last_Name'];
            $result[$counter]['Birth_Date'] = $r['pc']['Birth_Date'];
            $result[$counter]['Gender'] = $r['pc']['Gender'];
            $result[$counter]['Blood_Type'] = $r['pc']['Blood_Type'];
            $result[$counter]['Date_Time'] = $r['vhc']['Date_Time'];
            $result[$counter]['Anamnesa'] = $r['vhc']['Anamnesa'];
            $counter++;
        }
        return $result;
    }

    //New!
    public function insertDiagnose($id_visit, $detail, $time) {
        $sql = "INSERT INTO `ol_medic`.`doctor_diagnosis_clinic` 
		(`ID_Diagnosis`, `ID_Visit`, `Treatment`, `Prescription_List`, `Image`, `Memo`, `Time_Created`) 
		VALUES 
		(NULL, '$id_visit', '$detail[treatment]', '$detail[prescription_list]', '$detail[image]', '$detail[memo]', '$time');";
        $res = $this->query($sql);
    }

    //New!
    public function insertDetailDiagnose($id_diagnose, $detail) {
        $sql = "INSERT INTO `ol_medic`.`detail_doctor_diagnosis_clinic` 
		(`ID_Detail`, `ID_Diagnosis`, `Diagnosis`, `Memo`) 
		VALUES 
		(NULL, '$id_diagnose', '$detail[diagnose_code]', '$detail[memo]');";
        $res = $this->query($sql);
    }

    public function searchPatient($id_clinic, $partName) {
        $sql = "SELECT `ID_Patient`, `Social_Number`, `First_Name`, `Last_Name`, `Birth_Date`, `Address`, `Gender`, `Blood_Type`, `Weight`, `Handphone_Number`, `Emergency_Contact` FROM `patient_clinic` WHERE `ID_Store` = '$id_clinic' AND (`First_Name`  LIKE '%$partName%' OR `Last_Name` LIKE '%$partName%')";
        $res = $this->query($sql);
        $result = array();
        foreach ($res as $r) {
            $result[] = $r['patient_clinic'];
        }
        return $result;
    }

    //New!
    public function loadPatientQueue($id_clinic) {
        //Tanya: Kalo semua queue status di load, nanti berdasarkan statusnya bisa d lakuin hal yang beda2 dong? ga mending queue statusnya yang belom diprocess aja (0)?
        $sql = "SELECT `pc`.`ID_Patient`, `Social_Number`, 
		`pc`.`First_Name` as `Patient First Name`, 
			`pc`.`Last_Name` as `Patient Last Name`, `Birth_Date`, `Address`, `Gender`, 
			`Temp`.`First_Name` as `Doctor First Name`, 
			`Temp`.`Last_Name` as `Doctor Last Name`, 
			`Temp`.`ID_Doc` as `ID_Doctor`,
			`Temp`.`Queue Number` as `Queue Number`,
			`Temp`.`Queue Status`,`Temp`.`ID_Visit`
		FROM `patient_clinic` as `pc`
		JOIN (
			SELECT `ID_Patient`, `ID_Doc`, `First_Name`, `Last_Name`, `ID_Visit`, `qc`.`Status` as `Queue Status`, `qc`.`Queue_Number` as `Queue Number`
			FROM `visit_history_clinic` as vhc 
			JOIN `doctor_clinic` as `dc` 
			ON dc.`ID_Doctor` = vhc.`ID_Doc` 
            JOIN (
                SELECT `Status`,`Queue_Number`
                FROM `queue_clinic`
                WHERE `ID_Store` = '$id_clinic'
            ) as `qc`
            ON `qc`.`Queue_Number` = `vhc`.`Queue_Number`
			WHERE `ID_Store` = '$id_clinic' AND `vhc`.`Status` = 0
		) as `Temp`
		ON `pc`.`ID_Patient`= `Temp`.`ID_Patient`
		ORDER BY `Temp`.`Queue Status` ASC";
        $res = $this->query($sql);
        $result = array();
        $counter = 0;
        foreach ($res as $r) {
            $result[$counter]['ID_Patient'] = $r['pc']['ID_Patient'];
            $result[$counter]['Social_Number'] = $r['pc']['Social_Number'];
            $result[$counter]['Patient First Name'] = $r['pc']['Patient First Name'];
            $result[$counter]['Patient Last Name'] = $r['pc']['Patient Last Name'];
            $result[$counter]['Birth_Date'] = $r['pc']['Birth_Date'];
            $result[$counter]['Address'] = $r['pc']['Address'];
            $result[$counter]['Gender'] = $r['pc']['Gender'];
            $result[$counter]['Doctor First Name'] = $r['Temp']['Doctor First Name'];
            $result[$counter]['Doctor Last Name'] = $r['Temp']['Doctor Last Name'];
            $result[$counter]['Queue Status'] = $r['Temp']['Queue Status'];
            $result[$counter]['ID_Visit'] = $r['Temp']['ID_Visit'];
            $result[$counter]['Queue Number'] = $r['Temp']['Queue Number'];
            $result[$counter]['ID_Doctor'] = $r['Temp']['ID_Doctor'];
            $counter++;
        }
        return $result;
    }

    //New!
    public function searchInQueue($id_clinic, $partName) {
        $sql = "SELECT `pc`.`ID_Patient`, `Social_Number`, 
		`pc`.`First_Name` as `Patient First Name`, 
			`pc`.`Last_Name` as `Patient Last Name`, `Birth_Date`, `Address`, `Gender`, 
			`Temp`.`First_Name` as `Doctor First Name`, 
			`Temp`.`Last_Name` as `Doctor Last Name`, 
			`Temp`.`Queue Status`,`Temp`.`ID_Visit`
		FROM `patient_clinic` as `pc`
		JOIN (
			SELECT `ID_Patient`, `ID_Doc`, `First_Name`, `Last_Name`, `ID_Visit`, `qc`.`Status` as `Queue Status`
			FROM `visit_history_clinic` as vhc 
			JOIN `doctor_clinic` as `dc` 
			ON dc.`ID_Doctor` = vhc.`ID_Doc` 
            JOIN (
                SELECT `Status`,`Queue_Number`
                FROM `queue_clinic`
                WHERE `ID_Store` = '$id_clinic'
            ) as `qc`
            ON `qc`.`Queue_Number` = `vhc`.`Queue_Number`
			WHERE `ID_Store` = '$id_clinic' AND `vhc`.`Status` = 0
		) as `Temp`
		ON `pc`.`ID_Patient`= `Temp`.`ID_Patient`
		WHERE `pc`.`First_Name` LIKE '%$partName%' OR `pc`.`Last_Name` LIKE '%$partName%'
		ORDER BY `Temp`.`Queue Status` ASC";
        $res = $this->query($sql);
        $result = array();
        $counter = 0;
        foreach ($res as $r) {
            $result[$counter]['ID_Patient'] = $r['pc']['ID_Patient'];
            $result[$counter]['Social_Number'] = $r['pc']['Social_Number'];
            $result[$counter]['Patient First Name'] = $r['pc']['Patient First Name'];
            $result[$counter]['Patient Last Name'] = $r['pc']['Patient Last Name'];
            $result[$counter]['Birth_Date'] = $r['pc']['Birth_Date'];
            $result[$counter]['Address'] = $r['pc']['Address'];
            $result[$counter]['Gender'] = $r['pc']['Gender'];
            $result[$counter]['Doctor First Name'] = $r['Temp']['Doctor First Name'];
            $result[$counter]['Doctor Last Name'] = $r['Temp']['Doctor Last Name'];
            $result[$counter]['Queue Status'] = $r['Temp']['Queue Status'];
            $result[$counter]['ID_Visit'] = $r['Temp']['ID_Visit'];
            $counter++;
        }
        return $result;
    }

}
