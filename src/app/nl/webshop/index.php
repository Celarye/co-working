<?php

// Include the config file
require_once "../../config.php";

try {
	$sql = "SELECT * FROM product";
	$query = $db->query($sql);

} catch(PDOException $e) {
    echo "Er is iets misgegaan. Probeer het later nog eens. Error: " . $e->getMessage();
	exit;
};

?><!DOCTYPE html>
<html lang="nl">
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
		<link rel="stylesheet" href="../styles.css" />
		<link rel="stylesheet" href="styles.css" />
		<link rel="icon" type="image/png" href="../../includes/favicon.png" />
		<title>Accidental Finds | Webshop</title>
	</head>
	<body>
		<div class="language-selector-field language-selected">
			<ul>
				<li>
					<button
						id="dutch"
						onclick="languageSelect(this.id, '../..', '/webshop')"
					>
						Nederlands
					</button>
				</li>
				<li>
					<button
						id="french"
						onclick="languageSelect(this.id, '../..', '/webshop')"
					>
						Français
					</button>
				</li>
				<li>
					<button
						id="english"
						onclick="languageSelect(this.id, '../..', '/webshop')"
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
					<a href="../"
						><img
							src="../../includes/logo.png"
							alt="Website logo"
						/>
						Accidental&nbsp;Finds</a
					>
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
							<form action="./webshop-item/?">
								<input
									type="search"
									name="id"
									placeholder="Zoeken..."
								/>
							</form>
						</div>
					</section>
					<section>
						<ul>
							<li>
								<a href="./">Webshop</a>
							</li>
							<li><a href="../contact">Contact</a></li>
							<li>
								<a title="Account" href="../account"
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
								<a title="Winkelmandje" href="../basket"
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
					<h1>Webshop</h1>
					<section>
						<ul>
							<?php

								while ($product = $query->fetch(PDO::FETCH_ASSOC)) {

							?>
							<li>
								<a href="./webshop-item/?id=<?php echo $product['productId'] ?>"></a>
								<section class="info">
									<h2><?php echo $product['name'] ?></h2>
									<p>&euro; <?php echo $product['price'] ?></p>
									<button>Lees Meer</button>
								</section>
								<img src="<?php echo $product['image'] ?>" alt="<?php echo $product['name'] ?>">
							</li>
							<?php

								};
							
							?>
						</ul>
					</section>
				</main>
				<footer class="fixed-footer">
					<button onclick="languageReselect()">
						Verander Uw Taal
					</button>
					<p>
						Auteursrecht &copy; 2023 Aiko De Prez, Anureet Kaur,
						Eduard Smet en Jesse-Jadon Latré. MIT-licentie.
						<a href="../aboutus">Over Ons</a>
					</p>
				</footer>
			</div>
		</div>
		<script src="../script.js"></script>
	</body>
</html>
