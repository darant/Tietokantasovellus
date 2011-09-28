<?php
//include("/Applications/MAMP/htdocs/loginTest/session.php");
include("/Applications/MAMP/htdocs/loginTest/output.php");

$generator = new Generate();


class Generate {

	var $recipe_names;
	
    function Generate() {
    }
    
    function recipes_table() {
    	global $output;
        $names = $output->get_recipes();
        
 		$a = $this->arrayToImg($names, "recipe");
    
    	return $this->ImgToTable($a, 64);
    }
    
    //This function generates  recipe
    function recipe($name) {
        global $output;
        $result = $output->recipe_name($name);
        $rivi = $result->fetch();
        
        //This will get ingredient in a recipe later
        $recipe_ingredients = $output->recipe_ingredient($name);
        
        $list = $this->ingredientsToHTML($recipe_ingredients, $name, "ingredient");
       
        //Search for a picture in a file
        $imgname = str_replace(" ", "-", $name);
        $img = "<img src=\"images/Recipes/". $imgname ."-icon.png\">";
        
        //Change category id into a string
        $category_name = $output->categoryIdToStr($rivi['category_id']);
        $catname = $category_name->fetch();
     
        //return the final info
        return "<h2>".$rivi["name"]. "</h2><br>". $img . "<br><br><h3>Method:</h3><br>" . $rivi['description'] . "<br><br><h3>Ingredients:</h3>" . $list . 
        "<br><br><h3>Category:</h3><br><a href=\"page.php?category=".$catname['name']."\">" . $catname['name'] ."</a>";
    }
    
    function ingredient($name) {
        global $output;
        $result = $output->ingredient_name($name);
        $rivi = $result->fetch();
        return "<h3>". $rivi["name"]. "</h3><br>" . $rivi['description'];
    }
    
    function category($id) {
    	global $output;
    	$categories = $output->list_category($id);
        return $this->arrayToHTML("Recipes in this category:", $categories, "recipe");
    }

//need to fix that cause suggestions might have same names
	function suggestion($name) {
		global $output;
        $result = $output->suggestion($name);
        $rivi = $result->fetch();
        //echo $rivi['name'];
        return "<h3>". $rivi["name"]. "</h3><br>" .$rivi['ing1']. "<br>" . $rivi['ing2'] . "<br>" . $rivi['ing3'] . 
        "<br>" .$rivi['ing4']. "<br>" . $rivi['ing5'] . "<br>" . $rivi['ing6'] . "<br>" . $rivi['category'];
	}
    
    function all_recipes() {
	        global $output;
	        $recipes = $output->get_recipes();
			return $this->arrayToHTML("Recipes:", $recipes, "recipe");
    }
    
    function all_ingredients() {
    	    global $output;
	        $ingredients = $output->get_ingredients();        
	        return $this->arrayToHTML("Ingredients:", $ingredients, "ingredient");
    }
    
    function all_categories() {
    	global $output;
        $categories = $output->get_categories();     
        return $this->arrayToHTML("Categories:", $categories, "category");
    }
    
    /**
    * Is called when admin checks a list of normal users in the admin center, when deleting.
    */
    function standard_users() {
    	global $output;
    	$users = $output->get_standard_users();
    	return $this->arrayToHTML("Delete user:", $users, "deleteuser");
    }
    
    /**
    *Is called when admin checks a list of normal users in the admin center, when upgradingg.
    */
    function users_list_upgrade() {
    	global $output;
    	$users = $output->get_standard_users();
    	return $this->arrayToHTML("Upgrade user:", $users, "upgrade_user");
    }
    
    function upgrade_user($name) {
    	global $output;
    	$output->upgrade_user($name);
    	return "User $name is upgraded!";
    }
    
    function delete_user($name) {
    	global $output;
    	$output->delete_user($name);
    	return "User $name is deleted!";
    }
    
