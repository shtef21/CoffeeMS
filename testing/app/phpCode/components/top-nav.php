<div class="site-nav">
    <a href="<?php echo $ENDPOINTS['home'] ?>">Home</a>
    <a href="<?php echo $ENDPOINTS['login'] ?>">Login</a>
    <a href="<?php echo $ENDPOINTS['register'] ?>">Register</a>
    <a href="<?php echo $ENDPOINTS['about_us'] ?>">About us</a>

    <?php
    if($_SESSION["role"] >= 2) {
        echo '<a href="' . $ENDPOINTS['admin'] . '">Admin</a>';
    }
    if($_SESSION["role"] >= 1) {
        echo '<a href="' . $ENDPOINTS['search_drink'] . '">Find a cocktail</a>';
    }
    if($_SESSION["role"] >= 1) {
        echo '<a href="' . $ENDPOINTS['log_out'] . '" class="disabled">Log out</a>';
    }
    ?>
    
</div>