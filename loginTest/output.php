<?php
//include("/Applications/MAMP/htdocs/loginTest/database.php");
$output = new Output;

class Output {

    //var $database;
    
	function Output() {
	}
	
	//next three can be united
	function get_recipes() {
		global $database;
		return $database->query("SELECT * FROM recipes");
	}
	
	function get_ingredients() {
		global $database;
		return $database->query("SELECT * FROM ingredients");
	}
	
	function get_categories() {
		global $database;
		return $database->query("SELECT * FROM categories");
	}
	
	/*
function members() {
	    global $database;
		return $database->query("SELECT * FROM members");
	}
*/
	
	function recipe_name($name) {
		global $database;
	    return $database->query("SELECT * FROM recipes WHERE name='$name'");
	}
	
	function ingredient_name($name) {
		global $database;
		return $database->query("SELECT * FROM ingredients WHERE name='$name'");
	}
	
	function recipe_ingredient($name) {
		global $database;
		return $database->query("SELECT ingredients.name FROM ingredients, recipes_ingredients, recipes  WHERE recipes.name = '$name' AND recipes.id=recipes_ingredients.recipe_id AND ingredients.id=recipes_ingredients.ingredient_id");
	}
	
	function list_category($id) {
		global $database;
		return $database->query("Select recipes.name FROM recipes, categories WHERE recipes.category_id = categories.id and categories.name = 		'$id'");
	}
	
	function get_standard_users() {
		global $database;
		return $database->query("Select * from users where access_level < 3");
	}
	
	function upgrade_user($name) {
		global $database;
		$database->query("UPDATE users SET access_level = 2 WHERE name = '$name'");
	}
	
	function delete_user($name) {
		global $database;
		$database->query("DELETE FROM users WHERE name = '$name'");
	}
	
	function recipe_category() {}
	
	function recipe_alcohol() {}
	
	
	
	function ingredient_type() {}
	
	function list_recipes_containing($ingredient) {
		global $database;
		return $database->query("Select recipes.name FROM recipes, ingredients, recipes_ingredients WHERE ingredients.name = '$ingredient' AND recipes.id=recipes_ingredients.recipe_id AND ingredients.id=recipes_ingredients.ingredient_id");
	}
	
	function addSuggestion($recipename, $ing1, $ing2, $ing3, $ing4, $ing5, $ing6, $category) {
		global $database;
		$database->query("Insert into suggestions(name, ing1, ing2, ing3, ing4, ing5, ing6, category) values
		(\"$recipename\", \"$ing1\", \"$ing2\", \"$ing3\", \"$ing4\", \"$ing5\", \"$ing6\", \"$category\")");
	}
	
	function suggestion($name) {
		global $database;
		return $database->query("Select * from suggestions where name='$name'");
	}
	
	function get_suggestions() {
		global $database;
		return $database->query("Select * from suggestions");
	}
	
	function categoryIdToStr($id){
		global $database;
		return $database->query("Select name from categories where id = '$id'");
	}
	
	//is used to determine how much of each ingredient is in recipe
	function get_ingredient_amount($recipe_name, $ing_name) {
		global $database;
		return $database->query("Select amounts.name from amounts, recipes_ingredients, recipes, ingredients where recipes.id = recipes_ingredients.recipe_id and amounts.id = recipes_ingredients.amount_id and ingredients.id = recipes_ingredients.ingredient_id and recipes.name = '$recipe_name' and ingredients.name = '$ing_name'");
	}
	
	//Count amount of rows in table
	function count_rows($table_name) {
		global $database;
		return $database->query("Select count(id) from $table_name");
	}
	
	//Get recipe by its id number
	function recipe_by_id($id) {
		global $database;
		return $database->query("Select name from recipes where id=$id");	
	}
	
	//Search uses this to see if user is searching for a recipe
	function table_contains($table, $word){
		global $database;
        $recipe = $database->query("Select * from $table where name = '$word'");	
		$rivi = $recipe->fetch();
		//echo $rivi['name'];
		
		if($rivi == null) {
			return 0;
		} else {
			return 1;
		}
		//return "";
		//return "abra";
	}
	
	function toStr(){
		return "asda";
	}

};

/**
<p> Wikipedia: </p>
            	<p>An alcoholic beverage is a drink containing ethanol, commonly known as alcohol. Alcoholic beverages are divided into three general classes:</p>
            	<ul> 
            	<li>beers</li> 					
            	<li>wines</li>
            	<li>spirits</li>
            	</ul>
            	<p>They are legally consumed in most countries, and over 100 countries have laws regulating their production, sale, and consumption. 									In particular, such laws specify the minimum age at which a person may legally buy or drink them. This minimum age varies between 16 and 25 years, 						depending upon the country and the type of drink. Most nations set it at 18 years of age.</p>

*/
?>