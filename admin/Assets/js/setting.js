var setting = {
    ajaxMethod: 'POST',

    update: function () {
        let formData = $('#settingForm').serialize();

        console.log(formData);

        $.ajax({
            url: '/admin/settings/update/',
            type: this.ajaxMethod,
            data: formData,
            beforeSend: function(){

            },
            success: function(result){
                console.log(result);
            }
        });

    }
};

console.log(page);