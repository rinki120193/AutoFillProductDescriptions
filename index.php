<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Meta Generator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        label { font-weight: bold; }
        textarea { width: 100%; height: 80px; margin-top: 5px; }
        input, button { width: 100%; padding: 10px; margin-top: 10px; }
    </style>
</head>
<body>

    <h2>AI-Generated Meta Description & Keywords</h2>
    <form id="metaForm">
        <label>Product Title:</label>
        <input type="text" id="product_title" required placeholder="Enter product title...">
        
        <button type="submit">Generate Meta Data</button>
        
        <label>Meta Description:</label>
        <textarea id="meta_description" readonly></textarea>
        
        <label>Meta Keywords:</label>
        <textarea id="meta_keywords" readonly></textarea>
    </form>

    <script>
        $(document).ready(function(){
            $("#metaForm").submit(function(e){
                e.preventDefault();
                var title = $("#product_title").val();

                if(title.trim() === "") {
                    alert("Please enter a product title.");
                    return;
                }

                $.ajax({
                    url: "generate_meta.php",
                    type: "POST",
                    data: { title: title },
                    beforeSend: function(){
                        $("#meta_description").val("Generating...");
                        $("#meta_keywords").val("Generating...");
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        $("#meta_description").val(data.meta_description);
                        $("#meta_keywords").val(data.meta_keywords);
                    },
                    error: function() {
                        alert("Error generating meta data.");
                    }
                });
            });
        });
    </script>

</body>
</html>
