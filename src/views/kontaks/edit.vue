<script setup>
// import ref dan onMounted
import { ref, onMounted } from "vue";

// import router dan route
import { useRouter, useRoute } from "vue-router";

// import api
import api from "../../api";

// inisialisasi router
const router = useRouter();

// inisialisasi route
const route = useRoute();

// define state untuk kontak
const nama = ref("");
const email = ref("");
const telepon = ref("");
const pesan = ref("");
const errors = ref([]);

// onMounted untuk mendapatkan detail kontak berdasarkan ID
onMounted(async () => {
  // fetch data kontak berdasarkan ID yang ada di route params
  await api
    .get(`/kontaks/${route.params.id}`)
    .then((response) => {
      // set response data ke state
      nama.value = response.data.data.nama;
      email.value = response.data.data.email;
      telepon.value = response.data.data.telepon;
      pesan.value = response.data.data.pesan;
    })
    .catch((error) => {
      console.log(error);
    });
});

// method untuk handle perubahan file
// const handleFileChange = (e) => {
//   // assign file ke state
//   image.value = e.target.files[0];
// };

// method "updateKontak" untuk mengupdate data kontak
const updateKontak = async () => {
  // init formData untuk mengirim data melalui POST
  let formData = new FormData();

  // assign state value ke formData
  formData.append("nama", nama.value);
  formData.append("email", email.value);
  formData.append("telepon", telepon.value);
  formData.append("pesan", pesan.value);
  formData.append("_method", "PATCH");

  // store data dengan API
  await api
    .post(`/kontaks/${route.params.id}`, formData)
    .then(() => {
      // redirect ke halaman list kontak setelah update
      router.push({ path: "/kontaks" });
    })
    .catch((error) => {
      // assign error response ke state "errors"
      errors.value = error.response.data;
    });
};
</script>

<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <!-- Form untuk mengupdate data kontak -->
            <form @submit.prevent="updateKontak()">
              <div class="mb-3">
                <label class="form-label fw-bold">Nama</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="nama"
                  placeholder="Nama Kontak"
                />
                <div v-if="errors.nama" class="alert alert-danger mt-2">
                  <span>{{ errors.nama[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input
                  type="email"
                  class="form-control"
                  v-model="email"
                  placeholder="Email Kontak"
                />
                <div v-if="errors.email" class="alert alert-danger mt-2">
                  <span>{{ errors.email[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Telepon</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="telepon"
                  placeholder="Nomor Telepon Kontak"
                />
                <div v-if="errors.telepon" class="alert alert-danger mt-2">
                  <span>{{ errors.telepon[0] }}</span>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label fw-bold">Pesan</label>
                <textarea
                  class="form-control"
                  v-model="pesan"
                  rows="5"
                  placeholder="Pesan Kontak"
                ></textarea>
                <div v-if="errors.pesan" class="alert alert-danger mt-2">
                  <span>{{ errors.pesan[0] }}</span>
                </div>
              </div>
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
