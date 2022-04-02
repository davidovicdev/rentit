const REGEX_PASSWORD = /^(?=.*[A-Z])(?=.*[0-9])[A-z0-9$%^&*]{8,}$/;
const REGEX_USERNAME = /^[A-z][A-z0-9@#$%^&*]{3,20}$/;
const REGEX_EMAIL = /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;
const REGEX_NAMES = /^[A-Z][a-z]{2,20}$/;
const REGEX_LETTERS_ONLY = /^[A-Za-z]*$ /;
const REGEX_NUMBER_ONLY = /^[0-9]*$/;
const ERROR_FIRSTNAME =
  "* First name needs to start with first capital letter and length of minimum 3";
const ERROR_LASTNAME =
  "* Last name needs to start with first capital letter and length of minimum 3";
const ERROR_EMAIL =
  "* Email is not in valid format.  Example: john123@gmail.com";
const ERROR_CONFIRM_PASSWORD = "* Passwords do not match";
const ERROR_USERNAME =
  "* Username needs to start with a letter and length of minimum 3";
const ERROR_PASSWORD =
  "* Password needs to have at least one big letter, one number and length of minimum 8";
const ERROR_SURVEY = "Please vote to see results";
const ONE_DAY = 24 * 60 * 60 * 1000;
var results = document.getElementById("results");
results.style.display = "none";
var errors = [];
function check(regex, input, error, div) {
  if (!regex.test(input.val())) {
    errors.push(error);
    div.text(error);
  }
}
$("#loginButton").click(function () {
  errors = [];
  var username = $("#username");
  var password = $("#password");
  var usernameError = $("#usernameError");
  var passwordError = $("#passwordError");
  usernameError.text("");
  passwordError.text("");
  check(REGEX_USERNAME, username, ERROR_USERNAME, usernameError);
  check(REGEX_PASSWORD, password, ERROR_PASSWORD, passwordError);
  $.ajax({
    type: "POST",
    url: "logic/logicLogin.php",
    data: {
      usernamePHP: username.val(),
      passwordPHP: password.val(),
    },
    dataType: "json",
    success: function (response) {
      if (response == 0) {
        $("#wrongTyped").text("Wrong username or password. Try again.");
      } else {
        location.reload();
      }
    },
  });
});
$("#registerButton").click(function () {
  var username = $("#username");
  var password = $("#password");
  var confirmPassword = $("#confirmPassword");
  var email = $("#email");
  var firstName = $("#firstName");
  var lastName = $("#lastName");
  var usernameError = $("#usernameError");
  var passwordError = $("#passwordError");
  var confirmPasswordError = $("#confirmPasswordError");
  var emailError = $("#emailError");
  var firstNameError = $("#firstNameError");
  var lastNameError = $("#lastNameError");
  usernameError.text("");
  passwordError.text("");
  confirmPasswordError.text("");
  emailError.text("");
  firstNameError.text("");
  lastNameError.text("");
  check(REGEX_USERNAME, username, ERROR_USERNAME, usernameError);
  check(REGEX_PASSWORD, password, ERROR_PASSWORD, passwordError);
  check(REGEX_EMAIL, email, ERROR_EMAIL, emailError);
  check(REGEX_NAMES, firstName, ERROR_FIRSTNAME, firstNameError);
  check(REGEX_NAMES, lastName, ERROR_LASTNAME, lastNameError);
  if (confirmPassword.val() != password.val()) {
    errors.push(ERROR_CONFIRM_PASSWORD);
    confirmPasswordError.text(ERROR_CONFIRM_PASSWORD);
  }
  if (errors.length == 0) {
    console.log("USAO");
    $.ajax({
      type: "POST",
      url: "logic/logicRegister.php",
      data: {
        usernamePHP: username.val(),
        passwordPHP: password.val(),
        emailPHP: email.val(),
        firstNamePHP: firstName.val(),
        lastNamePHP: lastName.val(),
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        location.replace("index.php");
      },
    });
  }
});
$(document).on("click", "button[name='rent']", function () {
  var carID = $(this).attr("id");
  console.log(carID);
  $.ajax({
    type: "GET",
    url: "rentCar.php",
    data: {
      carIDPHP: carID,
    },
    dataType: "json",
    success: function (response) {},
    error: function (error) {
      location.replace(`rentCar.php?carIDPHP=${carID}`);
      console.error(error);
    },
  });
});
$("#contactButton").click(function () {
  const ERROR_MESSAGE = "Message needs to be at least 30 characters long";
  errors = [];
  var firstName = $("#firstName");
  var lastName = $("#lastName");
  var email = $("#email");
  var message = $("#message");
  var firstNameError = $("#firstNameError");
  var lastNameError = $("#lastNameError");
  var emailError = $("#emailError");
  var messageError = $("#messageError");
  firstNameError.text("");
  lastNameError.text("");
  emailError.text("");
  messageError.text("");
  check(REGEX_NAMES, firstName, ERROR_FIRSTNAME, firstNameError);
  check(REGEX_NAMES, lastName, ERROR_LASTNAME, lastNameError);
  check(REGEX_EMAIL, email, ERROR_EMAIL, emailError);
  if (message.val().length < 30) {
    errors.push(ERROR_MESSAGE);
    messageError.text(ERROR_MESSAGE);
  }
  if (errors.length == 0) {
    $.ajax({
      type: "POST",
      url: "logic/logicContact.php",
      data: {
        firstNamePHP: firstName.val(),
        lastNamePHP: lastName.val(),
        emailPHP: email.val(),
        messagePHP: message.val(),
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        $("#response").text(
          "Message was succesfully sent. We will try to reply as soon as possible"
        );
      },
    });
  }
});
$(document).on("click", "button[name='finalRent']", function (e) {
  errors = [];
  var carID = $(this).attr("id");
  $.ajax({
    type: "GET",
    url: "logic/logicRentCar.php",
    data: {
      carIDPHP: carID,
    },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == true) {
        alert("Please log in to rent a car.");
        location.replace("index.php");
      } else if (response == false) {
        location.replace(`rentCarFinal.php?carIDPHP=${carID}`);
      }
    },
    error: function (err) {
      console.log(err);
    },
  });
});
$("#endDate").change(function (e) {
  var currentDate = new Date();
  var price = $("input[data-price]").attr("data-price");
  var beginDate = new Date(document.getElementById("beginDate").value);
  var endDate = new Date(document.getElementById("endDate").value);
  var daysRent = Math.round(Math.abs((endDate - beginDate) / ONE_DAY));
  var totalPriceSpan = $("#totalPrice");
  console.log(beginDate);
  if (beginDate < currentDate || endDate < currentDate) {
    errors.push("ERROR DATE");
    totalPriceSpan.text("");
    $("#errorDate").text("Please select a date in future");
  }
  if (beginDate == "Invalid Date" || endDate == "Invalid Date") {
    totalPriceSpan.text("");
    $("#errorDate").text("Please select a date in future");
  } else {
    totalPriceSpan.html(daysRent * price + " &euro; / " + daysRent + " days");
  }
});
$("#finalRentButton").click(function (e) {
  errors = [];
  var currentDate = new Date();
  var carID = $("input[data-id]").attr("data-id");
  var price = $("input[data-price]").attr("data-price");
  var totalPriceSpan = $("#totalPrice");
  var beginDate = new Date(document.getElementById("beginDate").value);
  var endDate = new Date(document.getElementById("endDate").value);
  if (beginDate == "Invalid Date" || endDate == "Invalid Date") {
    errors.push("ERROR DATE");
    totalPriceSpan.text("");
    $("#errorDate").text("Please select a date");
  }
  if (beginDate < currentDate || endDate < currentDate) {
    errors.push("ERROR DATE");
    totalPriceSpan.text("");
    $("#errorDate").text("Please select a date in future");
  }
  if (errors.length == 0) {
    //TOTAL PRICE SHOW
    var daysRent = Math.round(Math.abs((endDate - beginDate) / ONE_DAY));
    totalPriceSpan.html(daysRent * price + " &euro; / " + daysRent + " days");
    var totalPrice = daysRent * price;
    $.ajax({
      type: "POST",
      url: "logic/logicFinalRent.php",
      data: {
        carIDPHP: carID,
        beginDatePHP: beginDate.toISOString().split("T")[0],
        endDatePHP: endDate.toISOString().split("T")[0],
        totalPricePHP: totalPrice,
      },
      dataType: "json",
      success: function (response) {
        alert(
          `You rented successfully for the ${daysRent} days and the total price of ${totalPrice} €`
        );
        location.replace("index.php");
      },
    });
  }
});
$("#survey").click(function (e) {
  errors = [];
  var answerID = $("input[name='answer']:checked").val();
  var surveyError = $("#surveyError");
  surveyError.text("");
  if (!answerID) {
    errors.push(ERROR_SURVEY);
    surveyError.text(ERROR_SURVEY);
  }
  if (errors.length == 0) {
    $.ajax({
      type: "POST",
      url: "logic/logicSurvey.php",
      data: {
        answerIDPHP: answerID,
      },
      dataType: "json",
      success: function (response) {
        location.reload();
      },
    });
  }
});
// ADMIN PANEL
var adminPanelErrorMessage = $("#error");
///////////////////////////////////////////////////////////ANSWERS
$("#answers").click(function (e) {
  showTable("answers.php");
});
// INSERT ANSWER
$(document).on("click", "#insertAnswer", function () {
  var answerName = $("#answerName").val();
  var votes = $("#votes").val();
  var surveyID = $("#surveyID").val();
  $.ajax({
    type: "POST",
    url: "logic/insertAnswers.php",
    data: {
      answerNamePHP: answerName,
      votesPHP: votes,
      surveyIDPHP: surveyID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("answers.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("answers.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
// DELETE ANSWERS
$(document).on("click", "input[name='deleteAnswer']", function (e) {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteAnswers.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("answers.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("answers.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
// UPDATE ANSWERS
$(document).on("click", "input[name='updateAnswer']", function (e) {
  var answerID = $(this).attr("id");
  var answerName = $(this)
    .parent()
    .parent()
    .find("td:nth-child(2) input")
    .val();
  var votes = $(this).parent().parent().find("td:nth-child(3) input").val();
  $.ajax({
    type: "POST",
    url: "logic/updateAnswers.php",
    data: {
      answerIDPHP: answerID,
      answerNamePHP: answerName,
      votesPHP: votes,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("answers.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("answers.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
///////////////////////////////////////////////////////////CARS
$("#cars").click(function (e) {
  showTable("cars.php");
});
//INSERT CAR
$(document).on("click", "#insertCar", function () {
  var carsBrandID = $("#carsBrandID").val();
  var model = $("#model").val();
  var km = $("#km").val();
  var driveID = $("#driveID").val();
  var carsBodyID = $("#carsBodyID").val();
  var topSpeed = $("#topSpeed").val();
  var kw = $("#kw").val();
  var transmissionID = $("#transmissionID").val();
  var color = $("#color").val();
  var imageID = $("#imageID").val();
  var price = $("#price").val();
  $.ajax({
    type: "POST",
    url: "logic/insertCar.php",
    data: {
      carsBrandIDPHP: carsBrandID,
      modelPHP: model,
      kmPHP: km,
      driveIDPHP: driveID,
      carsBodyIDPHP: carsBodyID,
      topSpeedPHP: topSpeed,
      kwPHP: kw,
      transmissionIDPHP: transmissionID,
      colorPHP: color,
      imageIDPHP: imageID,
      pricePHP: price,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        alert("Successfully inserted");
      }
    },
    error: function (error) {
      alert("Insert failed. Please insert valid values.");
    },
  });
});
// DELETE CAR
$(document).on("click", "input[name='deleteCar']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteCar.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      alert("Deleted successfully.");
    },
    error: function (error) {
      alert("Delete failed.");
    },
  });
});
///////////////////////////////////////////////////////////CARS_BODY
$("#cars_body").click(function () {
  showTable("cars_body.php");
});
//INSERT CARS_BODY
$(document).on("click", "#insertCarsBody", function (e) {
  var name = $("#carsBodyName").val();
  $.ajax({
    type: "POST",
    url: "logic/insertCarsBody.php",
    data: {
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("cars_body.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("cars_body.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE CARS_BODY
$(document).on("click", "input[name='deleteCarsBody']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteCarsBody.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("cars_body.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("cars_body.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
// UPDATE CARS_BODY
$(document).on("click", "input[name='updateCarsBody']", function (e) {
  var carsBodyID = $(this).attr("id");
  var name = $(this).parent().parent().find("td:nth-child(2) input").val();
  $.ajax({
    type: "POST",
    url: "logic/updateCarsBody.php",
    data: {
      carsBodyIDPHP: carsBodyID,
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("cars_body.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("cars_body.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//////////////////////////////////////////////////////////CARS_BRAND
$("#cars_brand").click(function () {
  showTable("cars_brand.php");
});
//INSERT CARS_BRAND
$(document).on("click", "#insertCarsBrand", function (e) {
  var name = $("#carsBrandName").val();
  $.ajax({
    type: "POST",
    url: "logic/insertCarsBrand.php",
    data: {
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("cars_brand.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("cars_brand.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE CARS_BRAND
$(document).on("click", "input[name='deleteCarsBrand']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteCarsBrand.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("cars_brand.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("cars_brand.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
// UPDATE CARS_BRAND
$(document).on("click", "input[name='updateCarsBrand']", function (e) {
  var carsBrandID = $(this).attr("id");
  var name = $(this).parent().parent().find("td:nth-child(2) input").val();
  $.ajax({
    type: "POST",
    url: "logic/updateCarsBrand.php",
    data: {
      carsBrandIDPHP: carsBrandID,
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("cars_brand.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("cars_brand.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//FUNCTIONS FOR ADMIN PANEL
function showTable(href) {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: `panel/${href}`,
    success: function (response) {
      $("#table").html(response);
    },
  });
}
//////////////////////////////////////////////////////////CONTACT
$("#contact").click(function () {
  showTable("contact.php");
});
//DELETE CONTACT
$(document).on("click", "input[name='deleteContact']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteContact.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("contact.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("contact.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//////////////////////////////////////////////////////////DRIVE
$("#drive").click(function () {
  showTable("drive.php");
});
//INSERT DRIVE
$(document).on("click", "#insertDrive", function (e) {
  var name = $("#carsBrandName").val();
  $.ajax({
    type: "POST",
    url: "logic/insertDrive.php",
    data: {
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("drive.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("drive.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE DRIVE
$(document).on("click", "input[name='deleteDrive']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteDrive.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("drive.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("drive.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
// UPDATE DRIVE
$(document).on("click", "input[name='updateDrive']", function (e) {
  var driveID = $(this).attr("id");
  var name = $(this).parent().parent().find("td:nth-child(2) input").val();
  $.ajax({
    type: "POST",
    url: "logic/updateDrive.php",
    data: {
      driveIDPHP: driveID,
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("drive.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("drive.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//////////////////////////////////////////////////////////ROLES
$("#roles").click(function () {
  showTable("roles.php");
});
//INSERT ROLES
$(document).on("click", "#insertRole", function (e) {
  var name = $("#role").val();
  $.ajax({
    type: "POST",
    url: "logic/insertRole.php",
    data: {
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("roles.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("roles.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE ROLE
$(document).on("click", "input[name='deleteRole']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteRole.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("roles.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("roles.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
// UPDATE DRIVE
$(document).on("click", "input[name='updateRole']", function (e) {
  var roleID = $(this).attr("id");
  var name = $(this).parent().parent().find("td:nth-child(2) input").val();
  $.ajax({
    type: "POST",
    url: "logic/updateRole.php",
    data: {
      roleIDPHP: roleID,
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("roles.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("roles.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
////////////////////////////////////////////////////////TRANSMISSION
$("#transmission").click(function () {
  showTable("transmission.php");
});
//INSERT TRANSMISSION
$(document).on("click", "#insertTransmission", function (e) {
  var name = $("#transmissionName").val();
  $.ajax({
    type: "POST",
    url: "logic/insertTransmission.php",
    data: {
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("transmission.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("transmission.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE TRANSMISSION
$(document).on("click", "input[name='deleteTransmission']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteTransmission.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("transmission.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("transmission.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//UPDATE TRANSMISSION
$(document).on("click", "input[name='updateTransmission']", function (e) {
  var transmissionID = $(this).attr("id");
  var name = $(this).parent().parent().find("td:nth-child(2) input").val();
  $.ajax({
    type: "POST",
    url: "logic/updateTransmission.php",
    data: {
      transmissionIDPHP: transmissionID,
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("transmission.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("transmission.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//////////////////////////////////////////////////////////MENU
$("#menu").click(function (e) {
  showTable("menu.php");
});
//INSERT MENU
$(document).on("click", "#insertMenu", function () {
  var href = $("#href").val();
  var title = $("#title").val();
  $.ajax({
    type: "POST",
    url: "logic/insertMenu.php",
    data: {
      hrefPHP: href,
      titlePHP: title,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("menu.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("menu.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE MENU
$(document).on("click", "input[name='deleteMenu']", function (e) {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteMenu.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("menu.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("menu.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//UPDATE MENU
$(document).on("click", "input[name='updateMenu']", function (e) {
  var menuID = $(this).attr("id");
  var href = $(this).parent().parent().find("td:nth-child(2) input").val();
  var title = $(this).parent().parent().find("td:nth-child(3) input").val();
  $.ajax({
    type: "POST",
    url: "logic/updateMenu.php",
    data: {
      menuIDPHP: menuID,
      hrefPHP: href,
      titlePHP: titlePHP,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("menu.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("menu.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
/////////////////////////////////////////////////////////////SURVEY
$("#survey").click(function () {
  showTable("survey.php");
});
//INSERT SURVEY
$(document).on("click", "#insertSurvey", function (e) {
  var name = $("#question").val();
  $.ajax({
    type: "POST",
    url: "logic/insertSurvey.php",
    data: {
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("survey.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("survey.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE SURVEY
$(document).on("click", "input[name='deleteSurvey']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteSurvey.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("survey.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("survey.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//UPDATE SURVEY
$(document).on("click", "input[name='updateSurvey']", function (e) {
  var surveyID = $(this).attr("id");
  var name = $(this).parent().parent().find("td:nth-child(2) input").val();
  $.ajax({
    type: "POST",
    url: "logic/updateSurvey.php",
    data: {
      surveyIDPHP: surveyID,
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("survey.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("survey.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
/////////////////////////////////////////////////////////////USERS_CARS
$("#users_cars").click(function (e) {
  showTable("users_cars.php");
});
//DELETE USERS_CARS
$(document).on("click", "input[name='deleteUsersCars']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteUsersCars.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("users_cars.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("users_cars.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
$("#users").click(function (e) {
  showTable("users.php");
});
//DELETE USER
$(document).on("click", "input[name='deleteUser']", function (e) {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteUser.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("users.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("users.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
///////////////////////////////////////////////////////////////IMAGES
$("#images").click(function (e) {
  showTable("images.php");
});
//DELETE IMAGE
$(document).on("click", "input[name='deleteImage']", function (e) {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "logic/deleteImage.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("images.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("images.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//INSERT IMAGE
$(document).on("click", "#insertImage", function (e) {
  var path = $("#image").val();
  $.ajax({
    type: "POST",
    url: "logic/insertImage.php",
    data: {
      pathPHP: path,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("images.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("images.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//SEARCH
$(document).on("blur", "#search", function () {
  setTimeout(() => {
    results.style.display = "none";
  }, 2000);
});
$(document).on("input", "#search", function () {
  var results = document.getElementById("results");
  var value = $(this).val();
  $.ajax({
    type: "POST",
    url: "logic/search.php",
    data: { valuePHP: value },
    dataType: "json",
    success: function (response) {
      if (response == 0) {
        results.style.display = "flex";
        results.innerText = "No results";
      } else {
        results.innerHTML = "";
        for (let i = 0; i < response.length; i++) {
          results.style.display = "flex";
          results.innerHTML += `<a href='rentCar.php?carIDPHP=${response[i]["carsID"]}' class='nav-link font-weight-bold text-center'><img class='img-fluid' src='${response[i]["path"]}'/> ${response[i]["car_brandName"]} ${response[i]["model"]}</a>`;
        }
      }
    },
  });
});
