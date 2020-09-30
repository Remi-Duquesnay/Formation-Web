$("#prev-btn").click(function () { change_page("prev") });
$("#next-btn").click(function () { change_page("next") });



function change_page(change = "") {
    anim_next_page();
    setTimeout(function () {
        let page = "#" + $(".displayed").attr("id");
        $(page).removeClass("displayed");
        if(change="next") // continuer ici!!!
        switch (page) {
            case "#home":
                nextPage = "#about";
                break;
            case "#about":
                nextPage = "#folio";
                break;
            case "#folio":
                nextPage = "#contact";
                break;
            default:
                nextPage = "#home";
        }
        $(nextPage).addClass("displayed");
    }, 500);
}
function anim_next_page() {
    let layers = document.querySelectorAll(".left-layer");
    console.log(layers);
    for (const layer of layers) {
        layer.classList.toggle("active");
    }
}
