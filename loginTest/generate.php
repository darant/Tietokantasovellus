<?php
//include("/Applications/MAMP/htdocs/loginTest/session.php");
include("/Applications/MAMP/htdocs/loginTest/output.php");

$generator = new Generate();


class Generate {

    function Generate() {
		//$this->generate_r('Margarita');
    }
    
    function f() {
    	echo "lala";
    }
    
    //This function generates  recipe
    function recipe($name) {
        global $output;
        $result = $output->recipe_name($name);
        $rivi = $result->fetch();
        //This will get ingredient in a recipe later
       // $ing = $output->get_ingredients($name);
       
        //Search for a picture in a file
        $imgname = str_ireplace(" ", "-", $name);
        $img = "<img src=\"images/Recipes/". $imgname ."-icon.png\">";
        //return the final info
        return "<h3>".$rivi["name"]. "</h3><br>". $img . "<br><br>" . $rivi['description'];
    }
    
    function ingredient($name) {
        global $output;
        $result = $output->ingredient_name($name);
        $rivi = $result->fetch();
        return "<h3>". $rivi["name"]. "</h3><br>" . $rivi['description'];
    }

    
    function all_recipes() {
	      // global $session;
	        global $output;
	        //echo $name;
	        //Search for a recipe with a certain name in database
	        $recipe = $output->get_recipes();
	        $outstr;
			$i=0;
			while($rivi = $recipe->fetch()) {   
	  			$outstr[$i] = "<a href=\"?recipe=".$rivi["name"]."\"><p>".$rivi["name"]. "</p></a>";
				$i++;	
	  		}
	  		
			$outp = join("", $outstr);
			
	        return $outp;
    }
    
     function all_ingredients() {
    	    global $output;
	        $ingredients = $output->get_ingredients();
	        $outstr;
			$i=0;
			while($ingredient = $ingredients->fetch()) {   
	  			$outstr[$i] = "<a href=\"?ingredient=".$ingredient["name"]."\" name=\"".$ingredient["name"]."\"><p>".$ingredient["name"]. "</p></a>";
				$i++;	
	  		}
	  		
			$outp = join("", $outstr);
			
	        return $outp;
    }
    
    /*
function insertFunc() {
		    
		if(isset($_GET['Margarita'])){
			//SendFunction();
			echo "adddjapndaopfn";
		}
    }
*/

};


?>