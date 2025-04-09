<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rae Luxury - Peminjaman Barang Mewah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .hero {
            background: url('../../assets/img/luxury-bg.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }

        .section {
            padding: 60px 20px;
        }

        .featured-section-luxury {
            background: white;
            padding: 80px 0;
        }

        .featured-item-wrapper {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            background-color: #fffdf8;
        }

        .featured-item-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
        }

        .featured-item-info {
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
            padding: 15px;
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            color: #f8f8f8;
        }

        .featured-item-info h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            color: #f8f8f8;
            font-weight: 600;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .featured-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            color: #2e2e2e;
            margin-bottom: 20px;
        }

        .featured-divider {
            border-top: 2px solid #c9a646;
            width: 60px;
            margin: 30px auto;
        }


        .hero-info {
            background-color: rgba(0, 0, 0, 0.34);
            padding: 20px;
            border-radius: 20px;
        }

        .how-it-works-section {
            background-color: #D9D9D9;
        }

        .testimonials-section {
            background-color: #D9D9D9;
        }

        .email-section {
            background-color: #D9D9D9;
        }

        .navbar-luxury {
            background-color: #1a1a1a;
        }

        .navbar-luxury .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: #d2b97e !important;
            display: flex;
            align-items: center;
        }

        .navbar-luxury .navbar-brand img {
            margin-right: 10px;
        }

        .navbar-luxury .nav-link {
            font-family: 'Georgia', serif;
            color: #f5f5f5 !important;
            font-size: 1rem;
            margin-right: 15px;
            transition: color 0.3s ease, border-bottom 0.3s ease;
            position: relative;
        }

        .navbar-luxury .nav-link:hover {
            color: #d2b97e !important;
        }

        .navbar-luxury .nav-link::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #d2b97e;
            transition: width 0.3s;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .navbar-luxury .nav-link:hover::after {
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-luxury sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../../assets/img/Rael.png" alt="Rael Luxury" height="30"> Rae Luxury
        </a>
        <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#abt-us">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#how">How it Works</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#featured">Featured Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#testi">Testimonials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#email">Email</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Hero Section -->
<section class="hero hero-list-barang">
    <div class="container">
        <div class="hero-info text-center">
            <h1 class="display-3 fw-bold mb-3" style="font-family: 'Playfair Display', serif; color:rgb(255, 255, 255); text-shadow: 2px 2px 8px rgba(0,0,0,0.4);">
                Rae Luxury
            </h1>
            <p class="lead" style="font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; color: #f8f8f8;">
                Temukan sentuhan elegan dalam setiap momen. Sewa barang mewah dengan kepercayaan dan gaya.
            </p>
            <!-- Optional CTA Button -->
            <!-- <a href="#featured" class="btn btn-outline-light btn-lg mt-4" style="border-radius: 30px; font-family: 'Georgia', serif;">Jelajahi Koleksi</a> -->
        </div>
    </div>
</section>


    <!-- About Us -->
    <section id="abt-us" class="section text-center" style="background-color: #ffffff; padding: 80px 0;">
        <div class="container">
            <h2 class="fw-bold" style="font-family: 'Georgia', serif; font-size: 2.5rem; color: #2e2e2e;">Tentang Kami
            </h2>
            <p class="lead"
                style="font-family: 'Arial', sans-serif; font-size: 1.2rem; color: #777; line-height: 1.6; max-width: 800px; margin: 0 auto;">
                Rae Luxury adalah platform peminjaman barang mewah terpercaya, menawarkan berbagai koleksi eksklusif
                untuk pengalaman terbaik Anda.
                Kami memberikan pengalaman tak terlupakan dengan kualitas layanan yang unggul dan barang-barang mewah
                berkualitas tinggi.
            </p>
            <div style="border-top: 2px solid #d2b97e; width: 80px; margin: 30px auto;"></div>
            <p style="font-family: 'Georgia', serif; font-size: 1.1rem; color: #2e2e2e; font-style: italic;">
                "Kemewahan adalah pengalaman yang tak terlupakan." - Rae Luxury
            </p>
        </div>
    </section>


    <!-- How It Works -->
    <section id="how" class="section text-center how-it-works-section"
        style="background-color: #f8f8f8; padding: 80px 0;">
        <div class="container">
            <h2 class="fw-bold"
                style="font-family: 'Georgia', serif; font-size: 2.5rem; color: #2e2e2e; letter-spacing: 1px;">Cara
                Kerja</h2>
            <p class="lead"
                style="font-family: 'Arial', sans-serif; font-size: 1.2rem; color: #777; line-height: 1.6; max-width: 800px; margin: 0 auto;">
                Ikuti langkah-langkah sederhana ini untuk menikmati kemewahan yang kami tawarkan. Kami memastikan
                pengalaman Anda mudah dan nyaman.
            </p>
            <div style="border-top: 2px solid #d2b97e; width: 80px; margin: 30px auto;"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="step-box"
                        style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); margin-bottom: 30px;">
                        <h4 style="font-family: 'Georgia', serif; font-size: 1.5rem; color: #2e2e2e;">Pilih Barang</h4>
                        <p style="color: #777;">Pilih barang mewah yang Anda inginkan dari koleksi eksklusif kami.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-box"
                        style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); margin-bottom: 30px;">
                        <h4 style="font-family: 'Georgia', serif; font-size: 1.5rem; color: #2e2e2e;">Ajukan Peminjaman
                        </h4>
                        <p style="color: #777;">Isi formulir dan tunggu konfirmasi dari tim kami untuk peminjaman yang
                            lancar.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="step-box"
                        style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); margin-bottom: 30px;">
                        <h4 style="font-family: 'Georgia', serif; font-size: 1.5rem; color: #2e2e2e;">Gunakan & Nikmati
                        </h4>
                        <p style="color: #777;">Dapatkan barang mewah Anda dan nikmati pengalaman terbaik dari kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Section -->
    <section id="featured" class="featured-section-luxury text-center">
        <div class="container">
            <h2 class="fw-bold" style="font-family: 'Georgia', serif; font-size: 2.5rem; color: #2e2e2e;">Barang Mewah
                Unggulan
            </h2>
            <p class="lead"
                style="font-family: 'Arial', sans-serif; font-size: 1.2rem; color: #555; max-width: 800px; margin: 0 auto;">
                Berikut adalah beberapa barang-barang yang tersedia untuk dipinjam.
            </p>
            <div class="featured-divider"></div>
            <div class="row mt-4">
                <div class="col-md-4 featured-item mb-4">
                    <div class="featured-item-wrapper">
                        <img src="../../assets/img/hermes.png" alt="Tas Mewah"
                            style="width: 100%; height: 300px; object-fit: cover;">
                        <div class="featured-item-info">
                            <h5 class="mt-2">Tas Hermes Birkin</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 featured-item mb-4">
                    <div class="featured-item-wrapper">
                        <img src="../../assets/img/rolex.webp" alt="Jam Tangan Mewah"
                            style="width: 100%; height: 300px; object-fit: cover;">
                        <div class="featured-item-info">
                            <h5 class="mt-2">Rolex Submariner</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 featured-item mb-4">
                    <div class="featured-item-wrapper">
                        <img src="../../assets/img/lamborghini.webp" alt="Barang Mewah"
                            style="width: 100%; height: 300px; object-fit: cover;">
                        <div class="featured-item-info">
                            <h5 class="mt-2">Lamborghini Aventador</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Testimonials -->
    <section id="testi" class="section text-center testimonials-section"
        style="background-color: #f8f8f8; padding: 80px 0;">
        <div class="container">
            <h2 class="fw-bold"
                style="font-family: 'Georgia', serif; font-size: 2.5rem; color: #2e2e2e; margin-bottom: 40px;">Apa Kata
                Mereka?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-item"
                        style="background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        <blockquote
                            style="font-family: 'Georgia', serif; font-size: 1.2rem; font-style: italic; color: #2e2e2e;">
                            "Pelayanan terbaik! Saya menyewa tas mewah untuk acara penting, bagus banget"
                        </blockquote>
                        <p
                            style="font-family: 'Arial', sans-serif; font-size: 1.1rem; color: #d2b97e; font-weight: bold;">
                            - Amelia</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-item"
                        style="background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        <blockquote
                            style="font-family: 'Georgia', serif; font-size: 1.2rem; font-style: italic; color: #2e2e2e;">
                            "Rael Luxury sangat terpercaya, mobil yang saya sewa dalam kondisi prima!"
                        </blockquote>
                        <p
                            style="font-family: 'Arial', sans-serif; font-size: 1.1rem; color: #d2b97e; font-weight: bold;">
                            - Daniel</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-item"
                        style="background-color: #ffffff; padding: 40px; border-radius: 10px; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        <blockquote
                            style="font-family: 'Georgia', serif; font-size: 1.2rem; font-style: italic; color: #2e2e2e;">
                            "Sangat direkomendasikan untuk yang ingin merasakan kemewahan tanpa membeli"
                        </blockquote>
                        <p
                            style="font-family: 'Arial', sans-serif; font-size: 1.1rem; color: #d2b97e; font-weight: bold;">
                            - Rafi</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FAQ Section -->
    <section id="faq" class="section text-center" style="background-color: #ffffff; padding: 80px 0;">
        <div class="container">
            <h2 class="fw-bold mb-4" style="font-family: 'Georgia', serif; font-size: 2.5rem; color: #2e2e2e;">
                Pertanyaan Umum</h2>
            <p class="lead"
                style="font-family: 'Arial', sans-serif; font-size: 1.2rem; color: #777; max-width: 800px; margin: 0 auto 40px;">
                Temukan jawaban atas pertanyaan yang sering diajukan mengenai layanan Rae Luxury.
            </p>
            <div style="border-top: 2px solid #d2b97e; width: 80px; margin: 30px auto;"></div>

            <div class="accordion accordion-flush" id="faqAccordion"
                style="max-width: 800px; margin: 0 auto; text-align: left;">
                <div class="accordion-item"
                    style="border: none; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border-radius: 10px;">
                    <h2 class="accordion-header" id="faqHeadingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseOne" aria-expanded="false" aria-controls="faqCollapseOne"
                            style="font-family: 'Georgia', serif; font-size: 1.1rem; background-color: #fefefe; color: #2e2e2e;">
                            Bagaimana cara meminjam barang di Rae Luxury?
                        </button>
                    </h2>
                    <div id="faqCollapseOne" class="accordion-collapse collapse" aria-labelledby="faqHeadingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="font-family: 'Arial', sans-serif; color: #555;">
                            Anda hanya perlu memilih barang, mengisi formulir peminjaman, dan menunggu konfirmasi dari
                            tim kami.
                        </div>
                    </div>
                </div>

                <div class="accordion-item"
                    style="border: none; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border-radius: 10px;">
                    <h2 class="accordion-header" id="faqHeadingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseTwo" aria-expanded="false" aria-controls="faqCollapseTwo"
                            style="font-family: 'Georgia', serif; font-size: 1.1rem; background-color: #fefefe; color: #2e2e2e;">
                            Apakah barang yang dipinjam diasuransikan?
                        </button>
                    </h2>
                    <div id="faqCollapseTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="font-family: 'Arial', sans-serif; color: #555;">
                            Ya, semua barang mewah kami dilindungi oleh asuransi premium untuk kenyamanan dan keamanan
                            Anda.
                        </div>
                    </div>
                </div>

                <div class="accordion-item"
                    style="border: none; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border-radius: 10px;">
                    <h2 class="accordion-header" id="faqHeadingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#faqCollapseThree" aria-expanded="false" aria-controls="faqCollapseThree"
                            style="font-family: 'Georgia', serif; font-size: 1.1rem; background-color: #fefefe; color: #2e2e2e;">
                            Berapa lama durasi peminjaman yang tersedia?
                        </button>
                    </h2>
                    <div id="faqCollapseThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body" style="font-family: 'Arial', sans-serif; color: #555;">
                            Anda dapat memilih durasi mulai dari 1 hari hingga 14 hari, dengan kemungkinan perpanjangan
                            berdasarkan permintaan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Contact Section -->
    <section id="email" class="section email-section text-center" style="background-color: #f8f8f8; padding: 80px 0;">
        <div class="container">
            <h2 class="fw-bold" style="font-family: 'Georgia', serif; font-size: 2.5rem; color: #2e2e2e;">Hubungi Kami
            </h2>
            <p class="lead"
                style="font-family: 'Arial', sans-serif; font-size: 1.2rem; color: #777; max-width: 800px; margin: 0 auto;">
                Punya pertanyaan atau butuh bantuan? Kami dengan senang hati akan membantu Anda. Isi formulir di bawah
                ini dan tim kami akan segera menghubungi Anda.
            </p>
            <div style="border-top: 2px solid #d2b97e; width: 80px; margin: 30px auto;"></div>

            <!-- Notification -->
            <div id="notif" class="alert alert-success d-none" role="alert">
                Pesan Anda telah dikirim!
            </div>

            <form id="contactForm" style="max-width: 700px; margin: 0 auto; text-align: left;">
                <div class="mb-3">
                    <label for="nama" class="form-label" style="font-weight: bold; color: #2e2e2e;">Nama</label>
                    <input type="text" class="form-control rounded-pill" id="nama" placeholder="Nama Lengkap" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label" style="font-weight: bold; color: #2e2e2e;">Email</label>
                    <input type="email" class="form-control rounded-pill" id="email" placeholder="Alamat Email"
                        required>
                </div>
                <div class="mb-3">
                    <label for="pesan" class="form-label" style="font-weight: bold; color: #2e2e2e;">Pesan</label>
                    <textarea class="form-control rounded" id="pesan" rows="4" placeholder="Tulis pesan Anda di sini..."
                        required></textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark rounded-pill px-4 py-2"
                        style="background-color: #2e2e2e; border: none;">Kirim</button>
                </div>
            </form>
        </div>
    </section>

    <!-- JavaScript -->
    <script>
        document.getElementById("contactForm").addEventListener("submit", function (e) {
            e.preventDefault(); // Prevent page refresh

            // Show notification
            const notif = document.getElementById("notif");
            notif.classList.remove("d-none");

            // Clear form
            this.reset();

            // Hide notification after 3 seconds
            setTimeout(() => {
                notif.classList.add("d-none");
            }, 3000);
        });
    </script>


    <!-- Footer -->
    <footer style="background-color: #1a1a1a; padding: 30px 0; color: #fff; text-align: center;">
        <div class="container">
            <p class="mb-0" style="font-family: 'Georgia', serif;">&copy; 2025 Rae Luxury. All rights reserved.</p>
        </div>
    </footer>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>