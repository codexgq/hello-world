<?php
  
if($_POST) {
    $name = "";
    $email = "";
    $phone = "";
    $subject = "";
    $department = "";
    $message = "";
    $email_body = "<div>";
      
    if(isset($_POST['name'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Visitor Name:</b></label>&nbsp;<span>".$name."</span>
                        </div>";
    }

    if(isset($_POST['email'])) {
        $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $email_body .= "<div>
                           <label><b>Visitor Email:</b></label>&nbsp;<span>".$email."</span>
                        </div>";
    }

    if(isset($_POST['phone'])) {
        $phone = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['phone']);
        $phone = filter_var($phone, FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Visitor Phone:</b></label>&nbsp;<span>".$phone."</span>
                        </div>";
    }
      
    if(isset($_POST['subject'])) {
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Reason For Contacting Us:</b></label>&nbsp;<span>".$subject."</span>
                        </div>";
    }
      
    if(isset($_POST['department'])) {
        $department = filter_var($_POST['department'], FILTER_SANITIZE_STRING);
        $email_body .= "<div>
                           <label><b>Concerned Department:</b></label>&nbsp;<span>".$department."</span>
                        </div>";
    }
      
    if(isset($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
        $email_body .= "<div>
                           <label><b>Visitor Message:</b></label>
                           <div>".$message."</div>
                        </div>";
    }
      
    if($department == "finance") {
        $recipient = "finance@codex.gq";
    }
    else if($department == "sales") {
        $recipient = "sales@codex.gq";
    }
    else if($department == "technical_support") {
        $recipient = "support@codex.gq";
    }
    else {
        $recipient = "info@codex.gq";
    }
      
    $email_body .= "</div>";
 
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email . "\r\n";
      
    if(mail($recipient, $subject, $email_body, $headers)) {
        echo "<p>Thank you for contacting us, $name. You will get a reply as soon as possible.</p>";
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }
      
} else {
    echo '<p>Something went wrong...</p>';
}
    
?>