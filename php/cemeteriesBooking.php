<?php
//payment gateway
//encryption key set in the Merchant Access Portal
$encryptionKey = 'secret';

$DateTime = new DateTime();

$data = array(
    'PAYGATE_ID'        => 10011072130,
    'REFERENCE'         => 'pgtest_123456789',
    'AMOUNT'            => 3299,//based on user input
    'CURRENCY'          => 'NAD',
    'RETURN_URL'        => 'https://my.return.url/page',//when transaction is done it should take you to another page
    'TRANSACTION_DATE'  => $DateTime->format('Y-m-d H:i:s'),
    'LOCALE'            => 'en-za',
    'COUNTRY'           => 'NAM',
    'EMAIL'             => 'customer@paygate.co.za',
);

$checksum = md5(implode('', $data) . $encryptionKey);

$data['CHECKSUM'] = $checksum;

$fieldsString = http_build_query($data);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch, CURLOPT_URL, 'https://secure.paygate.co.za/payweb3/initiate.trans');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOBODY, false);
curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/cemeteriesBooking.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      integrity="sha512-BPxTfN7eBUceU3W5Fs5IxFh+0ObJmo4Qh/a9x9vN1oQwvEJrhzMQ8biJrbUlf7nWhHr58Hh6gPuGvz6ARu94Q=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <title>Heavenly Tomb|Buy Graves</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.html">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a
              class="nav-link dropdown-toggle"
              href="service-providers-page.html"
              id="navbarDropdownMenuLink"
              role="button"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              Service Providers
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="avbobPage.html">AVBOB</a>
              <a class="dropdown-item" href="service-providers-page.html"
                >View More</a
              >
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cemeteries.html">Buy a Grave</a>
          </li>
        </ul>
      </div>
    </nav>

    <section class="grave-booking-landing">
      <div
        class="card text-white bg-dark mb-3 border-secondary"
        style="max-width: 90%"
      >
        <div class="card-header border-secondary" style="font-size: 2em">
          Payment For Graves
        </div>
        <div class="card-body">
          <div class="wrapper">
            <form action="https://secure.paygate.co.za/payweb3/process.trans" method="POST">
              <h4>Account</h4>
              <div class="input-group">
                <div class="input-box">
                  <input
                    type="text"
                    placeholder="Full Name"
                    required
                    class="name"
                  />
                  <i class="fa fa-user icon"></i>
                </div>
              </div>

              <div class="input-group">
                <div class="input-box">
                  <input
                    id="graveNum"
                    type="number"
                    oninput="calculateTotal()"
                    placeholder="Numer of Graves"
                    required
                    class="name"
                  />
                  <i class="fa fa-user icon"></i>
                </div>
              </div>

              <div class="input-group">
                <div class="input-box">
                  <input
                    type="email"
                    placeholder="Email Adress"
                    required
                    class="name"
                  />
                  <i class="fa fa-envelope icon"></i>
                </div>
              </div>

              <h4>Payment Details</h4>

              <div class="input-group">
                <div class="input-box">
                  <input
                    type="tel"
                    placeholder="Card Number"
                    required
                    class="name"
                  />
                  <i class="fa fa-credit-card icon"></i>
                </div>
              </div>
              <div class="input-group">
                <div class="input-box">
                  <input
                    type="tel"
                    placeholder="Card CVC"
                    required
                    class="name"
                  />
                  <i class="fa fa-user icon"></i>
                </div>
                <div class="input-box">
                  <select>
                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>
                  </select>
                  <select>
                    <option>2020</option>
                    <option>2021</option>
                    <option>2022</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
                    <option>2026</option>
                    <option>2027</option>
                  </select>
                </div>
              </div>
              <div class="input-group">
                <div class="input-box">
                  <button
                    id="checkoutBtn"
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#exampleModal"
                  >
                    PAY NOW
                  </button>
                </div>
              </div>
            </form>
          </div>
          <!--end of form-->

          

          <!-- Modal -->
          <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog" role="document">
              <div class="modal-content bg-dark border-secondary">
                <div class="modal-header border-secondary">
                  <h5 class="modal-title" id="exampleModalLabel">
                    Payment in Process
                  </h5>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body ">
                  Payment is in Progress. Come back and look for reply within 24 hours, if no reply is met try again. In the meanwhile, you can select a Service Provider.
                </div>
                <div class="modal-footer border-secondary">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                  >
                    Close
                  </button>
                  <button type="button" class="btn btn-primary">
                    <a href="serviceProvidersPage.html" style="color:white;">Find Service Provider</a>
                  </button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    <div>
    <!-- Footer -->
    <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
      <!-- Section: Social media -->
      <section class="d-flex justify-content-between p-4" style="background-color: #6351ce">
        <!-- Left -->
        <div class="me-5">
          <span>Get connected with us on social networks:</span>
        </div>
        <!-- Left -->

        <!-- Right -->
        <div>
          <a href="" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-google"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-linkedin"></i>
          </a>
          <a href="" class="text-white me-4">
            <i class="fab fa-github"></i>
          </a>
        </div>
        <!-- Right -->
      </section>
      <!-- Section: Social media -->

      <!-- Section: Links  -->
      <section class="">
        <div class="container text-center text-md-start mt-5">
          <!-- Grid row -->
          <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
              <!-- Content -->
              <h6 class="text-uppercase fw-bold">Company name</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                Here you can use rows and columns to organize your footer
                content. Lorem ipsum dolor sit amet, consectetur adipisicing
                elit.
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Products</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                <a href="#!" class="text-white">MDBootstrap</a>
              </p>
              <p>
                <a href="#!" class="text-white">MDWordPress</a>
              </p>
              <p>
                <a href="#!" class="text-white">BrandFlow</a>
              </p>
              <p>
                <a href="#!" class="text-white">Bootstrap Angular</a>
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Useful links</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p>
                <a href="#!" class="text-white">Your Account</a>
              </p>
              <p>
                <a href="#!" class="text-white">Become an Affiliate</a>
              </p>
              <p>
                <a href="#!" class="text-white">Shipping Rates</a>
              </p>
              <p>
                <a href="#!" class="text-white">Help</a>
              </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <!-- Links -->
              <h6 class="text-uppercase fw-bold">Contact</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
              <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
              <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
              <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
              <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row -->
        </div>
      </section>
      <!-- Section: Links  -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2020 Copyright:
        <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a>
      </div>
      <!-- Copyright -->
    </footer>
    <!-- Footer -->
  </div>
  <!-- End of .container -->

    <script src="../js/cemeteriesBooking.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
