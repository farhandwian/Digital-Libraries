function showPass() {
    var pass = document.querySelector("#password");
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}

function showPassAgain() {
    var passRe = document.querySelector("#repassword");
    if (passRe.type === "password") {
        passRe.type = "text";
    } else {
        passRe.type = "password";
    }
}

function showPassOld() {
    // var x = document.getElementById("repassword");
    var passOld = document.querySelector("#oldpassword");
    if (passOld.type === "password") {
        passOld.type = "text";
    } else {
        passOld.type = "password";
    }
}