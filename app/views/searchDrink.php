<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    #cocktail-container {
      margin: 50px auto;
      width: 100%;
      max-width: 1200px;
    }
    #output {
      width: 100%;
      min-height: 250px;
      resize: vertical;
    }
    #searchContainer {
      display: flex;
      justify-content: center;
      margin-bottom: 15px;
    }
    #input {
      width: 75%;
    }
    #submit {
      width: 20%;
    }
  </style>
    
  <?php
    require($APP_ROOT . '/components/imports.php')
  ?>
</head>
<body>

  <?php
    include($APP_ROOT . '/components/top-nav.php');
    include($APP_ROOT . '/components/header.php');
  ?>
  
  <main id="cocktail-container">
    <p>
      Be easy on us, this page is still WIP!
    </p>
    <div id="searchContainer">
      <input id="input" value="" placeholder="Start typing..." />
      <input id="submit" type="submit" value="Search" />
    </div>
    <textarea id="output" readonly></textarea>
  </main>
  
  <?php
    include($APP_ROOT . '/components/footer.php')
  ?>
  
  <script>

    async function testApi(cocktailName) {

      // output.value = 'Sending request...';

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

      let prettyOutput = {
        input: cocktailName,
        items_fetched: drinks.length,
        drink_names: drinks.map(d => d.name),
        data: drinks,
      };
      output.value = JSON.stringify(prettyOutput, null, 2);
    }

    function setup_page() {
      
      submit.onclick = () => testApi(input.value);
      submit.click();

      // Setup delayed search
      let delayed_tid = null;
      let prev_search = '';
      input.onkeyup = function() {
        output.value = 'Typing...';
        clearTimeout(delayed_tid);

        delayed_tid = setTimeout(() => {
          if (input.value !== prev_search) {
            prev_search = input.value;
            submit.click();
          }
        }, 1500);
      }
    }

    setup_page();
  </script>
</body>
</html>