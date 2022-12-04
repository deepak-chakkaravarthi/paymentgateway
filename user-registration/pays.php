<?php 

include_once('easebuzz-lib/easebuzz_payment_gateway.php');
include_once('easebuzz-lib/payment.php');
 
  $name =$_POST['name'];
  $email =$_POST['email'];
  $phone =$_POST['phone'];
  $amount =$_POST['amount'];

  $MERCHANT_KEY = "2PBP7IABZ2";
  $SALT = "DAH88E3UWQ";
  $ENV = "test"; // set enviroment name
  
  $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);

  $txnid = 'Test'.rand(1,100);

  $con = mysqli_connect('localhost','root','','user-registration');

  mysqli_query($con,"insert into payment(textid,name,email,phone,amount,status,paymentid) values('$txnid','$name','$email','$phone','$amount','pending','')");
  
  $postData = array ( 
    "txnid" => $txnid , 
    "amount" => $amount.'.0', 
    "firstname" => $name, 
    "email" => $email, 
    "phone" => $phone, 
    "productinfo" => "For test", 
    "surl" => "http://localhost/user-registration/success.php", 
    "furl" => "http://localhost/user-registration/failed.php", 
);

$data = _payment($postData,false, $MERCHANT_KEY, $SALT, $ENV);  

echo json_encode($data);


?>