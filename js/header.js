// isAdmin = false;
console.log(isLogin);


let hprofile = document.getElementById('profile')
let hloveIcon = document.getElementById('love-icon')
let hsignUpBtn = document.getElementById('signUp-btn')

let signInMenu = document.getElementById('signInMenu')
let signUpMenu = document.getElementById('signUpMenu')
let profileMenu = document.getElementById('profileMenu')



if (!isLogin) {
    hprofile.style = "display:none";
    hloveIcon.style = "display:none";
    hsignUpBtn.style = "display:inline-block";

    signInMenu.style = "display:inline-block";
    signUpMenu.style = "display:inline-block";
    profileMenu.style = "display:none";


} else {
    hprofile.style = "display:inline-block";
    hloveIcon.style = "display:inline-block";
    hsignUpBtn.style = "display:none";


    signInMenu.style = "display:none";
    signUpMenu.style = "display:none";
    profileMenu.style = "display:inline-block";
}




// Grab elements
const selectElement = (selector) => {
    const element = document.querySelector(selector);
    if (element) return element;
    throw new Error(`Something went wrong! Make sure that ${selector} exists/is typed correctly.`);
};

//Nav styles on scroll
const scrollHeader = () => {
    const navbarElement = selectElement('#header');
    if (this.scrollY >= 15) {
        navbarElement.classList.add('activated');
    } else {
        navbarElement.classList.remove('activated');
    }
}

window.addEventListener('scroll', scrollHeader);

// Open menu & search pop-up
const menuToggleIcon = selectElement('#menu-toggle-icon');
const formOpenBtn = selectElement('#search-icon');
const formCloseBtn = selectElement('#form-close-btn');
const searchContainer = selectElement('#search-form-container');

const toggleMenu = () => {
    const mobileMenu = selectElement('#hmenu');
    mobileMenu.classList.toggle('activated');
    menuToggleIcon.classList.toggle('activated');
}

menuToggleIcon.addEventListener('click', toggleMenu);

// Open/Close search form popup
formOpenBtn.addEventListener('click', () => searchContainer.classList.add('activated'));
formCloseBtn.addEventListener('click', () => searchContainer.classList.remove('activated'));
// -- Close the search form popup on ESC keypress
window.addEventListener('keyup', (event) => {
    if (event.key === 'Escape') searchContainer.classList.remove('activated');
});

// Switch theme/add to local storage
const body = document.body;
const themeToggleBtn = selectElement('#theme-toggle-btn');
const currentTheme = localStorage.getItem('currentTheme');

// Check to see if there is a theme preference in local Storage, if so add the ligt theme to the body
if (currentTheme) {
    body.classList.add('light-theme');
}

themeToggleBtn.addEventListener('click', function() {
    // Add light theme on click
    body.classList.toggle('light-theme');

    // If the body has the class of light theme then add it to local Storage, if not remove it
    if (body.classList.contains('light-theme')) {
        localStorage.setItem('currentTheme', 'themeActive');
    } else {
        localStorage.removeItem('currentTheme');
    }
});