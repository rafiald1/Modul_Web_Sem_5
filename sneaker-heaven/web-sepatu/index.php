<?php
// Koneksi ke database
include 'db.php';

// Query untuk mengambil data produk
$sql = "SELECT * FROM produk";
$stmt = $pdo->query($sql); // Menggunakan $pdo, bukan $conn
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SneakersHeaven</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="CSS/style.css" />
  </head>

  <body>
    <header>
      <nav class="navbar">
        <a href="#" class="navbar-logo">SneakersHeaven</a>
        <div class="navbar-nav">
          <a href="#home">Home</a>
          <a href="#about">About Us</a>
          <a href="#menu">Menu</a>
          <a href="#contact">Contact</a>
        </div>
        <div class="navbar-icons">
          <a href="#" id="search"><i data-feather="search"></i></a>
          <a href="#" id="shopping-cart"><i data-feather="shopping-cart"></i></a>
          <a href="#" id="hb-menu"><i data-feather="menu"></i></a>
        </div>
      </nav>
    </header>

    <section class="utama" id="home">
      <main class="primary">
        <h1>Surganya Sepatu SneakersHeaven</h1>
        <p>
          Langkahkan kaki Anda ke dunia di mana gaya bertemu dengan kenyamanan.
          <br />
          Di SneakersHeaven, kami percaya bahwa sepatu bukan hanya pelengkap,<br />
          tetapi juga pernyataan. Dengan koleksi terbaru dan terlengkap, kami
          <br />
          siap membantu Anda menemukan pasangan sempurna yang sesuai dengan
          <br />
          kepribadian dan gaya hidup Anda.
        </p>
      </main>
    </section>

    <section id="about" class="about">
      <h2>About Us</h2>
      <div class="row">
        <div class="cover-img">
          <img src="Assets/coverAbout2.jpg" alt="Cover About" />
        </div>
        <div class="content">
          <h3>Belanja di kami di jamin Ori</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum sit
            sint sequi maiores dicta ducimus!
          </p>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi atque
            cum nam, suscipit exercitationem similique?
          </p>
        </div>
      </div>
    </section>

    <section id="menu" class="menu">
      <h2>PRODUK TERBAIK KAMI</h2>

      <p>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aperiam id,
        fuga nesciunt odio numquam maxime necessitatibus eveniet adipisci
        suscipit autem?
      </p>

      <div class="product-list">
        <?php
        // Loop melalui data produk dan tampilkan
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
          <div class="product">
            <img src="<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_produk']; ?>" />
            <p class="category"><?php echo $row['kategori']; ?></p>
            <p class="product-name"><?php echo $row['nama_produk']; ?></p>
            <p class="price">Rp. <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
          </div>
        <?php
        }
        ?>
      </div>
    </section>

    <section id="contact" class="contact-section">
        <div class="container">
          <div class="contact-wrapper">
            <!-- Bagian Peta -->
            <div class="contact-map">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15807.194144192901!2d112.58789519408994!3d-7.91610182371577!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7881f31265cdeb%3A0x5e9fb030b533a942!2sTegalgondo%2C%20Kec.%20Karang%20Ploso%2C%20Kabupaten%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1728407259231!5m2!1sid!2sid"
                width="600"
                height="515"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </div>
            <!-- Bagian Form Kontak -->
            <div class="contact-form">
              <h2>Contact Us</h2>
              <form action="" method="post">
                <div class="input-group">
                  <label for="name">Name:</label>
                  <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Enter your name"
                    required
                  />
                </div>
                <div class="input-group">
                  <label for="email">Email:</label>
                  <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                  />
                </div>
                <div class="input-group">
                  <label for="phone">Phone:</label>
                  <input
                    type="text"
                    id="phone"
                    name="phone"
                    placeholder="Enter your phone number"
                    required
                  />
                </div>
                <div class="input-group">
                  <label for="message">Message:</label>
                  <textarea
                    id="message"
                    name="message"
                    rows="5"
                    placeholder="Enter your message"
                    required
                  ></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
              </form>
            </div>
          </div>
        </div>
      </section>
    

    <footer>
      <div class="footer-container">
        <div class="footer-about">
          <h3>About SneakersHeaven</h3>
          <p>
            Your one-stop shop for the latest and greatest in sneaker fashion.
            Our mission is to provide high-quality, stylish footwear for every
            sneaker enthusiast.
          </p>
        </div>
        <div class="footer-links">
          <h3>Quick Links</h3>
          <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#privacy">Privacy Policy</a></li>
          </ul>
        </div>
        <div class="footer-contact">
          <h3>Contact Us</h3>
          <p>
            <i data-feather="map-pin"></i> 123 Sneaker Street, Malang, Indonesia
          </p>
          <p><i data-feather="phone"></i> +62 123 4567 890</p>
          <p><i data-feather="mail"></i> support@sneakersheaven.com</p>
        </div>
        <div class="footer-social">
          <h3>Follow Us</h3>
          <div class="social-icons">
            <a href="#"><i data-feather="twitter"></i></a>
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
            <a href="#"><i data-feather="youtube"></i></a>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <p>© 2024 SneakersHeaven. All rights reserved.</p>
      </div>
    </footer>

    <script>
      feather.replace();
    </script>
    <script src="JS/script.js"></script>
  </body>
</html>
