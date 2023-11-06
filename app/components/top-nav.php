<div class="site-nav">
    <a href="?p=home">Home</a>
    <a href="?p=about_us">About us</a>

    <?php
    // if($_SESSION["role"] >= 2) {
    //     echo '<a href="?p=admin">Admin</a>';
    // }
    if ($_SESSION["role"] >= 1) {
        echo '<a href="?p=search_drink">Find a cocktail</a>';
    }
    if ($_SESSION["logged_in"]) {
        echo '<a href="?p=logout" class="disabled">Log out (' . $_SESSION["username"] . ')</a>';
    } else {
        echo '<a href="?p=login">Login</a>' . '<a href="?p=register">Register</a>';
    }
    ?>

    <a href="?p=testApi">Test out the API</a>

</div>