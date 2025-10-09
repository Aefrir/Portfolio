<?php
session_start();

$products = [
	[
		'Release Date' => '23-03-2018',
		'Image Source' => 'images/9200000067180307.jpg',
		'Console' => 'Playstation 4',
		'Name' => 'Red Dead Redemption 2',
		'Price' => 59.99
	],
	[
		'Release Date' => '23-03-2018',
		'Image Source' => 'images/9200000053083967.jpg',
		'Console' => 'Playstation 4',
		'Name' => 'Ni No Kuni II: Revenant Kingdom',
		'Price' => 49.99
	],
	[
		'Release Date' => '31-21-2018',
		'Image Source' => 'images/9200000082972427.jpg',
		'Console' => 'Playstation 4',
		'Name' => 'Biomutant',
		'Price' => 49.99
	],
	[
		'Release Date' => '27-03-2018',
		'Image Source' => 'images/9200000078668488.jpg',
		'Console' => 'Playstation 4',
		'Name' => 'Far Cry 5 - Deluxe Edition',
		'Price' => 59.99
	],
	[
		'Release Date' => '30-03-2018',
		'Image Source' => 'images/9200000084844101.jpg',
		'Console' => 'Playstation 4',
		'Name' => 'The Lost Child',
		'Price' => 49.99 //59.99
	],
	[
		'Release Date' => '29-03-2018',
		'Image Source' => 'images/9200000090287767.jpg',
		'Console' => 'Playstation 4',
		'Name' => 'Injustice 2 - Legendary Edition',
		'Price' => 59.99
	],
	[
		'Release Date' => '25-05-2018',
		'Image Source' => 'images/9200000088311502.jpg',
		'Console' => 'Playstation 4',
		'Name' => 'Dark Souls Remastered',
		'Price' => 39.99 //49.99
	],
	[
		'Release Date' => '30-03-2018',
		'Image Source' => 'images/9200000088397115.jpg',
		'Console' => 'Playstation 4',
		'Name' => 'Attack on Titan 2 - A.O.T. 2',
		'Price' => 59.99
	]
];

$ascRegex = '/^(asc)$/';
$descRegex = '/^(desc)$/';
$sort = 'asc';

if (isset($_GET['sort'])){
	if(preg_match($ascRegex, $_GET['sort'])){
		usort($products, function($a, $b){
			return $a['Name'] > $b['Name'];
		});
		$sort = $_GET['sort'];
	}
	elseif(preg_match($descRegex, $_GET['sort'])){
		usort($products, function($a, $b){
			return $a['Name'] < $b['Name'];
		});
		$sort = $_GET['sort'];
	}
	else{
		$sort = 'asc';
	}
}
else{
	$sort = 'asc';
}

$regex2 = '/^[1-8]$/';

if (isset($_GET['quantity']) && is_numeric($_GET['quantity']) && preg_match($regex2, $_GET['quantity'])){
	$max = $_GET['quantity'];
}
else{
	$max = 4;
}

$output = "";
for ($i = 0; $i < $max; $i++){
	$name = $products[$i];
	$output .= '<article>';
	$output .= '<span class="release">'.$name['Release Date'].'</span>';
	$output .= '<img src="'.$name['Image Source'].'" alt="'.$name['Name'].'" width="168" height="210">';
	$output .= '<span class="console">'.$name['Console'].'</span>';
	$output .= '<span class="name">'.$name['Name'].'</span>';
	$output .= '<span class="price">€'.$name['Price'].'</span>';
	$output .= '<a href="index.php?addToCart='.$name['Name'].'"><i class="fa-solid fa-cart-plus"></i></a>';
	$output .= '</article>';
}

if(!isset($_SESSION['shoppingCart'])){
	$_SESSION['shoppingCart'] = []; //create empty session array if no prior session array has been set
}

if(isset($_GET['addToCart'])){
	$productName = $_GET['addToCart']; //Retrieves product name from url
 	//rather than the literal product name, i have to somehow retrieve the info of the product by creating a link
	foreach($products as $productInfo){
		if($productInfo['Name'] === $productName){
			$found = false;
			foreach($_SESSION['shoppingCart'] as $key => $shopItem){
					if($shopItem['Name'] === $productName){
							$_SESSION['shoppingCart'][$key]['Quantity']++;
							$found = true;
							break;	
					}
			}
			if(!$found){
				$productInfo['Quantity'] = 1;
				$_SESSION['shoppingCart'][] = $productInfo; 
			}
			break;
		}
	}
}

$outputCart = '';
$overalTotal = 0;

