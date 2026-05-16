<?php $this->load->view('layouts/header'); ?>
<section class="contact-page" id="contact" data-aos="fade-up"><?php $this->load->view('layouts/header'); ?>

    <div class="contact-hero">
        <div class="contact-hero-text">
            <p>Contact Lavéra</p>
            <h1>Let’s Connect</h1>
            <span>
                Kami senang mendengar pesanmu. Hubungi kami untuk pertanyaan,
                konsultasi outfit, atau kebutuhan custom lainnya.
            </span>
        </div>
    </div>

    <div class="contact-wrapper">

        <div class="contact-info-card">
            <h2>Contact Information</h2>

            <div class="contact-info-item">
                <i class="fa-solid fa-location-dot"></i>
                <div>
                    <h4>Our Studio</h4>
                    <p>Tangerang, Banten, Indonesia</p>
                </div>
            </div>

            <div class="contact-info-item">
                <i class="fa-solid fa-envelope"></i>
                <div>
                    <h4>Email Us</h4>
                    <p>hello@lavera.id</p>
                </div>
            </div>

            <div class="contact-info-item">
                <i class="fa-solid fa-phone"></i>
                <div>
                    <h4>Call Us</h4>
                    <p>+62 813 1535 2350</p>
                </div>
            </div>

            <div class="contact-info-item">
                <i class="fa-solid fa-clock"></i>
                <div>
                    <h4>Business Hours</h4>
                    <p>Monday - Saturday<br>09.00 - 18.00 WIB</p>
                </div>
            </div>
        </div>

        <div class="contact-form-card">
            <h2>Send Us a Message</h2>

            <form action="#" method="post">
                <div class="form-row">
                    <input type="text" name="name" placeholder="Full Name">
                    <input type="email" name="email" placeholder="Email Address">
                </div>

                <input type="text" name="subject" placeholder="Subject">

                <textarea name="message" placeholder="Your Message"></textarea>

                <button type="submit">
                    Send Message
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="contact-cta">
        <div class="contact-cta-overlay"></div>
        <div class="contact-cta-content">
            <h2>
                Let’s Bring Your Dream Outfit to Life
            </h2>

            <span>
                Wujudkan outfit impianmu bersama Lavéra dengan desain elegan,
                detail personal, dan sentuhan fashion yang timeless.
            </span>

        </div>
    </div>

</section>

<?php $this->load->view('layouts/footer'); ?>