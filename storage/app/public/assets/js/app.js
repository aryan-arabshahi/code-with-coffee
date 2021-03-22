
class FormManager {

    constructor(formElement) {
        this.form = $(formElement);
        this.submitButton = this.form.find('.form-submit-btn');
    }

    getFormDataByElement = () => {
        const data = {};
        this.form.serializeArray().map(function(field, index) {
            data[field.name] = field.value;
        });
        return data;
    }

    lock = () => {
        this.submitButton.attr('disabled', 'true');
        this.changeSubmitButton('pending');
    }

    release = () => {
        this.submitButton.removeAttr('disabled');
        this.changeSubmitButton('clear');
    }

    changeSubmitButton = (status) => {
        switch(status) {

            case 'success':
                this.submitButton.find('.form-submit-label').addClass('invisible');
                this.submitButton.find('.form-submit-status').css('display', 'flex');
                this.submitButton.find('.form-submit-loader').hide();
                this.submitButton.find('.form-submit-success').show();
                break;

            case 'pending':
                this.submitButton.find('.form-submit-label').addClass('invisible');
                this.submitButton.find('.form-submit-status').css('display', 'flex');
                this.submitButton.find('.form-submit-success').hide();
                this.submitButton.find('.form-submit-loader').show();
                break;

            case 'clear':
                this.submitButton.find('.form-submit-label').removeClass('invisible');
                this.submitButton.find('.form-submit-status').hide();
                this.submitButton.find('.form-submit-loader').hide();
                this.submitButton.find('.form-submit-success').hide();
                break;

        }
    }

    getErrorMessages = (errors) => {
        const error_messages = [];
        errors.map(function(message, _index) {
            error_messages.push(
                '<span class="form-error-item">'+message+'<span>'
            );
        });
        return error_messages.join('<br/>');
    }

    onFail = (error) => {

        switch(error.status) {
            case 422:
                const errors = error.responseJSON.errors;
                const fields = Object.keys(errors);
                for (let i = 0; i < fields.length; i++) {
                    const field = fields[i];
                    console.log(this.form.find('.form-errors[field="'+field+'"]'));
                    this.form.find('.form-errors[field="'+field+'"]')
                        .html(
                            this.getErrorMessages(errors[field])
                        )
                        .show();
                }
                break;
        }

        this.release();

    }

    onSuccess = (response) => {
        this.success();
    }

    success = () => {
        this.clear();
        this.changeSubmitButton('success');
        if (this.form.attr('clearForm') === 'true') {
            this.form.trigger("reset");
        }
    }

    clear = () => {
        this.form.find('.form-errors').hide().html('');
    }

    submit = () => {
        this.clear()
        this.lock();
        $.ajax({
            type: this.form.attr('method'),
            url: this.form.attr('action'),
            data: this.getFormDataByElement(),
            dataType: 'json',
        })
        .done(this.onSuccess)
        .fail(this.onFail);
    }

}

/*
* Change navigation bar with scroll
*/
function checkNavigationBar() {
    const navigation = $('#navigation');
    const setBackground = () => {
        if ($(this).scrollTop() === 0) {
            navigation.css('background', 'none');
        }else{
            navigation.removeAttr('style');
        }
    }
    setBackground();
    $(window).scroll(function(e) {
        setBackground();
    });
}

$('.ajax-form').on('submit', function(e) {
    e.preventDefault();
    const form = new FormManager(e.target);
    form.submit();
});

$('#navigation-bars').on('click', function(e) {
    const rotate_class_name = '-rotate-90';
    const is_open = $(this).attr('is-open');
    const menu = $('#navigation-menu');
    if (is_open === 'true') {
        $(this).removeClass(rotate_class_name);
        menu.slideUp(300);
        $(this).attr('is-open', 'false');
    }else{
        $(this).addClass(rotate_class_name);
        menu.slideDown(300);
        $(this).attr('is-open', 'true');
    }
});
