<script setup>
// import ref dan onMounted
import { ref, onMounted } from "vue";

// import api
import api from "../../api";

// definisikan state untuk kontak
const kontaks = ref([]);

// method untuk fetch data kontak
const fetchDataKontaks = async () => {
  // fetch data
  await api.get("/kontaks").then((response) => {
    // set response data ke state "kontaks"
    kontaks.value = response.data.data.data;
  });
};

// jalankan hook "onMounted"
onMounted(() => {
  // panggil method "fetchDataKontaks"
  fetchDataKontaks();
});

// method untuk menghapus kontak
const deleteKontak = async (id) => {
  // hapus kontak melalui API
  await api.delete(`/kontaks/${id}`).then(() => {
    // panggil kembali method "fetchDataKontaks" untuk mendapatkan data terbaru
    fetchDataKontaks();
  });
};
</script>

<template>
  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-12">
        <!-- Link untuk menambah data kontak baru -->
        <router-link
          :to="{ name: 'kontaks.create' }"
          class="btn btn-md btn-success rounded shadow border-0 mb-3"
        >
          ADD NEW KONTAK
        </router-link>
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <table class="table table-bordered">
              <thead class="bg-dark text-white">
                <tr>
                  <th scope="col">Nama</th>
                  <th scope="col">Email</th>
                  <th scope="col">Telepon</th>
                  <th scope="col">Pesan</th>
                  <th scope="col" style="width: 15%">Actions</th>
                </tr>
              </thead>
              <tbody>
                <!-- Kondisi jika data kosong -->
                <tr v-if="kontaks.length == 0">
                  <td colspan="4" class="text-center">
                    <div class="alert alert-danger mb-0">
                      Data Belum Tersedia!
                    </div>
                  </td>
                </tr>
                <!-- Loop untuk menampilkan setiap kontak -->
                <tr v-else v-for="(kontak, index) in kontaks" :key="index">
                  <td>{{ kontak.nama }}</td>
                  <td>{{ kontak.email }}</td>
                  <td>{{ kontak.telepon }}</td>
                  <td>{{ kontak.pesan }}</td>
                  <td class="text-center">
                    <router-link
                      :to="{ name: 'kontaks.edit', params: { id: kontak.id } }"
                      class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2"
                    >
                      EDIT
                    </router-link>
                    <button
                      @click.prevent="deleteKontak(kontak.id)"
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
