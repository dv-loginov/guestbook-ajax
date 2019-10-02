 "use strict";
 const debug=1;

 const wrapMode=document.querySelector('.mode-header');
 const modeChecker=document.querySelector('.mode-checkbox');

 const arrElem=(selector, context)=> {
     context = context || document;
     const elements = context.querySelectorAll(selector);
     return Array.prototype.slice.call(elements);
 };
 ////////////////////////////////////////////////////////
//              Переключение режима
////////////////////////////////////////////////////////

 //0-user 1-admin
 const setMode=(mode)=>{
     sessionStorage.setItem('isAuth', mode);
     document.cookie=`isAuth=${mode}`;
     mode?wrapMode.innerHTML='режим администратора':wrapMode.innerHTML='режим пользователя';
     modeChecker.checked=mode;
 };

 if (document.cookie.replace(/(?:(?:^|.*;\s*)isAuth\s*\=\s*([^;]*).*$)|^.*$/, "$1")==='true'){
     setMode(true);
 }
 else{
     setMode(false);
 }

 modeChecker.addEventListener('change',()=>{
     setMode(modeChecker.checked);
     window.location.reload();
 });


 ////////////////////////////////////////////////////////
//    Прослушка формы и отправка Ajax
////////////////////////////////////////////////////////
 document.addEventListener(
    "submit", (event)=> {
        event.preventDefault();

        //console.log(event.target);
        let data='';
         arrElem('input',event.target).forEach((element)=>{
            data+=element.name+'='+element.value+'&';
         });
         data=data.slice(0,-1);

        console.log(event.target.action);
        console.log(data);
        ajaxSendData(event.target.action, data);

        event.target.reset();
});
