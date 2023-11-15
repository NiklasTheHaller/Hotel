<?php
$pageTitle = "Booking";
$metaDesc = "Book one of our rooms!";
include("inc/header.php");



?>

<main>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col">
                    <div class="card shadow-sm object-fit-contain">
                        <img src="img/hotelroom1.jpeg" height="225" class="object-fit-cover border rounded" alt="Picture of beatiful hotelroom 1">
                        <div class="card-body">
                            <p class="card-text">Our worst room with a view of the Eiffel Tower &#129314;</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a class="btn btn-sm btn-outline-secondary" href="room1.php" role="button">Book now!</a>
                                
                                <small class="text-body-secondary">$76/night</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm object-fit-contain">
                        <img src="img/hotelroom4.jpeg" height="225" class="object-fit-cover border rounded" alt="Picture of beatiful hotelroom 4">
                        <div class="card-body">
                            <p class="card-text">Wonderful room with beach access</p>
                            <div class="d-flex justify-content-between align-items-center">
                            <a class="btn btn-sm btn-outline-secondary" href="room2.php" role="button">Book now!</a>
                                <small class="text-body-secondary">$153/night</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm object-fit-contain">
                        <img src="img/hotelroom8.jpeg" height="225" class="object-fit-cover border rounded" alt="Picture of beatiful hotelroom 8">
                        <div class="card-body">
                            <p class="card-text">Beautiful room at on our top floor</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Book now!
                                </button>
                                <?php include("inc/book.php"); ?>
                                <small class="text-body-secondary">$249/night</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm object-fit-contain">
                        <img src="img/hotelroom6.jpeg" height="225" class="object-fit-cover border rounded" alt="Picture of beatiful hotelroom 6">
                        <div class="card-body">
                            <p class="card-text">Our master suite</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Book now!
                                </button>
                                <?php include("inc/book.php"); ?>
                                <small class="text-body-secondary">$400/night</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm object-fit-contain">
                        <img src="img/hotelroom2.jpeg" height="225" class="object-fit-cover border rounded" alt="Picture of beatiful hotelroom 2">
                        <div class="card-body">
                            <p class="card-text">Cozy room with fireplace</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Book now!
                                </button>
                                <?php include("inc/book.php"); ?>
                                <small class="text-body-secondary">$102/night</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card shadow-sm object-fit-contain">
                        <img src="img/hotelroom9.jpeg" height="225" class="object-fit-cover border rounded" alt="Picture of beatiful hotelroom 9">
                        <div class="card-body">
                            <p class="card-text">Buget option for young travelers!</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Book now!
                                </button>
                                <?php include("inc/book.php"); ?>
                                <small class="text-body-secondary">$77/night</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</main>

<?php
include("inc/footer.php")
?>