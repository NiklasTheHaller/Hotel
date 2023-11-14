<?php
$pageTitle = "Hotel Mama | Homepage";
$metaDesc = "Welcome to Hotel Mama Homepage!";

include("inc/header.php");
  ?>

<main class="bg-light">



  
    <div class="container col-xxl-8 px-4 py-5 custom-box">
      <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <div class="col-10 col-sm-8 col-lg-6">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner rounded">
              <div class="carousel-item active">
                <img src="img/hotelroom1.jpeg" class="d-block w-100" alt="Beautiful hotelroom 1">
              </div>
              <div class="carousel-item">
                <img src="img/hotelroom2.jpeg" class="d-block w-100" alt="Beautiful hotelroom 2">
              </div>
              <div class="carousel-item">
                <img src="img/hotelroom3.png" class="d-block w-100" alt="Beautiful hotelroom 3">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <div class="col-lg-6">
          <h1 class="display-5 fw-bold text-dark lh-1 mb-3 text-primary">Want to book a beautiful room in Austria?</h1>
          <p class="lead text-dark">Book a room here with us at Hotel Mama! We offer fantastic rooms at a stunning
            price!</p>
          <div class="d-grid gap-2 d-md-flex justify-content-md-start">

            <a class="btn btn-primary btn-lg px-4 me-md-2" href="rooms.php" role="button">Book now!</a>

          </div>
        </div>
      </div>
    </div>
  



</main>



<?php
include("inc/footer.php")
  ?>