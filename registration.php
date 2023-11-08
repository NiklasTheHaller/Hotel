<?php
$pageTitle = "Registration";
$metaDesc = "Sign-up Page";
include("inc/header.php");


$firstName = $lastName = $email = $confirmEmail = $password = $confirmPassword = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["firstname"])) {
        $firstName = $_POST["firstname"];
    }

    if (isset($_POST["lastname"])) {
        $lastName = $_POST["lastname"];
    }

    if (isset($_POST["email"])) {
        $email = $_POST["email"];

        if (strlen($email) == 0) {
            $invalidEmail = "Please enter your email address";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $invalidEmail = "Please validate your email address";
        }
    }

    if (isset($_POST["confirmemail"])) {
        $confirmEmail = $_POST["confirmemail"];

        if (strlen($confirmEmail) == 0) {
            $invalidEmail = "Please confirm your email address";
        } elseif ($confirmEmail != $email) {
            $invalidEmail = "Your emails do not match";
        }
    }

    if (isset($_POST["password"])) {
        $password = $_POST["password"];

        if (strlen($password) == 0) {
            $invalidPassword = "Please enter your password";
        } elseif (strlen($password) < 8) {
            $invalidPassword = "Your password must contain at least 8 characters";
        } elseif (!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
            $invalidPassword = "Your password must contain at least one special character";
        }
    }

    if (isset($_POST["confirmpassword"])) {
        $confirmPassword = $_POST["confirmpassword"];

        if (strlen($confirmPassword) == 0) {
            $invalidConfirmPassword = "Please enter your password";
        } elseif ($confirmPassword != $password) {
            $invalidConfirmPassword = "Your passwords do not match";
        }
    }


}


?>




<main>


    <div class="container mt-3 mb-3">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="custom-box">

                    <form class="container mt-4" action="registration.php" method="post">
                        <img class="mb-4 justify-center" src="img/icons8-hotel-48.png" alt="Hotel Logo">

                        <div class="mb-3 row">
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        placeholder="Max" aria-label="First name" value="<?= $firstName ?>" required>
                                    <label for="firstname">First Name</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        placeholder="Mustermann" aria-label="Last name" value="<?= $lastName ?>"
                                        required>
                                    <label for="lastname">Last Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="email"
                                    class="form-control <?= !empty($invalidEmail) ? 'is-invalid' : '' ?>" id="email"
                                    name="email" aria-describedby="emailHelp" placeholder="yourmail@domain.com"
                                    value="<?= $email ?>" required>
                                <label for="email">Email address</label>
                                <?= !empty($invalidEmail) ? '<div class="invalid-feedback is-invalid">' . $invalidEmail . '</div>' : '' ?>
                            </div>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="email"
                                    class="form-control <?= !empty($invalidEmail) ? 'is-invalid' : '' ?>"
                                    id="confirmemail" name="confirmemail" aria-describedby="emailHelp"
                                    placeholder="yourmail@domain.com" value="<?= $confirmEmail ?>" required>
                                <label for="confirmemail">Confirm Email address</label>
                                <?= !empty($invalidEmail) ? '<div class="invalid-feedback is-invalid">' . $invalidEmail . '</div>' : '' ?>
                            </div>
                            <div id="emailHelp" class="form-text">Please confirm your email address.</div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="password"
                                    class="form-control <?= !empty($invalidPassword) ? 'is-invalid' : '' ?>"
                                    id="password" name="password" placeholder="*********" required>
                                <label for="password">Password</label>
                                <?= !empty($invalidPassword) ? '<div class="invalid-feedback is-invalid">' . $invalidPassword . '</div>' : '' ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-floating">
                                <input type="password"
                                    class="form-control <?= !empty($invalidConfirmPassword) ? 'is-invalid' : '' ?>"
                                    id="confirmpassword" name="confirmpassword" placeholder="Re-enter your password"
                                    required>
                                <label for="confirmpassword">Confirm Password</label>
                                <?= !empty($invalidConfirmPassword) ? '<div class="invalid-feedback is-invalid">' . $invalidConfirmPassword . '</div>' : '' ?>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="termsofservice" name="termsofservice"
                                required>
                            <label class="form-check-label" for="termsofservice">I agree to the <a href="tos.php">terms
                                    of service</a>.</label>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="privacynote" name="privacynote"
                                required>
                            <label class="form-check-label" for="privacynote">I agree to the <a
                                    href="privacy-note.php">privacy note</a>.</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2" >Submit</button>
                        


                    </form>

                </div>
            </div>
        </div>
    </div>

</main>

<?php
include("inc/footer.php")
    ?>