<script setup>
// Import ref dan onMounted
import { ref, onMounted } from "vue";

// Import router dan route
import { useRouter, useRoute } from "vue-router";

// Import API
import api from "../../api";

// Inisialisasi router
const router = useRouter();

// Inisialisasi route
const route = useRoute();

// Definisikan state
const nama_produk = ref("");
const kategori = ref("");
const harga = ref("");
const image = ref("");
const errors = ref([]);

// onMounted
onMounted(async () => {
  // Ambil data produk berdasarkan ID dari API
  await api.get(`/produks/${route.params.id}`).then((response) => {
    // Set data response ke state
    nama_produk.value = response.data.data.nama_produk;
    kategori.value = response.data.data.kategori;
    harga.value = response.data.data.harga;
  });
});

// Method untuk menangani perubahan file
const handleFileChange = (e) => {
  // Assign file ke state image
  image.value = e.target.files[0];
};

// Method "updateProduk"
const updateProduk = async () => {
  // Inisialisasi FormData
  let formData = new FormData();

  // Assign nilai state ke dalam formData
  formData.append("nama_produk", nama_produk.value);
  formData.append("kategori", kategori.value);
  formData.append("harga", harga.value);
  formData.append("image", image.value);
  formData.append("_method", "PATCH");

  // Kirim data dengan API
  await api
    .post(`/produks/${route.params.id}`, formData)
    .then(() => {
      // Redirect setelah data berhasil diperbarui
      router.push({ path: "/produks" });
    })
    .catch((error) => {
      // Assign data error response ke state "errors"
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
            <form @submit.prevent="updateProduk()">
              <!-- Input untuk image -->
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
                Update
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
