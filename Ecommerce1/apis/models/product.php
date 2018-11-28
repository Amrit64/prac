<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include_once("../config.php");
include_once("../apis/dbcontroller.php");


Class Product {
    private $product = array();

    public function getProductList($input_data){  

               /*-----------------------------------------------------------------------------------------------------
               Input Parameter:
                tbl_id/patient_id
                NOTE:
                Marked as a * are required input parameter
                -------------------------------------------------------------------------------------------------------------*/

                $return_data = array();
                $return_data['success'] = '0';
                $return_data['message'] = 'Something getting wrong while processing request. Please try again later.';
                $dbcontroller = new DBController();
                $search = !empty($input_data['search']) ? $input_data['search'] : NULL;

                $whereArr = array();
                if($search != '') $whereArr[] = "quantity_per_unit LIKE '%".$search."%'";

                $whereStr = implode(" AND ", $whereArr);

                $query = "SELECT * FROM `add_product`";
                if($whereStr != '') $query.=" WHERE  ".$whereStr;
                $query = "SELECT * FROM `add_product`";



                $query_result = $dbcontroller->executeSelectQuery($query);
                if(!empty($query_result)){
                    $return_data['records'] = $query_result['records'];
                    $return_data['total_records'] = $query_result['retrivedtTotalRows'];
                    $return_data['success'] = '1';
                    $return_data['message'] = 'Records found successfully.'; 
                }else{
                    $return_data['success'] = '0';
                    $return_data['message'] = 'No records found!';      
                }

                return $return_data;

            }



            
public function getregisterEmployeeList($input_data){  

    $return_data = array();
    $return_data['success'] = '0';
    $return_data['message'] = 'Something getting wrong while processing request. Please try again later.';
    $dbcontroller = new DBController();
        // Received input parameters
    $search = !empty($input_data['search']) ? $input_data['search'] : NULL;

    $whereArr = array();
    if($search != '') $whereArr[] = "first_name LIKE '%".$search."%'";

    $whereStr = implode(" AND ", $whereArr);

    $query = "SELECT * FROM `employee_details`";
    if($whereStr != '') $query.=" WHERE  ".$whereStr;
    $query.= " ORDER BY id DESC";
    $query_result = $dbcontroller->executeSelectQuery($query);
    if(!empty($query_result)){
        $return_data['records'] = $query_result['records'];
        $return_data['total_records'] = $query_result['retrivedtTotalRows'];
        $return_data['success'] = '1';
        $return_data['message'] = 'Records found successfully.'; 
    }else{
        $return_data['success'] = '0';
        $return_data['message'] = 'No records found!';      
    }

    return $return_data;

}
public function login($input_data){  

    $return_data = array();

    $return_data['success'] = '0';
    $return_data['message'] = 'Something getting wrong while processing request. Please try again later.';
    $dbcontroller = new DBController();
    $email = !empty($input_data['email']) ? $dbcontroller->escapeString($input_data['email']) : NULL;
    $password = !empty($input_data['password']) ? $dbcontroller->escapeString($input_data['password']) : NULL;
    $is_active = !empty($input_data['is_active']) ? $dbcontroller->escapeString($input_data['is_active']) : NULL;
    $search = !empty($input_data['search']) ? $input_data['search'] : NULL;
    $search1 = !empty($input_data['search1']) ? $input_data['search1'] : NULL;
    $search2 = !empty($input_data['search2']) ? $input_data['search2'] : NULL;

    $whereArr = array();
    if($search != '') $whereArr[] = "email = '".$search."'";
    if($search1 != '') $whereArr[] = "password = '".$search1."'";
    if($search2 != '') $whereArr[] = "is_active = 'YES'";  

    $whereStr = implode(" AND ", $whereArr);
    $query = "SELECT * FROM `employee_details` WHERE ".$whereStr; 
    $query_result = $dbcontroller->executeSelectQuery($query);

    if(!empty($query_result)){
        $return_data['success'] = '1';
        $return_data['records'] = $query_result['records'];
        $return_data['message'] = 'Records Found.'; 
    }else{
        $return_data['success'] = '0';
        $return_data['message'] = 'Error occured while fetching data.';      
    }

    return $return_data;

}



        public function addProduct($input_data){  

                $return_data = array();
                $return_data['success'] = '0';
                $return_data['message'] = 'Something getting wrong while processing request. Please try again later.';
                $dbcontroller = new DBController();
                $product_name = !empty($input_data['product_name']) ? $dbcontroller->escapeString($input_data['product_name']) : NULL;
                $quantity_per_unit = !empty($input_data['quantity_per_unit']) ? $dbcontroller->escapeString($input_data['quantity_per_unit']) : NULL;
                $actual_price = !empty($input_data['actual_price']) ? $dbcontroller->escapeString($input_data['actual_price']) : NULL;
                $selling_price = !empty($input_data['selling_price']) ? $dbcontroller->escapeString($input_data['selling_price']) : NULL;
                $brand_name = !empty($input_data['brand_name']) ? $dbcontroller->escapeString($input_data['brand_name']) : NULL;
                $categories_id = !empty($input_data['categories_id']) ? $dbcontroller->escapeString($input_data['categories_id']) : NULL;
                $profile_pic = !empty($input_data['files']['profile_pic']['name']) ? $dbcontroller->escapeString($input_data['files']['profile_pic']['name']) : NULL;

                $query=("INSERT INTO `add_product`(`product_name`, `quantity_per_unit`, `actual_price`, `selling_price`, `brand_name`, `profile_pic`, `categories_id`) VALUES ('".$product_name."', '".$quantity_per_unit."', '".$actual_price."', '".$selling_price."', '".$brand_name."', '".$profile_pic."', '".$categories_id."')");
                $query_result = $dbcontroller->executeQuery($query);
                if(!empty($profile_pic)){
                    $upload_dir = '/var/www/html/Practies/API/apis/upload'; 
                    move_uploaded_file($input_data['files']['profile_pic']['tmp_name'], $upload_dir."/". $profile_pic);
                }

                if(!empty($query_result) && $query_result['affectedRows'] > 0){
                    $return_data['success'] = '1';
                    $return_data['message'] = 'Records added successfully.'; 
                }else{
                    $return_data['success'] = '0';
                    $return_data['message'] = 'Error occured while adding data.';      
                }

                return $return_data;

            }
// move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $_FILES["file"]["name"]);
        public function updateProduct($input_data){  

                $return_data = array();
                $return_data['success'] = '0';
                $return_data['message'] = 'Something getting wrong while processing request. Please try again later.';
                $dbcontroller = new DBController();
                $product_name = !empty($input_data['product_name']) ? $dbcontroller->escapeString($input_data['product_name']) : NULL;
                $quantity_per_unit = !empty($input_data['quantity_per_unit']) ? $dbcontroller->escapeString($input_data['quantity_per_unit']) : NULL;
                $actual_price = !empty($input_data['actual_price']) ? $dbcontroller->escapeString($input_data['actual_price']) : NULL;
                $selling_price = !empty($input_data['selling_price']) ? $dbcontroller->escapeString($input_data['selling_price']) : NULL;
                $brand_name = !empty($input_data['brand_name']) ? $dbcontroller->escapeString($input_data['brand_name']) : NULL;
                $categories_id = !empty($input_data['categories_id']) ? $dbcontroller->escapeString($input_data['categories_id']) : NULL;
                // $profile_pic = !empty($input_data['files']['profile_pic']['name']) ? $dbcontroller->escapeString($input_data['files']['profile_pic']['name']) : NULL;

                $search = !empty($input_data['search']) ? $input_data['search'] : NULL;

                $whereArr = array();
                if($search != '') $whereArr[] = "product_id LIKE '%".$search."%'";

                $whereStr = implode(" AND ", $whereArr);          
                $query=("UPDATE `add_product` SET `product_name`='$_POST[product_name]',`quantity_per_unit`='$_POST[quantity_per_unit]',`actual_price`='$_POST[actual_price]',`selling_price`='$_POST[selling_price]',`brand_name`='$_POST[brand_name]' WHERE ".$whereStr);
                $query_result = $dbcontroller->executeQuery($query);
                // if(!empty(['files']['profile_pic'])){
                //     $upload_dir = '';
                //     move_uploaded_file($input_data['files']['profile_pic']['tmp_name'], $upload_dir."/". $profile_pic);
                // }

                if(!empty($query_result) && $query_result['affectedRows'] > 0){
                    $return_data['success'] = '1';
                    $return_data['message'] = 'Records Update successfully.'; 
                }else{
                    $return_data['success'] = '0';
                    $return_data['message'] = 'Error occured while adding data.';      
                }

                return $return_data;

            }

        public function deleteProduct($input_data){  
                $return_data = array();
                $return_data['success'] = '0';
                $return_data['message'] = 'Something getting wrong while processing request. Please try again later.';
                $dbcontroller = new DBController();
                $search = !empty($input_data['search']) ? $input_data['search'] : NULL;
                $whereArr = array();

                if($search != '') $whereArr[] = "product_id LIKE '%".$search."%'";
                $whereStr = implode(" AND ", $whereArr);
                $query = ("DELETE FROM `add_product` WHERE ".$whereStr);




                $query_result = $dbcontroller->executeQuery($query);
                if(!empty($query_result)){
                    $return_data['success'] = '1';
                    $return_data['message'] = 'Records deleted successfully.'; 
                }else{
                    $return_data['success'] = '0';
                    $return_data['message'] = 'No records found!';      
                }
                return $return_data;

        }

    }
?>