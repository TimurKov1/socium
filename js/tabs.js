function change(object_1, object_2, button_1, button_2) {
    $(object_1).removeClass('hide');
    $(object_1).addClass('show');
    $(object_2).removeClass('show');
    $(object_2).addClass('hide');
}

function changeStyleSheet(button_1, button_2) {
    $(button_1).css({
        'color': '#fff',
        'background-color': '#3900B1'
    });
    $(button_2).css({
        'color': '#3900B1',
        'background-color': '#fff'
    });
}
$('.login-button').click(() => {
    change('.login-form', '.registration-form');
    changeStyleSheet('.login-button', '.registration-button');
});
$('.registration-button').click(() => {
    change('.registration-form', '.login-form');
    changeStyleSheet('.registration-button', '.login-button');
});