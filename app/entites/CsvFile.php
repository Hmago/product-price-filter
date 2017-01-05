<?php

/* 
 * CSV Object
 * Having getter and setter of csv properties
 */
class CSV{

	private $file;

	private $file_name;

	private $file_path;


	public function getFileName(){
		return $this->file_name;
	}

	public function setFileName($file_name){
		$this->file_name = $file_name;
	}

	public function getFilePath(){
		return $this->file_path;
	}

	public function setFilePath($file_path){
		$this->file_path = $file_path;
	}

	public function openCSV(){
		$this->file = fopen($this->file_path.$this->file_name,"r");
	}

	public function getCSV(){
		return $this->file;
	}

	public function closeCSV(){
		return fclose($this->file);
	}


	public function createCSV($path, $name, $data) {
	  if (!$fp = fopen($path.$name, 'w')){ echo 'failed to Create CSV: Permission denied; Please provide all user permission to project dir<br>'; }

	  foreach ($data as $line) fputcsv($fp, $line);

	  rewind($fp);

	  fclose($fp);
	}
	
}