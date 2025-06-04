<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo "cURL Error: " . $error;
} else {
    echo "It works! Response received.";
}
?>
 <div class="typing">
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
        <div class="typing-dot"></div>
      </div>