    function recipes_ingredients(){
    	global $output;
	    $ingredients = $output->get_ingredients();
    	
    	$str;
	    $i=0;
		
	  	while($item = $ingredients->fetch()) { 
	  		$str[$i] = "<a href=\"page.php?recipes_containing=".$item["name"]."\"><p>".$item["name"]. "</p></a>";
	 		$i++;	
  		}
	  		
		$str = join("", $str);
        return "<h2>Ingredients:</h2><br>" . $str;
    }
    
    //Search for recipes containing ingredient
    function recipes_containing($ingredient){
    	global $output;
	    $ingredients = $output->list_recipes_containing($ingredient);
	    
	    return $this->arrayToHTML("<h3>$ingredient is used in:</h3>", $ingredients, "recipe");
    }
    
    function list_suggestions() {
    	global $output;
    	$suggestions = $output->get_suggestions();
    	
    	return $this->arrayToHTML("Suggested recipes:", $suggestions, "viewsuggestion");
    }
    
    //Return random recipe from recipes table
    function get_random_recipe() {
    	global $output;
    	$rows = $output->count_rows("recipes");
    	$max = $rows->fetch();
    	
    	//generating random number based on current amount of recipes in database
    	$recipe_num = rand( 1 , $max[0]);
    	$recipe = $output->recipe_by_id($recipe_num);
    	$recipe = $recipe->fetch();
    	
    	//convert name to recipe html
    	return $this->recipe($recipe['name']);
    }
    
    function arrayToHTML($header, $array, $urlitem) {
        $str;
	    $i=0;
		
	  	while($item = $array->fetch()) { 
	  		$str[$i] = "<a href=\"page.php?".$urlitem."=".$item["name"]."\"><p>".$item["name"]. "</p></a>";
	 		$i++;	
  		}
	  		
		$str = join("", $str);
		$header = "<h2>".$header."</h2><br>";
		
        return $header.$str;

    }
    
     function ingredientsToHTML($array, $recipe_name, $urlitem) {
     	global $output;
        $str;
	    $i=0;
	    
		
	  	while($item = $array->fetch()) { 
	  		$amount = $output->get_ingredient_amount($recipe_name, $item["name"]);
	  		$amount = $amount->fetch();
	  		$str[$i] =  "<a href=\"page.php?".$urlitem."=" .$item["name"]."\"><p>" . $amount['name'] ." ".$item["name"]. "</p></a>";
	 		$i++;	
  		}
	  		
		$str = join("", $str);
		$header = "<h2>".$header."</h2><br>";
		
        return $header.$str;

    }
    
    function arrayToImg($array, $urlitem) {
    	$str;
	    $i=0;$name;
		
	  	while($item = $array->fetch()) { 
	  		$a = str_replace(" ", "-", $item["name"]);  
	  		$str[$i] = "<a href=\"page.php?recipe=". $item["name"] ."\"><img src=\"images/72/". $a . "-icon.png\"/></a>";
	  		$this->recipe_names[$i] = $item["name"];
	 		$i++;	
  		}

        return $str;
     }
     
     function ImgToTable($str, $i) { 
   		$tableContent;
  		$tableStart = "<table height=\"300\" width=\"300\" ><tr>";
	    for($k=0; $k<$i; $k++) {	    	
	    	if(($k%8) == 0) {
	    	    $tableCell[$k-1] = "</tr>";
	    		$tableCell[$k] = "<tr>";
	    	}
	    	$tableCell[$k] = $tableCell[$k] . "<td>". $str[$k] . "</td>";
	    	
	    	$tableContent = $tableContent . $tableCell[$k];
	    	
	    	if(($k%8 == 7)) {
	    	    $tableContent = $tableContent . "<tr>";
	    	    $y=$k-7;
	    	    for($n = $k; $n >= $k-7; $n--){
	    	    $tableContent = $tableContent . "<td><p>".$this->recipe_names[$y]."</p></td>";
	    	    $y++;

	    	    }
	    		$tableContent = $tableContent . "</tr>";
	    	}
	    	

	    }
	    $tableEnd = "</tr></table>";
	    
	    $table = $tableStart . $tableContent . $tableEnd;	    
	    return $table;
    }

};


?>