<?php
if(isset($_REQUEST ['ok'])){ 
$xml = new DOMDocument("1.0","UTF-8"); 
$xml->load("a.xml";

$rootTag = $xml->getElementsByTagName("document")->item(0); 

$dataTag = $xml->createElement("data"); 

$nameTag = $xml-> createElement("name",$_REQUEST['name']); 
$surnameTag = $xml-> createElement("surname",$_REQUEST['surname']); 
$dataTag->appendChild($nameTag); 
$dataTag->appendChild($surnameTag); 

$rootTag->appendChild($dataTag); 

$xml->save("student.xml"); 

}
	include 'defines.php';
	include 'email_validation.php';
$post = (!empty($_POST)) ? true : false;

	if($post){

		$name = stripslashes($_POST['name']);
		$phone = stripslashes($_POST['phone']);
		$email = stripslashes($_POST['email']);
		$surname = stripslashes($_POST['surname']);
		$subject = 'Заявка';
		$error = '';	
		$message = '
			<html>
					<head>
							<title>Заявка</title>
					</head>
					<body>
							<p>Имя: '.$name.'</p>
							<p>Фамилия: '.$surname.'</p>
							<p>Телефон : '.$phone.'</p>	
							<p>Email : '.$email.'</p>
					</body>
			</html>';

		if (!ValidateEmail($email)){
			$error = 'Email введен неправильно!';
		
		}

		if(!$error){
			$mail = mail(CONTACT_FORM, $subject, $message,
			     "From: ".$name." <".$email.">\r\n"
			    ."Reply-To: ".$email."\r\n"
			    ."Content-type: text/html; charset=utf-8 \r\n"
			    ."X-Mailer: PHP/" . phpversion());

			if($mail){
				echo 'OK';
			}
		}else{
			echo '<div class="bg-danger">'.$error.'</div>';
		}

	}


?>
