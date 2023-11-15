<?php

// Initialize the session
session_start();

// Include the config file
require_once "../../../config.php";

// Define variables and initialize with empty values
$quantity = 1;
$quantityError = $basketFeedbackPositive = $basketFeedbackNegative = "";

try {
	$productId = intval(htmlspecialchars($_GET["id"]));

	if ($query = $db->query("SELECT COUNT(*) FROM product")) {
		$rowCount = (int)implode("",$query->fetch(PDO::FETCH_ASSOC));
		
		if (preg_match('/^0*[1-9]\d*$/',$productId) && $productId <= $rowCount) {
			$sql = "SELECT * FROM product WHERE `productId`= $productId";

			if ($query = $db->query($sql)) {
				$product = $query->fetch(PDO::FETCH_ASSOC);
			};
		} else {
			http_response_code(404);
			echo("404 : La page est introuvable. <a href=\"../\">Retournez à la boutique en ligne.</a>");
			exit;
		};
	};
} catch(PDOException $e) {
    echo "Un problème s'est produit. Veuillez réessayer plus tard. Erreur : " . $e->getMessage();
	exit;
};

// Processing the form data when it's submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
	try {
		// Prepare a select statement
		$sql = "SELECT * FROM basketItem WHERE AID = :AID AND PID = :PID";

		if($stmt = $db->prepare($sql)) {
		
			// Bind variables to the prepared statement as parameters
			$stmt->bindParam(":AID", $paramAID, PDO::PARAM_INT);
			$stmt->bindParam(":PID", $paramPID, PDO::PARAM_INT);
			
			// Set parameters
			$paramAID =  $_SESSION['accountId'];
			$paramPID = $product['productId'];
			
			// Attempt to execute the prepared statement
			if($stmt->execute()) {
				if($stmt->rowCount() == 1) {
					if($row = $stmt->fetch()) {
						$quantityInBasket = $row["quantity"];

						$quantitySum = $_POST['quantity'] + $quantityInBasket;

						if($quantitySum > 5) {
							$quantityLeft = $_POST['quantity'] - ($quantitySum - 5);

							if($quantityLeft == 1) {
								$quantityError = "Vous ne pouvez ajouter qu'une seule pièce à votre panier. Actuellement dans votre panier : 4";

							} elseif($quantityLeft > 1) {
								$quantityError = "Vous ne pouvez ajouter que $quantityLeft pièces à votre panier. Actuellement dans votre panier : $quantityInBasket";
							
							} else {
								$quantityError = "Votre panier a atteint le nombre maximum d'articles. Actuellement dans votre panier : 5";
							};
						} else {
							$sql = "UPDATE basketItem SET quantity = $quantitySum WHERE AID = $paramAID AND PID = $paramPID";
							
							if($db->exec($sql)) {
								// Show the success message
								if($_POST['quantity'] > 1) {
									$basketFeedbackPositive = "Les articles ont été ajoutés à votre panier !";

								} else {
									$basketFeedbackPositive = "L'article a été ajouté à votre panier !";
								};
							} else {
								// Show the failure message
								$basketFeedbackNegative = "Un problème s'est produit. Veuillez réessayer plus tard.";
							};
						};
					};
				} else {
					$sql = "INSERT INTO basketItem VALUES (:AID, :PID, :quantity)";
			
					if($stmt = $db->prepare($sql)) {
						// Bind variables to the prepared statement as parameters
						$stmt->bindParam(':AID', $paramAccountId, PDO::PARAM_INT);
						$stmt->bindParam(':PID', $paramProductId, PDO::PARAM_INT);
						$stmt->bindParam(':quantity', $paramQuantity, PDO::PARAM_INT);

						// Set the parameters
						$paramAccountId = $_SESSION['accountId'];
						$paramProductId = $product['productId'];
						$paramQuantity = $_POST['quantity'];
						
						// Attempt to execute the prepared statement
						if($stmt->execute()) {
							// Show the success message
							if($_POST['quantity'] > 1) {
								$basketFeedbackPositive = "Les articles ont été ajoutés à votre panier !";
								
							} else {
								$basketFeedbackPositive = "L'article a été ajouté à votre panier !";
							};
						} else {
							// Show the failure message
							$basketFeedbackNegative = "Un problème s'est produit. Veuillez réessayer plus tard.";
						};

						// Close statement
						unset($stmt);
					};
				};
			};
		};
		// Close connection
    	unset($db);
	
	} catch(PDOException $e) {
		echo "Un problème s'est produit. Veuillez réessayer plus tard. Erreur : " . $e->getMessage();
		exit;
	};
};

