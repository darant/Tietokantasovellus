<?php
//include("/Applications/MAMP/htdocs/loginTest/session.php");
include("/Applications/MAMP/htdocs/loginTest/output.php");

$generator = new Generate();


class Generate {

	var $recipe_names;
	
    function Generate() {
		//$this->generate_r('Margarita');
    }
    
    function f() {
    	echo "lala";
    }
    
    function recipes_table() {
    	global $output;
    	$array = array("Americano", "Apple-Martini", "B-52", "Bacardi", "Banana-Daiquiri",
    	"Black-Russian", "Bloody-Mary", "Brandy-Alexander");
        
        $names = $output->get_recipes();
        
        
   /* $pics;
        for($i = 0; $i<7; $i++) {
        	$pics[$i] = "<a href=\"?recipe=". $array[$i]."\"><img src=\"images/72/". $array[$i] . "-icon.png\"/></a>";
        	echo $pics[$i];
        	
        }/*
		return "<table height=\"300\" width=\"300\" >
				<tr>
				<td><img src=\"images/72/Americano-icon.png\"/></td>
				<td><img src=\"images/72/Americano-icon.png\"/></td>
				<td><img src=\"images/72/Americano-icon.png\"/></td>
				<td><img src=\"images/72/Americano-icon.png\"/></td>
				<td><img src=\"images/72/Americano-icon.png\"/></td>
				<td><img src=\"images/72/Americano-icon.png\"/></td>
				<td><img src=\"images/72/Americano-icon.png\"/></td>
				<td><img src=\"images/72/Americano-icon.png\"/></td>
				</tr>    
    	</table>";
*/		$a = $this->arrayToImg($names, "recipe");
    
    	return $this->ImgToTable($a, 64);
    }
    
    //This function generates  recipe
    function recipe($name) {
        global $output;
        $result = $output->recipe_name($name);
        $rivi = $result->fetch();
        
        //This will get ingredient in a recipe later
        $recipe_ingredients = $output->recipe_ingredient($name);
        
        $list = $this->arrayToHTML($recipe_ingredients, "ingredient");
       
        //Search for a picture in a file
        $imgname = str_replace(" ", "-", $name);
        $img = "<img src=\"images/Recipes/". $imgname ."-icon.png\">";
        //return the final info
        return "<h3>".$rivi["name"]. "</h3><br>". $img . "<br><br>" . $rivi['description'] . "<br><br><h3>Ingredients:</h3><br>" . $list;
    }
    
    function ingredient($name) {
        global $output;
        $result = $output->ingredient_name($name);
        $rivi = $result->fetch();
        return "<h3>". $rivi["name"]. "</h3><br>" . $rivi['description'];
    }

    
    function all_recipes() {
	        global $output;
	        $recipes = $output->get_recipes();

			return $this->arrayToHTML($recipes, "recipe");
    }
    
     function all_ingredients() {
    	    global $output;
	        $ingredients = $output->get_ingredients();
	        
	        return $this->arraytoHTML($ingredients, "ingredient");
    }
    
    function all_categories() {
    	global $output;
        $categories = $output->get_categories();
        
        return $this->arraytoHTML($categories, "category");
    }
    
    function arrayToHTML($array, $urlitem) {
        $str;
	    $i=0;
			
	  	while($item = $array->fetch()) {   
	  		$str[$i] = "<a href=\"?".$urlitem."=".$item["name"]."\"><p>".$item["name"]. "</p></a>";
	 		$i++;	
  		}
	  		
		$str = join("", $str);
        return $str;

    }
    
    function arrayToImg($array, $urlitem) {
    	$str;
	    $i=0;$name;
			
	  	while($item = $array->fetch()) { 
	  		$a = str_replace(" ", "-", $item["name"]);  
	  		$str[$i] = "<a href=\"?recipe=". $item["name"] ."\"><img src=\"images/72/". $a . "-icon.png\"/></a>";
	  		$this->recipe_names[$i] = $item["name"];
	 		$i++;	
  		}
  		//$this->recipe_name = $name;
  		//$str = join("", $str);
       return $str;
     }
     
     function ImgToTable($str, $i) { 
  		//echo $i;
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