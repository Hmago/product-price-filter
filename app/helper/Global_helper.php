<?php

/* function for pretty printing array. Used while development */
function _p($data){
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

/*Function add css styles in the page */
function tableStyles(){
	echo '<style>
	table, td, th {    
	    border: 1px solid #ddd;
	    text-align: left;
	}

	table {
	    border-collapse: collapse;
	    width: 70%;
	}

	th, td {
	    padding: 8px;
	}
	</style>';
}

/*Function create HTML table on the scrren 
	@Params: $header (array): Table header
			 $data (array)  : table data
			 $heading (string):	list heading
*/
function createTable($header, $data, $heading){

	Global $display_on_screen;
	if($display_on_screen == 'no'){
		return;
	}

	_p("<h1>".$heading.":</h1>");
	echo '
		<table>
		  <tr>';
		  foreach ($header as $key => $value) {
		  	echo '<th>'.$value.'</th>';
		  }
		  echo '
		  </tr>
		    ';
		    foreach($data as $product_id=>$product_data){
			  echo '<tr>';
		    	foreach($product_data as $key=>$value){
			    	echo '<td>'.$value.'</td>';
		    	}
		  		echo '</tr>';
		    }
		    echo '
	  </table><br><br>
	';
}