if(isset($_POST['empty'])){
	setcookie('savedShoppingCart', '', time() - 108000);
	session_unset();
	$_SESSION['shoppingCart'] = [];
	header("Location: " . $_SERVER['PHP_SELF']); //moet 2x "empty cart" klikken voordat de tabel leeg is. geen idee waarom.
}

if(isset($_POST['save'])){
	$savedCart = json_encode($_SESSION['shoppingCart']);
	setcookie('savedShoppingCart', $savedCart, time()+108000);
}

if(isset($_COOKIE['savedShoppingCart']) && empty($_SESSION['shoppingCart'])){
	$savedCookie = $_COOKIE['savedShoppingCart'];
	$_SESSION['shoppingCart'] = json_decode($savedCookie, true);
}

if (!empty($_SESSION['shoppingCart'])){ 
	$outputCart .= '<table>';
	$outputCart .= '<tr><th>Product Name</th><th>Price per piece</th><th>Quantity</th><th>Total</th></tr>';
	foreach($_SESSION['shoppingCart'] as $item){
		$total = $item['Quantity'] * $item['Price'];
		$outputCart .= '<tr>';
		$outputCart .= '<td>'.$item['Name'].'</td>';
		$outputCart .= '<td>€'.$item['Price'].'</td>';
		$outputCart .= '<td>'.$item['Quantity'].'</td>'; //quant
		$outputCart .= '<td>€'.$total.'</td>'; //total price
		$outputCart .= '</tr>';
		$overalTotal += $total;
	}
	$outputCart .= '<tr class="alignment"><td colspan="4">€'.$overalTotal.'</td></tr>';
	$outputCart .= '<tr><td colspan="4"><form action="index.php" method="post" class="between"><input type="submit" value="Empty Cart" name="empty"><input type="submit" value="Save Cart" name="save"></form></td></tr>';
	$outputCart .= '</table>';
	}
else{
		$outputCart = '<p class="alignment"><strong>Cart is empty.</strong></p>';
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>PlayStation 4</title>
		<link rel="stylesheet" href="css/stylesheet.css">
		<script src="https://kit.fontawesome.com/a0a5e50891.js" crossorigin="anonymous"></script>
			<style>
				table, td, tr, th{
					border: solid 1px black;
					border-collapse: collapse;
					padding: 0.5em;
				}
		</style>
	</head>
	<body>
		<div id="container">
			<header>
				<ol class="breadcrumbs">
					<li>
						<a href="http://www.webshop.com"><span content="Home"><i class="fa fa-home"></i></span></a> >
					</li>					
					<li>
						<a href="http://www.webshop.com/muziek-film-games"><span>Muziek, Film & Games</span></a> >
					</li>
					<li>
						<a href="http://www.webshop.com/games"><span>Games</span></a> >
					</li>
					<li>
						<span>PlayStation 4</span>
					</li>
				</ol>
				<?=$outputCart?>
			</header>
			<main>
				<section>
					<h1>Videogames - PlayStation 4</h1>
					<p>
						Er is een groot aanbod in PlayStation 4 games. Elke game is divers en heeft unieke eigenschappen. Bedenk dus goed in wat voor game jij geïnteresseerd bent. In ons assortiment vind je games in verschillende genres van sport tot actie en van simulatie tot Role Playing Game (RPG). Exclusieve games voor de PlayStation 4 zijn Horizon Zero Dawn, Uncharted, Gran Turismo, InFamous, Killzone.
					</p>
				</section>
				<form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="get">
					<label for="quantity">Number of products shown:</label>
					<select name="quantity" id="quantity" value="<?=$max?>">
						<option value="2" <?=$max == '2' ? 'selected' : ''?>>2</option>
						<option value="4" <?=$max == '4' ? 'selected' : ''?>>4</option>
						<option value="6" <?=$max == '6' ? 'selected' : ''?>>6</option>
						<option value="8" <?=$max == '8' ? 'selected' : ''?>>8</option>
					</select>
					<label for="asc">Oplopend (A-Z)</label>
					<input type="radio" id="asc" name="sort" value="asc" <?=$sort == 'asc' ? 'checked' : ''?>>
					<label for="desc">Aflopend (Z-A)</label>
					<input type="radio" id="desc" name="sort" value="desc" <?=$sort == 'desc' ? 'checked' : ''?>>
					<input type="submit" value="Submit" name="submit">
				</form>
				<section id="products">
					<?=$output?>
				</section>
			</main>
		</div>
		<footer></footer>		
	</body>
</html>