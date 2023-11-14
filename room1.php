<?php
$pageTitle = "Room Details";
$metaDesc = "Details of the selected room";


// Adjust the path based on your folder structure
include("inc/header.php");

// Sample room data (you can replace this with dynamic data based on the selected room)
$selectedRoom = [
    "image" => "img/hotelroom1.jpeg",
    "description" => "Our worst room with a view of the Eiffel Tower &#129314;",
    "price" => 76,
    "breakfast" => "7.50",
    "parking" => "9.99",
    "pets" => "6.00",
];
?>




<main class="bg-tertiary">

    <div class="container custom-box my-2 bg-light">

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

                </form>

                <!-- Add more details here as needed -->
                <button type="button" class="btn btn-primary">Book Now!</button>
            </div>
        </div>

    </div>

</main>

<?php include("inc/footer.php") ?>