<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once("../apis/models/product.php");
require_once("../apis/rest_api_general.php");

class ProductRestHandler extends RestApiGeneral {


    function getProductList(){
        $input_data = array();
        $input_data = $_GET;

        
        $product = new product();
        $rawData = $product->getProductList($input_data);

        if(empty($rawData)) {
            $statusCode = 404;
            $rawData['success'] = 0; 
            $rawData['message'] = "Something went wrong while processing your request.";    
        } else {
            $statusCode = 200;
        }
        
        // $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $requestContentType = $_SERVER['CONTENT_TYPE'];
        $this ->setHttpHeaders($requestContentType, $statusCode);
        $result = $rawData;

        $response = $this->encodeJson($result);
        echo $response;             
    }


    function addProduct(){
        $input_data = array();
        $input_data = $_POST;
        $input_data['files'] = $_FILES;

        
        $product = new product();
        $rawData = $product->addProduct($input_data);

        if(empty($rawData)) {
            $statusCode = 404;
            $rawData['success'] = 0; 
            $rawData['message'] = "Something went wrong while processing your request.";    
        } else {
            $statusCode = 200;
        }
        
        //$requestContentType = $_SERVER['HTTP_ACCEPT'];
        $requestContentType = $_SERVER['CONTENT_TYPE'];
        $this ->setHttpHeaders($requestContentType, $statusCode);
        $result = $rawData;

        $response = $this->encodeJson($result);
        echo $response;             
    }
    
    function updateProduct(){
        $input_data = array();
        $input_data = $_GET;
        // $input_data['files'] = $_FILES;

        
        $product = new product();
        $rawData = $product->updateProduct($input_data);

        if(empty($rawData)) {
            $statusCode = 404;
            $rawData['success'] = 0; 
            $rawData['message'] = "Something went wrong while processing your request.";    
        } else {
            $statusCode = 200;
        }
        
        //$requestContentType = $_SERVER['HTTP_ACCEPT'];
        $requestContentType = $_SERVER['CONTENT_TYPE'];
        $this ->setHttpHeaders($requestContentType, $statusCode);
        $result = $rawData;

        $response = $this->encodeJson($result);
        echo $response;             
    }
    
    function deleteProduct(){
        $input_data = array();
        $input_data = $_GET;

        
        $product = new product();
        $rawData = $product->deleteProduct($input_data);

        if(empty($rawData)) {
            $statusCode = 404;
            $rawData['success'] = 0; 
            $rawData['message'] = "Something went wrong while processing your request.";    
        } else {
            $statusCode = 200;
        }
        
        //$requestContentType = $_SERVER['HTTP_ACCEPT'];
        $requestContentType = $_SERVER['CONTENT_TYPE'];
        $this ->setHttpHeaders($requestContentType, $statusCode);
        $result = $rawData;

        $response = $this->encodeJson($result);
        echo $response;             
    }

    public function encodeJson($responseData) {
      $jsonResponse = json_encode($responseData);
      return $jsonResponse;		
  }

}
?>