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

            // Close the prepared statement and the database connection
    
            // Return data as JSON
            //echo json_encode($items);
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

        async function generateMenus() {

            let categories = <?php echo json_encode($categories); ?>;
            let items = <?php echo json_encode($items); ?>;
            let user_role = <?php echo json_encode($_SESSION['role']) ?>;

            let siteNav = document.querySelector('.drink-nav');
            let menuContainer = document.querySelector('.drink-menu');
            // let menus = await fetch(ENDPOINTS['drink_menu'])
            //     .then((res) => res.json());
            siteNav.innerHTML = '';

            debugger;
            for (let category of categories) {

                // Generate table
                let table = document.createElement('table');
                table.id = category.category_id;

                let tableHead = ''
                    + '<tr><th colspan="'
                    + (user_role > 1 ? 3 : 2) + '">'
                    + '<i class="' + category.category_icon + '"></i> '
                    + category.category_name
                    + '</th></tr>';
                table.insertAdjacentHTML('beforeend', tableHead);

                for (let item of items) {
                    if (item.category_id === category.category_id) {
                        let priceRounded = Number(item.item_price).toFixed(2);
                        let tableItem = ''
                            + '<tr><td>' + item.item_name + '</td>'
                            + '<td>' + priceRounded + ' EUR' + '</td>';
                        if (user_role > 1) {
                            tableItem += '<td> <button class="btn bg-brown1" style="border:1px solid black" onClick="deleteItem(' + item.item_id + ')"> Delete </button> </td>'
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

        document.querySelector('.drink-menu').innerHTML = '';
        generateMenus();

        async function deleteItem(item_id) {

            console.log(item_id);

            let url = 'index.php'

            await fetch(url, {
                method: "POST", // *GET, POST, PUT, DELETE, etc.
                mode: "cors", // no-cors, *cors, same-origin
                cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
                credentials: "same-origin", // include, *same-origin, omit
                headers: {
                    "Content-Type": "application/json",
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: "follow", // manual, *follow, error
                referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify({ functionName: 'delete_item', id: item_id }) // body data type must match "Content-Type" header
            });
            //location.reload();

        }

    </script>

</body>

</html>