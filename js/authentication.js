let photo;
$('input[name="photo"]').change(function(e){
    photo = e.target.files[0];
    console.log(photo);
});
$(document).on('click', '.registration', function(e){
    e.preventDefault();
    let form = $(this).parent('form');
    form.find('.error_msg').text('');
    let user = {
        'name': form.find('input[name="name"]').val().replace(/\s+/g, '').trim(),
        'surname': form.find('input[name="surname"]').val().replace(/\s+/g, '').trim(),
        'email': form.find('input[name="email"]').val().replace(/\s+/g, '').trim(),
        'password': form.find('input[name="password"]').val().trim()
    }
    let resValid = validation(user);
    if(resValid.status){
        let send = new FormData();
        send.append('table', 'users');
        send.append('data', JSON.stringify(user));
        send.append('photo', photo);
        ajaxQuery('insert_data.php', send, (data) => {
            if(data.status){
                form[0].reset();
                form.find('.error_msg').text('Регистрация прошла успешно!');
            }else{
                form.find('.error_msg').text('Что-то пошло не так.');
            }
        }, true);
    }else{
        form.find('.error_msg').text(resValid.msg);
    }
});
$(document).on('click', '.logIn', function(e){
    e.preventDefault();
    let form = $(this).parent('form');
    form.find('.error_msg').text('');
    let user = {
        'email': form.find('input[name="email"]').val().replace(/\s+/g, '').trim(),
        'password': form.find('input[name="password"]').val().trim()
    }
    let send = new FormData();
    send.append('table', 'users');
    send.append('fields', JSON.stringify([]));
    send.append('terms', JSON.stringify(user));
    ajaxQuery('get_data.php', send, (response) => {
        if(Array.isArray(response.data)){
            form[0].reset();
            let send1 = new FormData();
                send1.append('user', JSON.stringify(response.data[0]));
                ajaxQuery('authorization.php', send1, (response) => {
                    document.location.href='profile.php';
                    location.reload();
                }, true);
        }else{
            form.find('.error_msg').text('Неверные логин и/или пароль.'); 
        }
    }, true);
});