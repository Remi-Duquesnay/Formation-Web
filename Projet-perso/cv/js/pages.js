$("#prev-btn").click(function () { change_page("prev") });
$("#next-btn").click(function () { change_page("next") });

function displayNavBTNs(page){
    if(page=="#home" || page="" || page="" || page=""){
    $("#prev-btn").addClass("displayed")
}
}


function change_page(change = "",) {
    anim_next_page();
    setTimeout(function () {
        let page = "#" + $("section.displayed").attr("id");
        displayNavBTNs(page)
        $(page).removeClass("displayed");
        switch (page) {
            case "#home":
                nextPage = "#about";
                break;
            case "#about":
                prevPage = "#home";
                nextPage = "#folio";
                break;
            case "#folio":
                prevPage = "#about";
                nextPage = "#contact";
                break;
            default:
                prevPage = "#folio";
        }
        if(change="next"){
            $(nextPage).addClass("displayed");
        }else if(change="prev"){
            $(prevPage).addClass("displayed");
        }else{
            $(change).addClass("displayed");
        }
        
    }, 500);
}
function anim_next_page() {
    let layers = document.querySelectorAll(".left-layer");
    console.log(layers);
    for (const layer of layers) {
        layer.classList.toggle("active");
    }
}
