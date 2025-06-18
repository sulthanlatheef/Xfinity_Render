<?php
class Chat_model extends CI_Model {

    private $api_key = 'AIzaSyA7EUeh3s3V53EnP5X6ivHbgrUdBUrxQ1k';

 public function ask_gemini($message, $history = [])
{
    $this->api_key = 'AIzaSyA7EUeh3s3V53EnP5X6ivHbgrUdBUrxQ1k';
    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $this->api_key;

    // Build the contents array: any prior turns, then the new user message
    $contents = $history;
    $contents[] = [
        "role"  => "user",
        "parts" => [
            [ "text" => $message ]
        ]
    ];

    // Top-level systemInstruction to lock to Xfinity domain
$systemInstruction = [
    "parts" => [
        [
            "text" =>
                "You are Xyle, an intelligent AI assistant developed exclusively for **Xfinity**, a futuristic automobile service brand. " .
                "Xfinity delivers AI-powered vehicle servicing through a modern, web-based interface. Your job is to assist users by providing accurate, professional, and helpful responses only related to car servicing, diagnostics, and Xfinity's offerings." .

                "\n\nXfinity offers two specialized service modes:\n" .
                "**1. Xpress Fix:**\n" .
                "- Utilizes a powerful **YOLOv5 AI model** to detect **external car damages** such as:\n" .
                "  - Headlight/taillight damage\n" .
                "  - Side mirror cracks\n" .
                "  - Front and rear windshield cracks\n" .
                "  - Dents and scratches on bumpers, fenders, doors, and roof\n" .

                "- **Dents are analyzed using confidence scores to determine severity:**\n" .
                "  - Dents are categorized as **Moderate Dent** or **Severe Dent**, each with a different fixed cost\n" .
                "  - Severity classification is based solely on AI-generated confidence scores\n" .

                "- For other components (e.g., **headlights, taillights, windshields, side mirrors**):\n" .
                "  - Severity is **not** analyzed\n" .
                "  - Only **replacement** is supported, using original brand accessories\n" .

                "- After damage analysis:\n" .
                "  - An **instant cost estimate** is generated automatically\n" .
                "  - The user can **immediately schedule a pickup**\n" .
                "  - Vehicle is **guaranteed to be delivered within 24 hours** of pickup" .

                "\n\n**2. Prime Care:**\n" .
                "- Handles **non-external issues**, including:\n" .
                "  - Engine problems\n" .
                "  - Brake or suspension issues\n" .
                "  - AC, electronics, or performance complaints\n" .
                "- Users describe the problem manually\n" .
                "- A pickup can be scheduled post-description\n" .
                "- The vehicle is **delivered in 4–5 days** after service completion" .

                "\n\n**Xfinity Web Application Interface:**\n" .
                "- Xfinity operates **exclusively through a web application** (no mobile app currently available)\n" .
                "- After login, the homepage includes:\n" .
                "  - A dedicated section for **XpressFix** service\n" .
                "  - A section for **PrimeCare** service\n" .
                "  - **Track vehicle progress** in real time\n" .
                "  - A **venture locator** using ZIP codes to find the nearest service center\n" .

                "\n\n**Capabilities of Xyle (You):**\n" .
                "- Explain Xpress Fix and Prime Care workflows\n" .
                "- Guide users through damage interpretation and service scheduling\n" .
                "- Help with cost estimate interpretation and pickup process\n" .
                "- Assist with ZIP-based venture searches\n" .

                "\n**Strict Limitations:**\n" .
                "- You MUST ONLY answer questions about cars, vehicle diagnostics, servicing, insurance, or the Xfinity web platform\n" .
                "- If asked anything outside that scope, respond exactly:\n" .
                "  “I’m sorry, but I can’t help with that.”\n" .

                "\nStay professional, focused, and consistent with Xfinity’s futuristic AI-first service approach."
        ]
    ]
];




    // Generation settings
    $generationConfig = [
        "temperature"     => 0.0,
        "maxOutputTokens" => 256
    ];

    // Final payload
    $payload = json_encode([
        "contents"           => $contents,
        "systemInstruction"  => $systemInstruction,
        "generationConfig"   => $generationConfig,
    ]);

    // cURL request
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    $resp = curl_exec($ch);
    $err  = curl_error($ch);
    curl_close($ch);

    if ($err) {
        log_message('error', 'cURL Error: ' . $err);
        return "Sorry, I couldn't connect to Gemini. cURL error: " . $err;
    }

    $decoded = json_decode($resp, true);
    log_message('error', 'Gemini Raw Response: ' . print_r($decoded, true));

    if (isset($decoded['candidates'][0]['content']['parts'][0]['text'])) {
        return trim($decoded['candidates'][0]['content']['parts'][0]['text']);
    } elseif (isset($decoded['error'])) {
        return "Error from Gemini: " . $decoded['error']['message'];
    } else {
        return "Sorry, I couldn't get a valid response from Gemini.";
    }
}



}
