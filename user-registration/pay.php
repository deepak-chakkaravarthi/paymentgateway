<?php
//     include_once('easebuzz-lib/easebuzz_payment_gateway.php');
// if(isset($_POST['submit'])){
//   $name =$_POST['name'];
//   $email =$_POST['email'];
//   $phone =$_POST['phone'];
//   $amount =$_POST['amount'];

//   $MERCHANT_KEY = "2PBP7IABZ2";
//   $SALT = "DAH88E3UWQ";
//   $ENV = "test"; // set enviroment name
  
//   $easebuzzObj = new Easebuzz($MERCHANT_KEY, $SALT, $ENV);

//   $txnid = 'Test'.rand(1,100);

//   $con = mysqli_connect('localhost','root','','user-registration');

//   mysqli_query($con,"insert into payment(textid,name,email,phone,amount,status,paymentid) values('$txnid','$name','$email','$phone','$amount','pending','')");
  
//   $postData = array ( 
//     "txnid" => $txnid , 
//     "amount" => $amount.'.0', 
//     "firstname" => $name, 
//     "email" => $email, 
//     "phone" => $phone, 
//     "productinfo" => "For test", 
//     "surl" => "http://localhost/user-registration/success.php", 
//     "furl" => "http://localhost/user-registration/failed.php", 
// );

// $data = $easebuzzObj->initiatePaymentAPI($postData);   
// print_r($data);
// }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form id="paymentform" method="POST">
       <label for="name">Name</label> <br/>
       <input type="text" name="name" id="name"> <br/>

       <label for="email">email</label> <br/>
       <input type="text" name="email" id="email"> <br/>

       <label for="phone">phone</label> <br/>
       <input type="text" name="phone" id="phone"> <br/>

       <label for="amount">amount</label> <br/>
       <input type="text" name="amount" id="amount"> <br/>
<br/>
       <input type="submit" name="submit">
</form>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script src="https://ebz-static.s3.ap-south-1.amazonaws.com/easecheckout/easebuzz-checkout.js"></script> 

<script>
    $('#paymentform').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url : 'pays.php',
            type : 'post',
            data : $('#paymentform').serialize(),
            success : function(data){
              var easebuzzCheckout = new EasebuzzCheckout('2PBP7IABZ2','test');
            
                var access_key = JSON.parse(data).data;
                var options = {
                       access_key: access_key,
                onResponse:(response)=>{
                    var pid = response.easepayid;
                    var txnid = response.txnid;
                    var surl = response.surl;
                    $.ajax({
                        url : 'checkoutpay.php',
                        type : 'post',
                        data : {pid:pid,txnid:txnid},
                        success: function(data){
                            if(data == 1){
                                window.location.href = surl;
                            }
                        }
                    });

                },
                theme: "#123456"
              }
              easebuzzCheckout.initiatePayment(options);
            }
        });
    });
    </script>

</body>
</html>