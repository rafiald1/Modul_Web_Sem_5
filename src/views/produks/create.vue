<script setup>
// Import ref
import { ref } from "vue";

// Import router
import { useRouter } from "vue-router";

// Import API
import api from "../../api";

// Inisialisasi router
const router = useRouter();

// Definisikan state
const nama_produk = ref("");
const kategori = ref("");
const harga = ref("");
const image = ref("");
const errors = ref([]);

// Method untuk menangani perubahan file
const handleFileChange = (e) => {
  // Assign file ke state image
  image.value = e.target.files[0];
};

// Method "storeProduk" untuk menyimpan data produk
const storeProduk = async () => {
  // Inisialisasi FormData
  let formData = new FormData();

  // Assign nilai state ke dalam formData
  formData.append("nama_produk", nama_produk.value);
  formData.append("kategori", kategori.value);
  formData.append("harga", harga.value);
  formData.append("image", image.value);

  // Kirim data dengan API untuk membuat produk baru
  await api
    .post("/produks", formData)
    .then(() => {
      // Redirect setelah produk berhasil disimpan
      router.push({ path: "/produks" });
    })
    .catch((error) => {
      // Menyimpan pesan error jika ada
      errors.value = error.response.data.errors;
    });
};
</script>

<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <form @submit.prevent="storeProduk()">
              <!-- Input untuk gambar -->
              <div class="mb-3">
                <label class="form-label fw-bold">Image</label>
                <input
                  type="file"
                  class="form-control"
                  @change="handleFileChange($event)"
                />
                <div v-if="errors.image" class="alert alert-danger mt-2">
                  <span>{{ errors.image[0] }}</span>
                </div>
              </div>

              <!-- Input untuk nama produk -->
              <div class="mb-3">
                <label class="form-label fw-bold">Nama Produk</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="nama_produk"
                  placeholder="Nama Produk"
                />
                <div v-if="errors.nama_produk" class="alert alert-danger mt-2">
                  <span>{{ errors.nama_produk[0] }}</span>
                </div>
              </div>

              <!-- Input untuk kategori -->
              <div class="mb-3">
                <label class="form-label fw-bold">Kategori</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="kategori"
                  placeholder="Kategori Produk"
                />
                <div v-if="errors.kategori" class="alert alert-danger mt-2">
                  <span>{{ errors.kategori[0] }}</span>
                </div>
              </div>

              <!-- Input untuk harga -->
              <div class="mb-3">
                <label class="form-label fw-bold">Harga</label>
                <input
                  type="number"
                  class="form-control"
                  v-model="harga"
                  placeholder="Harga Produk"
                />
                <div v-if="errors.harga" class="alert alert-danger mt-2">
                  <span>{{ errors.harga[0] }}</span>
                </div>
              </div>

              <!-- Tombol submit -->
              <button
                type="submit"
                class="btn btn-md btn-primary rounded-sm shadow border-0"
              >
                Save
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
