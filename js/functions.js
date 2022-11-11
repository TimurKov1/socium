function ajaxQuery(file, send, func, async){
    $.ajax({
        url: 'php/' + file,
        method: 'post',
        dataType: 'json',
        processData:false,
        contentType:false,
        async: async,
        cache:false,
        data: send,
        success: function(data){
            func(data);
        }
    });
}

function validation(fields){
    const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;
    let result = {
        status: true,
        msg: ''
    };
    $.each(fields, function(key, val){
        if(key == 'email'){
            let send = new FormData();
            send.append('table','users');
            send.append('fields', JSON.stringify(['id']));
            send.append('terms', JSON.stringify({'email': val}));
            ajaxQuery('get_data.php', send, function(response){
                if(Array.isArray(response.data)){
                    result.status = false;
                    result.msg = 'Этот email уже используется другим аккаунтом.';
                }
            }, false);
            if(!EMAIL_REGEXP.test(val)){
                result.status = false;
                result.msg = 'Неверный формат email.';
            }
        }
        if(key == 'name' || key == 'surname'){
            if(!/^[a-zA-Zа-яА-я]*$/.test(val)){
                result.status = false;
                result.msg = 'В имени и фамилии могут быть только буквы.';
            }
        }
        if(!result.status){
            return false;
        }
    });
    return result;
}