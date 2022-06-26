console.log("Found Js");


let button = document.getElementById('toggle')
let back = document.getElementById('back-view')
let front = document.getElementById('front-view')


button.addEventListener('click', toggle);

// document.addEventListener(button, () => {
//     console.log("Edit now");
// });

function toggle() {
    console.log("Toggling");

    if (back.style.display == "none") {
        back.style.display = "inline-block";
        front.style.display = "none";
        return;
    }
    back.style.display = "none";
    front.style.display = "inline-block";
}