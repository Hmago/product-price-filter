<?php

/*Report only errors */
error_reporting(E_ERROR);

/*Loading configuration file */
include_once 'configs/config.php';

/*Loading helper functions */
include_once 'app/helper/Global_helper.php';

/*Loading main repo and creating an object of it*/
include_once 'app/repository/Efficientbazaar.php';
$efficientbazaar = new Efficientbazaar();

/*Initializing project entities */
$efficientbazaar->init();
/*Processing data, i.e. filtering cheapest and expensive list*/
$efficientbazaar->process();
/*Create cheapest list in csv file as well as printing it on the screen */
$efficientbazaar->createCheapestList();
/*Create expensivr list in csv file as well as printing it on the screen */
$efficientbazaar->createExpensiveList();
/*Create custom list having data of mentioned product ids in csv file as well as printing it on the screen */
$efficientbazaar->createCustomProductList();