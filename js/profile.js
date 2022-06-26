console.log(isAdmin);

// console.log("Js found");


let button = document.getElementById('isEdit')
let logout = document.getElementById('logout')
let fieldset = document.getElementById('adminOnly')
let submitBtn = document.getElementById('submit-btn')

let del = document.getElementById('delete')

del.addEventListener('click', delet);

function delet() {
    console.log("Deleting");
    console.log(id);
    window.location = "./exeDelete.php?" + id;
}
if (!isAdmin) {
    button.style = "display:none";
    submitBtn.style = "display:none";

}

button.addEventListener('click', editDetails);
logout.addEventListener('click', logOutFunc);

// document.addEventListener(button, () => {
//     console.log("Edit now");
// });

function editDetails() {
    if (fieldset.disabled == true) {
        fieldset.disabled = false;



    } else if (fieldset.disabled == false) {
        fieldset.disabled = true;
    }
}



function logOutFunc() {

    window.location = "./index.php?logout=1";
}

/* Show login form on button click */

let pwa = document.getElementById('password');
let pwb = document.getElementById('confirmPassword');
let pwo = document.getElementById('oldPassword');


console.log('found js');

pwa.addEventListener("keyup", function() {
    pwa.style = "border-bottom: 2px solid rgb(91, 243, 131);";
    pwb.style = "border-bottom: 2px solid rgb(91, 243, 131);";
}, false);

pwb.addEventListener("keyup", function() {
    pwa.style = "border-bottom: 2px solid rgb(91, 243, 131);";
    pwb.style = "border-bottom: 2px solid rgb(91, 243, 131);";
}, false);

$('.loginBtn').click(function() {
    $('.login').show();
    $('.signUp').hide();
    /* border bottom on button click */
    $('.loginBtn').css({ 'border-bottom': '2px solid #ff4141' });
    /* remove border after click */
    $('.signUpBtn').css({ 'border-style': 'none' });
});


/* Show sign Up form on button click */

$('.signUpBtn').click(function() {
    $('.login').hide();
    $('.signUp').show();
    /* border bottom on button click */
    $('.signUpBtn').css({ 'border-bottom': '2px solid #ff4141' });
    /* remove border after click */
    $('.loginBtn').css({ 'border-style': 'none' });
});

//check password matching
var checkRegister = function() {

    let pwa = document.getElementById('password');
    let pwb = document.getElementById('confirmPassword');
    if (pwa.value != pwb.value) {

        alert('Password Does not Match');
        pwa.style = "border-bottom: 2px solid red;";
        pwb.style = "border-bottom: 2px solid red;";
        // document.getElementById('confirmPassword').border-bottom = '2px solid red';
        return false;

    }
    if (pwo.value != password) {

        alert('Old Password Wrong');
        pwo.style = "border-bottom: 2px solid red;";
        // document.getElementById('confirmPassword').border-bottom = '2px solid red';
        return false;

    }
    return true;
}