?><!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link
			href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,400;0,800;1,200;1,400;1,800&display=swap"
			rel="stylesheet"
		/>
		<link
			href="https://unpkg.com/@csstools/normalize.css"
			rel="stylesheet"
		/>
		<link rel="stylesheet" href="../../styles.css" />
		<link rel="stylesheet" href="../styles.css" />
		<link rel="stylesheet" href="styles.css"/>
		<link rel="icon" type="image/png" href="../../../includes/favicon.png" />
		<title>Accidental Founds | Webshop</title>
	</head>
	<body>
		<div class="language-selector-field language-selected">
			<ul>
				<?php

					echo "<script>let productId = $productId;</script>";

				?>
				<li>
					<button
						id="dutch"
						onclick="languageSelect(this.id, '../../..', `/webshop/webshop-item/?id=${productId}`)"
					>
						Nederlands
					</button>
				</li>
				<li>
					<button
						id="french"
						onclick="languageSelect(this.id, '../../..', `/webshop/webshop-item/?id=${productId}`)"
					>
						Français
					</button>
				</li>
				<li>
					<button
						id="english"
						onclick="languageSelect(this.id, '../../..', `/webshop/webshop-item/?id=${productId}`)"
					>
						English
					</button>
				</li>
			</ul>
		</div>
		<div class="language-selector-tint language-selected"></div>
		<div class="content">
			<header>
				<nav>
					<a href="../../index.html"
						><img
							src="../../../includes/logo.png"
							alt="Website logo"
						/>
						Accidental&nbsp;Founds</a>
					<section>
						<div class="quick-search">
							<svg
								xmlns="http://www.w3.org/2000/svg"
								width="16"
								height="16"
								fill="currentColor"
							>
								<path
									d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"
								/>
							</svg>
							<form action="./?">
								<input
									type="search"
									name="id"
									placeholder="Rechercher..."
								/>
							</form>
						</div>
					</section>
					<section>
						<ul>
							<li>
								<a href="../">Webshop</a>
							</li>
							<li><a href="../../contact">Contact</a></li>
							<li>
								<a title="Account" href="../../account"
									><svg
										xmlns="http://www.w3.org/2000/svg"
										width="28"
										height="28"
										fill="currentColor"
										viewBox="0 0 16 16"
									>
										<path
											d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"
										/>
										<path
											fill-rule="evenodd"
											d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"
										/></svg
								></a>
							</li>
							<li>
								<a title="Panier" href="../../basket"
									><svg
										xmlns="http://www.w3.org/2000/svg"
										width="28"
										height="28"
										fill="currentColor"
										viewBox="0 0 16 16"
									>
										<path
											d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"
										/></svg
								></a>
							</li>
						</ul>
					</section>
				</nav>
			</header>
			<div class="container">
				<main>
					<?php

						switch($_COOKIE['preferred-language']) {
							case 'dutch':
								$productDescriptionLanguage = $product['descriptionDutch'];
								break;
							case 'french':
								$productDescriptionLanguage = $product['descriptionFrench'];
								break;
							case 'english':
								$productDescriptionLanguage = $product['descriptionEnglish'];
								break;
							default:
								$productDescriptionLanguage = $product['descriptionDutch'];
								break;
						}

					?>
					<img src="../<?php echo $product['image']?>" alt="<?php echo $product['name']?>">
					<div class="info">
						<section>
							<h2><?php echo $product['name'] ?></h2>
							<p class="product-id">Product ID: <?php echo $product['productId']?></p>
						</section>
						<p class="description"><?php echo $productDescriptionLanguage?></p>
						<p class="price">&euro; <?php echo $product['price']?></p>
						<?php
							
							// Check if the user is signed in
							if(!isset($_SESSION["signedIn"]) || isset($_SESSION["signedIn"]) && !$_SESSION["signedIn"] === true){

						?>
						<section class="not-signed-in">
							<a href="../../account/signin">Se connecter</a>
							<p>Vous devez être connecté pour ajouter des produits à votre panier.</p>
						</section>
						<?php

							} else {

						?>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $productId; ?>" method="post">
							<section>
								<label for="quantity">Nombre</label>
								<input type="number" name="quantity" class="quantity <?php echo (!empty($quantityError)) ? 'is-invalid' : ''; ?>" value="<?php echo $quantity; ?>" min="1" max="5" oninput="validity.valid||(value='');">
								<p>Maximum 5 par client.</p>
							</section>
							<input type="submit" value="Ajouter au panier">
						</form>
						<section class="basket-feedback">
							<p><?php echo $basketFeedbackPositive; ?></p>
							<p class="basket-feedback-negative"><?php echo $quantityError,$basketFeedbackNegative; ?></p>
						</section>
						<?php

							}

						?>
					</div>
   				 </main>
				<footer class="fixed-footer" id="fixed-footer-overwrite">
					<button onclick="languageReselect()">
                        Changer de langue
					</button>
					<p>
						Copyright &copy; 2023 Aiko De Prez, Anureet Kaur, Jesse-Jadon Latré and Eduard Smet. MIT License.
						<a href="../../aboutus/">A propos de nous</a>
					</p>
				</footer>
			</div>
		</div>
		<script src="../../script.js"></script>
	</body>
</html>
