<?php
/////////////////////////////////////////////////////////////////////////////
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////
// BaseMailer
// The lines in the PlainTextMessage should be seperated by \r\n
// The lines in HtmlTextMessage should be seperated by <br /> or other
// appropriate html entities with \r\n being optional
/////////////////////////////////////////////////////////////////////////
function BaseMailer(
	$From,
	$ReplyTo,
	$To,
	$Subject,
	$PlainBodyText,
	$HtmlBodyText)
{
	$Partition = md5(date('r', time()));

	$Headers	= "From: $From\r\nReply-To: $ReplyTo\r\n".
				"\r\nContent-Type: multipart/alternative; boundary=\"GreenJapanB2B-$Partition\"";
	//$Headers	= "From: $From\r\nReply-To: $ReplyTo";

	$MessageBody = "--GreenJapanB2B-$Partition\r\n". 
	"Content-Type: text/plain; charset=\"iso-8859-1\"\r\n".
	"Content-Transfer-Encoding: 7bit\r\n\r\n".
	$PlainBodyText.
	"\r\n\r\n".
	"--GreenJapanB2B-$Partition\r\n".
	"Content-Type: text/html; charset=\"iso-8859-1\"\r\n". 
	"Content-Transfer-Encoding: 7bit\r\n\r\n".
	"<html><body>\r\n".
	$HtmlBodyText.
	"</body></html>\r\n".
	"--GreenJapanB2B-$Partition--\r\n\r\n";

	DebugEcho("MessageBody :".$MessageBody);
	DebugEcho("Subject :".$Subject);
	DebugEcho("To :".$To);
	DebugEcho("Headers :".$Headers);
	$MailSuccessCode = mail($To, $Subject, $MessageBody, $Headers ); 
	//$MailSuccessCode = mail($To, $Subject, $PlainBodyText, $Headers ); 

	return $MailSuccessCode;
};

if (!function_exists('mime_content_type'))
{
    function mime_content_type($file, $method = 0)
    {
        if ($method == 0)
        {
            ob_start();
            system('/usr/bin/file -i -b ' . realpath($file));
            $type = ob_get_clean();

            $parts = explode(';', $type);

            return trim($parts[0]);
        }
        else if ($method == 1)
        {
            // another method here
        }
    }
}

/////////////////////////////////////////////////////////////////////////
// BaseMailerWithAttachment
// The lines in the PlainTextMessage should be seperated by \r\n
// The lines in HtmlTextMessage should be seperated by <br /> or other
// appropriate html entities with \r\n being optional
/////////////////////////////////////////////////////////////////////////
function BaseMailerWithAttachment(
	$From,
	$ReplyTo,
	$To,
	$Subject,
	$PlainBodyText,
	$HtmlBodyText,
	$FileName)
{
	$Partition = md5(date('r', time()));
	$BaseFileName = substr(strrchr($FileName, "/"), 1);

	$Headers	= "From: $From\r\nReply-To: $ReplyTo\r\n".
				"\r\nContent-Type: multipart/alternative; boundary=\"GreenJapanB2B-$Partition\"";
	//$Headers	= "From: $From\r\nReply-To: $ReplyTo";

	$AttachmentContent = chunk_split(base64_encode(file_get_contents($FileName))); 

	$MessageBody = "--GreenJapanB2B-$Partition\r\n". 
	"Content-Type: text/plain; charset=\"iso-8859-1\"\r\n".
	"Content-Transfer-Encoding: 7bit\r\n\r\n".
	$PlainBodyText.
	"\r\n\r\n".
	"--GreenJapanB2B-$Partition\r\n".
	"Content-Type: text/html; charset=\"iso-8859-1\"\r\n". 
	"Content-Transfer-Encoding: 7bit\r\n\r\n".
	"<html><body>\r\n".
	$HtmlBodyText.
	"</body></html>\r\n".
	"Content-Type: ".mime_content_type($FileName)."; name=\"$BaseFileName\"\r\n" .
	"Content-Transfer-Encoding: base64\r\n" .
	"Content-Disposition: inline;\r\n" .
	" filename=\"$BaseFileName\"\r\n\r\n" .
	$AttachmentContent.
	"\r\n\r\n--GreenJapanB2B-$Partition--\r\n\r\n";

	DebugEcho("MessageBody :".$MessageBody);
	$MailSuccessCode = mail($To, $Subject, $MessageBody, $Headers ); 
	//$MailSuccessCode = mail($To, $Subject, $PlainBodyText, $Headers ); 

	return $MailSuccessCode;
};

/////////////////////////////////////////////////////////////////////////////
// Mailer - The Mailer class is meant to simplify the task of sending emails
// to users. Note: this email system will not work if your server is not
// setup to send mail.
/////////////////////////////////////////////////////////////////////////////
class Mailer
{
	function ErrorReport($ErrorMessage)
	{
	  $From = "From: ".DAEMON_EMAIL." <".DAEMON_EMAIL.">";
	  $Subject = "Error Report";
	  $Body = ",\n\n"
			 ."The following error was received: "
			 .$ErrorMessage;

	  return mail(ADMIN_EMAIL, $Subject, $Body, $From);
	}

	/////////////////////////////////////////////////////////////////////////
	// BaseMailer
	// The lines in the PlainTextMessage should be seperated by \r\n
	// The lines in HtmlTextMessage should be seperated by <br /> or other
	// appropriate html entities with \r\n being optional
	/////////////////////////////////////////////////////////////////////////
	function BaseMailer(
		$From,
		$ReplyTo,
		$To,
		$Subject,
		$PlainBodyText,
		$HtmlBodyText)
	{
		$Partition = md5(date('r', time()));

		$Headers	= "From: $From\r\nReply-To: $ReplyTo\r\n".
					"\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-$Partition\"";

		$MessageBody = "\r\n--PHP-alt-$Partition\r\n". 
		"Content-Type: text/plain; charset=\"iso-8859-1\"\r\n".
		"Content-Transfer-Encoding: 7bit\r\n\r\n".
		$PlainBodyText.
		"\r\n\r\n".
		"--PHP-alt-$Partition\r\n".
		"Content-Type: text/html; charset=\"iso-8859-1\"\r\n". 
		"Content-Transfer-Encoding: 7bit\r\n". 
		$HtmlBodyText.
		"--PHP-alt-$Partition--\r\n";

		DebugEcho("MailBody: ".$MessageBody);

		$MailSuccessCode = mail($To, $Subject, $MessageBody, $Headers ); 

		return $MailSuccessCode;
	}
}	// End Class
?>
