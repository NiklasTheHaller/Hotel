<?php
$pageTitle = "Hotel Mama | Login";
$metaDesc = "Login Page";
include("inc/header.php");

$firstName = $lastName = $email = $confirmEmail = $password = $confirmPassword = "";
$invalidEmail = $invalidPassword = $invalidCredentials = false;

// Database connection
include("config/db_config.php");

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

  // If the submission is valid, check the email and password against the database
  if (!$invalidEmail && !$invalidPassword) {
    $stmt = $conn->prepare("SELECT firstname, lastname, userpassword FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName, $hashedPassword);

    if ($stmt->fetch() && password_verify($password, $hashedPassword)) {
      $_SESSION["firstname"] = $firstName;
      $_SESSION["lastname"] = $lastName;
      $_SESSION["active"] = true;
      header("Location: index.php");
      exit();
    } else {
      // Invalid credentials, show an error
      $invalidCredentials = "Invalid email or password";
    }
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