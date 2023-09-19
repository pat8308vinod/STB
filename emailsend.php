<?php

require 'PHPMailer/PHPMailerAutoload.php';

session_start();



     

        function died($error) {

            // your error code can go here

           // echo "We are very sorry, but there were error(s) found with the form you submitted. ";

           // echo "These errors appear below.<br /><br />";

            echo $error."<br /><br />";

            echo "Please go back and fix these errors.<br /><br />";

            die();

        }

       // validation expected data exists

        if(!isset($_POST['name']) ||

           !isset($_POST['cname']) ||

           !isset($_POST['phone']) ||

           !isset($_POST['email']) ||

		       !isset($_POST['pname']) ||

           !isset($_POST['msg'])  ||

		   !isset($_POST['cd']))

		   {

            died("We are sorry, but there appears to be a problem with the form you submitted.");       

        }

		

       $name = $_POST['name']; // required

        $c_name= $_POST['cname']; // required

        $phone = $_POST['phone']; // required

        $email = $_POST['email']; // not required

        $message = $_POST['msg']; // required

		    $productname = $_POST['pname']; // required

		   $captcha = $_POST['cd']; // required

        $error_message = "";

    //     $email_exp = "/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/";



    //     if(!preg_match($email_exp,$email)) {

    //         $error_message .= "The Email Address you entered does not appear to be valid.<br />";

    //     }

    //     $string_exp = "/^[A-Za-z .'-]+$/";

    //     if(!preg_match($string_exp,$name)) {

    //         $error_message .= "The  Name you entered does not appear to be valid.<br />";

    //     }

    //     if(!preg_match($string_exp,$c_name)) {

    //         $error_message .= "The company  Name you entered does not appear to be valid.<br />";

    //     }

    //     if(strlen($message) < 2) {

    //         $error_message .= "The message you entered do not appear to be valid.<br />";

    //     }

    //     if(strlen($error_message) > 0) {

    //         died($error_message);

    //     }

	  	if($_SESSION['captcha']!=$captcha)

	     {

		    $error_message .= "Please Enter Valid Captcha Code.";

		    died($error_message);

         }


$mail = new PHPMailer;



$mail->isSMTP();                                   // Set mailer to use SMTP

//$mail->Host = 'smtp.gmail.com';

$mail->Host = 'smtpout.secureserver.net';

//$mail->Host = 'smtpauth.weblinkservices.net';                    // Specify main and backup SMTP servers

$mail->SMTPAuth = true;                            // Enable SMTP authentication

$mail->Username = 'enquiry@weblinkservices.net';          // SMTP username

$mail->Password = 'wlspl@123'; // SMTP password

//$mail->SMTPSecure = 'tls'; 

//$mail->SMTPSecure = 'ssl'; 

                       // Enable TLS encryption, `ssl` also accepted

$mail->Port = 587; 

//$mail->Port = 25; 

$mail->SMTPOptions = array(

'ssl' => array(

'verify_peer' => false,

'verify_peer_name' => false,

'allow_self_signed' => true

)

);                                // TCP port to connect to



$mail->setFrom('enquiry@weblinkservices.net', 'Enquiry');

$mail->addReplyTo($email);



//$mail->addAddress('info@biosourcebiotech.com');   // Add a recipient email address

$mail->addAddress('sangitachavan037@gmail.com');

$mail->addBCC('info@weblinkservices.net');

// $mail->addAddress('design@weblinkservices.net');   // Add a recipient

// $mail->addCC('pushpendrakushwaha07@gmail.com');

//$mail->addBCC('vaibhav@weblinkservices.net');



$mail->isHTML(true);  // Set email format to HTML





$bodyContent ="<p><b>Name : ".$name."</b></p>";

$bodyContent .="<p><b>Company Name : ".$c_name."</b></p>";

$bodyContent .="<p><b>Phone : ".$phone."</b></p>";

$bodyContent .="<p><b>Email : ".$email."</b></p>";

$bodyContent .="<p><b>Product Name :".$productname."</b></p>";

$bodyContent .="<p><b>Message :".$message."</b></p>";

 //$bodyContent = '<h1>Sending Email </h1>';

 //$bodyContent .= '<p>Finaly Now I can send mail <b>online</b></p>';



$mail->Subject = 'Enquiry from Website';

$mail->Body    = $bodyContent;



if(!$mail->send()) {

    echo 'Message could not be sent.';

    echo 'Mailer Error: ' . $mail->ErrorInfo;

} else {

    echo "<script type='text/javascript'>alert('Your email has been sent!')</script>";

echo "<script>document.location='enquiry.php'</script>";

}

?>

