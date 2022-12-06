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
let darkMode = localStorage.getItem('dark-mode');

const enableDarkMode = () =>{
    body.classList.toggle('dark');
    header.classList.toggle('dark');
    localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
    body.classList.toggle('dark');
    header.classList.toggle('dark');
    localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enableDarkMode();
}

icon.addEventListener('click', () => {
    darkMode = localStorage.getItem('dark-mode');
   if(darkMode === 'disabled'){
      enableDarkMode();
   }else{
      disableDarkMode();
   }
})

let searchForm = document.querySelector('.search-form');

document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
    shoppingCart.classList.remove('active');
    loginForm.classList.remove('active');
    navbar.classList.remove('active');
    logRegister.classList.remove('active');
}

let shoppingCart = document.querySelector('.shopping-cart');

document.querySelector('#cart-btn').onclick = () => {
    shoppingCart.classList.toggle('active');
    searchForm.classList.remove('active');
    loginForm.classList.remove('active');
    logRegister.classList.remove('active');
    navbar.classList.remove('active');
}


let loginForm = document.querySelector('.login-form');
let logRegister = document.querySelector('.log-register');

document.querySelector('#login-btn').onclick = () => {
    logRegister.classList.toggle('active');
    searchForm.classList.remove('active');
    shoppingCart.classList.remove('active');
    navbar.classList.remove('active');
    login()
}

function login_home(onclick){
    document.querySelector('#faca-login');
    logRegister.classList.toggle('active');
    login()
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
    logRegister.classList.remove('active');
}

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

/* função login e register */

var logi = document.getElementById("login");
var registe = document.getElementById("register");
var btn = document.getElementById("btn");
var logregiste = document.querySelector(".log-register");
var logform = document.querySelector(".login-form");
var logtext = document.querySelector(".log-text");
var regtext = document.querySelector(".reg-text");

function register(){
    logi.style.left="400px";
    registe.style.left="0px";
    btn.style.left="140px";
    logregiste.style.height="595px";
    logtext.style.color="#ffffff"
    regtext.style.color="#cc1825"
}

function login(){
    logi.style.left="0px";
    registe.style.left="-385px";
    btn.style.left="20px";
    logregiste.style.height="400px";
    logtext.style.color="#cc1825"
    regtext.style.color="#ffffff"
}