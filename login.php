<?php
$pageTitle = "Hotel Mama | Login";
$metaDesc = "Login Page";
include("inc/header.php");

$firstName = $lastName = $email = $confirmEmail = $password = $confirmPassword = "";
$invalidEmail = $invalidPassword = $invalidCredentials = false;


// hardcoded user 
$hardcodedUser = [
  "email" => "example@email.com",
  "password" => "Tester123",
  "firstname" => "Niklas",
  "lastname" => "Haller",
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate email
  if (isset($_POST["email"])) {
    $email = $_POST["email"];

    if (strlen($email) == 0) {
      $invalidEmail = "Please enter your email address";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $invalidEmail = "Please enter a valid email address";
    }
  }

  // Validate password
  if (isset($_POST["password"])) {
    $password = $_POST["password"];

    if (empty($password)) {
      $invalidPassword = "Please enter your password";
    }
  }

  // Check if email and password match the hardcoded user
  if ($email == $hardcodedUser["email"] && $password == $hardcodedUser["password"]) {
    $_SESSION["firstname"] = $hardcodedUser["firstname"];
    $_SESSION["lastname"] = $hardcodedUser["lastname"];
    $_SESSION["active"] = true;

    // If "Remember Me" is checked, generate and store a secure token
    if (isset($_POST["remember_me"]) && $_POST["remember_me"] == "on") {
      $token = bin2hex(random_bytes(32)); // Generate a secure random token
      setcookie("remember_me_token", $token, time() + 3600 * 24 * 30); // Set cookie for 30 days
    } else {
      // Clear "Remember Me" cookie if not checked
      setcookie("remember_me_token", "", time() - 3600);
    }

    header("Location: index.php");
    exit();
  } else {
    // Invalid credentials, show an error
    $invalidCredentials = "Invalid email or password";
  }
} elseif (isset($_COOKIE["remember_me_token"])) {
  // If "Remember Me" cookie exists, validate the token and automatically log in the user
  $token = $_COOKIE["remember_me_token"];

  // Add the same validation logic as before to ensure the credentials are correct
  if (true) { // Replace with actual validation logic
    $_SESSION["firstname"] = $hardcodedUser["firstname"];
    $_SESSION["lastname"] = $hardcodedUser["lastname"];
    $_SESSION["active"] = true;
    header("Location: index.php");
    exit();
  }
}
?>

<main class="bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="custom-box mx-auto my-5">


          <form class="container mt-4" method="post" novalidate>
            <div class="mb-3">
              <img class="mb-4" src="img/icons8-hotel-48.png" alt="Hotel Logo">
              <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            </div>

            <div class="mb-3">
              <div class="form-floating mb-3">
                <input type="email" class="form-control <?= !empty($invalidEmail) ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="name@example.com" value="<?= $email ?>" required>
                <label for="email">Email address</label>
                <?= !empty($invalidEmail) ? '<div class="invalid-feedback is-invalid">' . $invalidEmail . '</div>' : '' ?>
              </div>
            </div>

            <div class="mb-3">
              <div class="form-floating mb-3">
                <input type="password" class="form-control <?= !empty($invalidPassword) ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Password" required>
                <label for="password">Password</label>
                <?= !empty($invalidPassword) ? '<div class="invalid-feedback is-invalid">' . $invalidPassword . '</div>' : '' ?>
              </div>
            </div>

            <div class="mb-3">
              <div class="form-check text-start">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Remember me</label>
              </div>
            </div>

            <div class="mb-3">
              <button class="btn btn-primary w-100 py-2" type="submit">Sign in</button>
            </div>


            <div class="mb-3">
              <p class="mt-5 mb-3 text-body-secondary">© 2017–2023</p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
include("inc/footer.php")
?>