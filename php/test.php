<!-- container -->
<div class="container pt-8 pb-12">
    <div class="row mb-8 justify-content-center">
        <div class="col-lg-8 col-md-12 col-12 text-center">
            <!-- caption -->
            <span class="text-primary mb-3 d-block text-uppercase fw-semibold ls-xl">Reviews</span>
            <h2 class="mb-2 display-4 fw-bold">Don’t just take our word for it.</h2>
            <p class="lead">12+ million people are already learning on Geeks</p>
        </div>
    </div>
    <!-- row -->
    <div class="row ">
        <!-- col -->
        <div class="col-md-12">
            <div class="position-relative">
                <!-- controls -->
                <ul class="controls-testimonial controls " id="sliderTestimonialControls">
                    <li class="">
                        <i class="fe fe-chevron-left"></i>
                    </li>
                    <li class="next ms-2">
                        <i class="fe fe-chevron-right"></i>
                    </li>
                </ul>
                <!-- slider -->
                <div class="sliderTestimonial">
                    <div class="item">
                        <!-- card -->
                        <div class="card border shadow-none">
                            <!-- card body -->
                            <div class="card-body p-5">
                                
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Review
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Review</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="../php/companyPage.php?service_provider_name=<?php echo urlencode($serviceProviderName); ?>" method="post">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                  <label for="reviewMessage" class="form-label">Add Review</label>
                  <textarea class="form-control" id="reviewMessage" name="review" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>




            </div>


          </div>
        </div>
      </div>