const burgerMenu = document.querySelector('.burger_menu');
const burgerCancel = document.querySelector('.burger_cancel');
const navItems = document.querySelector('.second_nav_items');

burgerMenu.addEventListener('click', () => {
    navItems.classList.add('active');
});

burgerCancel.addEventListener('click', () => {
    navItems.classList.remove('active');
});
