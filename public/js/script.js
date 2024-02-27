$(document).ready(function () {
  const comUrl = "https://geo.api.gouv.fr/communes?codePostal=";
  const adressUrl = "https://api-adresse.data.gouv.fr/search/?q="; //8+bd+du+port&postcode=44380
  const format = "&format=json";
  let nom = "";
  let cp = $("#cp");
  let ville = $("#ville");
  let adresse = $("#adresse");
  let adresses = $("#adresses");
  $(cp).on("blur", function () {
    let code = $(this).val();
    let url = comUrl + code + format;
    // console.log(url)
    fetch(url, { method: "get" })
      .then((response) => response.json())
      .then((results) => {
        // console.log(results)
        if (results.length) {
          $.each(results, function (k, v) {
            // console.log(v)
            // console.log(v.nom)
            $(ville).append(
              '<option value="' + v.nom + '">' + v.nom + "</option>"
            );
          });
        }
      })
      .catch((err) => {
        console.log(err);
      });
  });

  /** Adresse */
  // $(cp).on('blur', function () {
  $(adresse).on("keyup", function () {
    let code = $(cp).val();
    let nom = $(this).val().split(" ");
    let part = "";
    for (let i = 0; i < nom.length; i++) {
      part += nom[i] + "+";
      if (part.length >= 1) {
        let urlAdresse =
          adressUrl + part + "&postcode=" + code + format + "&limit=80";
        console.log(urlAdresse);
        $.ajax({
          type: "GET",
          url: urlAdresse,
          dataType: "json",
          success: function (result) {
            let results = result.features;
            // console.log(results)
            results.forEach((adresse) => {
              let addr = adresse.properties.label;
              document.querySelector(
                "#adresses"
              ).innerHTML += `<option value="${addr}">`;
              // console.log(addr)
            });
            i++;
          },
        });
      }
    }
  });
});

let paysUrl = "https://restcountries.com/v3.1/all";
let pays = $("#pays");
$(pays).on("click", () => {
  $.ajax({
    type: "GET",
    url: paysUrl,
    dataType: "json",
    success: (result) => {
      result.forEach((country) => {
        let pay = country.name.common;
        $(pays).append(`<option value="${pay}"> ${pay} </option>`);
      });
    },
  });
});
// });

/** modifier password */
let pass = document.getElementById("editPass");
let input = document.getElementById("pass");
if (pass) {
  pass.addEventListener("click", function () {
    if (input.style.display == "block") {
      input.style.display = "none";
    } else {
      input.style.display = "block";
    }
  });
}

const flash = document.getElementById('flash-message')
if(flash) {
  setTimeout(() => {
    flash.remove();
  }, 5000);
}