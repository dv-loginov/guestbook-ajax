
let xhr = new XMLHttpRequest();

    xhr.addEventListener("load", transferComplete, false);
    xhr.addEventListener("error", transferFailed, false);

function ajaxSendData(action,data){

    xhr.open("POST", action, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.send(data);

}


function transferComplete(){
    if(debug){ console.log("Получен ответ: "+xhr.responseText);}
    document.querySelector("#view-message").innerHTML=xhr.responseText;
}

function transferFailed(){
    if(debug){ console.log("Ошибка: "+xhr.status + ': ' + xhr.statusText );}
}
