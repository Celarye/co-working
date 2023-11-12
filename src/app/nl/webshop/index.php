<?php

// Show all errors
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Database connection-settings
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'website');

date_default_timezone_set('Europe/Brussels');

// Console log helper function
function debug_to_console($output) {
    echo "<script>console.log('$output');</script>";
}

// Connect with the database
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	debug_to_console('Successfully connected to the database!');
} catch (PDOException $e) {
    debug_to_console('An error occurred while trying to connect to the database: ' . $e->getMessage());
    exit;
}

$sql = "SELECT * FROM `product`";
$result = $db->query($sql);
?>







<!DOCTYPE html>
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
		<title>Accidental Founds | Webshop</title>
	</head>
	<body>
		<div class="language-selector-field">
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
		<div class="language-selector-tint"></div>
		<div class="content">
			<header>
				<nav>
					<a href="../"
						><img
							src="../../includes/logo.png"
							alt="Website logo"
						/>
						Accidental&nbsp;Founds</a
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
							<form action="./">
								<input
									type="search"
									name="search"
									id="search"
									placeholder="Quick Search..."
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
					<section class="card-placement">
					<?php
					       while ($row = $result->fetch(PDO::FETCH_ASSOC)){
							$productId=$row['product-id']
					?>
					    
					        <div class="card">
					          
					       
					                <a href="./webshop-items/?myid=<?php echo $productId ?>">
					                	<img src="<?php echo $row['image'] ?>"alt="<?php echo $row['name']?>">
					                	<h2><?php echo $row['name'] ?></h2>
								<div class="position">
					                    		<p>&euro; <?php echo $row['price']?></p>
									<button class="info">Lees meer!</button>
								</div>
					                </a>
					        </div>
					<?php
						}           
					?>
					</section>
				</main>
				<footer class="fixed-footer">
					<button onclick="languageReselect()">
						Verander je taal
					</button>
					<p>
						Copyright &copy; 2023 All rights reserved. Aiko De Prez,
						Anureet Kaur, Jesse-Jadon Latré and Eduard Smet.
						<a href="./aboutus">Over Ons</a>
					</p>
				</footer>
			</div>
		</div>
		<script src="../script.js"></script>
	</body>
</html>
