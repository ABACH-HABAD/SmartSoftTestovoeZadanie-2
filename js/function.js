document.addEventListener("DOMContentLoaded", function () {
  const textarea1 = document.getElementById("InputMessage");
  const textarea2 = document.getElementById("InputMessage2");
  textarea1.style.height = "100px";
  textarea2.style.height = "100px";
});

function sendForm1(event) {
  event.preventDefault();

  var exMessage = "";
  if ($("#InputName").val().length < 3) {
    if ($("#InputName").val().length < 1) exMessage += "Введите имя<br>";
    else
      exMessage +=
        "Имя слишком короткое. Минимальная дланна имени 3 символа<br>";
  }
  if ($("#InputEmail").val().length < 1) {
    exMessage += "Введите электронную почту<br>";
  }
  if ($("#InputMessage").val().length < 1) {
    exMessage += "Введите сообщение<br>";
  }

  if (exMessage) {
    Swal.fire("Неверные данные", exMessage, "error");
    return;
  }

  var formData = {
    name: $("#InputName").val(),
    surname: $("#InputSurname").val(),
    email: $("#InputEmail").val(),
    message: $("#InputMessage").val(),
  };

  $.ajax({
    url: "submit_form1.php",
    type: "POST",
    contentType: "application/json",
    data: JSON.stringify(formData),
    success: function (response) {
      if (response.success) {
        Swal.fire({
          title: "Успех!",
          text: "Сообщение успешно отправлено",
          icon: "success",
        });
      } else {
        Swal.fire({
          title: "Ошибка!",
          text: "Произошла ошибка при отправке: " + response.error,
          icon: "error",
        });
      }
    },
    error: function (xhr, status, error) {
      Swal.fire({
        title: "Критическая ошибка!",
        text: "Произошла критическая ошибка при отправке: " + error,
        icon: "error",
      });
    },
  });
}

$(document).ready(function () {
  $("#Form1").on("submit", sendForm1);
});

function sendForm2(event) {
  event.preventDefault();

  var exMessage = "";
  if ($("#InputName2").val().length < 3) {
    if ($("#InputName2").val().length < 1) exMessage += "Введите имя<br>";
    else
      exMessage +=
        "Имя слишком короткое. Минимальная дланна имени 3 символа<br>";
  }
  if (!$("#AcceptTermsOfContract").is(":checked")) {
    exMessage += "Вы должны принять условия договора-оферты<br>";
  }
  if (exMessage) {
    Swal.fire("Неверные данные", exMessage, "error");
    return;
  }

  var formData = {
    name: $("#InputName2").val(),
    surname: $("#InputAdress").val(),
    message: $("#InputMessage2").val(),
  };

  var result =
    "Имя: " +
    document.getElementById("InputName2").value +
    "<br>Адрес доставки: " +
    document.getElementById("InputAdress").value +
    "<br>Сообщение: " +
    document.getElementById("InputMessage2").value;
  Swal.fire("Заказ успешно принят", result, "success");
}

$(document).ready(function () {
  $("#Form2").on("submit", sendForm2);
});

document.getElementById("InputMessage").addEventListener("input", function () {
  this.style.height = "auto";
  this.style.height = Math.max(this.scrollHeight, 100) + "px";
});

document.getElementById("InputMessage2").addEventListener("input", function () {
  this.style.height = "auto";
  this.style.height = Math.max(this.scrollHeight, 100) + "px";
});
