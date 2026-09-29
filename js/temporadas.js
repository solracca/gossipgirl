const seasons = [
    {
        number: "SEASON 01",
        title: "Everything starts here.",
        image: "img/season1.jpg",
        description: "Serena van der Woodsen vuelve al Upper East Side después de haber estado fuera de Nueva York. Su regreso cambia la dinámica del grupo y hace que los secretos comiencen a salir a la luz."
    },

    {
        number: "SEASON 02",
        title: "The summer changes everything.",
        image: "img/season2.jpg",
        description: "Después de un verano lleno de cambios, el grupo vuelve a Nueva York. Nuevas relaciones, conflictos y secretos comienzan a cambiar la vida del Upper East Side."
    },

    {
        number: "SEASON 03",
        title: "A new chapter begins.",
        image: "img/season3.jpg",
        description: "El grupo comienza una nueva etapa lejos del colegio. La universidad, las relaciones y las decisiones personales hacen que todo vuelva a cambiar."
    },

    {
        number: "SEASON 04",
        title: "New York, new secrets.",
        image: "img/season4.jpg",
        description: "Entre Nueva York y París, Blair y Serena viven una nueva etapa llena de romances, amistades y secretos que vuelven a poner al grupo en el centro de Gossip Girl."
    },

    {
        number: "SEASON 05",
        title: "Love, secrets and consequences.",
        image: "img/season5.jpg",
        description: "Las relaciones se complican y nuevas decisiones cambian el futuro de los personajes. El mundo del Upper East Side vuelve a estar lleno de secretos."
    },

    {
        number: "SEASON 06",
        title: "The final chapter.",
        image: "img/season6.jpg",
        description: "El grupo enfrenta los últimos secretos de Gossip Girl mientras sus vidas toman caminos diferentes. Todo llega finalmente a su desenlace."
    }
];

let currentSeason = 0;

const image = document.getElementById("season-image");
const number = document.getElementById("season-number");
const title = document.getElementById("season-title");
const description = document.getElementById("season-description");

const prevButton = document.getElementById("prev");
const nextButton = document.getElementById("next");

const dots = document.querySelectorAll(".dot");


function showSeason(index) {

    const season = seasons[index];

    image.style.opacity = "0";

    setTimeout(function() {

        image.src = season.image;
        image.alt = "Gossip Girl " + season.number;

        number.textContent = season.number;
        title.textContent = season.title;
        description.textContent = season.description;

        image.style.opacity = "1";

    }, 200);


    dots.forEach(function(dot, i) {

        dot.classList.toggle("active", i === index);

    });
}


nextButton.addEventListener("click", function() {

    currentSeason++;

    if (currentSeason >= seasons.length) {
        currentSeason = 0;
    }

    showSeason(currentSeason);

});


prevButton.addEventListener("click", function() {

    currentSeason--;

    if (currentSeason < 0) {
        currentSeason = seasons.length - 1;
    }

    showSeason(currentSeason);

});


showSeason(currentSeason);

// Clic en los puntitos

dots.forEach(function(dot, index){

    dot.addEventListener("click", function(){

        currentSeason = index;
        showSeason(currentSeason);

    });

});







const buttons=document.querySelectorAll(".fact-btn");

buttons.forEach(btn=>{

btn.addEventListener("click",()=>{

const content=btn.nextElementSibling;

content.classList.toggle("open");

});

});