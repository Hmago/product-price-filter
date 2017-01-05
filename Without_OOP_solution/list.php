<?php

	function _p($data){
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}

	$file = fopen("products.csv","r");

	$isHeaderId = 1;
	$csvIndex = array();
	$productData = array();
	$productCodeIndex = null;
	$priceIndex = null;
	while($data = fgetcsv($file, 0, ",")) {
		if($isHeaderId){
			$csvIndex = $data;
			foreach ($data as $key => $value) {
				if($value == 'Product Code'){
					$productCodeIndex = $key;
				}

				if($value == 'Price'){
					$priceIndex = $key;
				}
			}

			if($productCodeIndex == null){
				die;
			}

			$isHeaderId = 0;
		}else{
			if(empty($productData[$data[$productCodeIndex]])){
				$productData[$data[$productCodeIndex]][] = $data;
			}else{
				$isPlaced = false;
				$temp = array();
				foreach ($productData[$data[$productCodeIndex]] as $key => $value) {
					if($data[$priceIndex] < $value[$priceIndex]){
						$temp[] = $data;
						$isPlaced = true;
					}
					$temp[] = $value;
				}

				if(!$isPlaced){
					$temp[] = $data;
				}

				$productData[$data[$productCodeIndex]] = $temp;
			}
		}


	}


	Global $required_proucts;

	$cheapest = array();
	$expensive = array();
	$customProducts = array();

	$temp_required_product_ids = array();
	foreach($required_proucts as $key=>$product_id){
		$temp_required_product_ids[$product_id] = $product_id;
	}

	foreach ($productData as $productId => $poductData) {
		$cheapest[$productId] = current($poductData);
		$expensive[$productId] = end($poductData);

		if(!empty($temp_required_product_ids[$productId])){
			$customProducts[$productId]['cheapest'] = $cheapest[$productId];
			$customProducts[$productId]['expensive'] = $expensive[$productId];
		}
	}

	_p(array('cheapest'=>$cheapest, 'expensive'=>$expensive, 'customProducts'=>$customProducts));

	_p($productData);

	die;