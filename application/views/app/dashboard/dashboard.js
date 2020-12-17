
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
    document.getElementById("product_id").value = "";
    document.getElementById("model").value = "";
    amount = document.getElementById("amount").value = "";
    year = document.getElementById("year").value = "";
    document.getElementById("err_msg_car").innerHTML = "";
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
    document.getElementById("err_msg_car").innerHTML = "";
}


/* Ajax object creation for sales transaction */
function createdRequestObjectSalesTrans() {
    var tmpXmlHttpObject;
    if (window.XMLHttpRequest)
    {
        tmpXmlHttpObject = new XMLHttpRequest();
    } else if (window.ActiveXObject)
    {
        tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return tmpXmlHttpObject;
}
var httpSaleTrans = createdRequestObjectSalesTrans();

/*Ajax call for Sale transaction..*/

function sendRequestSalesDash() {

    if (appSalesTestVali()) {
        var url = document.getElementById("base_url").value;
        var productId = document.getElementById("product_id").value;
        var user = document.getElementById("user_id").value;
        var quantity = document.getElementById("quantity").value;
        var productType = document.getElementById("product_type").value;
        var model = document.getElementById("model").value;
        var amount = document.getElementById("amount").value;
        var year = document.getElementById("year").value;
        var txtMissionId = document.getElementById("txt_mission_id").value;
        var carType = document.getElementById("car_type").value;
        var carModel = document.getElementById("car_model").value;
        var carTest = document.getElementById("car_test_txt").value;
        var data = productId + "~" + user + "~" + quantity + "~" + productType + "~" + model + "~" + amount + "~" + year + "~" + txtMissionId + "~" + carType + "~" + carModel + "~" + carTest;
        httpSaleTrans.open('get', url + 'app_controller/Dashboard/insert_sale_test?data=' + data);
        httpSaleTrans.onreadystatechange = processResponseSaleTest;
        httpSaleTrans.send(null);

        document.getElementById("product_id").value = "";
        document.getElementById("model").value = "";
        amount = document.getElementById("amount").value = "";
        year = document.getElementById("year").value = "";
        document.getElementById("err_msg_car").innerHTML = "";

    }
}

/*Ajax response for Sale transaction..*/
function processResponseSaleTest() {
    if (httpSaleTrans.readyState == 4)
    {
        var response1 = httpSaleTrans.responseText;
//        document.getElementById("sales_transaction").innerHTML = response1;

        if (response1 != "inserted")
        {
            if (document.getElementById("car_test_txt").value == "Reg")
            {
                document.getElementById("MissionCompleted").innerHTML = "&nbsp;&nbsp;Sorry. Does not register Sales Car.";
            } else {
                document.getElementById("MissionCompleted").innerHTML = "&nbsp;&nbsp;Sorry. Does not register Test Drive.";
            }
            document.getElementById("mission-span").style.backgroundColor = "#F2DEDE";
            document.getElementById("MissionCompleted").style.color = "#AC4F50";
            document.getElementById("mission-span").style.display = "block";
        } else {
            if (document.getElementById("car_test_txt").value == "Reg")
            {
                document.getElementById("MissionCompleted").innerHTML = "&nbsp;&nbsp;Sales Car has been registered successfully.";
            } else {
                document.getElementById("MissionCompleted").innerHTML = "&nbsp;&nbsp;Test Drive Car has been registered successfully.";
            }

            document.getElementById("mission-span").style.backgroundColor = "#DFF0D8";
            document.getElementById("MissionCompleted").style.color = "green";
            document.getElementById("mission-span").style.display = "block";
        }
        /*Ajax call for Sale progressbar function..*/
        sendRequestShowProgress();
    }

}

/* Ajax object creation for ShowProgress */
function createdRequestObjectShowProgress() {
    var tmpXmlHttpObject;
    if (window.XMLHttpRequest)
    {
        tmpXmlHttpObject = new XMLHttpRequest();
    } else if (window.ActiveXObject)
    {
        tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return tmpXmlHttpObject;
}
var httpShowProgress = createdRequestObjectShowProgress();

/* Ajax call for progressbar..*/
function sendRequestShowProgress() {
    var user = document.getElementById("user_id").value;
    var gameId = document.getElementById("game_id").value;
    var txtMissionId = document.getElementById("txt_mission_id").value;
    var updatedTime = document.getElementById("updated_time").value;
    var lastComTime = document.getElementById("clock").innerHTML;
    var url = document.getElementById("base_url").value;
    var data = user + "~" + gameId + "~" + txtMissionId + "~" + updatedTime + "~" + lastComTime;
    httpShowProgress.open('get', url + 'app_controller/Dashboard/show_progress?data=' + data);
    httpShowProgress.onreadystatechange = processResponseShowProgress;
    httpShowProgress.send(null);
}

/* Ajax response for progressbar..*/
function processResponseShowProgress() {
    if (httpShowProgress.readyState == 4) {
        var response = httpShowProgress.responseText;
        document.getElementById('progress_bar').innerHTML = response;
        getTrophy();                 /*Ajax call for trophy function..*/
        fatchCarTestTill();          /*function call get total qty sale and test */
        fatchCarTestBudget();        /*function call get budget qty sale and test */
        /* condition for next budget */
        var finalProBar = document.getElementById("final_pro_bar").value;
        var mission_compl_status = document.getElementById("mission_compl_status").value;
        if (finalProBar > 99 && mission_compl_status == "is_null") {
            startBudgetDash();
        }
    }
}


/* Ajax object creation for startBudget */
function createdRequestObjectStartBudget() {
    var tmpXmlHttpObject;
    if (window.XMLHttpRequest)
    {
        tmpXmlHttpObject = new XMLHttpRequest();
    } else if (window.ActiveXObject)
    {
        tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return tmpXmlHttpObject;
}
var httpStartBudget = createdRequestObjectStartBudget();

/*Ajax request for start budget ..*/
function startBudgetDash() {
    var user = document.getElementById("user_id").value;
    var url = document.getElementById("base_url").value;
    httpStartBudget.open('get', url + 'app_controller/Dashboard/start_budget?user=' + user);
    httpStartBudget.onreadystatechange = processResponsestartBudget;
    httpStartBudget.send(null);
}


/*Ajax response for start budget ..*/
function processResponsestartBudget() {
    if (httpStartBudget.readyState == 4) {
        var response = httpStartBudget.responseText;
        var b = "";
        var bits = response.split(/[\s~]+/);
        var availivility = bits[bits.length - 11];
        var url = document.getElementById("base_url").value;
                    //alert(response);
        /* conditions for check available budget */
        if (availivility == 1 || availivility == "AllCompleted" || availivility == "NoNextMission")
        {
            if (availivility == "AllCompleted")
            {
                document.getElementById("MissionCompleted").innerText = "All mission completed";
                document.getElementById("mission-span").style.backgroundColor = "#F2DEDE";
                document.getElementById("MissionCompleted").style.color = "#AC4F50";
                document.getElementById("mission-span").style.display = "block";
                document.getElementById("test_drive_button").disabled = true;
                document.getElementById("registration_button").disabled = true;
                document.getElementById("new_btn").disabled = true;
                document.getElementById("used_btn").disabled = true;
                document.getElementById("submit").disabled = true;
            } else if (availivility == "NoNextMission")
            {
                document.getElementById("MissionCompleted").innerText = "   Sorry, next mission budget not set. Please contact to admin.";
                document.getElementById("mission-span").style.backgroundColor = "#F2DEDE";
                document.getElementById("MissionCompleted").style.color = "#AC4F50";
                document.getElementById("mission-span").style.display = "block";
                document.getElementById("test_drive_button").disabled = true;
                document.getElementById("registration_button").disabled = true;
                document.getElementById("new_btn").disabled = true;
                document.getElementById("used_btn").disabled = true;
                document.getElementById("submit").disabled = true;
            } else {
                document.getElementById("mission-span").style.display = "none";
                document.getElementById("test_drive_button").disabled = false;
                document.getElementById("registration_button").disabled = false;
                document.getElementById("new_btn").disabled = false;
                document.getElementById("used_btn").disabled = false;
                document.getElementById("submit").disabled = false;
            }
            document.getElementById("fetch_last_mission_status").value = bits[bits.length - 8];
            document.getElementById("game_id").value = bits[bits.length - 7];
            document.getElementById("mission_id").value = bits[bits.length - 6];
            document.getElementById("txt_mission_id").value = bits[bits.length - 6];
            document.getElementById("my_img").src = url + "application/views/asset/image/porsche_city/" + bits[bits.length - 5];
            document.getElementById("date_start").value = bits[bits.length - 4] + " " + bits[bits.length - 3];
            document.getElementById("first_time_video").value = bits[bits.length - 2];
            document.getElementById("allow_day").value = bits[bits.length - 1];
            document.getElementById("txt_budget_started").value = 1;
            if (bits[bits.length - 9] == "is_null") {
                b = bits[bits.length - 8];
            } else {
                b = bits[bits.length - 9];
            }

            /* video call condition for starting video */
            if (document.getElementById("first_time_video").value == "yes") {
                var video = document.getElementById("addiction_video");
                video.src = url + "application/views/asset/knowledge_media/" + b;
                videoOpen();         /* fuction for open video */
            }
            getVideoList();          /* fuction for get all video on video list video */
        } else {
            document.getElementById("MissionCompleted").innerHTML = "&nbsp;&nbsp; Sorry, Mission budget not set. Please contact to admin.";
            document.getElementById("mission-span").style.backgroundColor = "#F2DEDE";
            document.getElementById("MissionCompleted").style.color = "#AC4F50";
            document.getElementById("mission-span").style.display = "block";
        }

        /* condition for calling ajax for progressbar */
        if (document.getElementById("txt_budget_started").value == 1)
        {
            sendRequestShowProgress();  /* calling ajax for progressbar function*/
        }
    }
}





/*Fatching Car and test Qty Total from ajax page..*/
function fatchCarTestTill() {
    document.getElementById("car_quantity").innerText = document.getElementById("car_till_quantity").value;
    document.getElementById("test_quantity").innerText = document.getElementById("test_till_quantity").value;
}

/*Fatching Car and test Qty budget from ajax page..*/
function fatchCarTestBudget() {
    document.getElementById("car_quantity_budget").innerText = document.getElementById("car_budget_qty").value;
    document.getElementById("test_quantity_budget").innerText = document.getElementById("test_budget_qty").value;
}


/* Ajax object creation for Trophy */
function createdRequestObjectTrophy() {
    var tmpXmlHttpObject;
    if (window.XMLHttpRequest)
    {
        tmpXmlHttpObject = new XMLHttpRequest();
    } else if (window.ActiveXObject)
    {
        tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return tmpXmlHttpObject;
}
var httpTrophy = createdRequestObjectTrophy();

/* Ajax request for Trophy */
function getTrophy() {
    var m = document.getElementById("txt_mission_id").value;
    var url = document.getElementById("base_url").value;
    httpTrophy.open('get', url + 'app_controller/Dashboard/dashboard_tropy?m=' + m);
    httpTrophy.onreadystatechange = processResponseTrophy;
    httpTrophy.send(null);
}

/* Ajax response for Trophy */
function processResponseTrophy() {
    if (httpTrophy.readyState == 4) {
        var response = httpTrophy.responseText;
        document.getElementById('trophy').innerHTML = response;
    }
}




/* Ajax object creation for VideoList*/
function createdRequestObjectVideoList() {
    var tmpXmlHttpObject;
    if (window.XMLHttpRequest)
    {
        tmpXmlHttpObject = new XMLHttpRequest();
    } else if (window.ActiveXObject)
    {
        tmpXmlHttpObject = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return tmpXmlHttpObject;
}
var httpVideoList = createdRequestObjectVideoList();

/* Ajax request for video list */
function getVideoList() {
    var m = document.getElementById("txt_mission_id").value;
    var url = document.getElementById("base_url").value;
    httpVideoList.open('get', url + 'app_controller/Dashboard/dashboard_video_list?m=' + m);
    httpVideoList.onreadystatechange = processResponseVideoList;
    httpVideoList.send(null);
}

function selectVideo(video) {
    var videotag = document.getElementById("addiction_video");
    var url = document.getElementById("base_url").value;
    videotag.src = url + "application/views/asset/knowledge_media/" + video;
    videoOpen();
    closeVlist();
}

/* Ajax response for video list */
function processResponseVideoList() {
    if (httpVideoList.readyState == 4) {
        var response = httpVideoList.responseText;
        document.getElementById('video-list').innerHTML = response;
    }
}


/* Open result list dropdown */
function videoList() {
    var video = document.getElementById("v-list-open");
    var videoClose = document.getElementById("v-list-close");
    var videoList = document.getElementById("video-list");
    if (video.style.display === "block") {
        video.style.display = "none";
        videoClose.style.display = "block";
        videoList.style.display = "block";
    } else {
        menuClose.style.display = "none";
        videoList.style.display = "none";
        menu.style.display = "block";
    }
}

/* Close result list dropdown */

function closeVlist() {
    var video = document.getElementById("v-list-open");
    var videoClose = document.getElementById("v-list-close");
    var videoList = document.getElementById("video-list");
    if (videoClose.style.display === "block") {
        video.style.display = "block";
        videoClose.style.display = "none";
        videoList.style.display = "none";
    } else {
        menuClose.style.display = "block";
        dropdown.style.display = "block";
        menu.style.display = "none";
    }
}

function quizNotify() {
    document.getElementById("notify-modal").style.display = "block";
}
function quizClose() {
    document.getElementById("notify-modal").style.display = "none";
}

/* For error span */
function showError() {
    document.getElementById("mission-span").style.display = "block";
}
function closeError() {
    document.getElementById("mission-span").style.display = "none";
}

function openLogout() {
    document.getElementById("alert-logout").style.display = "block";
}
function closeLogout() {
    document.getElementById("alert-logout").style.display = "none";
}


/*Clock Code..*/
/* Update the count down every 1 second*/
var x = setInterval(function () {

    var allowDay = document.getElementById("allow_day").value;
    allowDay = parseInt(allowDay);
    var dateStart = document.getElementById("date_start").value;
    if (dateStart != "") {
        countDownDate = new Date(dateStart);
        countDownDate.setDate(countDownDate.getDate() + allowDay);
        // Get today's date and time
        var x = new Date();
        var now = x.toGMTString();
        now = now.split(' ', 5).join(' ');
        now = new Date(now);
        // now.setSeconds( now.getSeconds() + 105 );
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        if (distance >= 0) {
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("clock").innerText = days + "D " + hours + "H "
                    + minutes + "M " + seconds + "S ";

            var dateStart = document.getElementById("date_start").value;
            countDownDate = new Date(dateStart);

            var distance = now - countDownDate;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("updated_time").value = days + "D " + hours + "H "
                    + minutes + "M " + seconds + "S ";
        } else {
            document.getElementById("clock_div").style.backgroundColor = "#cc0000";

            var distance = now - countDownDate;
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("clock").innerText = days + "D " + hours + "H "
                    + minutes + "M " + seconds + "S ";

            days = parseInt(days) + parseInt(allowDay);
            document.getElementById("updated_time").value = days + "D " + hours + "H "
                    + minutes + "M " + seconds + "S ";
        }
    }
}, 1000);

/* Validation for form app forgor password page */
function appSalesTestVali()
{
    var model = document.getElementById("model");
    var amount = document.getElementById("amount");

    return (emptyValidation(model, 'err_msg_car') ?
            emptyValidation(amount, 'err_msg_car') ?
            allNumbers(amount, 'err_msg_car') ?
            checkGreterThanZero(amount, 'err_msg_car') ?
            true : false : false : false : false);
}

/* Check Empty text fields. */

function emptyValidation(control, msgBox) {
    var control_len = control.value.length;

    if (control_len === 0) {
        document.getElementById(msgBox).innerHTML = control.placeholder + ' is required field';
        control.focus();
        return false;
    }
    document.getElementById(msgBox).innerHTML = '';
    return true;
}

/* Check Empty text fields. */

function checkGreterThanZero(control, msgBox) {
    var control_len = control.value;
    if (control_len < 1) {
        document.getElementById(msgBox).innerHTML = 'Amount should be greter than zero';
        control.focus();
        return false;
    }
    document.getElementById(msgBox).innerHTML = '';
    return true;
}

function CheckTags(txtfld, msgBox) {

    var reg = /<(.|\n)*?>/g;
    var value = txtfld.value;
    if (reg.test(value) == false) {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    }
    document.getElementById(msgBox).innerHTML = 'do not allow HTMLTAGS';
    txtfld.focus();
    return false;

}



/*Check AllNumbers On Submit .*/
function allNumbers(txtfld, msgBox) {
    var letters = /^[0-9]+$/;

    if (txtfld.value.match(letters)) {
        document.getElementById(msgBox).innerHTML = '';
        return true;
    } else {
        document.getElementById(msgBox).innerHTML = 'Must have Numbers only';
        txtfld.focus();
        return false;
    }
}


