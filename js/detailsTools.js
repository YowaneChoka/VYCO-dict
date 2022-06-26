console.log(isAdmin);


let button = document.getElementById('isEdit')
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
    del.style = "display:none";
}



button.addEventListener('click', editDetails);

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