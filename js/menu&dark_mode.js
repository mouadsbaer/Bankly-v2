menu.addEventListener('click', ()=>{
    
    setTimeout(()=>{
    menu_content.classList.add('open');
    }, 150);
});
menu_close.addEventListener('click', (e)=>{
    e.preventDefault()
    setTimeout(()=>{
        menu_content.classList.remove('open');
    }, 150);
});