<?php 

$con = mysqli_connect('localhost','root','','user-registration');

$pid =$_POST['pid'];
$txnid = $_POST['txnid'];
$sql = "update payment set status='success',paymentid='$pid' where textid='$txnid'";

if(mysqli_query($con, $sql)){
    echo 1;
}

?>