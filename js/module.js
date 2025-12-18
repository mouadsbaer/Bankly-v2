const show_module_customers = document.getElementById('show_module_customers');
const module_customers = document.getElementById('module_customers');
const menu_close_module = document.getElementById('menu_close_module')
const cancel_btn = document.getElementById('cancel_btn');
const add_btn = document.getElementById('add_btn');
const module_msg = document.getElementById('module_msg');

show_module_customers.addEventListener('click', ()=>{
    module_customers.style.display = 'block';
});

menu_close_module.addEventListener('click', ()=>{
  if(module_customers.style.display === 'block'){
    module_customers.style.display = 'none'
  }
    
});
let module_msg_original = module_msg.textContent;
function reinisialisation(){
  module_msg.textContent= module_msg_original;
    module_msg.style.color = "#004E64";
    module_msg.style.textAlign = 'center';
    module_msg.style.borderBottom = '2px solid #004E64';
}
cancel_btn.addEventListener('click', ()=>{
   module_msg.textContent= 'Cancelling ..';
    module_msg.style.color = "red";
    module_msg.style.textAlign = 'center';
    module_msg.style.borderBottom = '2px solid red';
  setTimeout(()=>{
    if(module_customers.style.display === 'block'){
    module_customers.style.display = 'none';
   
  }

  reinisialisation();
  },1000)
  
});


