<?php
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
