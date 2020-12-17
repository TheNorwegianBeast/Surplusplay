
/* Open result list dropdown */
function openList() {
    document.getElementById("menu-icon").style.display = "none";
    document.getElementById("menu-close").style.display = "block";
    document.getElementById("dropdown-list").style.display = "block";
}

/* Close result list dropdown */
function closeList() {
    document.getElementById("menu-icon").style.display = "block";
    document.getElementById("menu-close").style.display = "none";
    document.getElementById("dropdown-list").style.display = "none";
}

$(document).mouseup(function (e) {
    var container = $("#dropdown-list");
    if (!container.is(e.target) &&
            container.has(e.target).length === 0) {
        container.hide();
        document.getElementById('menu-icon').style.display = 'block';
        document.getElementById('menu-close').style.display = 'none';
    }
});

$(document).mouseup(function (ex) {
    var content = $("#video-list");
    if (!content.is(ex.target) &&
            content.has(ex.target).length === 0) {
        content.hide();
        document.getElementById('v-list-open').style.display = 'block';
        document.getElementById('v-list-close').style.display = 'none';
    }
});

function videoOpen() {
     var video = document.getElementById('addiction_video');
    video.play();
    document.getElementById("modal-video").style.display = "block";
}
function videoClose() {
    document.getElementById("modal-video").style.display = "none";
     var video = document.getElementById('addiction_video');
    video.pause();
}

function replayVideo() {
    var video = document.getElementById('addiction_video');
    video.play();
}

function priceListOpen() {
    document.getElementById("model_new_button").style.display = "block";
    var new_btn = document.getElementById("new_btn");
    var used_btn = document.getElementById("used_btn");
    new_btn.style.color = "white";
    used_btn.style.color = "gray";
    used_btn.style.backgroundColor = "white";
    new_btn.style.backgroundColor = "#cc0000";
}

function priceListClose() {
    document.getElementById("model_new_button").style.display = "none";
}
function inventoryOpen() {
    document.getElementById("modal_used_button").style.display = "block";
    var new_btn = document.getElementById("new_btn");
    var used_btn = document.getElementById("used_btn");
    new_btn.style.color = "gray";
    used_btn.style.color = "white";
    used_btn.style.backgroundColor = "#cc0000";
    new_btn.style.backgroundColor = "white";
}

function inventoryClose() {
    document.getElementById("modal_used_button").style.display = "none";
}



function regShow() {
    var btnReg = document.getElementById("registration_button");
    var btnTest = document.getElementById("test_drive_button");
    btnReg.style.color = "white";
    btnTest.style.color = "gray";
    btnTest.style.backgroundColor = "white";
    btnReg.style.backgroundColor = "#cc0000";
    document.getElementById("car_test_txt").value = "Reg";
//
    document.getElementById("product_id").value = "";
    document.getElementById("model").value = "";
    amount = document.getElementById("amount").value = "";
    year = document.getElementById("year").value = "";
//                document.getElementById("err_msg_car").innerHTML = "";
}

function testShow() {
    var btnReg = document.getElementById("registration_button");
    var btnTest = document.getElementById("test_drive_button");
    btnReg.style.color = "gray";
    btnTest.style.color = "white";
    btnTest.style.backgroundColor = "#cc0000";
    btnReg.style.backgroundColor = "white";
    document.getElementById("car_test_txt").value = "Test";
    document.getElementById("product_id").value = "";
    document.getElementById("model").value = "";
    amount = document.getElementById("amount").value = "";
    year = document.getElementById("year").value = "";
//                document.getElementById("err_msg_car").innerHTML = "";
}


