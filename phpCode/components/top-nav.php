<div class="site-nav">
    <a href="./">Home</a>
    <a href="./login.php">Login</a>
    <a href="./register.html">Register</a>
    <a href="./aboutUs.html">About us</a>
    <?php 
    echo $_SESSION["role"];
    if($_SESSION["role"] >= 2) {
        echo '<a href="./admin.php">Admin</a>';
    }
    if($_SESSION["role"] >= 1) {
        echo '<a href="./drinkApiTest.html">Find a cocktail</a>';
    }
    if($_SESSION["role"] >= 1) {
        echo '<a href="./logout.php" class="disabled">Log out</a>';
    }
    ?>
    
</div>