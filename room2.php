<?php
$pageTitle = "Hotel Mama | Room Details";
$metaDesc = "Details of the selected room";
include("inc/header.php");

// Sample room data
$selectedRoom = [
    "image" => "img/hotelroom4.jpeg",
    "description" => "Wonderful room with beach access",
    "price" => 153,
    "breakfast" => "7.50",
    "parking" => "9.99",
    "pets" => "6.00",
];
?>




<main class="bg-tertiary">

    <div class="container custom-box my-2">

        <!-- Room Details -->
        <div class="row">
            <div class="col-md-6">
                <img src="<?= $selectedRoom['image'] ?>" class="img-fluid mb-3 rounded" alt="Room Image">
            </div>
            <div class="col-md-6">
                <h2>
                    <?= $pageTitle ?>
                </h2>
                <p class="lead">
                    <?= $selectedRoom['description'] ?>
                </p>
                <p class="fw-bold">Price:
                    $<?= $selectedRoom['price'] ?>/night
                </p>
                <p>Would you like to include some of our offers in your booking?</p>
                <form action="" method="post" class="my-4">

                    <ul class="list-group">
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="" id="firstCheckbox">
                            <label class="form-check-label" for="firstCheckbox">Breakfast | +$
                                <?= $selectedRoom['breakfast'] ?>
                            </label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="" id="secondCheckbox">
                            <label class="form-check-label" for="secondCheckbox">Parking | +$
                                <?= $selectedRoom['parking'] ?>
                            </label>
                        </li>
                        <li class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" value="" id="thirdCheckbox">
                            <label class="form-check-label" for="thirdCheckbox">Pets | +$
                                <?= $selectedRoom['pets'] ?>
                            </label>
                        </li>
                    </ul>

                    <button type="submit" class="btn btn-primary mt-2">Book Now!</button>
                </form>



            </div>
        </div>

    </div>

</main>

<?php include("inc/footer.php") ?>