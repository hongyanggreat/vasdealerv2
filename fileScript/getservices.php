<!-- #!/usr/bin/php -q -->
<?php
// echo 'get services';
define ("USERNAME", "TDL_1SOLUTION");
define ("PASSWORD", "1solution@123456");
define ("MASTER_ID", 1019);
define ("SHAREKEY", "1solution@123456");


define ("URL_API", "http://210.211.98.80:8989/api/");

define ("URL_GET_SERVICES", URL_API."getServiceList?");

ob_implicit_flush(true); 
set_time_limit(5); 
// $con = mysql_connect("127.0.0.1","vasdealer","vasdealer@13456789"); 
// $db  = mysql_select_db("db_vasdealer",$con);


// $servername = "127.0.0.1";
// $username = "root";
// $password = "";
// $dbname = "db_vasdealer";

$servername = "127.0.0.1";
$username = "vasdealer";
$password = "vasdealer@13456789";
$dbname = "db_vasdealer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$dataParams = [
    'userName'  => USERNAME,
    'password'  => PASSWORD,
    'masterId'  => MASTER_ID,
    'checkSum'  => base64_encode(sha1(USERNAME.PASSWORD.MASTER_ID.SHAREKEY, true)),
];
// echo URL_GET_SERVICES;
// echo '<pre>';
// print_r($dataParams);

$result = serviceAPI(URL_GET_SERVICES,$dataParams);
// $result = actionServices();
// print_r($result);
// die;
// echo '<pre>';
if($result){
	$arrDataApi = json_decode($result);
	// print_r($arrDataApi);
	if(isset($arrDataApi->items)){
		// print_r($arrDataApi->items);
		$items = $arrDataApi->items;
		// die;
		$sqlInsert = "";
		$sqlUpdate = "";
		foreach ($items as $key => $item) {
			// print_r($item);
			// die;
			$idPackage      = $item->id;
			
			$serviceCode    = $item->serviceCode;
			$productCode    = $item->productCode;
			$price          = $item->price;
			$cycles         = $item->cycles;
			$description    = $item->description;
			$type           = $item->type;
			$commissionType = $item->commissionType;
			$status         = 1;
			$time           = date('Y-m-d H:i:s');

			$sql = "SELECT ID_PACKAGE FROM services WHERE ID_PACKAGE = ".$idPackage;
			$one = $conn->query($sql);

			if ($one->num_rows > 0) {
			    // output data of each row
			    while($row = $one->fetch_assoc()) {
			    	 // echo "ID_PACKAGE: " . $row["ID_PACKAGE"]. "<br>";
			        $sqlUpdate .= "UPDATE services SET SERVICE_CODE='".$serviceCode."',PRODUCT_CODE='".$productCode."',PRICE='".$price."',DESCRIPTION='".$description."',TYPE='".$type."',STATUS='".$status."',CONMISSION_TYPE='".$commissionType."',CYCLES='".$cycles."' WHERE ID_PACKAGE='".$idPackage."';";
			    }
			} else {
			    // echo "0 results";
				$sqlInsert .= "INSERT INTO services (ID_PACKAGE, SERVICE_CODE,PRODUCT_CODE,PRICE, DESCRIPTION,TYPE,STATUS,CONMISSION_TYPE,CYCLES,CREATE_AT)
					VALUES ('$idPackage', '$serviceCode','$productCode','$price', '$description','$type','$status','$commissionType','$cycles',NOW());";
			}
			
		}
		// echo $sqlInsert;
		// die;
		// echo $sqlUpdate;
		if ($conn->multi_query($sqlInsert) === TRUE) {
		    echo "New records created successfully";
		} else {
		    echo "Error: " . $sqlInsert . "<br>" . $conn->error;
		}
		echo '<br>';
		if ($conn->multi_query($sqlUpdate) === TRUE) {
		    echo "New records Update successfully";
		} else {
		    echo "Error: " . $sqlUpdate . "<br>" . $conn->error;
		}
	}else{
		// echo 'cha co gi';
	}
}else{
	// echo 'khong lay duoc du lieu';
}


$conn->close();


function  serviceAPI($url,$data,$method = "GET") {
    $getdata = http_build_query($data);
  
    if($method == "GET"){
       @$result =   file_get_contents($url.$getdata);
    }
    return $result;
}
function actionServices()
    {
        $data = [];
            $data = [
                   
                    'errorCode' =>1,
                    'errorDesc' =>'Thành công',
                    'quantity'  =>4,
                    'items'     => [
                        [
                            'id'             => 91,        
                            'serviceCode'    => "BANTINTAICHINH",        
                            'productCode'    => "BANTINTAICHINH",        
                            'price'          => 3000,        
                            'cycles'         => 7,        
                            'description'    => "BANTINTAICHINH",        
                            'type'           => 0,        
                            'commissionType' => 1, 
                        ],
                        
                        [
                            'id'             => 84,        
                            'serviceCode'    => "BANTINTAICHINH",        
                            'productCode'    => "BANTINGIAITRI",        
                            'price'          => 1000,        
                            'cycles'         => 1,        
                            'description'    => "BANTINGIAITRI",        
                            'type'           => 0,        
                            'commissionType' => 1, 
                        ],  [
                            'id'             => 82,        
                            'serviceCode'    => "BANTINAMNHAC",        
                            'productCode'    => "WEEKLY",        
                            'price'          => 1000,        
                            'cycles'         => 1,        
                            'description'    => "BANTINAMNHAC",        
                            'type'           => 0,        
                            'commissionType' => 1, 
                        ], 

                        [
                            'id'             => 70,        
                            'serviceCode'    => "MI_MAX90_12M",        
                            'productCode'    => "12TMAX90",        
                            'price'          => 3000,        
                            'cycles'         => 7,        
                            'description'    => "",        
                            'type'           => 0,        
                            'commissionType' => 1, 
                        ],
                        
                        [
                            'id'             => 83,        
                            'serviceCode'    => "MI_MAX90_6M",        
                            'productCode'    => "6TMAX90",        
                            'price'          => 1000,        
                            'cycles'         => 1,        
                            'description'    => "",        
                            'type'           => 0,        
                            'commissionType' => 1, 
                        ],  [
                            'id'             => 72,        
                            'serviceCode'    => "MI_MAXSV2",        
                            'productCode'    => "MAXSV2",        
                            'price'          => 1000,        
                            'cycles'         => 1,        
                            'description'    => "",        
                            'type'           => 0,        
                            'commissionType' => 1, 
                        ],  [
                            'id'             => 73,        
                            'serviceCode'    => "MI_MAXS_12M",        
                            'productCode'    => "12TMAXS",        
                            'price'          => 3000,        
                            'cycles'         => 7,        
                            'description'    => "",        
                            'type'           => 0,        
                            'commissionType' => 1, 
                        ],
                        
                        [
                            'id'             => 74,        
                            'serviceCode'    => "MI_MAXS_6M",        
                            'productCode'    => "6TMAXS",        
                            'price'          => 1000,        
                            'cycles'         => 1,        
                            'description'    => "",        
                            'type'           => 0,        
                            'commissionType' => 1, 
                        ],  [
                            'id'             => 75,        
                            'serviceCode'    => "MI_MAX_12M",        
                            'productCode'    => "12TMAX",        
                            'price'          => 1000,        
                            'cycles'         => 1,        
                            'description'    => "",        
                            'type'           => 0,        
                            'commissionType' => 1, 
                        ],  
                          
                    ],
            ];
        return  json_encode($data);
    }
?>

