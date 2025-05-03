document.addEventListener('DOMContentLoaded', function(){
  const btn = document.querySelector('.js-menu-toggle');
  const menu = document.querySelector('.js-menu');
  btn.addEventListener('click', function(){
    menu.classList.toggle('open');
  });
});