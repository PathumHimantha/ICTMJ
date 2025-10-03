<?php include 'header.php'; ?>

<main class="main">
  <!-- Hero Section -->
  <section id="hero" class="hero section transparent-background">
    <div class="container text-center" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h2>ICT WITH MALINDA JAYASIRI</h2>
          <p>Master ICT concepts with expert guidance and prepare confidently for your O/L examination.</p>
        </div>

        <!-- Countdown Timer -->
        <div class="countdown d-flex justify-content-center" data-count="2025/12/03">
          <div><h3 class="count-days">0</h3><h4>Days</h4></div>
          <div><h3 class="count-hours">0</h3><h4>Hours</h4></div>
          <div><h3 class="count-minutes">0</h3><h4>Minutes</h4></div>
          <div><h3 class="count-seconds">0</h3><h4>Seconds</h4></div>
        </div>

        <!-- CTA -->
         <div class="col-lg-5 hero-newsletter mt-4">
          <p>Get started with us today!</p>       
        
               <form action="check_email.php" method="POST" class="newsletter-form">
          <input type="email" name="email" placeholder="Enter your email" required />
          <input type="submit" value="Register / Login" />
        </form>
         
        </div> 

   


        <!-- Social Links -->
        <div class="social-links mt-4">
          <a href="#"><i class="bi bi-twitter-x"></i></a>
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>
  </section>
  <!-- /Hero Section -->

  <!-- About Section -->
  <section id="about" class="about section transparent-background">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
          <p>ICT with Malinda Jayasiri is dedicated to helping students master ICT concepts...</p>
          <ul>
            <li><i class="bi bi-check2-circle"></i> Comprehensive coverage of the O/L ICT syllabus.</li>
            <li><i class="bi bi-check2-circle"></i> Step-by-step guidance with theory & past paper discussions.</li>
            <li><i class="bi bi-check2-circle"></i> Interactive learning to strengthen problem-solving skills.</li>
          </ul>
        </div>
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
          <p>Whether you are just starting ICT or preparing for your final exams...</p>
        </div>
      </div>
    </div>
  </section>
  <!-- /About Section -->

  <!-- Contact Section -->
  <section id="contact" class="contact section transparent-background">
    <div class="container section-title" data-aos="fade-up">
      <h2>Contact</h2>
      <p>Get in touch with us for class details, registrations, or any inquiries.</p>
    </div>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <div class="col-lg-6">
          <div class="row gy-4">
            <div class="col-md-6"><div class="info-item"><i class="bi bi-geo-alt"></i><h3>Address</h3><p>Mangalagama, Moladgoda, Kegalle</p></div></div>
            <div class="col-md-6"><div class="info-item"><i class="bi bi-telephone"></i><h3>Call Us</h3><p>+94 71 076 9763</p></div></div>
            <div class="col-md-6"><div class="info-item"><i class="bi bi-envelope"></i><h3>Email Us</h3><p>ictmalindajayasiri@gmail.com</p></div></div>
            <div class="col-md-6"><div class="info-item"><i class="bi bi-clock"></i><h3>Contact Support</h3><p>Monday - Sunday<br>24/7</p></div></div>
          </div>
        </div>

        <div class="col-lg-6">
          <form action="forms/contact.php" method="post" class="php-email-form">
            <div class="row gy-4">
              <div class="col-md-6"><input type="text" name="name" class="form-control" placeholder="Your Name" required /></div>
              <div class="col-md-6"><input type="email" name="email" class="form-control" placeholder="Your Email" required /></div>
              <div class="col-12"><input type="text" name="subject" class="form-control" placeholder="Subject" required /></div>
              <div class="col-12"><textarea name="message" rows="6" class="form-control" placeholder="Message" required></textarea></div>
              <div class="col-12 text-center"><button type="submit">Send Message</button></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!-- /Contact Section -->
</main>

<?php include 'footer.php'; ?>
