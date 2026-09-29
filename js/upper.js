const placeButtons = document.querySelectorAll(".place-btn");

placeButtons.forEach(button => {

    button.addEventListener("click", () => {

        const content = button.nextElementSibling;

        // Cierra los demás
        document.querySelectorAll(".place-content").forEach(item => {
            if(item !== content){
                item.classList.remove("open");
            }
        });

        content.classList.toggle("open");

    });

});