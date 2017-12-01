var CommonLanding = {};
//CSS-Selectors and config:
CommonLanding.email = '#email';
CommonLanding.phone = '#phone';
CommonLanding.name = '#name';
CommonLanding.text = '#text';
CommonLanding.errorMessage = '#error-messages';
CommonLanding.form = 'form';
CommonLanding.successText = 'Р—Р°СЏРІРєР° СѓСЃРїРµС€РЅРѕ РѕС‚РїСЂР°РІР»РµРЅР°!';
CommonLanding.url = '/redplace/php/SendMail.php';
//Handlers:
CommonLanding.sendEmail = function () {
    $.ajax({
        url: CommonLanding.url,
        type: 'POST',
        data: {
            email: $(CommonLanding.email).val(),
            name: $(CommonLanding.name).val(),
            phone: $(CommonLanding.phone).val(),
            text: $(CommonLanding.text).val()
        },
        dataType: 'json',
        success: function (data) {
            if(data.status == 'good') {
                $(CommonLanding.form).text(CommonLanding.successText);
            } else {
                $(CommonLanding.errorMessage).text('');
                for(var item in data) {
                    console.log(item)
                    if(item != 'status') {
                        $(CommonLanding.errorMessage).append('<p>'+data[item]+'</p>');
                    }
                }
            }
            return false;
        }
    });
    return false;
}
//Event handlers
$(document).on('click', '.send', CommonLanding.sendEmail);
