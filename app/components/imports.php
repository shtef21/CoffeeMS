<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
crossorigin="anonymous"></script>

<!-- Font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- Local styles -->
<link rel="stylesheet" href="<?php echo $ENDPOINTS['main.css'] ?>">

<script>
    <?php
        // Expose some variables to frontend
    ?>
    var ENDPOINTS = {
        "drink_menu": "<?php echo $ENDPOINTS['drink_menu'] ?>"
    };

    // Turn on hot reload
    function hotReload(speed) {

        let timeout = 1000;

        if (speed === 'fast') {
            timeout = 500;
        }
        else if (speed === 'slow') {
            timeout = 2500;
        }

        let prevHtml = null;
        let iid = null;

        iid = setInterval(async () => {
            let currHtml = await fetch(window.location.href)
                .then(res => res.text());
            if (!prevHtml) {
                prevHtml = currHtml;
            }
            else if (prevHtml !== currHtml) {
                clearInterval(iid);
                console.log('%c hotReload: Change detected. Reloading in 1s...', 'color: red;');
                setTimeout(() => window.location.reload(), timeout);
            }
        }, 1000);
    }
</script>