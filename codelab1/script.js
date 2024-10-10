const num1 = document.getElementById("num1");
const num2 = document.getElementById("num2");
const result = document.getElementById("result");
const addBtn = document.getElementById("addBtn");
const resetBtn = document.getElementById("resetBtn");

addBtn.addEventListener("click", function () {
  const bil1 = parseFloat(num1.value) || 0;
  const bil2 = parseFloat(num2.value) || 0;

  const total = bil1 + bil2;
  result.textContent = total;
});

resetBtn.addEventListener("click", function () {
  num1.value = "";
  num2.value = "";
  result.textContent = "0";
});
