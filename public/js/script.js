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
        $(adresse).on('keypress', function () {
            let code = $(cp).val()
            let nom = $(this).val().split('')
            let part = ""
            for (let i = 0; i < nom.length; i++) {
                    part += nom[i]
                if(part.length>=1){
                let urlAdresse = adressUrl + part + "&postcode=" + code + format
                console.log(urlAdresse)
                fetch(
                    urlAdresse,
                    { method: 'get' }).then(response => response.json()).then(results => {
                        console.log(results.features)
                        if (results.features) {
                            // $.each(results.features, function (k, v) {
                            //     let ve = v['properties']
                            //     $.each(ve, function (ke, va) {
                            //         if (ke == 'name') {
                            //             // console.log(va)
                            //             $(adresses).append('<option class="resultat" value="' + va + '">' + va + '</option>')
                            //             // $('.resultat').val("")
                            //         }
                            //     })
                            // })
                            let data = results.features
                            data.forEach((adresse) => {
                                document.querySelector('#adresses').innerHTML += `<option value="${adresse.properties.name}">`
                            })
                        }
                    }).catch(err => {
                        console.log(err)
                })
            }
                
            }
        })
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
let commune=$('#commune')
let met= $('.met')
let urlMeteo = "https://api.meteo-concept.com/api/forecast/daily?token=252724d997e784c487b348613a6faf2ed719bdf72fa2ed845eba772b5192e80d&insee=67482"
fetch(
    urlMeteo,
    { method: 'get' }).then(response => response.json()).then(results => {
        let location = results.city.name
        $(document).ready(function(){
            $(commune).html= location
        })
        let tab = results.forecast
        console.log(tab)
        $.each(tab, function (k, v) {
            for (let i = 0; i < tab.length; i++) {
                let heur = v.datetime
                let heure = heur[i]
                for(let j=0; j<=heure;j+=24){
                    let heures=heure[j]
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