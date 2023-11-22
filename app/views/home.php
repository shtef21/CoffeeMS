<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee MS - Home</title>

    <?php
    require($APP_ROOT . '/components/imports.php')
    ?>
</head>

<body class="home">

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <div class="modal-header">
            <span class="close">&times;</span>
        </div>

        <!-- Modal content -->
        <div class="modal-content" style="width:50%;">
            <form>
                <div class="form-group">
                    <label for="new_item_name" class="mb-1">Item Name</label>
                    <input type="text" class="form-control mb-3" id="new_item_name" placeholder="Insert item name">
                </div>
                <div class="form-group">
                    <label for="new_item_price" class="mb-1">Item Price</label>
                    <input type="number" class="form-control mb-3" id="new_item_price" placeholder="Insert item price">
                </div>
                <button type="button" class="btn btn-primary" id="add_item_button" onclick="add_edit()">Add</button>
            </form>
        </div>

    </div>

    <?php
    include($APP_ROOT . '/components/top-nav.php');
    include($APP_ROOT . '/components/header.php');
    ?>

    <!-- Generated in JS -->
    <div class="site-nav drink-nav">
        <a>&nbsp;</a>
    </div>

    <!-- Generated in JS -->
    <div class="main-content drink-menu">
    </div>

    <?php
    include($APP_ROOT . '/components/footer.php');

    // Database configuration
    $server_name = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'coffeems';

    // Create a database connection
    $mysqli = new mysqli($server_name, $username, $password, $dbname);

    // Check the connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Query to fetch data using a prepared statement
    $fetchItems = "SELECT * FROM items;";
    $fetchCategories = "SELECT * FROM categories;";

    // Prepare the statement
    $stmt = $mysqli->prepare($fetchItems);
    if ($stmt) {

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result) {
            $items = array();

            // Fetch data and store it in an array
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        } else {
            echo "No results found.";
        }
    }

    $stmt = $mysqli->prepare($fetchCategories);
    if ($stmt) {
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result) {
            $categories = array();

            // Fetch data and store it in an array
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        } else {
            echo "No results found.";
        }
    }

    $stmt->close();
    $mysqli->close();


    ?>

    <script>
        document.querySelector('.drink-menu').innerHTML = '';
        on_load();

        async function on_load() {

            let user_role = <?php echo json_encode($_SESSION['role']) ?>;
            let items = await fetch_items();
            let categories = await fetch_categories();

            generate_menus(items, categories, user_role);

        }

        // Log result of a fetch response as string
        async function log_response(res) {
            console.log(await res.text());
        }

        function generate_menus(items, categories, user_role) {

            let siteNav = document.querySelector('.drink-nav');
            let menuContainer = document.querySelector('.drink-menu');

            siteNav.innerHTML = '';

            for (let category of categories) {

                // Generate table
                let table = document.createElement('table');
                table.id = category.category_id;

                let tableHead = '' +
                    '<tr><th colspan="' +
                    (user_role > 1 ? 4 : 2) + '">' +
                    '<i class="' + category.category_icon + '"></i> ' +
                    category.category_name;
                if (user_role > 1) {
                    tableHead += '<button class="btn bg-brown1 add-item-button" onClick="openModal(' + category.category_id + ', true )"> + </button>'
                }
                tableHead += '</th></tr>';
                table.insertAdjacentHTML('beforeend', tableHead);

                for (let item of items) {
                    if (item.category_id === category.category_id) {
                        let priceRounded = Number(item.item_price).toFixed(2);
                        let tableItem = '' +
                            '<tr><td>' + item.item_name + '</td>' +
                            '<td>' + priceRounded + ' EUR' + '</td>';
                        if (user_role > 1) {
                            tableItem += '<td> <button class="btn bg-brown1" style="border:1px solid black" onClick="delete_item(' + item.item_id + ')"> Delete </button> </td>'
                            tableItem += '<td> <button class="btn bg-brown1" style="border:1px solid black" onClick="openModal(' + item.item_id + ', false)"> Edit </button> </td>'
                        }
                        tableItem += '</tr>';
                        table.insertAdjacentHTML('beforeend', tableItem);
                    }

                }

                menuContainer.insertAdjacentElement('beforeend', table);

                // Generate navigation
                let navButton = document.createElement('a');
                navButton.innerText = category.category_name;
                navButton.href = '#' + category.category_id;

                siteNav.appendChild(navButton);
            }
        }

        async function fetch_items() {
            let items;
            await fetch('/CoffeeMS/api/items.php')
                .then(response => response.text())
                .then(data => {
                    items = JSON.parse(data);
                    // pre_get_items.value = JSON.stringify(data);
                })
                .catch(error => {
                    items = 'Error: ' + error;
                })
            return items;
        }

        async function fetch_categories() {
            let categories;
            await fetch('/CoffeeMS/api/categories.php')
                .then(response => response.text())
                .then(data => {
                    categories = JSON.parse(data);
                    // pre_get_items.value = JSON.stringify(data);
                })
                .catch(error => {
                    categories = 'Error: ' + error;
                })
            return categories;
        }

        function add_edit() {

            let isAddItem = document.getElementById("add_item_button").dataset.add_item;

            if (isAddItem === "true") {
                add_item();
            } else {
                edit_item();
            }

        }

        async function delete_item(item_id) {

            await fetch('/CoffeeMS/api/items.php?id=' + item_id, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${CMS_TOKEN}`,
                    }
                })
                .then(response => {
                    if (response.ok) {
                        location.reload();
                    }
                    else {
                        console.log('API did not return HTTP OK');
                        log_response(response);
                    }
                })
                .catch(error => {
                    console.log('Error:', error);
                });
        }

        async function add_item() {

            let category_id = document.getElementById("add_item_button").dataset.id;
            let item_name = document.getElementById("new_item_name").value;
            let item_price = document.getElementById("new_item_price").value;

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
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${CMS_TOKEN}`,
                    }
                })
                .then(response => {
                    if (response.ok) {
                        location.reload();
                    }
                    else {
                        console.log('API did not return HTTP OK');
                        log_response(response);
                    }
                })
                .catch(error => {
                    console.log('Error:', error);
                });
        }

        async function edit_item() {
            let item_id = document.getElementById("add_item_button").dataset.id;
            let item_name = document.getElementById("new_item_name").value;
            let item_price = document.getElementById("new_item_price").value;

            const data = {
                item_id,
                item_name,
                item_price
            };

            // Send a PUT request to your API
            fetch('/CoffeeMS/api/items.php', {
                    method: 'PUT',
                    body: JSON.stringify(data),
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${CMS_TOKEN}`,
                    }
                })
                .then(response => {
                    if (response.ok) {
                        location.reload();
                    }
                    else {
                        console.log('API did not return HTTP OK');
                        log_response(response);
                    }
                })
                .catch(error => {
                    console.log('Error:', error);
                });
        }

        function openModal(id, add_item) {

            var modal = document.getElementById("myModal");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            let btn = document.getElementById("add_item_button");
            btn.dataset.id = id;
            btn.dataset.add_item = add_item;

            modal.style.display = "block";

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    </script>

</body>



</html>