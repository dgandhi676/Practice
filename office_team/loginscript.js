const nameRegex = /^[A-Za-z ]+$/;
const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
const passRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;

function validateForm() {
  const fullname = document.forms["loginform"]["fullname"].value;
  const email = document.forms["loginform"]["email"].value;
  const username = document.forms["loginform"]["username"].value;
  const newPassword = document.getElementById("password").value;

  if (fullname === "" || !nameRegex.test(fullname)) {
    alert(
      "fullname",
      "Employee First Name should contain alphabets and spaces only!"
    );
    return false;
  }

  if (!emailRegex.test(email)) {
    alert(
      "email",
      "Please enter a valid email address (name@example.com)."
    );
    return false;
  }

  if (username === "") {
    alert("username", "Username cannot be empty.");
    return false;
  }

  if (newPassword.length < 8 || newPassword.length > 16) {
    alert("password", "Password should be between 8 to 16 characters.");
    return false;
  }

  if (!passRegex.test(newPassword)) {
    alert(
      "password",
      "Password should contain at least one number and one special character."
    );
    return false;
  }

  return true;
}

function showTooltip(elementId, message) {
  const element = document.getElementById(elementId);
  const tooltip = new bootstrap.Tooltip(element, {
    title: message,
    trigger: "manual",
    placement: "bottom",
  });

  tooltip.show();
  setTimeout(() => {
    tooltip.hide();
  }, 2000);
}

document
  .getElementById("loginform")
  .addEventListener("submit", function (event) {
    if (!validateForm()) {
      event.preventDefault();
    }
  });

document
  .getElementById("fullname")
  .addEventListener("keypress", function (event) {
    const regex = /^[A-Za-z\s]+$/;
    const key = String.fromCharCode(event.charCode);
    if (!regex.test(key)) {
      event.preventDefault();
    }
  });

document.getElementById("username").addEventListener("input", function (event) {
  const username = event.target.value;
  if (username === "") {
    showTooltip("username", "Username cannot be empty.");
    return;
  }

  $.post("signup.php", { username: username }, function (data) {
    if (data === "exists") {
      showTooltip("username", "Username already exists.");
    } else {
      showTooltip("username", "");
    }
  });
});
