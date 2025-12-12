const langage_site_btn = document.getElementById('langage_site');
const menu_language_btn = document.getElementById('menu_language_btn');

langage_site_btn.addEventListener('click', ()=>{
    menu_language_btn.classList.toggle('open');
});