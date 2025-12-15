const filter_btn = document.getElementById('filter_btn');
const filter_menu = document.getElementById('filter_menu');


filter_btn.addEventListener('click', ()=>{
    filter_menu.classList.toggle('open');
});