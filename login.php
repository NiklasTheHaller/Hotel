<?php
$pageTitle = "Login";
$metaDesc = "Login Page";
include("inc/header.php");
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["email"])) {
    $email = $_POST["email"];

    if (strlen($email) == 0) {
      $invalidEmail = "Please enter your email address";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $invalidEmail = "Please validate your email address";
    }
  }

  if (isset($_POST["password"])) {
    $password = $_POST["password"];

    if (strlen($password) == 0) {
      $invalidPassword = "Please enter your password";
    } 
  }



}

?>

<main>
  <div class="container mt-3 mb-3">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="custom-box mx-auto">


          <form class="container mt-4" method="post" novalidate>
            <div class="mb-3">
              <img class="mb-4" src="img/icons8-hotel-48.png" alt="Hotel Logo">
              <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            </div>

            <div class="mb-3">
              <div class="form-floating mb-3">
                <input type="email" class="form-control <?= !empty($invalidEmail) ? 'is-invalid' : '' ?>" id="email"
                  name="email" placeholder="name@example.com" required>
                <label for="email">Email address</label>
                <?= !empty($invalidEmail) ? '<div class="invalid-feedback is-invalid">' . $invalidEmail . '</div>' : '' ?>
              </div>
            </div>

            <div class="mb-3">
              <div class="form-floating mb-3">
                <input type="password" class="form-control <?= !empty($invalidPassword) ? 'is-invalid' : '' ?>"
                  id="password" name="password" placeholder="Password" required>
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