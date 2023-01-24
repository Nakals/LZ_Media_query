$('document').ready(function(){
    $('.add_btn').on('click',function(){
        $('.modal_wrapper').show();
    });
    $('.bg, .close_form').on('click',function(){
        $('.modal_wrapper').hide();
    });

    $('form.form_wrapper input').on('input', function(){
        $(this).next('.error').remove();
    });
    
    $('form.form_wrapper').submit(function(e) {
        e.preventDefault();

        var name = $('form.form_wrapper input[name=name]').val();
        var surname = $('form.form_wrapper input[name=surname]').val();
        console.log(surname);
        var valid_regular = /^[a-zA-Zа-яА-Я]+$/;
        var valid = false;
        if(name.length > 2 && name != '' && valid_regular.test(name)){
            valid = true;
        }
        else {
            valid = false;
            $('form.form_wrapper input[name=name]').next('.error').remove();
            $('form.form_wrapper input[name=name]').after( "<span class='error'>Введите корректное значение</span>" );
        }

        if(surname.length > 2 && surname != '' && valid_regular.test(surname)){
            valid = true;
        }
        else {
            valid = false;
            $('form.form_wrapper input[name=surname]').next('.error').remove();
            $('form.form_wrapper input[name=surname]').after( "<span class='error'>Введите корректное значение</span>" );
        }

        var data = $('form.form_wrapper').serialize();

        if(valid){
            $.ajax({
                type: 'POST',
                url: 'https://www.contentimo.com/lzmedia/Query/person',
                data: data,
                // contentType: "text/html; charset=utf-8",
                success: function(data) {
                }
            });
            $('form.form_wrapper input').val('');
        }
    });

    $('form.get_data').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'https://www.contentimo.com/lzmedia/Query/list',
        }).done(function(data){
                console.log(data);
                const linkSource = `data:application/pdf;base64,${data}`;
                const downloadLink = document.createElement("a");
                downloadLink.href = linkSource;
                downloadLink.download = 'query';
                downloadLink.click();
        });
    });
});