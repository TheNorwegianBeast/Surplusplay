function adminDropdown() {
    var dropdown = document.getElementById('myDropdown');
    if (dropdown.style.display == 'block') {
        dropdown.style.display = 'none'
    } else {
        dropdown.style.display = 'block'
    }
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdown = document.getElementById('myDropdown');
        dropdown.style.display = 'none'
    }
};