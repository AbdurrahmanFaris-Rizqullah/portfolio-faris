<?php

  // $receiving_email_address = 'nugasriz03@gmail.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  // $contact = new PHP_Email_Form;
  // $contact->ajax = true;
  
  // $contact->to = $receiving_email_address;
  // $contact->from_name = $_POST['name'];
  // $contact->from_email = $_POST['email'];
  // $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  // $contact->add_message( $_POST['name'], 'From');
  // $contact->add_message( $_POST['email'], 'Email');
  // $contact->add_message( $_POST['message'], 'Message', 10);

  // echo $contact->send();

  // Periksa apakah metode permintaan adalah POST
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ganti email penerima dengan email Anda yang sebenarnya
    $receiving_email_address = 'nugasriz03@gmail.com';
    
    // Ambil data dari formulir
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Buat pesan email
    $email_message = "Nama: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Subjek: $subject\n\n";
    $email_message .= "Pesan:\n$message\n";
    
    // Tentukan header email
    $headers = 'From: ' . $email . "\r\n" .
               'Reply-To: ' . $email . "\r\n" .
               'X-Mailer: PHP/' . phpversion();
    
    // Kirim email
    if (mail($receiving_email_address, $subject, $email_message, $headers)) {
      // Jika email berhasil dikirim, beri respons yang sesuai
      http_response_code(200);
      echo "Pesan Anda telah terkirim. Terima kasih!";
    } else {
      // Jika gagal, beri respons dengan kode kesalahan
      http_response_code(500);
      echo "Maaf, terjadi kesalahan saat mengirim pesan.";
    }
  } else {
    // Jika metode permintaan bukan POST, kembalikan respons dengan kode kesalahan
    http_response_code(403);
    echo "Akses ditolak.";
  }
?>

