let navbar = document.querySelector('.header .flex .navbar');
let profile = document.querySelector('.header .flex .profile');
let searchForm = document.querySelector('.header .flex .search-form');

const menuBtn = document.querySelector('#menu-btn');
const userBtn = document.querySelector('#user-btn');
const searchBtn = document.querySelector('#search-btn');

if (menuBtn && navbar) {
   menuBtn.onclick = () => {
      navbar.classList.toggle('active');
      searchForm?.classList.remove('active');
      profile?.classList.remove('active');
   };
}

if (userBtn && profile) {
   userBtn.onclick = () => {
      profile.classList.toggle('active');
      searchForm?.classList.remove('active');
      navbar?.classList.remove('active');
   };
}

if (searchBtn && searchForm) {
   searchBtn.onclick = () => {
      searchForm.classList.toggle('active');
      navbar?.classList.remove('active');
      profile?.classList.remove('active');
   };
}

window.onscroll = () => {
   profile?.classList.remove('active');
   navbar?.classList.remove('active');
   searchForm?.classList.remove('active');
};

document.querySelectorAll('.content-150').forEach(content => {
   if (content.innerHTML.length > 150) {
      content.innerHTML = content.innerHTML.slice(0, 150);
   }
});
