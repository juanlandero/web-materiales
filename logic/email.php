<?php


class Respuesta {
    public $resultado;
}
$retorna = new Respuesta();

$para = 'jcarlos210193@gmail.com';
 
//remitente del correo
$from = $_POST['email'];
$fromName = $_POST['nombre'];
 
$asunto = 'www.cmir.com.mx'; 


$mensaje = "<h3>Le escribe: ".$fromName."</h3>\r\n<h3>E-mail: ".$from."</h3>\r\n"."<p>".$_POST['mensaje']."</p>";
$mensaje = wordwrap($mensaje, 70, "\r\n");

//Contenido del Email
$htmlContent = $mensaje;
 
//Encabezado para información del remitente
$headers = "De: $fromName"." <".$from.">";

 
//Limite Email
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
 
//Encabezados para archivo adjunto 
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
 
//límite multiparte
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 
 
//preparación de archivo
if(!empty($file) > 0){
    if(is_file($file)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));
 
        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
        "Content-Description: ".basename($files[$i])."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}
$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;
 
//Enviar EMail
$mail = @mail($para, $asunto, $message, $headers, $returnpath); 
 
//echo $mail?"<h1>Correo enviado.</h1>":"<h1>El envío de correo falló.</h1>";

if($_POST['nombre']=="" || $_POST['email']=="" || $_POST['mensaje']==""){
    $retorna->resultado = FALSE;
}else{
    $retorna->resultado = TRUE;
}


echo json_encode($retorna);

?>