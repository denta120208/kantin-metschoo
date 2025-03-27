document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll("a");

    buttons.forEach(button => {
        button.addEventListener("mouseover", () => {
            button.classList.add("shadow-lg");
        });

        button.addEventListener("mouseleave", () => {
            button.classList.remove("shadow-lg");
        });
    });
});
