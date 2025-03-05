<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'])) {
    $api_key = "API_KEY_DATA"; 
    $product_title = trim($_POST['title']);

    $prompt = "Generate SEO-friendly meta description and meta keywords for the product titled '$product_title'.";

    $data = array(
        "model" => "gpt-4",
        "messages" => array(
            array("role" => "user", "content" => $prompt)
        ),
        "temperature" => 0.7
    );

    $headers = array(
        "Content-Type: application/json",
        "Authorization: " . "Bearer $api_key"
    );

    $ch = curl_init("https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);
    
    if (isset($result['choices'][0]['message']['content'])) {
        $output = explode("\n", $result['choices'][0]['message']['content']);
        
        $meta_description = isset($output[0]) ? trim($output[0]) : "No description generated.";
        $meta_keywords = isset($output[1]) ? trim($output[1]) : "No keywords generated.";

        echo json_encode([
            "meta_description" => $meta_description,
            "meta_keywords" => $meta_keywords
        ]);
    } else {
        echo json_encode(["meta_description" => "Error generating description.", "meta_keywords" => "Error generating keywords."]);
    }
}
?>
