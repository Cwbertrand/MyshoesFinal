const navSlide = () => {
    const navShow = document.querySelector('.fa-bars'),
        navHide = document.querySelector('.fa-xmark'),
        nav = document.querySelector('.nav_links')

    //Toggle nav. This shows the nav bar when we click on. It adds the nav_active class
    if(navShow){
        navShow.addEventListener('click', () => {
            nav.classList.add('nav_active')
        });
    }

    if(navHide){
        navHide.addEventListener('click', () => {
            nav.classList.remove('nav_active')
        })
    }

}

//this is for the user Icon
var dd_main = document.querySelector(".dd_main");

	dd_main.addEventListener("click", function(){
		this.classList.toggle("account_active");
	})

navSlide();

// Get all navigation links
const navLinks = document.querySelectorAll('.nav_ul a');

//Get current URL
//in the place of href, you can also use pathname
const currentURL = window.location.href;

//Checking if current URL matches any of the navigation links
navLinks.forEach(link => {
    if(link.href === currentURL){
        link.classList.add('menwochild');
    }
})


