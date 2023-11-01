<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
    
  <?php
    require($APP_ROOT . '/components/imports.php')
  ?>
</head>
<body class="search-cocktail">

  <?php
    include($APP_ROOT . '/components/top-nav.php');
    include($APP_ROOT . '/components/header.php');
  ?>
  
  <main id="cocktailPage" class="container main-content">
    <div class="row">
      <div id="searchContainer" class="col-12">
        <div class="search-wrapper">
          <div class="input-wrapper">
            <input id="input" value="" placeholder="Search cocktails..." />
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
        </div>
      </div>
    </div>

    <div id="cocktailContainer" class="row isFetching">
    </div>
  </main>
  
  <?php
    include($APP_ROOT . '/components/footer.php')
  ?>

  <template id="t_cocktail">
    <div class="col-12 col-md-6 col-lg-4">
      <div class="cocktail-card">
        <img src="${ data.thumbnail }" />
        <div class="card-body">
          <h5 class="title">
            ${ data.name }
          </h5>
          <div>
            Glass type: <strong> ${ data.glassType } </strong>
            <br />
            ${ (data.ingredientsHtml ? 'Ingredients:' : '') }
            ${ (data.ingredientsHtml || '') }
          </div>
          <div>
            <u> Preparation: </u> <br />
            ${ data.instructions }
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>

    // Simple templating
    const generateHtml = (html, data={}) => eval('`' + html + '`');

    function generateCocktails(drinks) {
      cocktailContainer.innerHTML = '';

      for (let i = 0; i < drinks.length; ++i) {
        if (drinks[i]?.ingredients && drinks[i].ingredients.length > 0) {
          drinks[i].ingredientsHtml = '<ul>';
          drinks[i].ingredientsHtml += drinks[i].ingredients.map(ingr => (
            '<li>'
            + '<strong>' + ingr.name + '</strong>'
            + (ingr.amount ? ', ' + ingr.amount : '')
            + '</li>'
          )).join('');
          drinks[i].ingredientsHtml += '</ul>';
        }
        const cocktailHtml = generateHtml(t_cocktail.innerHTML, drinks[i]);
        cocktailContainer.insertAdjacentHTML('beforeend', cocktailHtml);
      }
    }

    async function initCocktailSearch(cocktailName) {

      const nameEncoded = encodeURIComponent(cocktailName);
      const drinksUrl = `https://www.thecocktaildb.com/api/json/v1/1/search.php?s=${nameEncoded}`;

      const responseJson = await fetch(drinksUrl).then(res => res.json());
      const drinks = (responseJson.drinks || []).map(drink => {
        let ingredients = [];
        for (let i = 1; i < 16; ++i) {
          const ingKey = `strIngredient${i}`;
          const amtKey = `strMeasure${i}`;
          if (drink[ingKey]) {
            ingredients.push({
              name: drink[ingKey],
              amount: (drink[amtKey] || null),
            });
          }
        }
        return {
          id: drink.idDrink,
          name: drink.strDrink,
          category: drink.strCategory,
          alcoholic: (drink.strAlcoholic === 'Alcoholic'),
          glassType: drink.strGlass,
          instructions: drink.strInstructions,
          thumbnail: drink.strDrinkThumb,
          ingredients,
          // raw: drink,
        }
      });

      generateCocktails(drinks);
      cocktailContainer.classList.remove('isFetching');
    }

    function setup_page() {

      // Turn on hotReload
      hotReload();

      // Setup delayed search
      let delayed_tid = null;
      let prev_search = '';
      input.onkeyup = function() {
        clearTimeout(delayed_tid);
        cocktailContainer.classList.add('isFetching');

        delayed_tid = setTimeout(() => {
          if (input.value !== prev_search) {
            prev_search = input.value;
            initCocktailSearch(input.value);
          }
        }, 1500);
      }

      // Search initially
      initCocktailSearch(input.value);
    }

    setup_page();
  </script>
</body>
</html>