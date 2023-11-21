<?php
$pageTitle = "Hotel Mama | FAQs";
$metaDesc = "Hotel Mama's FAQs";
include("inc/header.php")
    ?>
<main>


    <div class="container mt-5">
        <h1 class="mb-3 text-white">Frequently Asked Questions</h1>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header collapsed" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        FAQ 1: What is your company's mission?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Our mission is to provide the best service to our customers.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        FAQ 2: What services do you offer?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        We offer a variety of services for additional fees including breakfast, parking, and pets. Find
                        out more when you're booking your room!
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        FAQ 3: What types of rooms do you offer?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        We offer a variety of rooms to suit different needs and budgets, including single rooms, double
                        rooms, and luxury suites.
                    </div>
                </div>
            </div>
        </div>
    </div>


</main>

<?php
include("inc/footer.php")
    ?>