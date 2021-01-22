
window.addEventListener("keydown", checkKeyPress, false);

function checkKeyPress(key){
    if(key.altKey && key.which == 65){
        alert("The A Presed");
    }
}
