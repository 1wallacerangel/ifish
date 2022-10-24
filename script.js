//Contador Slide Fotos
let contador = 1;

setInterval(function () {

    document.getElementById('radio-' + contador).checked = true;
    contador++;

    if (contador > 4) {
        contador = 1;
    }

}, 4000);
//Darkmode
/*
 const body = document.querySelector('.body');
 const icon = document.querySelector('.icon');
 
 icon.addEventListener('click', () => {
 body.classlist.toggle('body-dark');
 })*/

const body = document.querySelector('.body');
const header = document.querySelector('.header');
const icon = document.querySelector('.icon');

icon.addEventListener('click', () => {
    body.classList.toggle('dark');
    header.classList.toggle('dark');
})


let searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
}

let shoppingCart = document.querySelector('.shopping-cart');

document.querySelector('#cart-btn').onclick = () => {
    shoppingCart.classList.toggle('active');
    searchForm.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
}

let loginForm = document.querySelector('.login-form');
let logRegister = document.querySelector('.log-register');

document.querySelector('#login-btn').onclick = () => {
    loginForm.classList.toggle('active');
    logRegister.classList.toggle('active');
    searchForm.classList.remove('active');
    shoppingCart.classList.remove('active');
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
    logRegister.classList.remove('active');
}

window.onscroll = () => {
    searchForm.classList.remove('active');
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
}
/*
var swiper = new Swiper(".product-slider", {
    loop: true,
    spaceBetween: 20,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    centeredSlides: true,
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1020: {
            slidesPerView: 3,
        },
    },
});

var swiper = new Swiper(".review-slider", {
    loop: true,
    spaceBetween: 20,
    autoplay: {
        delay: 7500,
        disableOnInteraction: false,
    },
    centeredSlides: true,
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1020: {
            slidesPerView: 3,
        },
    },
});
*/
/*Ocultar e Mostrar Senha*/

const eye = document.getElementById("eye")
const senha = document.getElementById("senha-id")

function eyeClick() {

    if (senha.type === "password") {
        showPassword()
    } else {
        hidePassword()
    }
}

function showPassword() {
    senha.setAttribute("type", "text")
    eye.classList.toggle('open')
}

function hidePassword() {
    senha.setAttribute("type", "password")
    eye.classList.toggle('open')
}

var logi = document.getElementById("login");
var registe = document.getElementById("register");
var btn = document.getElementById("btn");

function register(){
    logi.style.left="400px";
    registe.style.left="0px";
    btn.style.left="140px";
}

function login(){
    logi.style.left="0px";
    registe.style.left="-380px";
    btn.style.left="20px";
}