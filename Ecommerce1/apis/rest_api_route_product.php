<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once("../apis/controllers/product_controller.php");
require_once("../apis/rest_api_general.php");

callRoute();
exit;

// Authentication
session_start();


function callRoute(){
	$method = $_SERVER['REQUEST_METHOD'];
	$view = "";

	if(isset($_GET["action"]))
		$action = $_GET["action"];
	/*
	controls the RESTful services
	URL mapping
	*/
	switch($action){

		//--------------------------------------------------------------
		// Product related operations
		//--------------------------------------------------------------
		case "product-list":
			$ProductRestHandler = new ProductRestHandler();
			$result = $ProductRestHandler->getProductList();
		break;
		case "add-product":
			$ProductRestHandler = new ProductRestHandler();
			$result = $ProductRestHandler->addProduct();
		break;
			case "update-product":
			$ProductRestHandler = new ProductRestHandler();
			$result = $ProductRestHandler->updateProduct();
		break;
			case "delete-product": 
			// echo 'gfggdf';exit;
			$ProductRestHandler = new ProductRestHandler();
			$result = $ProductRestHandler->deleteProduct();
		break;
	}
}
?>