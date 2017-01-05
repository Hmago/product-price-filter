<?php

class Efficientbazaar{

	/*CSV entity object */
	private $csv_object;

	/*product entity object */
	private $product_object;

	/*
		API for entities initialization 
	*/
	public function init(){
		include_once 'app/entites/CsvFile.php';
		$this->csv_object = new CSV();

		include_once 'app/entites/Product.php';
		$this->product_object = new Product();
	}

	/*API for Processing data, i.e. filtering cheapest and expensive list*/
	public function process(){

		include_once 'app/populator/CsvFile.php';
		$csv_populator = new CsvPopulator();

		$csv_populator->populate($this->csv_object);
		$file = $this->csv_object->getCSV();

		if(empty($file)){
			echo 'File does not exist!!';
			exit();
		}

		include_once 'app/populator/Product.php';
		$product_populator = new ProductPopulator();
		
		$product_populator->populate($this->product_object, $file);
		$this->csv_object->closeCSV();
	}

	/*API to create cheapest list in csv file as well as printing it on the screen */
	public function createCheapestList(){
		tableStyles();

		Global $output_csv_file_path, $output_csv_file_names;

		/*Creating csv file */
		$this->csv_object->createCSV($output_csv_file_path,$output_csv_file_names['cheapest'], array_merge(array($this->product_object->getProductHeader()), $this->product_object->getCheapestSortedList()) );
		/*Printing data on the screen */
		createTable($this->product_object->getProductHeader(), $this->product_object->getCheapestSortedList(), 'Cheapest Products');
	}

	/*API to create expensive list in csv file as well as printing it on the screen */
	public function createExpensiveList(){

		Global $output_csv_file_path, $output_csv_file_names;

		/*Creating csv file */
		$this->csv_object->createCSV($output_csv_file_path,$output_csv_file_names['expensive'], array_merge(array($this->product_object->getProductHeader()), $this->product_object->getExpensiveSortedList()) );

		/*Printing data on the screen */
		createTable($this->product_object->getProductHeader(), $this->product_object->getExpensiveSortedList(), 'Expensive Products');
	}

	/*API to create custom list in csv file as well as printing it on the screen */
	public function createCustomProductList(){

		Global $output_csv_file_path, $output_csv_file_names;

		$customProductHeader = $this->product_object->getProductHeader();
		$customProductHeader[] = 'Filter Type';

		$index = 0;
		$customRequiredProductsData = array();
		$temp = $this->product_object->getRequiredProductData();
		foreach($temp as $key=>$wholeData){
			foreach($wholeData as $filterType=>$values){
				$customRequiredProductsData[$index] = $values;
				$customRequiredProductsData[$index][] = $filterType;
				$index++;
			}

		}
		
		/*Creating csv file */
		$this->csv_object->createCSV($output_csv_file_path,$output_csv_file_names['requiredProduct'], array_merge(array($customProductHeader), $customRequiredProductsData) );

		/*Printing data on the screen */
		createTable($customProductHeader, $customRequiredProductsData, 'Required Products');
		
	}
}