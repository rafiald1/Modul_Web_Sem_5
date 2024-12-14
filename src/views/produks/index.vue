<script setup>
// Import ref dan onMounted
import { ref, onMounted } from "vue";

// Import API
import api from "../../api";

// Definisikan state
const produk = ref([]);

// Method fetchDataProduk
const fetchDataProduk = async () => {
  // Ambil data produk
  await api
    .get("/produks")
    .then((response) => {
      // Set data response ke state "produk"
      produk.value = response.data.data.data;
    })
    .catch((error) => {
      console.error("Gagal mengambil data produk: ", error);
    });
};

// Run hook "onMounted"
onMounted(() => {
  // Panggil method fetchDataProduk
  fetchDataProduk();
});

// Method deleteProduk
const deleteProduk = async (id) => {
  // Hapus produk dengan API
  await api
    .delete(`/produks/${id}`)
    .then(() => {
      // Panggil method "fetchDataProduk" setelah produk dihapus
      fetchDataProduk();
    })
    .catch((error) => {
      console.error("Gagal menghapus produk: ", error);
    });
};
</script>

<template>
  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-12">
        <!-- Mengubah link untuk menambahkan produk baru -->
        <router-link
          :to="{ name: 'produks.create' }"
          class="btn btn-md btn-success rounded shadow border-0 mb-3"
        >
          ADD NEW PRODUK
        </router-link>
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <table class="table table-bordered">
              <thead class="bg-dark text-white">
                <tr>
                  <th scope="col">Nama Produk</th>
                  <th scope="col">Kategori</th>
                  <th scope="col">Harga</th>
                  <th scope="col">Image</th>
                  <th scope="col" style="width: 15%">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="produk.length === 0">
                  <td colspan="4" class="text-center">
                    <div class="alert alert-danger mb-0">
                      Data Belum Tersedia!
                    </div>
                  </td>
                </tr>
                <tr v-else v-for="(item, index) in produk" :key="index">
                  <td>{{ item.nama_produk }}</td>
                  <td>{{ item.kategori }}</td>
                  <td>{{ item.harga }}</td>
                  <td class="text-center">
                    <img
                      :src="item.image"
                      width="200"
                      height="200"
                      class="rounded-3"
                    />
                  </td>
                  <td class="text-center">
                    <!-- Mengubah router-link untuk edit produk -->
                    <router-link
                      :to="{ name: 'produks.edit', params: { id: item.id } }"
                      class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2"
                    >
                      EDIT
                    </router-link>
                    <button
                      @click.prevent="deleteProduk(item.id)"
                      class="btn btn-sm btn-danger rounded-sm shadow border-0"
                    >
                      DELETE
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
