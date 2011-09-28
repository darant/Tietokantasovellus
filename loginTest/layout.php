
<html>
<head>
<meta charset=utf-8"/>
<link href="default.css" rel="stylesheet" type="text/css" />
<title><!--TITLE--></title>
</head>

<body>

<div id="logo">Drinkkiarkisto</div>
<div id="content">
	<div id="sidebar">
		<div id="login" class="boxed">
			<h2 class="title">Log in:</h2>
			<div class="content">
				<!--LOGIN-->
			</div>
		</div>
        <!-- end login box-->
        
		<div id="menu" class="boxed">
			<h2 class="title">Drink database:</h2>
			<div class="content">
			
			<dl>
			<dt><a href="page.php?menu=name"><strong>Drinks:</strong></a></dt>
			<dd>
				<ul>
				<li><a href="page.php?menu=name2">by name</a></li>
				<li><a href="page.php?menu=category" name="recipe_cat">by category</a></li>
				<!--<li><a href="page.php?menu=alcohol">by alcohol</a></li>-->
				<li><a href="page.php?menu=ingredient">by ingredient</a></li>
				</ul>
			</dd>

			<dt><a href="page.php?menu=i_name"><strong>Ingredients:</strong></a></dt>
			<dd>
				<ul>
				<li><a href="page.php?menu=i_name">by name</a></li>
				<!--<li><a href="page.php?menu=i_type">by type</a></li>-->
				</ul>
			</dd>

			<dt><strong><a href="page.php?random_recipe" action="">Random</a></strong></dt>

			</dl>
			
			</div>
			
			<div id="search" class="boxed">
				
				<form name="form" action="search.php" method="get">
				<input type="text" name="a" />
				<input type="submit" name="search" value="Search" />
				</form>
			</div>
			<!--end content-->
		</div>
		<!--end menu-->
	</div>
	<!--end sidebar-->
	 <div id="menubar" class="boxed">

			<!--MENUBAR-->
			
	</div>
	
	<div id="main" class="boxed">
	   
    	<div id="example" class="boxed">
        	<!--<h2 class="title">Output window:</h2>-->
        	<!--OUTPUT-->  
		    </table>	
   	    </div>
    	<!--end example-->
	</div>
	<!--end main window-->
</div>
<!--end all content-->

<div id="footer">
	<p>2011 Tietokantasovellus.
	<br>Recipes: <a href="http://www.iba-world.com/english/cocktails/">IBA Official Cocktails</a>
	<br>Cocktail icons licensed from <a href="http://cedarseed-fire.blogspot.com/">Cedarseed.com</p></a>
</div>
</body>
</html>


