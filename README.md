# AutoFillProductDescriptions

## Overview
AutoFillProductDescriptions is a PHP-based tool that utilizes AI to automatically generate SEO-friendly meta descriptions and meta keywords for eCommerce product titles. It integrates with OpenAI API to enhance product visibility and search engine ranking.

## Features
- AI-powered meta description and keyword generation
- AJAX-based seamless form submission
- Uses OpenAI API
- Simple and lightweight implementation

## Requirements
- PHP 8.1 or higher
- cURL enabled in PHP
- OpenAI API Key
- Web server (Apache, Nginx, etc.)

## Installation
1. Clone the repository:
   ```sh
   git clone https://github.com/yourusername/AutoFillProductDescriptions.git
   ```
2. Navigate to the project directory:
   ```sh
   cd AutoFillProductDescriptions
   ```
3. Set up your OpenAI API key:
   - Get your API key from [OpenAI](https://platform.openai.com/)
   - Replace `YOUR_OPENAI_API_KEY` in the code with your actual API key.

## Usage
### Frontend Form
Use the following form to input a product title and fetch AI-generated meta descriptions and keywords:
```html
<form id="product-form">
    <input type="text" id="product-title" name="title" placeholder="Enter product title" required>
    <button type="submit">Generate</button>
</form>
<div id="results"></div>
```

### AJAX Request (JavaScript)
```js
$(document).ready(function () {
    $('#product-form').submit(function (event) {
        event.preventDefault();
        let title = $('#product-title').val();
        
        $.ajax({
            url: 'generate_meta.php',
            type: 'POST',
            data: { title: title },
            success: function (response) {
                $('#results').html(response);
            },
            error: function () {
                alert('Error generating meta details.');
            }
        });
    });
});
```

### Backend (PHP - `generate_meta.php`)
```php
<?php
$api_key = "YOUR_OPENAI_API_KEY";
$product_title = trim($_POST['title']);

$prompt = "Generate SEO-friendly meta description and meta keywords for the product titled '$product_title'.";

$url = "https://api.openai.com/v1/chat/completions";
$data = json_encode([
    "model" => "gpt-4",
    "messages" => [["role" => "user", "content" => $prompt]],
    "temperature" => 0.7
]);

$headers = [
    "Content-Type: application/json",
    "Authorization: Bearer " . $api_key
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
```

## API Testing with Postman
- **Method:** `POST`
- **URL:** `https://api.openai.com/v1/chat/completions`
- **Headers:**
  ```json
  {
      "Content-Type": "application/json",
      "Authorization": "Bearer YOUR_OPENAI_API_KEY"
  }
  ```
- **Body:**
  ```json
  {
      "model": "gpt-4",
      "messages": [
          {
              "role": "user",
              "content": "Generate SEO-friendly meta description and meta keywords for the product titled 'Wireless Bluetooth Headphones'."
          }
      ],
      "temperature": 0.7
  }
  ```

## Troubleshooting
- If you receive an `invalid_request_error` or `model_not_found` error, ensure you have:
  - A valid OpenAI API key from [OpenAI](https://platform.openai.com/)
  - Selected a supported model (e.g., `gpt-4` or `gpt-3.5-turbo`)
  - Correctly formatted API request

## License
This project is open-source and licensed under the MIT License.

## Contact
For any queries, reach out to [your.email@example.com](mailto:rinki120193@gmail.com).

