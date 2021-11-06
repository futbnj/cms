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
                // button.addClass('loading')
            },
            success: function(result){
                console.log(result);
                // button.removeClass('loading')
            }
        });
    },

    setActiveTheme: function (element, theme) {
        let formData = new FormData();
        let button = $(element);

        formData.append('theme', theme);

        $.ajax({
            url: '/admin/setting/activateTheme/',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                button.addClass('loading')
            },
            success: function(result){
                console.log(result);
                window.location.reload();
            }
        });
    },
};
