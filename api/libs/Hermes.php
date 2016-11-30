<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Hermes
 *
 * @author pabhoz
 */
class Hermes {
    
    public static function send($to,$subject,$from,$message,$reply ="",$cc = ""){
        
        $headers = "From: " . strip_tags($from) . "\r\n";
        if($cc != ""){
        $headers .= "Reply-To: ". strip_tags($reply) . "\r\n";
        }
        if($cc != ""){
            $headers .= "CC: susan@example.com\r\n";    
        }
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        mail($to, $subject, $message, $headers);
    }
    
    public static function getPasswordBody($username,$pin){
       return "<!DOCTYPE html>
        <html>
        <body>
                <div>Hola, ".$username."</div>
                <p>Al parecer se ha extraviado tu contraseña de JOGO, para cambiarla introduce el siguiente PIN en la aplicación: </p>
                <p><b>".strip_tags($pin)."</b></p>
                <p>Si no fuiste tu quien solicitó el cambio, omite éste mensaje.</p>
                <p>Equipo JOGO.</p>
        </body>
        </html>";
    }
    
}
