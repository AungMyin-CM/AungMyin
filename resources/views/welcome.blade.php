<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>AungMyin Clinic Manager</title>
  <meta content="" name="description">

  <meta content="" name="keywords">
  <link href={{asset("assets/img/logo.png")}} rel="icon">
  <link href={{asset("assets/img/apple-touch-icon.png")}} rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href={{asset("assets/vendor/aos/aos.css")}}  rel="stylesheet">
  <link href={{asset("assets/vendor/bootstrap/css/bootstrap.min.css")}} rel="stylesheet">
  <link href={{asset("assets/vendor/bootstrap-icons/bootstrap-icons.css")}} rel="stylesheet">
  <link href={{asset("assets/vendor/glightbox/css/glightbox.min.css")}}  rel="stylesheet">
  <link href={{asset("assets/vendor/remixicon/remixicon.css")}}  rel="stylesheet">
  <link href={{asset("assets/vendor/swiper/swiper-bundle.min.css")}}  rel="stylesheet">
  <link href={{asset("assets/css/style.css")}} rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span>Aung Myin</span><sub>Clinic Manager</sub>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#home">Home</a></li>
          <li><a class="nav-link scrollto" href="#services">Our Services</a></li>
          <li><a class="nav-link scrollto" href="#pricing">Packages</a></li>       
          <li><a class="nav-link scrollto" href="#contact">Contact Us</a></li>
          @auth
            <li><a class="getstarted" href="{{asset('home')}}">My Dashboard</a></li>
          @else
            <li><a class="getstarted" href="{{asset('login')}}">Login</a></li>
            <li><a class="login" href="{{asset('register')}}">Create Account</a></li>
          @endauth
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= home Section ======= -->
  <section id="home" class="home d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up" style="font-family: 'Times New Roman', Times, serif;  font-style: italic;">Manage your </h1>
          <h1 data-aos="fade-up" style="font-family: 'Times New Roman', Times, serif;">Clinic in one Place</h1>
          <br>
          <h5 data-aos-delay="400">Why you need to upgrade your clinic?</h5>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="{{route('register.user')}}" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Started</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 home-img" data-aos="zoom-out" data-aos-delay="200">
          {{-- <img src="assets/img/home-img.png" class="img-fluid" alt=""> --}}
        </div>
      </div>
    </div>

  </section><!-- End home -->
 

  <main id="main">

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">
        <header class="section-header">       
          <p>What kind of feature are in?</p>
          <h2>Our Services</h2>
        </header>
        <div class="row gx-0">
          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Feature 1</h3>
              <h2>Assign permission by roles</h2>
              <p>
                Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor consequatur itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et est corrupti.
              </p>
            </div>
          </div>
        </div>
        <div class="row gx-0">
          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Feature 2</h3>
              <h2>Patient treatment</h2>
              <p>
                Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor consequatur itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et est corrupti.
              </p>
            </div>
          </div>
          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="" class="img-fluid" alt="">
          </div>
        </div>
        <div class="row gx-0">
          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Feature 3</h3>
              <h2>Library your keywords</h2>
              <p>
                Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor consequatur itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et est corrupti.
              </p>
            </div>
          </div>
        </div>
        <div class="row gx-0">
          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Feature 4</h3>
              <h2>Pharmacy counter</h2>
              <p>
                Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor consequatur itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et est corrupti.
              </p>
            </div>
          </div>
          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="" class="img-fluid" alt="">
          </div>
        </div>
        <div class="row gx-0">
          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Feature 5</h3>
              <h2>POS system for your pharmacy counter</h2>
              <p>
                Quisquam vel ut sint cum eos hic dolores aperiam. Sed deserunt et. Inventore et et dolor consequatur itaque ut voluptate sed et. Magnam nam ipsum tenetur suscipit voluptatum nam et est corrupti.
              </p>
            </div>
          </div>
        </div>
      </div>
       
      </div>

    </section><!-- End Services Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">

      <div class="container" data-aos="fade-up">

        <header class="section-header">        
          <p>Ready to give us a try?</p><br>
          <h2>Our Packages</h2>
        </header>

        <div class="row gy-4" data-aos="fade-left">

          <div class="col-lg-6 col-md-6" data-aos="zoom-in" data-aos-delay="100">
            <div class="box">
              <h3 style="color: #07d5c0;">Free</h3>
              <div class="price"> 0 MMK</div>
              <p>Totally free for one month</p>
              <img src="assets/img/pricing-free.png" class="img-fluid" alt="">

         
              <ul>
                <!-- <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li class="na">Pharetra massa</li>
                <li class="na">Massa ultricies mi</li> -->
              </ul>
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>

          <div class="col-lg-6 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="box">
              <span class="featured">Recommened</span>
              <h3 style="color: #65c600;">Premium</h3>
              <div class="price"> 49,000 MMK</div>
              <p>Per Month</p>
              <img src="assets/img/pricing-starter.png" class="img-fluid" alt="">
              <ul>
                <!-- <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li>Pharetra massa</li>
                <li class="na">Massa ultricies mi</li> -->
              </ul>
              <a href="#" class="btn-buy">Buy Now</a>
            </div>
          </div>
        </div>

      </div>

    </section><!-- End Pricing Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <p>Aung Myin for your Clinic</p><br>
          <h2>Contact</h2>      
        </header>

        <div class="row gy-4">
          <div class="col-lg-6">
            <div class="row gy-4">
              <div class="col-md-12">
                <div class="info-box">
                  <h3>Feel free to contact us for your query</h3>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>09403113003</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>info@aungmyin.io</p>
                </div>
              </div>  
            </div>
          </div>
          <div class="col-lg-6">
            <form action="{{route('contact-us')}}" method="post" class="php-email-form">
              @csrf
              <div class="row gy-4">
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>
                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="4" placeholder="Message" required></textarea>
                </div>
                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                  <button type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
 
          <div class="col-lg-5 col-5 footer-links">        
            <div class="social-links mt-3">
              <h3>Follow us:</h3>
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div> 
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy;2022 Copyright <strong><span>Aung Miyin</span></strong>. All Rights Reserved
      </div>
     
    </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>