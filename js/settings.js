const container_settings = document.getElementById('container_settings')
const settings_btn = document.getElementById('settings_btn')
settings_btn.addEventListener('click', ()=>{
    container_settings.classList.toggle('open');
})