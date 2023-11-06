<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./src/images/favicon.ico" type="image/x-icon">
    <title>Coffee MS - Test api</title>

    <?php
    require($APP_ROOT . '/components/imports.php')
    ?>
</head>
<body class="test">

    
    <h1>Add Item</h1>
    <form id="addItemForm">
        <label for="category_id">Category ID:</label>
        <input type="text" id="category_id" name="category_id" required><br>

        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" required><br>

        <label for="item_price">Item Price:</label>
        <input type="text" id="item_price" name="item_price" required><br>

        <button type="button" id="addItemButton">Add Item</button>
    </form>

    <div id="response"></div>

    <script>
        hotReload();

        document.getElementById("addItemButton").addEventListener("click", function() {
            // Get form data
            const category_id = document.getElementById("category_id").value;
            const item_name = document.getElementById("item_name").value;
            const item_price = document.getElementById("item_price").value;

            // Create a JSON object with the data
            const data = {
                category_id: category_id,
                item_name: item_name,
                item_price: item_price
            };

            // Send a POST request to your API
            fetch('api.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById("response").textContent = JSON.stringify(data);
            })
            .catch(error => {
                document.getElementById("response").textContent = 'Error: ' + error;
            });
        });
    </script>
</body>
</html>