const form = document.getElementById("registrationForm");
const nameInput = document.getElementById("name");
const emailInput = document.getElementById("email");
const addressInput = document.getElementById("address");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const name = nameInput.value.trim();
  const email = emailInput.value.trim();
  const address = addressInput.value.trim();

  if (name === "") {
    alert("Nama tidak boleh kosong");
  } else if (email === "") {
    alert("Email tidak boleh kosong");
  } else if (address === "") {
    alert("Alamat tidak boleh kosong");
  } else {
    alert("Pendaftaran berhasil!");
  }
});
