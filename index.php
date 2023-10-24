<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <?php
      session_start();
      require('./phpCode/components/imports.html')
    ?>
</head>
<body class="home">

  <?php
    include('./phpCode/components/top-nav.php');
    include('./phpCode/components/header.html');
  ?>

  <!-- Generated in JS -->
  <div class="site-nav drink-nav">
    <a>&nbsp;</a>
  </div>

  <!-- Generated in JS -->
  <div class="main-content drink-menu">
  </div>
  
  <?php
    include('./phpCode/components/footer.html')
  ?>

  <script>
    
    async function generateMenus() {

      let siteNav = document.querySelector('.drink-nav');
      let menuContainer = document.querySelector('.drink-menu');
      let menus = await fetch('./src/data/drinkMenu.json')
        .then((res) => res.json());
      siteNav.innerHTML = '';

      for (let menu of menus) {

        // Generate table
        let table = document.createElement('table');
        table.id = menu.categoryId;

        let tableHead = ''
          + '<tr><th colspan="2">'
          + '<i class="' + menu.icon + '"></i> '
          + menu.category
          + '</th></tr>';
        table.insertAdjacentHTML('beforeend', tableHead);

        for (let item of menu.items) {
          let priceRounded = item.price.toFixed(2);
          let tableItem = ''
            + '<tr><td>' + item.name + '</td>'
            + '<td>' + priceRounded + ' EUR' + '</td></tr>';
          table.insertAdjacentHTML('beforeend', tableItem);
        }

        menuContainer.insertAdjacentElement('beforeend', table);

        // Generate navigation
        let navButton = document.createElement('a');
        navButton.innerText = menu.category;
        navButton.href = '#' + menu.categoryId;
        
        siteNav.appendChild(navButton);
      }
    }

    document.querySelector('.drink-menu').innerHTML = '';
    generateMenus();

  </script>

</body>
</html>