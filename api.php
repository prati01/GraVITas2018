<?php 
 
 //database constants
 define('DB_HOST', '127.0.0.1');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'bhel_database');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $conn->prepare("SELECT * FROM vw_handingovermaster;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($CheckNo, $ItemReferenceNo, $HODate, $HOMNo, $IRNo, 
 	$QuantityHandedOver, $Status, $Remark, $QCRemark, $confirmdate, 
 	$MatLocation, $CustomerName, $ProjectName, $CustDescription, $DrawingNo, 
 	$ItemRate, $UserName, $QCLogin, $Weight);
 
 $products = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['checkno'] = $CheckNo; 
 $temp['itemreferenceno'] = $ItemReferenceNo; 
 $temp['hodate'] = $HODate; 
 $temp['homno'] = $HOMNo; 
 $temp['irno'] = $IRNo;
 $temp['quantityhandedover'] = $QuantityHandedOver; 
 $temp['status'] = $Status; 
 $temp['remark'] = $Remark; 
 $temp['qcremark'] = $QCRemark; 
 $temp['confirmdate'] = $confirmdate;
 $temp['matlocation'] = $MatLocation; 
 $temp['customername'] = $CustomerName; 
 $temp['projectname'] = $ProjectName; 
 $temp['custdescription'] = $CustDescription; 
 $temp['drawingno'] = $DrawingNo;
 $temp['itemrate'] = $ItemRate; 
 $temp['username'] = $UserName;
 $temp['qclogin'] = $QCLogin; 
 $temp['weight'] = $Weight;
 array_push($products, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($products);