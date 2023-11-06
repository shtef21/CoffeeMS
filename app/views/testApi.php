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

    <div class="container mt-4">
        <h1>Get items</h1>
        <button type="button" id="getItemsButton">Get item</button>
        <div>
            <textarea id="pre_get_items" style="width: 100%; min-height: 150px; resize: vertical;"></textarea>
        </div>
    </div>

    <div class="container mt-4">
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
    
        <div>
            <textarea id="pre_post_items" style="width: 100%; min-height: 150px; resize: vertical;"></textarea>
        </div>
    </div>

    <script>
        hotReload('slow');

        getItemsButton.onclick = function() {
            // Send a POST request to your API
            fetch('/CoffeeMS/api/items.php')
            .then(response => response.text())
            .then(data => {
                pre_get_items.value = data;
                // pre_get_items.value = JSON.stringify(data);
            })
            .catch(error => {
                pre_get_items.value = 'Error: ' + error;
            });
        }
        addItemButton.onclick = function() {
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
            fetch('/CoffeeMS/api/items.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.text())
            .then(data => {
                pre_post_items.value = data;
            })
            .catch(error => {
                pre_post_items.value = 'Error: ' + error;
            });
        };
    </script>
</body>
</html>