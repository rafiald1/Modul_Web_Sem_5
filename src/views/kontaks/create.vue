<script setup>
// import ref
import { ref } from "vue";

// import router
import { useRouter } from "vue-router";

// import api
import api from "../../api";

// inisialisasi router
const router = useRouter();

// define state untuk kontak
const nama = ref("");
const email = ref("");
const telepon = ref("");
const pesan = ref("");
const errors = ref([]);

// method "storePost" untuk mengirim data kontak
const storePost = async () => {
  // init formData untuk mengirim data
  let formData = new FormData();

  // assign state value ke formData
  formData.append("nama", nama.value);
  formData.append("email", email.value);
  formData.append("telepon", telepon.value);
  formData.append("pesan", pesan.value);
  // formData.append("_method", "PATCH");

  // kirim data dengan API
  await api
    .post("/kontaks", formData)
    .then(() => {
      // redirect setelah data berhasil disimpan
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
            <!-- Form untuk membuat kontak baru -->
            <form @submit.prevent="storePost()">
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
                  placeholder="Telepon Kontak"
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
                Save
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
