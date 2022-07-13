const navSlide = ()=> { 
    const icono = document.querySelector(".icono");
    const nav = document.querySelector(".navs");

    icono.addEventListener("click",()=>{
        nav.classList.toggle("navs-avtive");
    });
}

navSlide();