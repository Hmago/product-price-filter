<?php
	
	/*
	 * Populates data to the product object
	 */
class ProductPopulator{

	public function populate($product_object, $file){
		Global $required_proucts;

		$data = $this->_processCSVData($file);
		$filteredData = $this->filterProductData($data['product_data'], $required_proucts);
		
		$product_object->setProductData($data['product_data']);
		$product_object->setProductHeader($data['product_header']);
		$product_object->setRequiredProductData($required_proucts);
		$product_object->setCheapestSortedList($filteredData['cheapest']);
		$product_object->setExpensiveSortedList($filteredData['expensive']);
		$product_object->setRequiredProductData($filteredData['customProducts']);
	}

	/* 
	 * Make up data by groupping them by productId having products in sorted order of their price list.
	 *	@Params: $file : CSV file instance
	 */
	private function _processCSVData($file){

		/*Some temp variable to hold data */
		$isHeaderId = 1;
		$product_header = array();
		$product_data = array();
		$productCodeIndex = null;
		$priceIndex = null;
		while($data = fgetcsv($file, 0, ",")) {

			/*If it is first element i.e. header of the csv file */
			if($isHeaderId){
				$product_header = $data;
				foreach ($data as $key => $value) {

					/*Storing product code column sequence */
					if($value == 'Product Code'){
						$productCodeIndex = $key;
					}

					/*Storing price column sequence */
					if($value == 'Price'){
						$priceIndex = $key;
					}
				}

				/*Invalid csv */
				if($productCodeIndex == null){
					return;
				}

				$isHeaderId = 0;
			}else{

				/* checking if, it is the first record of the product*/
				if(empty($product_data[$data[$productCodeIndex]])){
					$product_data[$data[$productCodeIndex]][] = $data;
				}else{
					$isPlaced = false;
					$temp = array();

					/*Inserting new product detial in the sorted order */
					foreach ($product_data[$data[$productCodeIndex]] as $key => $value) {
						if($data[$priceIndex] < $value[$priceIndex]){
							$temp[] = $data;
							$isPlaced = true;
						}
						$temp[] = $value;
					}

					if(!$isPlaced){
						$temp[] = $data;
					}

					$product_data[$data[$productCodeIndex]] = $temp;
				}
			}

		}

		return array('product_data'=>$product_data, 'product_header'=>$product_header);
	}


	/*API to make up data in accordance to the sheets */
	public function filterProductData($product_data, $required_product_ids){
		$cheapest = array();
		$expensive = array();
		$customProducts = array();

		$temp_required_product_ids = array();
		foreach($required_product_ids as $key=>$product_id){
			$temp_required_product_ids[$product_id] = $product_id;
		}

		foreach ($product_data as $productId => $poductData) {
			$cheapest[$productId] = current($poductData);
			$expensive[$productId] = end($poductData);

			if(!empty($temp_required_product_ids[$productId])){
				$customProducts[$productId]['cheapest'] = $cheapest[$productId];
				$customProducts[$productId]['expensive'] = $expensive[$productId];
			}
		}

		return array('cheapest'=>$cheapest, 'expensive'=>$expensive, 'customProducts'=>$customProducts);
	}
}