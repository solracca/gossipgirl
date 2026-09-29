const outfits = Array.from({ length: 16 }, (_, i) => ({
    img: `img/outfit${i + 1}.jpg`
}));

let current = 0;

const img = document.getElementById("outfitImg");
const dots = document.getElementById("outfitDots");

function renderOutfit(){

    img.style.opacity = 0;

    setTimeout(() => {
        img.src = outfits[current].img;
        img.style.opacity = 1;
    },150);

    document.querySelectorAll(".outfit-dot").forEach((dot,index)=>{
        dot.classList.toggle("active", index === current);
    });

}

outfits.forEach((_,index)=>{

    const dot = document.createElement("div");
    dot.className = "outfit-dot";

    dot.onclick = () => {
        current = index;
        renderOutfit();
    };

    dots.appendChild(dot);

});

document.getElementById("nextOutfit").onclick = () => {
    current = (current + 1) % outfits.length;
    renderOutfit();
};

document.getElementById("prevOutfit").onclick = () => {
    current = (current - 1 + outfits.length) % outfits.length;
    renderOutfit();
};

renderOutfit();