<?php

namespace Demo\PhpMvc\Services;

class MailService
{
    private $header;

    private static function headersConfig($sender)
    {
        $smtp = 'username@mysmtp.com';
        if (!$sender) $sender = $smtp;
        $this->header = implode( "\n", array( "From: ".$smtp, "Reply-To: ".$sender, "Return-Path: ".$sender, "MIME-Version: 1.0", "X-Priority: 3", "Content-Type: text/html; charset=UTF-8" ));   
    }

    public static function sendEmail($sender = null, $to, $subject, $content)
    {
        $day = date('d/m/Y');
        $hour = date('H:i:s');
        $content = $content ."\n".$hour."\n".$day;
        
        self::headerConfig($sender);
        if (mail($to, $subject, nl2br($content), $this->header)) { 
           return true;
        }
        return false; 
    }
}
