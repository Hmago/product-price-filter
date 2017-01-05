<?php
	
/* 
 * Product Object
 * Having getter and setter of product properties
 */

class Product{

	private $required_product_ids;

	private $product_header;

	private $product_data;

	private $cheapest_sorted_list;

	private $expensive_sorted_list;

	Private $required_products_data;

	public function getRequiredProductIds(){
		return $this->required_product_ids;
	}

	public function setRequiredProductIds($required_product_ids){
		$this->required_product_ids = $required_product_ids;
	}

	public function getCheapestSortedList(){
		return $this->cheapest_sorted_list;
	}

	public function setCheapestSortedList($cheapest_sorted_list){
		$this->cheapest_sorted_list = $cheapest_sorted_list;
	}

	public function getRequiredProductData(){
		return $this->required_products_data;
	}

	public function setRequiredProductData($required_products_data){
		$this->required_products_data = $required_products_data;
	}

	public function getExpensiveSortedList(){
		return $this->expensive_sorted_list;
	}

	public function setExpensiveSortedList($expensive_sorted_list){
		$this->expensive_sorted_list = $expensive_sorted_list;
	}

	public function getProductHeader(){
		return $this->product_header;
	}

	public function setProductHeader($product_header){
		$this->product_header = $product_header;
	}

	public function getProductData(){
		return $this->csv_data;
	}

	public function setProductData($csv_data){
		$this->csv_data = $csv_data;
	}
}