<?php

// Initialize the session
session_start();
 
// Check if the user is already signed in, if yes then redirect him to welcome page
if(isset($_SESSION["signedIn"]) && !$_SESSION["signedIn"] === true) {
    header("location: ../");
    exit;
};

// Include the config file
require_once "../../../config.php";

// Define variables and initialize with empty values
$email = $password = "";
$emailError = $passwordError = $signInError = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))) {
        $emailError = "Voer uw e-mailadres in.";

    } else {
        $email = trim($_POST["email"]);
    };
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))) {
        $passwordError = "Voer uw wachtwoord in.";
		
    } else {
        $password = trim($_POST["password"]);
    };
    
    // Validate credentials
    if(empty($emailError) && empty($passwordError)) {
        // Prepare a select statement
        $sql = "SELECT * FROM account WHERE email = :email";
        
        if($stmt = $db->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $paramEmail, PDO::PARAM_STR);
            
            // Set parameters
            $paramEmail = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()) {
                // Check if email exists, if yes then verify password
                if($stmt->rowCount() == 1) {
                    if($row = $stmt->fetch()) {
                        $accountId = $row["accountId"];
                        $email = $row["email"];
                        $hashed_password = $row["password"];
						$createdOn = $row["createdOn"];

                        if(password_verify($password, $hashed_password)) {

                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["signedIn"] = true;
                            $_SESSION["accountId"] = $accountId;
                            $_SESSION["email"] = $email;
							$_SESSION["createdOn"] = $createdOn;
                            
                            // Redirect user to account page
                            header("location: ../");
							exit;

                        } else {
                            // Password is not valid, display a generic error message
                            $signInError = "Onheldig email of password.";
                        };
                    };
                } else {
                    // Email doesn't exist, display a generic error message
                    $signInError = "Onheldig email of password.";
                };
            } else {
                echo "Er is iets misgegaan. Probeer het later nog eens.";
				exit;
            };
            // Close statement
            unset($stmt);
        };
    };
    // Close connection
    unset($db);
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
		<link rel="stylesheet" href="../../styles.css" />
		<link rel="stylesheet" href="styles.css" />
		<link
			rel="icon"
			type="image/png"
			href="../../../includes/favicon.png"
		/>
		<title>Accidental Founds | Sign In</title>
	</head>
	<body>
		<div class="language-selector-field language-selected">
			<ul>
				<li>
					<button
						id="dutch"
						onclick="languageSelect(this.id, '../../..', '/account/signin')"
					>
						Nederlands
					</button>
				</li>
				<li>
					<button
						id="french"
						onclick="languageSelect(this.id, '../../..', '/account/signin')"
					>
						Français
					</button>
				</li>
				<li>
					<button
						id="english"
						onclick="languageSelect(this.id, '../../..', '/account/signin')"
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
					<a href="../../"
						><img
							src="../../../includes/logo.png"
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
							<form action="../../webshop/webshop-item/?">
								<input
									type="search"
									name="id"
									placeholder="Quick Search..."
								/>
							</form>
						</div>
					</section>
					<section>
						<ul>
							<li>
								<a href="../../webshop">Webshop</a>
							</li>
							<li><a href="../../contact">Contact</a></li>
							<li>
								<a title="Account" href="../"
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
								<a title="Winkelmandje" href="../../basket"
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
					<h1>Sign In</h1>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<section class="email">
								<label for="email">E-mail</label>
								<input type="text" name="email" id="email" class="<?php echo (!empty($emailError)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>"/>
								<span class="invalid-entry-feedback"><?php echo $emailError; ?></span>
							</section>
							<section class="password">
								<label for="password">Wachtwoord</label>
								<input type="password" name="password" id="password" class="<?php echo (!empty($passwordError)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
								<span class="invalid-entry-feedback"><?php echo $signInError,$passwordError; ?></span>
							</section>
							<input type="submit" class="submit" value="Verzenden">
							<p>Heb je nog geen account? <a href="../signup">Registreer je hier.</a></p>
					</form>
				</main>
				<footer class="fixed-footer">
					<button onclick="languageReselect()">
						Verander je taal
					</button>
					<p>
						Copyright &copy; 2023 Aiko De Prez, Anureet Kaur, Jesse-Jadon Latré and Eduard Smet. MIT License.
						<a href="./aboutus">Over Ons</a>
					</p>
				</footer>
			</div>
		</div>
		<script src="../../script.js"></script>
	</body>
</html>
