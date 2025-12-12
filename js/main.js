const menu_content = document.getElementById('menu_content');
const menu = document.getElementById('menu');
const menu_close = document.getElementById('menu_close');
const container_dark_mode = document.getElementById('container_dark_mode');
const content_dark_mode = document.getElementById('content_dark_mode');
const body = document.body;
const t = document.getElementById('t');
const titre1 = document.getElementById('titre1');
const titre2 = document.querySelector('.titre2');
const titre3 = document.querySelector('.titre3');
const parag1 = document.querySelector('.body_part2_parag');
const email_input = document.getElementById('email_input');
const password_input = document.getElementById('password_input');
const customers_section_customer = document.getElementById('customers_section_customer');
const statistiques_all = document.getElementById('statistiques');

const agent_btn = document.getElementById('agent_btn');
const btn_login = document.getElementById('btn_login');



content_dark_mode.style.left = "2px";
container_dark_mode.addEventListener('click', ()=>{
    
        if(content_dark_mode.style.left === "2px"){
            content_dark_mode.style.left = "27px";
            content_dark_mode.style.background = "#000000ff"
            content_dark_mode.style.boxShadow = "-1px -1px 3px #000601ff"
            container_dark_mode.style.border = "1px solid #000000ff";
            body.classList.add('dark_mode');
            t.classList.add('dark_mode');
            titre1.classList.add('dark_mode');
            parag1.classList.add('dark_mode');
            titre2.classList.add('dark_mode');
            titre3.classList.add('dark_mode');
            customers_section_customer.classList.add('dark_mode');
            statistiques_all.classList.add('dark_mode');
        }
        else{
            content_dark_mode.style.left = "2px";
            content_dark_mode.style.background = "#28FF48"
            content_dark_mode.style.boxShadow = "1px 1px 3px #28FF48"
            container_dark_mode.style.border = "1px solid #28FF48"
            body.classList.remove('dark_mode');
            t.classList.remove('dark_mode');
            titre1.classList.remove('dark_mode');
            parag1.classList.remove('dark_mode');
            titre2.classList.remove('dark_mode');
            titre3.classList.remove('dark_mode');
        }
    
});

agent_btn.addEventListener('click', ()=>{
    alert('Contact your admin to discuss the registration matter')
});
