function validateform() {
  const nameRegex = /^[A-Za-z ]+$/;
  const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
  const dobInput = document.getElementById("dob");
  const numberInput = document.getElementById("monumber");

  let firstName = document.forms["teamform"]["fname"].value;
  if (firstName === "" || !nameRegex.test(firstName)) {
    showTooltip(
      "fname",
      "Employee First Name should contain alphabets and spaces only!"
    );
    return false;
  }

  let lastName = document.forms["teamform"]["lname"].value;
  if (lastName === "" || !nameRegex.test(lastName)) {
    showTooltip(
      "lname",
      "Employee Last Name should contain alphabets and spaces only!"
    );
    return false;
  }

  let number = numberInput.value;
  const phoneRegex = /^\d{10}$/;
  if (!phoneRegex.test(number)) {
    showTooltip("monumber", "Enter 10 digit number");
    return false;
  }

  let selectedDate = dobInput.value;
  const today = new Date().toISOString().split("T")[0];
  if (selectedDate === "" || selectedDate > today) {
    showTooltip("dob", "Please select a valid date.");
    return false;
  }

  let imagehidden = $("#hiddenimg").val();
  let fileInput = document.getElementById("empimg");
  let file = fileInput.files[0];
  const allowedMimeTypes = [
    "image/jpeg",
    "image/png",
    "image/gif",
    "image/jpg",
  ];
  if (imagehidden) {
    return true;
  } else if (
    !file ||
    file.size > 100000 ||
    !allowedMimeTypes.includes(file.type)
  ) {
    showTooltip(
      "empimg",
      "Please Upload Image (maximum size: 100KB, allowed file types: JPEG, PNG, GIF)."
    );
    return false;
  }

  let email = document.forms["teamform"]["email"].value;
  if (!emailRegex.test(email)) {
    showTooltip(
      "email",
      "Please enter a valid email address (name@example.com)."
    );
    return false;
  }

  let male = document.getElementById("Male").checked;
  let female = document.getElementById("Female").checked;
  if (!male && !female) {
    showTooltip("gender", "Select a Gender");
    return false;
  }

  const selectedCountry = countrySelect.value;
  if (selectedCountry === "") {
    showTooltip("country", "Please select a country");
    return false;
  }
  const selectedState = stateSelect.value;
  if (selectedState === "") {
    showTooltip("state", "Please select a state");
    return false;
  }
  const selectedCity = citySelect.value;
  if (selectedCity === "") {
    showTooltip("city", "Please select a city.");
    return false;
  }

  let completionOptions = document.querySelectorAll(
    'input[name="complete[]"]:checked'
  );
  if (completionOptions.length === 0) {
    showTooltip("complete", "Select At least One Option");
    return false;
  }

  let profileDescription = document.forms["teamform"]["profiledes"].value;
  if (profileDescription === "") {
    showTooltip("profiledes", "Please Enter Profile Description!!!");
    return false;
  }

  return true;
}
function validateImageSize(input) {
  const file = input.files[0];
  if (file && file.size > 100000) {
    showTooltip("empimg", "Image size exceeds 100KB.");
    input.value = "";
  }
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
  .getElementById("teamform")
  .addEventListener("submit", function (event) {
    if (!validateform()) {
      event.preventDefault();
    }
  });

document.getElementById("fname").addEventListener("keypress", function (event) {
  const regex = /^[A-Za-z\s]+$/;
  const key = String.fromCharCode(event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
  }
});

document.getElementById("lname").addEventListener("keypress", function (event) {
  const regex = /^[A-Za-z\s]+$/;
  const key = String.fromCharCode(event.charCode);
  if (!regex.test(key)) {
    event.preventDefault();
  }
});

document
  .getElementById("monumber")
  .addEventListener("keypress", function (event) {
    const key = String.fromCharCode(event.charCode);
    if (!/[0-9]/.test(key)) {
      event.preventDefault();
    }
  });

// USING API KEY COUNTRY, STATE, CITY DROPDOWN
let config = {
  cUrl: "https://api.countrystatecity.in/v1/countries",
  ckey: "Q29WMVZCQktWWnJoY0s4Z3pqcnlMUTJub0ZEYnl1U1RuNng4V1ZzMQ==",
};

let countrySelect, stateSelect, citySelect;

window.onload = function () {
  countrySelect = document.getElementById("country");
  stateSelect = document.getElementById("state");
  citySelect = document.getElementById("city");

  loadCountries();
};

document.addEventListener("DOMContentLoaded", function () {
  countrySelect = document.getElementById("country");
  stateSelect = document.getElementById("state");
  citySelect = document.getElementById("city");

  loadCountries();
});

function loadCountries() {
  let apiEndPoint = config.cUrl;
  stateSelect.innerHTML = '<option value="">Select State</option>';
  citySelect.innerHTML = '<option value="">Select City</option>';
  var getCountry = $("#hiddencountry").val();

  fetch(apiEndPoint, {
    headers: {
      "X-CSCAPI-KEY": config.ckey,
    },
  })
    .then((Response) => Response.json())
    .then((data) => {
      data.forEach((country) => {
        const option = document.createElement("option");
        option.value = country.iso2;
        if (getCountry === country.iso2) {
          option.selected = true;
        }
        option.textContent = country.name;
        countrySelect.appendChild(option);
      });
      loadStates();
    })
    .catch((error) => console.error("Error loading countries:", error));
}

function loadStates(status = false) {

  const selectedCountryCode = countrySelect.value;
  stateSelect.innerHTML = '<option value="">Select State</option>';
  citySelect.innerHTML = '<option value="">Select City</option>';
  if(!status){
    var getCountry = $("#hiddencountry").val();
    var getState = $("#hiddenstate").val();
  }else{
    var getCountry = selectedCountryCode;  
    citySelect.disabled = true;          
  }

  fetch(`${config.cUrl}/${getCountry}/states`, {
    headers: {
      "X-CSCAPI-KEY": config.ckey,
    },
  })
    .then((Response) => Response.json())
    .then((data) => {
      if(data.length > 1){
        stateSelect.disabled = false;
        data.forEach((state) => {
          const option = document.createElement("option");
          option.value = state.iso2;
          if (getState === state.iso2) {
            option.selected = true;
          }
          option.textContent = state.name;
          stateSelect.appendChild(option);
        }); 
      }else{
        stateSelect.disabled = true;    
        stateSelect.innerHTML = '<option value="">State Could Not Found.</option>';
        citySelect.innerHTML = '<option value="">City Could Not Found.</option>';

      }
        
      if(!status){  
        loadCities();
      }
      
    })
    .catch((error) => console.error("Error loading states:", error));
}

function loadCities(status = false) {
  const selectedCountryCode = countrySelect.value;
  const selectedStateCode = stateSelect.value;

  citySelect.innerHTML = '<option value="">Select City</option>';
  // citySelect.value = "";
  if(!status){
    var getCountry = $("#hiddencountry").val();
    var getState = $("#hiddenstate").val();
    var getCity = $("#hiddencity").val();
  }else{
    var getCountry = selectedCountryCode;
    var getState = selectedStateCode;
    citySelect.disabled = false;    
  }
  
  fetch(`${config.cUrl}/${getCountry}/states/${getState}/cities`, {
    headers: { "X-CSCAPI-KEY": config.ckey },
  })
    .then((Response) => Response.json())
    .then((data) => {
      if(data.length > 1){
        data.forEach((city) => {            
          const option = document.createElement("option");
          option.value = city.name;
          if (getCity == city.name) {
            
            option.selected = true;
          }
          option.textContent = city.name;
          citySelect.appendChild(option);
        });
      }else{
        citySelect.innerHTML = '<option value="">City Not Found.</option>';
      }
      
    })
    .catch((error) => console.error("Error loading cities:", error));
}
