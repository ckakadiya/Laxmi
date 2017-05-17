<?php
session_start();
if (isset($_SESSION['username']) && $_GET['msg']=="send")
{
?>
<?php
include_once("Function.php");
require 'SendEmail/PHPMailerAutoload.php';
include('clientsms/func.php');

$ser="http://site24.way2sms.com/";
$ckfile = tempnam ("/tmp", "CURLCOOKIE");
$login=$ser."Login1.action";
$errorMsgSms="";
$errorMsgMail="";

$uid="8140850671";
$pwd="Hardik312";

if($uid && $pwd)
{
	$lhtml="0";
	$loginpost="gval=&username=".$uid."&password=".$pwd."&Login=Login";

	$ch = curl_init();
	$lhtml=post($login,$loginpost,$ch,$ckfile);

	if(stristr($lhtml,'Location: '.$ser.'vem.action') || stristr($lhtml,'Location: '.$ser.'MainView.action') || stristr($lhtml,'Location: '.$ser.'ebrdg.action'))
	{
		preg_match("/~(.*?);/i",$lhtml,$id);
		$id=$id['1'];

		if(!$id)
		{
			$errorMsgSms="Way2Sms Login Failed.";
			goto end;
		}
			goto bal;
		}
		elseif(stristr($lhtml,'Location: http://site2.way2sms.com/entry'))
		{		
			$errorMsgSms="Way2Sms Invalid Login Details.";
			goto end;
		}
		else
		{
			$errorMsgSms="Way2Sms Login Problemm.";
			goto end;
		}

		bal:

		$date=date('Y-m-d', strtotime("+10 days"));
		$date1=date('Y-m-d');
		$qry="select * from policy where emailStatus=0 AND expireDate between '$date1' AND '$date'";				
		$res=mysql_query($qry) or die(mysql_error());
		while($row=mysql_fetch_assoc($res))
		{	
			$clientId=$row['clientId'];
			$qry1="select * from clients where clientId='$clientId'";
			$res1=mysql_query($qry1) or die(mysql_error());			
			
			while($row2=mysql_fetch_assoc($res1))
			{
				$msg="Hello ".$row2['firstName'].", Your Policy ".$row['policyName']." is Due after Some Day. So Please Renew Policy.";
				$to=$row2['phoneNo'];
				$main=$ser."smstoss.action";
				$ref=$ser."sendSMS?Token=".$id;
				$conf=$ser."smscofirm.action?SentMessage=".$msg."&Token=".$id."&status=0";
				$post="ssaction=ss&Token=".$id."&mobile=".$to."&message=".$msg."&Send=Send Sms&msgLen=".strlen($msg);
				$mhtml=post($main,$post,$ch,$ckfile,'',$ref);
				if(stristr($mhtml,'smscofirm.action?SentMessage='))
				{
					$errorMsgSms="Messages Are Send Sucessfully to All Client.";
				}
				else
				{
					$errorMsgSms="There is Some Problem During Send SMS.";
					goto end;
				}
				
				////////////////////////////////////	Email Send	///////////////////////////////
				$cemail=$row2['emailId'];
				$fileName=$row['fileName'];
				$policyId=$row['policyId'];
				
				$file="pdf/".$cemail."/Policy/".$fileName;
				$email = "garage.hub.2016@gmail.com";
				$password = "Garage@Hub@2016";
				$to_id = $cemail;
				$message = "Hello,";
				$subject = "Renewal Notice For ".$row['policyName']." Policy.";
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->SMTPSecure = 'ssl';
				$mail->SMTPAuth = true;
				$mail->Username = $email;
				$mail->Password = $password;
				$mail->addAddress($to_id);
				$mail->Subject = $subject;
				$mail->addAttachment($file,$fileName);
				
				$mail->msgHTML($message);
				if (!$mail->send()) 
				{
					$errorMsgMail = "Mailer Error: " . $mail->ErrorInfo;
					goto end;
				}
				else 
				{
					$qry="update policy set emailStatus=1 where policyId='$policyId'";
					mysql_query($qry) or die(mysql_error());
					$errorMsgMail = "Emails Are Send Sucessfully to All Client.";
				}
			}
		}

end:

	header("Location:upcomingRenewal.php?errorMsgSms=$errorMsgSms&errorMsgMail=$errorMsgMail");

}

}
else
{
	header("location:newCustomer.php");
}
?>