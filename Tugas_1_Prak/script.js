const display = document.getElementById("display");
const buttons = document.querySelectorAll("button");

let currentInput = "";
let operator = null;
let previousInput = "";

function updateDisplay(value) {
  display.value = value;
}

function calculate() {
  let result = 0;
  const num1 = parseFloat(previousInput);
  const num2 = parseFloat(currentInput);

  switch (operator) {
    case "+":
      result = num1 + num2;
      break;
    case "-":
      result = num1 - num2;
      break;
    case "*":
      result = num1 * num2;
      break;
    case "/":
      result = num1 / num2;
      break;
    case "%":
      result = num1 % num2;
      break;
    case "^":
      result = Math.pow(num1, num2);
      break;
    default:
      break;
  }

  return result.toString();
}

buttons.forEach(function (button) {
  button.addEventListener("click", function () {
    const value = this.getAttribute("data-value");

    if (value === "C") {
      currentInput = "";
      previousInput = "";
      operator = null;
      updateDisplay("0");
      return;
    }

    if (value === "=") {
      if (operator !== null && currentInput !== "") {
        currentInput = calculate();
        operator = null;
        previousInput = "";
        updateDisplay(currentInput);
      }
      return;
    }

    if (["+", "-", "*", "/", "%", "^"].includes(value)) {
      if (currentInput !== "") {
        operator = value;
        previousInput = currentInput;
        currentInput = "";
      }
      return;
    }

    currentInput += value;
    updateDisplay(currentInput);
  });
});
