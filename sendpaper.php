<?php

//请自行引入phpmailer模块


if($_GET["mode"] == 'paper' && $_GET["to"] && $_GET["id"]){
    if(!file_exists("@Upload_PAPER/".$_GET["id"].'.ordylandata')){echo "Paper Not Found.";exit;}
    if($_GET["token"] != md5("ORDYLANNOTE_token_PAPER_ID".$_GET["id"]."_PASS")){echo "WrongToken.";exit;}
        $notteee = file("@Upload_PAPER/".$_GET["id"].'.ordylandata')[0];
        $notteee = explode('{[(<||>)]}', $notteee);
        $bt = $notteee[0];
        $url = $notteee[2];
        $url = str_ireplace('https://on.ordylan.com/', '', $url);
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = '*';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '*';                     //SMTP username
        $mail->Password   = '*';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 994;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom('ordylannote@ordylan.cn', 'OrdylanNote');
        $mail->addAddress($_GET["to"], 'User');     //Add a recipient
        $mail->Encoding = "base64";
    
        //Attachments
        $mail->addAttachment($url);         //Add attachments
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = '[笔记系统试卷厅] 你的试卷('.$bt.')到啦, 快打开下载吧!';
        $mail->Body    = '见附件, 感谢选择笔记系统!';
        $mail->AltBody = '笔记系统试卷厅';
    
        $mail->send();
        echo 'Successfully !!';
        require_once 'dolog.php';
    $logF = new LOG_FUNCTION();
        $logF->addlogs(1,"邮件试卷:".$url." to ".$_GET["to"],"成功","邮件试卷|/sendpaper.php");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    
    
    }
    
    else{exit ("faild");}
    
    
    