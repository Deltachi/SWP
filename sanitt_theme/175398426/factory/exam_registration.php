<?php 
	require 'PHPMailer-master/class.phpmailer.php';
	//global vars
	$key = "sanitt_save"; 
	$sent_key = "";
	$examID = "1";
	$admin_email = "a.sancar@sanitt.de";

	function getExamID(){
		$directory = "exam_registration/log/";
		$files = glob($directory . "*.txt");
		if ( $files !== false )
		{
		    $filecount = count( $files );
		    $examID = $filecount + 1;
		    echo "Exam ID is: ".$examID." \n";
		    return $examID;
		}
		else
		{
			$examID = 1;
		    echo "Exam ID is: 1 \n";
		    return $examID;
		}
	}
	function writeLog($array, $myfile, $offset_val){
		
		// calculate offset for PRETTY_JSON
		$offset_string = "";
		$offset = $offset_val*4;
		while ($offset > 0) {
			$offset_string = $offset_string." ";
			$offset--;
		}

		

		foreach ($array as $key => $value) {
			if(!is_array($value)){
				$txt = $offset_string.$key.": ".$value;
				fwrite($myfile, $txt.PHP_EOL);
			}else{
				fwrite($myfile, $offset_string.$key.":".PHP_EOL);
				fwrite($myfile, $offset_string.">>>".PHP_EOL);
				writeLog($value, $myfile, $offset_val+1);
				fwrite($myfile, $offset_string."<<<".PHP_EOL);
			}
			fwrite($myfile, PHP_EOL);
		}
	}
	function backup_sendMail($from, $to, $subject, $body, $path_to_zip){
		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		// $mail->isSMTP();                                      // Set mailer to use SMTP
		// $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
		// $mail->SMTPAuth = true;                               // Enable SMTP authentication
		// $mail->Username = 'user@example.com';                 // SMTP username
		// $mail->Password = 'secret';                           // SMTP password
		// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		// $mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('backup@sanitt.de', 'System');
		foreach ($to as $single_email){
			$mail->addAddress($single_email);     // Add a recipient
		}
		// $mail->addAddress('ellen@example.com');               // Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		$mail->addAttachment($path_to_zip);         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(false);                                  // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $body;
		// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}
	}
	function registration_sendMail($from, $to, $subject, $body){
		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		// $mail->isSMTP();                                      // Set mailer to use SMTP
		// $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
		// $mail->SMTPAuth = true;                               // Enable SMTP authentication
		// $mail->Username = 'user@example.com';                 // SMTP username
		// $mail->Password = 'secret';                           // SMTP password
		// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		// $mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('exams@sanitt.de', 'Sanitt Pruefungsanmeldung');
		foreach ($to as $single_email){
			$mail->addAddress($single_email);     // Add a recipient
		}
		// $mail->addAddress('ellen@example.com');               // Name is optional
		// $mail->addReplyTo('info@example.com', 'Information');
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $body;
		// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}
	}
	function buildMail($data){
		$mail_body = "";
		// Header
		$mail_body .= "<h2 style='color: gray;'>Es gab eine neue Pr&uuml;fungsanmeldung!</h2><br><br>";
		// Exam Information
		$mail_body .= "<h3>Pr&uuml;fungsinformationen:</h3>";
		$mail_body .= "<p>
							<strong>Pr&uuml;fung:</strong> " . $data['exam_data']['super'] . "<br>
							<strong>Kurzbezeichnung und Sprache:</strong> " . $data['exam_data']['name'] . "<br>
							<strong>Wunschtermin:</strong> " . $data['exam_data']['date1'] . "<br>
							<strong>Wunschuhrzeit:</strong> " . $data['exam_data']['time1'] . "<br><br>
							<strong>Kathegorie:</strong> " . $data['exam_type'] . "<br>
		</p>";
		// Members Information
		$mail_body .= "<h3>Teilnehmerinformationen:</h3>";
		foreach ($data['exam_members'] as $key => $member) {
			$mail_body .= "<p>";
			if(isset( $member['title'])){$mail_body .= "<strong>Titel:</strong> " . $member['title'] . "<br>";}
			$mail_body .= "
								<strong>Vorname:</strong> " . $member['firstname'] . "<br>
								<strong>Nachname:</strong> " . $member['lastname'] . "<br>
								<strong>Geschlecht:</strong> " . $member['gender'] . "<br>
								<strong>Wohnort:</strong> <br>" . $member['street']['name'] . " " . $member['street']['number'] . "<br>" . $member['city']['plz'] . " " . $member['city']['name'] . "<br>
								<strong>Geburtstag:</strong> " . $member['birthday'] . "<br>
								<strong>Geburtsort:</strong> " . $member['birthplace'] . "<br>";
			if(isset( $member['phone'])){$mail_body .= "<strong>Telefon:</strong> " . $member['phone'] . "<br>";}
			if(isset( $member['mobile'])){$mail_body .= "<strong>Mobiltelefon:</strong> " . $member['mobile'] . "<br>";}
			if(isset( $member['student'])){$mail_body .= "<strong>Ist Student:</strong> " . $member['student'] . "<br>";}
			$mail_body .= "		<strong>Email:</strong> " . $member['email'] . "<br>
			</p>";
		}
		return $mail_body;
	}
	function saveUserData($examID,$admin_email){
		
		$myfile = fopen("exam_registration/log/logfile_".time()."_ID".$examID.".txt", "wb") or die("Unable to open file!");
		$date = date('d.m.Y H:i:s', time());
		//file heading
		fwrite($myfile, "Register Time (Server): ".$date.PHP_EOL."-------------------------------------------".PHP_EOL);
		//function for pretty json to TXT file
		writeLog($_POST, $myfile, 0);
		fclose($myfile);

		// $pretty = json_encode($_POST, JSON_PRETTY_PRINT);
		$pretty = buildMail($_POST);
		echo "Mail body: \n ".$pretty."\nRequesting mailing system..\n";
		registration_sendMail("kunde@sanitt.de",$admin_email,'New Exam: '.$_POST['exam_data']['name'],"Hello Admin!\nYou have a new exam registration!\n Here is the logfile:\n".$pretty);
	}
	function zipAndDelete($admin_email){
		// Get real path for our folder
		$rootPath = realpath('exam_registration/log/');

		// Initialize archive object
		$zip_name = 'exam_registration/backup_exam_registrations_'.time().'.zip';
		$zip = new ZipArchive();
		$zip->open($zip_name, ZipArchive::CREATE | ZipArchive::OVERWRITE);

		// Initialize empty "delete list"
		$filesToDelete = array();

		// Create recursive directory iterator
		/** @var SplFileInfo[] $files */
		$files = new RecursiveIteratorIterator(
		    new RecursiveDirectoryIterator($rootPath),
		    RecursiveIteratorIterator::LEAVES_ONLY
		);

		foreach ($files as $name => $file)
		{
		    // Skip directories (they would be added automatically)
		    if (!$file->isDir())
		    {
		        // Get real and relative path for current file
		        $filePath = $file->getRealPath();
		        $relativePath = substr($filePath, strlen($rootPath) + 1);

		        // Add current file to archive
		        $zip->addFile($filePath, $relativePath);

		        // Add current file to "delete list"
		        // delete it later cause ZipArchive create archive only after calling close function and ZipArchive lock files until archive created)
		        if ($file->getFilename() != 'important.txt')
		        {
		            $filesToDelete[] = $filePath;
		        }
		    }
		}
		$zip->close();
		// Zip archive will be created only after closing object
		echo "\nZipped files successfully!\n";
		// Delete all files from "delete list"
		foreach ($filesToDelete as $file)
		{
		    unlink($file);
		}
		echo "\nDeleted unzipped files.\nRequesting backup mailing system..\n";
		backup_sendMail('backup@sanitt.de',$admin_email,'New Backup',"Hello Admin!\n Here is a backup.zip for exam registrations containing the last recent log files.",$zip_name);
	}

	//main function
	if (isset($_POST['key']) && $_POST['key'] == $key) {
		unset($_POST['key']);
		var_dump($_POST);
		$examID = getExamID();
		if (isset($_POST['admin_email'])) {
			$admin_email = $_POST['admin_email'];
		}
		saveUserData($examID,$admin_email);
		if (isset($_POST['zip']) && $_POST['zip'] == true && $examID > 100) {
			zipAndDelete($admin_email);

		}
	}else{
		header("HTTP/1.1 403 Unauthorized" );
		echo "Denied: Sent key is wrong.";
		exit;
	}

?>