<script setup>
// Import ref, onMounted, dan api
import { ref, onMounted } from "vue";
import api from "../api"; // Pastikan path ini sesuai dengan struktur project Anda

// Definisikan state untuk produk dan kontak
const produk = ref([]);
const nama = ref("");
const email = ref("");
const telepon = ref(""); // Field telepon
const pesan = ref("");
const errors = ref([]);

// Method untuk mengambil data produk
const fetchDataProduk = async () => {
  await api
    .get("/produks") // Ganti dengan endpoint API yang sesuai
    .then((response) => {
      produk.value = response.data.data.data; // Data produk yang diterima
    })
    .catch((error) => {
      console.error("Gagal mengambil data produk: ", error);
    });
};

// Method untuk mengirim pesan kontak
const sendMessage = async () => {
  let formData = new FormData();
  formData.append("nama", nama.value);
  formData.append("email", email.value);
  formData.append("telepon", telepon.value); // Kirimkan telepon juga
  formData.append("pesan", pesan.value);

  try {
    await api.post("/kontaks", formData); // Ganti dengan endpoint API untuk kontak
    // Reset form setelah berhasil
    nama.value = "";
    email.value = "";
    telepon.value = ""; // Reset telepon setelah submit
    pesan.value = "";
    alert("Pesan berhasil dikirim! Terima kasih telah menghubungi kami.");
  } catch (error) {
    errors.value = error.response?.data || ["Terjadi kesalahan. Coba lagi."];
  }
};

// Memanggil fetchDataProduk saat component mounted
onMounted(() => {
  fetchDataProduk();
});
</script>

<template>
  <div>
    <!-- Header Navbar sticky -->
    <header
      class="navbar navbar-expand-lg navbar-light bg-primary shadow-sm sticky-top"
    >
      <div class="container-fluid">
        <a class="navbar-brand fs-4 fw-bold text-white" href="#"
          >SneakersHeaven</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto justify-content-center w-100">
            <li class="nav-item">
              <a class="nav-link text-white" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#about">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#menu">Menu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </header>

    <!-- Hero Section -->
    <section
      class="bg-dark text-white text-center py-5"
      id="home"
      style="
        background-image: url('/images/hero-background.jpg');
        background-size: cover;
        background-position: center;
      "
    >
      <div class="container">
        <h1 class="display-4 fw-bold animate__animated animate__fadeInUp">
          Surganya Sepatu SneakersHeaven
        </h1>
        <p class="lead animate__animated animate__fadeInUp animate__delay-1s">
          Langkahkan kaki Anda ke dunia di mana gaya bertemu dengan kenyamanan.
        </p>
      </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-5 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h2 class="display-4" style="color: #343a40">About Us</h2>
            <p class="lead" style="color: #6c757d">
              SneakersHeaven adalah tempat terbaik untuk menemukan koleksi
              sepatu sneakers dengan desain modern yang memadukan kenyamanan dan
              gaya. Kami menawarkan berbagai pilihan sepatu untuk semua kalangan
              dengan kualitas terbaik.
            </p>
            <p class="text-muted" style="color: #6c757d">
              Temukan sneakers favorit Anda dan rasakan sensasi berbelanja
              dengan pengalaman terbaik hanya di SneakersHeaven.
            </p>
          </div>
          <div class="col-md-6">
            <img
              src="../assets/image/MainHero.jpg"
              alt="About Us Image"
              class="img-fluid rounded-3 shadow-lg"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Produk -->
    <section id="menu" class="py-5" style="background-color: #f8f9fa">
      <div class="container">
        <h2 class="text-center mb-4" style="color: #343a40">
          PRODUK TERBAIK KAMI
        </h2>
        <p class="text-center mb-5" style="color: #6c757d">
          Temukan sepatu favorit Anda dari koleksi terbaru kami.
        </p>
        <div class="row g-4">
          <div
            v-for="item in produk"
            :key="item.id"
            class="col-12 col-sm-6 col-md-4 col-lg-3"
          >
            <div
              class="card h-100 shadow-lg rounded-3 product-card hover-effect"
            >
              <img
                :src="item.image"
                :alt="item.nama_produk"
                class="card-img-top rounded-3"
              />
              <div class="card-body">
                <h5 class="card-title text-truncate" style="color: #343a40">
                  {{ item.nama_produk }}
                </h5>
                <p class="card-text text-muted" style="font-size: 0.9rem">
                  {{ item.kategori }}
                </p>
                <p class="fw-bold" style="color: #28a745">
                  Rp. {{ new Intl.NumberFormat("id-ID").format(item.harga) }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-light">
      <div class="container">
        <h2 class="text-center mb-4" style="color: #343a40">Contact Us</h2>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <form @submit.prevent="sendMessage">
              <!-- Nama -->
              <div class="mb-3">
                <label for="name" class="form-label">Your Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  placeholder="Enter your name"
                  v-model="nama"
                />
                <div v-if="errors.nama" class="alert alert-danger mt-2">
                  <span>{{ errors.nama[0] }}</span>
                </div>
              </div>

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  placeholder="Enter your email"
                  v-model="email"
                />
                <div v-if="errors.email" class="alert alert-danger mt-2">
                  <span>{{ errors.email[0] }}</span>
                </div>
              </div>

              <!-- Telepon -->
              <div class="mb-3">
                <label for="telepon" class="form-label">Phone Number</label>
                <input
                  type="tel"
                  class="form-control"
                  id="telepon"
                  placeholder="Enter your phone number"
                  v-model="telepon"
                />
                <div v-if="errors.telepon" class="alert alert-danger mt-2">
                  <span>{{ errors.telepon[0] }}</span>
                </div>
              </div>

              <!-- Pesan -->
              <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea
                  class="form-control"
                  id="message"
                  rows="4"
                  placeholder="Your message here"
                  v-model="pesan"
                ></textarea>
                <div v-if="errors.pesan" class="alert alert-danger mt-2">
                  <span>{{ errors.pesan[0] }}</span>
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit" class="btn btn-primary w-100 submit-btn">
                Send Message
              </button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
      <p class="mb-0 fs-5">© 2024 SneakersHeaven. All rights reserved.</p>
    </footer>
  </div>
</template>

<style scoped>
/* Hover Effect on Product Cards */
/* Styling untuk gambar di Section Menu */
.product-card img {
  height: 200px; /* Tetapkan tinggi gambar */
  width: 100%; /* Membuat gambar selebar kontainer */
  object-fit: cover; /* Menjaga agar gambar memenuhi area tanpa merusak aspek rasio */
  border-radius: 8px;
}

/* Hover Effect on Product Cards */
.product-card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card:hover {
  transform: scale(1.05); /* Slight zoom effect */
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); /* Shadow effect */
}

/* Styling Form Section */
#contact form {
  padding: 2rem;
  background-color: #fff;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

#contact .form-label {
  font-weight: 600;
  color: #343a40;
}

input,
textarea {
  border-radius: 8px;
}

button[type="submit"] {
  font-size: 1.1rem;
  padding: 1rem;
}

.alert {
  margin-top: 5px;
}

/* Spacing for Sections */
section {
  padding-top: 5rem;
}

#menu {
  background-color: #f8f9fa;
}

#contact {
  background-color: #f1f3f5;
  margin-top: 5rem;
}
</style>
