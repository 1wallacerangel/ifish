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

let logRegister = document.querySelector('.log-register');

document.querySelector('#login-btn').onclick = () => {
    logRegister.classList.toggle('active');
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    logRegister.classList.remove('active');
}

window.onscroll = () => {
    navbar.classList.remove('active');
    logRegister.classList.remove('active');
}

function scrolltop(onclick){
    window.scrollTo({top: 0,behavior: 'smooth',})
}