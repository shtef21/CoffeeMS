<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
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
</head>
<body>
  
  <div id="searchContainer">
    <input id="input" value="margarita" />
    <input id="submit" type="submit" value="Search" />
  </div>
  <textarea id="output"></textarea>
  
  <script>
    async function testApi(cocktailName) {

      output.value = 'Sending request...';

      const nameEncoded = encodeURIComponent(cocktailName);
      const drinksUrl = `https://www.thecocktaildb.com/api/json/v1/1/search.php?s=${nameEncoded}`;

      const responseJson = await fetch(drinksUrl).then(res => res.json());
      const drinks = responseJson.drinks.map(drink => {
        
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
      output.value = JSON.stringify(drinks, null, 2);
    }
    submit.onclick = () => testApi(input.value);
    submit.click();
  </script>
</body>
</html>