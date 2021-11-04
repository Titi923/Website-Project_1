<?php
    // Messageg Vars
    $msg = '';
    $msgClass = '';

    // Check For Submit
    if(filter_has_var(INPUT_POST, 'submit')) {
        // Get Form Data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Check Required Fields
        if(!empty($email) && !empty($name) && !empty($message)) {
          // Passed
          // Check Email
          if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
              // Failed
              $msg = 'Please enter a valid email address..';
              $msgClass = 'alert-danger';
          } else {
            // Passed
            // Recipient Email
            $toEmail = 'petrisor.buciutaa@gmail.com';
            $subject = 'Contact Request From' .$name;
            $body = '<h2>Contact Request</h2>
                <h4>Name</h4><p>'.$name.'</p>
                <h4>Email</h4><p>'.$email.'</p>
                <h4>Message</h4><p>'.$message.'</p>
                ';

                // Email Headers
                $headers = "MIME-Version: 1.0" ."\r\n";
                $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

                // Additional Headers
                $headers .= "From: " .$name. "<".$email.">". "\r\n";

                if(mail($toEmail, $subject, $body, $headers)) {
                  // Email Sent
                  $msg = 'Your email has been sent';
                  $msgClass = 'alert-success';
                } else {
                  // Failed
                  $msg = 'Your email was not sent';
                  $msgClass = 'alert-danger';
                }

          }
        } else {
          // Failed
          $msg = 'Please fill in all fields';
          $msgClass = 'alert-danger';
        }

    }
    
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    <title>Website_2</title>
    <script
      src="https://kit.fontawesome.com/54e170f569.js"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>

    <div class="container block__center">
      <div class="contact__wrapper">
        <div class="contact__info">
          <img style="width: 88%;" src="icons/Logo.svg" alt="">
          <p>Send me an Email here!</p>
        </div>
        <div class="contact__input">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p>
              <label>Name</label>
              <input type="text" name="name" placeholder="Enter your name..." value="<?php echo isset($_POST['name']) ? $name : ''; ?>" />
            </p>
            <p>
              <label>Email Address</label>
              <input type="email" name="email" placeholder="Enter your email..." value="<?php echo isset($_POST['email']) ? $email : ''; ?>"/>
            </p>
            <p class="full">
              <label>Message</label>
              <textarea name="message" rows="7" placeholder="What is your message for me?"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
            </p>
            <p class="full">
              <button type="submit" name="submit">Send</button>
            </p>
              <?php if($msg != ''): ?>
                        <div class="full alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
                      <?php endif; ?>
          </form>
          
        </div>
      </div>
      
    </div>
    <script src="js/main.js"></script>
  </body>
</html>