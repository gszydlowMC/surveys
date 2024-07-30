const Swal = require('sweetalert2');
SubmitForm = {
    init() {
        $('body').on('submit', 'form.form-ajax-send', e => {
            const form = e.currentTarget;
            const $this = this;
            let button = form.querySelector('[type="submit"].focus');
            if (e.originalEvent && e.originalEvent.submitter) {
                button = e.originalEvent.submitter;
                // this.disableSubmitButton(button);
            }

            if (button && button.dataset.timeout && button.dataset.timeout > 0) {
                setTimeout(function () {
                    $this.makeRequest(form, button);
                }, button.dataset.timeout);
            } else {
                $this.makeRequest(form, button);
            }
            e.preventDefault();
        });

        $('body').on('click', 'button', e => {
            $('body').find('button').removeClass('focus');
            e.currentTarget.classList.add('focus');
        });
    },

    disableSubmitButton(button) {
        if (button) {
            button.setAttribute('disabled', '');
            button.classList.add('disabled');
            this.saveButtonInner = button.innerHTML;
            button.innerHTML = '<i class="fa spinner-border spinner-border-sm mt-1 mb-1 fa-spin"></i>';
        }
    },

    enableSubmitButton(button) {
        if (button) {
            button.removeAttribute('disabled');
            button.classList.remove('disabled');
        }
    },

    dispatchAfterFormSubmittedEvent(item, data) {
        const event = new CustomEvent('forms:submitted', {
            detail: data
        });

        document.dispatchEvent(event);
        document.body.dispatchEvent(event);
        item.dispatchEvent(event);
    },

    removeSpinner(button) {
        if (button && button.querySelector('.fa-spin')) {
            button.innerHTML = this.saveButtonInner;
        }
    },

    makeRequest(form, button, params = {}) {
        let error = {};
        const formData = new FormData(form);
        //durzecenie parametrow
        for (let key in params) {
            formData.append(key, params[key]);
        }
        const modal = form.closest('.modal');
        formData.append('_method', form.querySelector('[name="_method"]') ? 'PATCH' : 'POST');
        if (button && button.hasAttribute('name')) {
            formData.append('btn_name', button.getAttribute('name'));
        }

        $('.global-loader').show();
        $(form).find('.invalid-feedback').remove();
        $(form).find('.is-invalid').removeClass('is-invalid');
        $(form).find('.bxs-error').remove();

        $.ajax({
            url: form.action,
            type: form.method,
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false,
            success: (d) => {
                $('.global-loader').hide();

                if (d.message) {
                    Swal.fire(
                        {
                            title: 'Wysłany formularz',
                            text: d.message,
                            type: 'success',
                            timer: 3000
                        }
                    )
                }

                this.enableSubmitButton(button);
                this.removeSpinner(button);

                const replaceContainer = form.getAttribute('data-replace-element');
                const replaceElement = document.querySelector('[' + replaceContainer + ']');
                if (replaceElement && d[replaceContainer]) {
                    replaceElement.outerHTML = d[replaceContainer];
                    app.runInitScripts(document.querySelector('[' + replaceContainer + ']'), '[' + replaceContainer + ']');
                    $(form).trigger('change');
                }

                if (d['redirect']) {
                    setTimeout(function () {
                        window.location.href = d['redirect'];
                    }, 1000);
                }

                if (d['reload']) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }

                if (button) {
                    const clearFields = button.getAttribute('data-clear-fields');
                    if (clearFields) {
                        $(clearFields).val('').trigger('change');
                    }
                }

                this.dispatchAfterFormSubmittedEvent(form, {
                    form: form,
                    button: button,
                    ...d
                });

                $(form).find('.close').click();
                // if ($(button).closest('.card')) {
                //     $(button).closest('.card').find('.EDataTable .btn_refresh').click();
                // }
                // $(form)[0].reset();
            },
            error: error => {
                $('.global-loader').hide();
                if (error.responseJSON && error.responseJSON.data && error.responseJSON.data.errors) {
                    let errors = [];
                    Swal.fire(
                        {
                            title: 'Błąd formularza!',
                            text: 'Twój formularz posiada błędy.',
                            type: 'error',
                            timer: 3000
                        }
                    )
                    let navAddError = [];
                    let tableTd = [];
                    Object.entries(error.responseJSON.data.errors).forEach(([key, row]) => {
                        let strKey = '';
                        let strKey2 = '';
                        let temp = '';
                        findEl = undefined;
                        if (key.indexOf('.') > -1) {
                            let aKey = key.split('.');
                            if (aKey.length > 0) {
                                aKey.forEach(function (value, k) {
                                    if (k != 0) {

                                        strKey += '[' + value + ']';
                                    }
                                });
                                temp = aKey[0] + strKey;
                                strKey = ':input[name="' + temp + '"]';
                                strKey2 = ':input[name="' + temp + '[]"]';

                            }
                        } else {
                            strKey = ':input[name="' + key + '"]';
                            strKey2 = ':input[name="' + key + '[]"]';
                        }

                        if ($(strKey).length > 0) {
                            findEl = $(strKey);
                        } else if ($(strKey2).length > 0) {
                            findEl = $(strKey2);
                        }

                        const errorMsg = row[0];
                        const errorMsgHtml = '<span id="' + key + '-error" class="pl-1 invalid-feedback" style="display: block;">' + errorMsg + '</span>';
                        if (typeof findEl !== 'undefined' && findEl.length) {

                            let parent = findEl.parents('label');
                            if (!parent.length) {
                                parent = findEl.parents('.form-group');
                            }
                            if (parent.length > 0) {
                                parent.find('.invalid-feedback').remove();
                                errors[key] = parent.append(errorMsgHtml);
                            } else {
                                findEl.next('.invalid-feedback').remove();
                                errors[key] = findEl.after(errorMsgHtml);
                                findEl.addClass('is-invalid');
                            }
                            const tab = findEl.closest('.tab-pane');
                            const table = findEl.closest('table');
                            const td = findEl.closest('td');
                            if (table) {
                                const thead = table.find('thead');
                                const index = td.index();
                                if (thead && tableTd[index] != true) {
                                    thead.find('th:eq(' + index + ')').append('<i class=\'bx bxs-error text-danger px-1\'></i>');
                                    tableTd[index] = true;
                                }
                            }
                            if (tab) {
                                const tabId = tab.attr('id');
                                const navTab = $(form).find('#' + tabId + 'Nav');
                                if (navTab && navAddError[tabId] != true) {
                                    navTab.find('button').append('<i class=\'bx bxs-error text-danger px-1\'></i>');
                                    navAddError[tabId] = true;
                                }
                            }
                        }
                    });
                }else if(error.responseJSON.error){
                    Notification.Error(error.responseJSON.error);
                    // form.reset();
                }

                this.enableSubmitButton(button);
                this.removeSpinner(button);

                return error;
            }
        });

        return error;
    }
}
document.addEventListener('DOMContentLoaded', () => {
    SubmitForm.init();
});
