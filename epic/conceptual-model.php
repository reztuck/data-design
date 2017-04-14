<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="../public_html/css/styles.css" type="text/css">
		<title>Bad Etsy Conceptual Model</title>
	</head>

	<body>
		<!--	Contains the header and header description-->
		<h1>Bad Etsy Conceptual Model</h1>
		<h3><a href="conceptual-model.php">Model</a> | <a href="persona.php">Persona</a> | <a href="use-case.php">Use-Case</a> | <a href="fun.php">Products</a></h3>
		<br>
		<h3>Below is the interaction flow for my bad-etsy site.</h3>
		<br>

<!--		Below is the relative data set for the Profile-->
<!--			These are the table headers used to name the columns-->
		<h3>Profile</h3>
		<table class="center">
			<tr>
				<th>profileID</th>
				<th>profileToken</th>
				<th>profileLocation</th>
				<th>profileHash_TagStayThirsty</th>
				<th>profielSalt</th>
				<th>profileEmail</th>
			</tr>

<!--			Table data that is sequentially populated into a row-cell relative to each header-->
			<tr>
				<td>722F</td>
				<td>2AAC598B</td>
				<td>Somewhere in Bermuda</td>
				<td>3FFA56735C67</td>
				<td>2FA22D9B9FAA</td>
				<td>fuzzychest10@yahoo.com</td>
				<td></td>
			</tr>
		</table>

<!--		Below is the relative data set for the Product-->
		<!--	These are the table headers used to name the columns-->
		<h3>Product</h3>
		<table class="center">
			<tr>
				<th>productDescription</th>
				<th>productID</th>
				<th>productPrice</th>
			</tr>

			<!--			Table data that is sequentially populated into a row-cell relative to each header-->
			<tr>
				<td>Helps you stay thirsty</td>
				<td>Dos Equis</td>
				<td>$777.77</td>
				<td></td>
			</tr>
		</table>
		<!--Below is the relative data set for the Favorite-->
		<!--	These are the table headers used to name the columns-->
		<h3>Favorite</h3>
		<table class="center">
			<tr>
				<th>favoriteProductid</th>
				<th>favoriteProfileid</th>
			</tr>

			<!--			Table data that is sequentially populated into a row-cell relative to each header-->
			<tr>
				<td>9007B21BE4</td>
				<td>105BBG334F</td>
				<td></td>
			</tr>
		</table>
	</body>

</html>