<?php

 /* Configuration file */

/*Variable having input csv path */
 Global $csv_path;
 $csv_path = 'csv/input/';

/*Variable having input csv name */
 Global $csv_name;
 $csv_name = 'products.csv';

/*Variable having input required product ids */
 Global $required_proucts;
 $required_proucts = array(3736, 4356, 3732, 3746, 3759, 3719, 3740, 4341);

/*Variable having output csv path */
 Global $output_csv_file_path;
 $output_csv_file_path = 'csv/output/';

/*Variable having output csv names */
 Global $output_csv_file_names;
 $output_csv_file_names = array('cheapest'=>'cheapest.csv', 'expensive'=>'expensive.csv', 'requiredProduct'=>'requiredProduct.csv');

 /*In case you don't want to display the data on the screen then set it to 'no' */
 Global $display_on_screen;
 $display_on_screen = 'yes'; // yes || no