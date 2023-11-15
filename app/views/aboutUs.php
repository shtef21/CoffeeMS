<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./src/images/favicon.ico" type="image/x-icon">
    <title>CoffeeMS - About us</title>

    <?php
    require($APP_ROOT . '/components/imports.php')
        ?>
</head>

<body class="about-us">

    <?php
    include($APP_ROOT . '/components/top-nav.php');
    include($APP_ROOT . '/components/header.php');
    ?>

    <!-- Generated in JS -->
    <div class="site-nav blog-nav">
        <a>&nbsp;</a>
    </div>

    <!-- Generated in JS -->
    <div class="main-content">
        <div class="blog about-us-dest">
        </div>
    </div>


    <footer class="site-footer">
        &copy; 2023 Coffee MS
    </footer>

    <script>

        function generateNav() {

            let blogNav = document.querySelector('.site-nav.blog-nav');
            blogNav.innerHTML = '';
            let titles = document.querySelectorAll('.main-content .blog > h1, .main-content .blog > h2');

            for (let i = 0; i < titles.length; ++i) {
                let titleEl = titles[i];
                titleEl.id = (titleEl.id || 'title') + '-' + i;

                let anchor = document.createElement('a');
                anchor.innerText = titleEl.innerText;
                anchor.href = '#' + titleEl.id;
                blogNav.appendChild(anchor);
            }
        }

        async function fetchBlog() {

            let blogContainer = document.querySelector('.about-us-dest');
            let data = await fetch('/coffeems/app/src/data/aboutUs.json')
                .then((res) => res.json());
            blogContainer.innerHTML = data.aboutUs || '<h2>Blog not found</h2>';

            generateNav();
        }
        fetchBlog();

    </script>

</body>

</html>