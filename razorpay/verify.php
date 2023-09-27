<html>
<head>
<title>kito</title>
 <link rel="stylesheet" href="style.css">

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php

require 'config.php';

session_start();

require 'razorpay-php/Razorpay.php';
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try
    {
       
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature'],
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {

    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $email = $_SESSION['email'];
    $price = $_SESSION['price'];
    $customer = $_SESSION['name'];


    $sql = "INSERT INTO `orders` (`order_id`,`name`, `razorpay_payment_id`, `price`, `status`, `email`) VALUES ('$razorpay_order_id','$customer','$razorpay_payment_id', '$price', 'success', '$email')";

    if (mysqli_query($con, $sql)) {
        echo "<script> 
        Swal.fire({
            title: 'Payment Done',
            icon: 'success',
           
            confirmButtonColor: '#3085d6',
        
            confirmButtonText: 'ok'
          }).then((result) => {
            if (result.isConfirmed) {
             document.location='index.php'; 
            }
          })
        
        </script>";
    }

    // $html = "<script>
    //          alert(`{$_POST['razorpay_payment_id']}`);
    //          header('Location: index.php');
    //          </script>
    //          ";
} else {
     mysqli_query("INSERT INTO `orders` (`order_id`, `razorpay_payment_id`, `price`, `status`, `email`) VALUES ('$razorpay_order_id','$razorpay_payment_id', '$price', 'failed', '$email')");
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

// echo $html;
?>
</body>
</html>