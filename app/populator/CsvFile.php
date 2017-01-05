<?php 
	/*
	 * Populates data to the csv object
	 */
class CsvPopulator{

	public function populate($csv_object){
		Global $csv_path;
		Global $csv_name;
		
		$csv_object->setFileName($csv_name);
		$csv_object->setFilePath($csv_path);
		$csv_object->openCSV();
	}
}