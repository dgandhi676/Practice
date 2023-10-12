function validateform() {
  const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

  let email = document.forms["loginform"]["email"].value;
  if (!emailRegex.test(email)) {
    showTooltip(
      "email",
      "Please enter a valid email address (name@example.com)."
    );
    return false;
  }
  var newPassword = document.getElementById("password").newPassword.value;
  var minNumberofChars = 8;
  var maxNumberofChars = 16;
  var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
  showTooltip(newPassword);
  if (newPassword.length < minNumberofChars || newPassword.length > maxNumberofChars) {
    return false;
  }
  if (!regularExpression.test(newPassword)) {
    showTooltip("password", "password should contain atleast one number and one special character");
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
    $password = stripslashes($_REQUEST["password"]);
    $password = mysqli_real_escape_string($con, $password);
    tooltip.hide();
  }, 1000);
}
document
  .getElementById("loginform")
  .addEventListener("submit", function (event) {
    if (!validateform()) {
      event.preventDefault();
    }
  });
