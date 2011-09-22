<?php
//include("/Applications/MAMP/htdocs/loginTest/database.php");
$output = new Output;

class Output {

    //var $database;
    
	function Output() {
	}
	
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
	
	function recipe_category() {}
	
	function recipe_alcohol() {}
	
	
	
	function ingredient_type() {}
	
	
	
	
	
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