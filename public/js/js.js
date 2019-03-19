/* visitor
 page url that is browsed
 visitor’s browser
 visitor’s  ip
 datetime
*/

window.yC = 'yCookie';
window.yDetails = {};

// Get all non-HTTP cookies
function getYcookie(yName) {
    var sstart = "; ";
    var send = "=";
    var yCookie = sstart + document.cookie;
    var names = yCookie.split(sstart + yName + send);
    if (names.length == 2)
        return names.pop().split(";").shift();

    return false;
}

// Generate random JS code for user identification
function generateYcode() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var length = 20;

    for (var i = 0; i < length; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

// Add a cookie
function setYcookie(value) {
    var CookieDate = new Date;
    CookieDate.setFullYear(CookieDate.getFullYear() + 5);
    document.cookie = yC + '=' + value + '; expires=' + CookieDate.toUTCString() + ';';
}

function getDetails() {
    var d = new Date();
    var n = d.toUTCString();

    yDetails.location = window.location.href;
    yDetails.userAgent = navigator.userAgent;
    yDetails.yU = yU;
    yDetails.date = n;
}

function dispatch(param) {
    const Http = new XMLHttpRequest();
    const url = 'http://technicaltest.localhost/accept';
    Http.open("POST", url, true);
    Http.send(JSON.stringify(yDetails));
}

window.yU = getYcookie(yC);
if (!yU) {
    var yU = generateYcode();
    setYcookie(yU);
}
getDetails();
dispatch(yDetails);