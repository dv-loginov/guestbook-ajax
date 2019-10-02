function ajaxSendData(action,dataForm){

    if (debug){console.log("action: "+action+" data: "+dataForm);}

    $.ajax({
        url: action,
        type: 'POST',
        data: dataForm,
        cache: false,
        dataType: "html",
        success: function(html) {
            $("#wrap-message").html(html);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            $("#errors").html(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
}

