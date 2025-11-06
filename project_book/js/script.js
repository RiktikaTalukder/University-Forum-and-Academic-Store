let userBox = document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () =>{
   userBox.classList.toggle('active');
   navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () =>{
   navbar.classList.toggle('active');
   userBox.classList.remove('active');
}

window.onscroll = () =>{
   userBox.classList.remove('active');
   navbar.classList.remove('active');

   if(window.scrollY > 60){
      document.querySelector('.header .header-2').classList.add('active');
   }else{
      document.querySelector('.header .header-2').classList.remove('active');
   }
}/*=============== HOME SWIPER ===============*/
document.addEventListener('DOMContentLoaded', function() {
  const homeSwiper = new Swiper('.home__swiper', {
    loop: true,
    effect: 'slide',
    speed: 800,
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    spaceBetween: 40,
    
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
});

/*=============== FEATURED SWIPER ===============*/
let swiperFeatured = new Swiper('.featured__swiper', {
  loop: true,
  spaceBetween: 16,
  grabCursor: true,
  slidesPerView: 'auto',
  centeredSlides: 'auto',

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  
  breakpoints:{
    1150: {
      slidesPerView: 4,
      centeredSlides: false,
    },
  },
})

/*=============== NEW SWIPER ===============*/
let swiperNew = new Swiper('.new__swiper', {
  loop: true,
  spaceBetween: 16,
  slidesPerView: 'auto',

  breakpoints:{
    1150: {
      slidesPerView: 3,
    },
  },
})

/*=============== SHOW SCROLL UP ===============*/ 
const scrollUp = () =>{
	const scrollUp = document.getElementById('scroll-up')
    // When the scroll is higher than 350 viewport height, add the show-scroll class to the a tag with the scrollup class
	this.scrollY >= 350 ? scrollUp.classList.add('show-scroll')
						: scrollUp.classList.remove('show-scroll')
}
window.addEventListener('scroll', scrollUp)

/*=============== SCROLL REVEAL ANIMATION ===============*/
// Initialize ScrollReveal
const sr = ScrollReveal({
  origin: 'top',
  distance: '60px',
  duration: 2500,
  delay: 400,
  reset: false, // Set to true if you want animations to repeat on scroll up
  easing: 'cubic-bezier(0.5, 0, 0, 1)', // Smoother easing
  mobile: true // Enable on mobile devices
});

// Apply animations
sr.reveal(`.home__data, .featured__container, .new__container, .products, .home-contact, .footer`, {
  interval: 100 // Stagger animations
});

sr.reveal(`.home__images`, { 
  delay: 600,
  origin: 'right' 
});

sr.reveal(`.services__card`, { 
  interval: 300,
  scale: 1 
});

sr.reveal(`.discount__data`, { 
  origin: 'left',
  distance: '40px'
});

sr.reveal(`.discount__images`, { 
  origin: 'right',
  distance: '40px'
});
sr.reveal(`.products .title, .home-contact h3`, {
  origin: 'top',
  distance: '30px'
});

sr.reveal(`.products .box-container .box, .home-contact .content`, {
  interval: 100,
  origin: 'bottom',
  distance: '30px'
});
