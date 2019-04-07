<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
if(isset($_POST['submeter'])){
    try {
        
        //Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = '********@gmail.com';                     // SMTP username
        $mail->Password   = '********';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to


        $remetente= $_POST['remetente'];
        $destinatario= $_POST['destinatario'];
        $titulo= $_POST['titulo'];

                //Recipients
        $mail->setFrom($remetente);
        $mail->addAddress($destinatario);     // Add a recipient
        

        $cabecalho= $_POST['cabecalho'];
        $texto= $_POST['texto'];
        $rodape= $_POST['rodape'];
        $mensagem = "<p>".$cabecalho."</p><br><p>".$texto."</p><br>".$rodape;
        echo $mensagem;

        // Content
        $mail->isHTML(false);                                  // Set email format to HTML
        $mail->Subject = $titulo;
        $mail->Body    = $mensagem;
        $mail->AltBody = $mensagem;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
<html>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<meta charset="utf-8">
<style type="text/css">
  #cabecalho{
    resize:none;
    background-color: #efefef;
  }
  #texto{
    resize:none;
  }
  #rodape{
    resize:none;
    background-color: #efefef;
  }
</style>
<style>
#faketextarea {
  border: 2px solid #215297;
}
input[type="text"],
select.form-control-de {
  background: transparent;
  border: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  border-radius: 0;
}
label{
  font-size: 13px;
}
hr{
  border-top: 1px #8c8b8b;
}
input[type="text"]:focus,
select.form-control:focus {
  -webkit-box-shadow: none;
  box-shadow: none;
}
</style>
<form  method="post">
<div id=faketextarea style="width:297">

<div class="form-group">
  <label>De:</label>
  <input type="text" name="remetente" class="form-control" id="remetente" style="width:264">
  <hr>
  <label>Para:</label>
  <input type="text" name="destinatario" class="form-control" id="destinatario" style="width:250">
  <hr>
  <label>Titulo:</label>
  <input type="text" name="titulo" class="form-control" id="titulo" style="width:240">
</div>


<textarea id=cabecalho name=cabecalho readonly style="border:0; overflow: auto;" cols=40 rows=1>Prezado(a), estamos comunicando voce este seguinte recado.</textarea>
<BR>
<textarea id=texto name=texto style="border:0; overflow: auto;" cols=40 rows=10></textarea>
<BR>
<textarea id=rodape name=rodape readonly style="border:0; overflow: auto;" cols=40 rows=1>Esta mensagem é automatica, por favor não responda.</textarea>
</div>
<BR>
        <input type="submit" name="submeter" value="Submeter"/>
<BR>
</form>
</html>
