$(document).ready(function () {
    const comUrl = "https://geo.api.gouv.fr/communes?codePostal="
    const adressUrl = "https://api-adresse.data.gouv.fr/search/?q="//8+bd+du+port&postcode=44380
    const format = "&format=json"
    let nom = "";
    let cp = $('#cp')
    let ville = $('#ville')
    let adresse = $('#adresse')
    let adresses = $('#adresses')
    $(cp).on('blur', function () {
        let code = $(this).val()
        let url = comUrl + code + format
        // console.log(url)
        fetch(
            url,
            { method: 'get' }).then(response => response.json()).then(results => {
                // console.log(results)
                if (results.length) {
                    $.each(results, function (k, v) {
                        // console.log(v)
                        // console.log(v.nom)
                        $(ville).append('<option value="' + v.nom + '">' + v.nom + '</option>')
                    })
                }
            }).catch(err => {
                console.log(err)
            })
    })

    /** Adresse */
    // $(cp).on('blur', function () {
    $(adresse).on('keyup', function () {
        let code = $(cp).val()
        let nom = $(this).val().split(' ')
        let part = ""
        for (let i = 0; i < nom.length; i++) {
            part += nom[i] + '+'
            if (part.length >= 1) {
                let urlAdresse = adressUrl + part + "&postcode=" + code + format + "&limit=80"
                console.log(urlAdresse)
                $.ajax({
                    type: 'GET',
                    url: urlAdresse,
                    dataType: 'json',
                    success: function (result) {
                        let results = result.features
                        // console.log(results)
                        results.forEach((adresse) => {
                            let addr = adresse.properties.label
                            document.querySelector('#adresses').innerHTML += `<option value="${addr}">`
                            // console.log(addr)
                        })
                        i++
                    }
                });
            }

        }
    })
})

    let paysUrl = "https://restcountries.eu/rest/v2/all"
    let pays = $('#pays')
    $(pays).on('click', () => {
        $.ajax({
            type: 'GET',
            url: paysUrl,
            dataType: 'json',
            success: (result) => {
                // let results=result.features
                // console.log(results)
                result.forEach((country) => {
                    let pay = country.name
                    $(pays).append( `<option value="${pay}"> ${pay} </option>`)
                    // console.log(addr)
                })
            }
        });
    })
// });

/** modifier password */
let pass = document.getElementById("editPass")
let input = document.getElementById("pass")
pass.addEventListener('click', function () {
    if (input.style.display == "block") {
        input.style.display = "none"
    }
    else {
        input.style.display = "block"
    }
});
/**
 API grv des meteo
 */
let divMeteo = $('#meteo')
let commune = $('#commune')
let met = $('.met')
let urlMeteo = "https://api.meteo-concept.com/api/forecast/daily?token=252724d997e784c487b348613a6faf2ed719bdf72fa2ed845eba772b5192e80d&insee=67482"
fetch(
    urlMeteo,
    { method: 'get' }).then(response => response.json()).then(results => {
        let location = results.city.name
        $(document).ready(function () {
            $(commune).html = location
        })
        let tab = results.forecast
        console.log(tab)
        $.each(tab, function (k, v) {
            for (let i = 0; i < tab.length; i++) {
                let heur = v.datetime
                let heure = heur[i]
                for (let j = 0; j <= heure; j += 24) {
                    let heures = heure[j]
                    $(met).append('<option class="resultat" value="' + heures + '">' + heures + '</option>')
                }
            }
        })
        // console.log(results.forecast)

        // Récupération de certains résultats
        // var temperature = meteo.current_observation.temp_c;
        // var humidite = meteo.current_observation.relative_humidity;
        // var imageUrl = meteo.current_observation.icon_url;
        // // Affichage des résultats
        // var conditionsElt = document.createElement("div");
        // conditionsElt.textContent = "Il fait actuellement " + temperature +
        //     "°C et l'humidité est de " + humidite;
        // var imageElt = document.createElement("img");
        // imageElt.src = imageUrl;
        // var meteoElt = document.getElementById("meteo");
        // meteoElt.appendChild(conditionsElt);
        // meteoElt.appendChild(imageElt);
        // divMeteo.value = conditionsElt.textContent + imageElt.src + meteoElt.appendChild(conditionsElt) + meteoElt.appendChild(imageElt)
    })