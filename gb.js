"use strict";
const debug=1;

////////////////////////////////////////////////////////
//              Переключение режима
////////////////////////////////////////////////////////
document.querySelector(".mode_user").addEventListener(
    "click",function(){
        sessionStorage.setItem('isAuth', 'false');
        document.cookie='isAuth=false';
    });

document.querySelector(".mode_admin").addEventListener("click",function(){
    sessionStorage.setItem('isAuth', 'true');
    document.cookie='isAuth=true';
});

////////////////////////////////////////////////////////
//    Прослушка формы и отправка Ajax
////////////////////////////////////////////////////////

document.addEventListener(
    "submit", function (e) {
        e.preventDefault();
        document.querySelector("#errors").innerHTML='';
        let form=new FormData(e.target);
        let action=e.target.action;
        let data="";
        let error=false;

        for(let record of form.entries()) {
            data+=record[0]+ '='+ record[1]+'&';
            if(record[1]===''){
                error=true;
                document.querySelector("#errors").innerHTML='Пустые поля запрещены';
            }
        }

        console.log("Action: "+action+" Data: "+data);
        if (!error) {
            e.target.reset();
            ajaxSendData(action, data)
        }
});
