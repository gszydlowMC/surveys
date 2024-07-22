const Swal = require('sweetalert2');

function __(text) {
    return text;
}

$(document).ready(function (e) {
    $(document).ajaxStart(function () {
        addLoader('ajaxLoader123123');
    }).ajaxStop(function () {
        removeLoader('ajaxLoader123123');
    }).ajaxError(function (e, xhr, settings, exception) {
        removeLoader('ajaxLoader123123');
    });

    $(document).on('click', '.ref', function (e) {
        e.preventDefault();
        $that = $(this);
        var ref = $that.attr('ref');
        if (ref != '') {
            if (ref.indexOf("(") != -1 && ref.indexOf(")") != -1) {
                if (ref.indexOf(";") != -1) {
                    var funcs = ref.split(';');
                    for (i = 0; i < funcs.length; i++) {
                        if (funcs[i] !== '') {
                            eval(funcs[i].trim());
                        }
                    }
                    return false;
                } else {
                    func = new Function(ref);
                }

            } else {
                func = new Function(ref + '($that)');
            }
            func();
        }
        return false;
    });

    $('.table-container .sright').on('click mouseenter', function (e) {
        var leftPos = $(this).parent().scrollLeft();
        $(this).parent().animate({scrollLeft: leftPos + 400}, 400);
    });

    $('.table-container .sleft').on('click mouseenter', function (e) {
        var leftPos = $(this).parent().scrollLeft();
        $(this).parent().animate({scrollLeft: leftPos - 400}, 400);
    });

    $(document).on('change', '.EDataTable select[name="tableWidthConfig"]', function (e) {
        const width = $(this).val();
        const dt = $(this).parents('.EDataTable');
        if (dt.length) {
            dt.css({'width': width + '%'});
            if (dt.outerWidth() > dt.parent().width()) {
                $(this).parents('.table-container').find('.sign_direction').show();
                $(this).parents('table').find('th, td').addClass('autoWidth');
            } else {
                $(this).parents('.table-container').find('.sign_direction').hide();
                $(this).parents('table').find('th, td').removeClass('autoWidth');
            }
        }
    });

    setTimeout(function () {
        if ($('.EDataTable.sticky').length) {
            $('.EDataTable.sticky').each(function () {
                const table = $(this);
                if (table.outerWidth() > table.parent().width()) {
                    $(this).parents('.table-container').find('.sign_direction').show();
                    $(this).parents('table').find('th, td').addClass('autoWidth');
                } else {
                    $(this).parents('.table-container').find('.sign_direction').hide();
                    $(this).parents('table').find('th, td').removeClass('autoWidth');
                }
            });
        }
    }, 1000);


    $('.dt_copy_url').on('click', function () {
        const filters = $(this).parents(".EDataTable").find(".filters :input").filter(function (index, element) {
            return $(element).val() != '';
        }).serialize();
        let url = document.URL.split('?');
        let out = url[0] + '?' + filters;

        const $txt = $('<textarea />');
        $txt.val(out).css({width: "1px", height: "1px"}).appendTo('body');
        $txt.select();
        if (document.execCommand('copy')) {
            $txt.remove();
        }
    });
    select2Init();

    $('.select-all').on('click', function () {
        if ($(this).is(':checked')) {
            $(this).closest('table').find('tr td .check-row').prop("checked", true);
        } else {
            $(this).closest('table').find('tr td .check-row').prop("checked", false);
        }
    });

    $('.select-all-ul').on('click', function () {
        if ($(this).is(':checked')) {
            $(this).closest('li').find('li .form-check-input').prop("checked", true);
        } else {
            $(this).closest('li').find('li .form-check-input').prop("checked", false);
        }
    });

    if ($('.menu-categories .mc-item a')) {
        const currentUrl = window.location.href;
        $('.menu-categories .mc-item a').each(function () {
            if (currentUrl.indexOf($(this).attr('href')) > -1) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
    }
    if ($('.sortable-compontent').length) {
        $('.table-search').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $(".sortable-compontent:first-child tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value.toLowerCase()) > -1)
            });
        });
    }

    // if ($('ol.search-tree-enable').length) {
    //     $('.table-search').on('change', function () {
    //         var value = $(this).val().toLowerCase();
    //         const a = [];
    //         $("ol.search-tree-enable li .toggle").filter(function () {
    //             if ($(this).text().trim().toLowerCase().indexOf(value.toLowerCase()) > -1) {
    //                 $(this).closest('li').removeClass('d-none');
    //                 a.push($(this));
    //             }else{
    //                 $(this).closest('li').addClass('d-none');
    //             }
    //         });
    //
    //         if (a.length > 0) {
    //             $('.search-container .text-find').addClass('text-success');
    //             $('.search-container .text-find').html('Znaleziono '+a.length+' elementów.');
    //             setTimeout(function(){
    //                 $('.search-container .text-find').removeClass('text-success');
    //                 $('.search-container .text-find').html('');
    //             },3000)
    //         }
    //     });
    // }

    if ($('.search-tree-enable').length) {
        $('.table-search').on('change', function () {
            var value = $(this).val().toLowerCase();
            $(".search-tree-enable .search-span").removeClass('text-danger');
            if (value.length > 0) {
                $(".search-tree-enable .collapse").removeClass('show');
                const a = [];
                $(".search-tree-enable .search-span").filter(function () {
                    if ($(this).text().trim().toLowerCase().indexOf(value.toLowerCase()) > -1) {
                        a.push($(this));
                    }
                });

                if (a.length > 0) {
                    a.forEach((element) => {
                        element.parents('.collapse').last().addClass('show');
                        let ul = element.parents('.collapse').last().find('ul.collapse');

                        ul.each(function () {
                            if ($(this).find(element).length > 0) {
                                $(this).addClass('show');
                            } else {
                                $(this).removeClass('show');
                            }
                        });

                        element.addClass('text-success');
                    });

                    $('.search-container .text-find').addClass('text-success');
                    $('.search-container .text-find').html('Znaleziono ' + a.length + ' elementów.');
                    setTimeout(function () {
                        $('.search-container .text-find').removeClass('text-success');
                        $('.search-container .text-find').html('');
                    }, 3000)
                }
            }
        });
    }

    $(document).on('click', '.collapse-all', function () {
        if ($(this).hasClass('show')) {
            $(this).closest('.has-menu').find('.collapse.show').removeClass('show');
            $(this).closest('.has-menu').find('.bx-chevron-up').addClass('bx-chevron-down').removeClass('bx-chevron-up');
            $(this).removeClass('show');
        } else {
            $(this).closest('.has-menu').find('.collapse:not(.show)').addClass('show');
            $(this).closest('.has-menu').find('.bx-chevron-down').addClass('bx-chevron-up').removeClass('bx-chevron-down');
            $(this).addClass('show');
        }
    });

    $(document).on('click', '.collapse-item .bx-chevron-down', function () {
        $(this).addClass('bx-chevron-up').removeClass('bx-chevron-down');
    });

    $(document).on('click', '.collapse-item .bx-chevron-up', function () {
        $(this).addClass('bx-chevron-down').removeClass('bx-chevron-up');
    });
});

formatBytes = function (bytes, decimals = 2) {
    if (!+bytes) return '0 Bytes'

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];

    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`;
}

function select2Init() {
    if ($('.select2-ajax').length) {
        $('.select2-ajax').each(function () {
            const data_url = $(this).attr('data-url');
            let tags = false;
            if ($(this).hasClass('tags-enable')) {
                tags = true;
            }
            $(this).select2({
                theme: 'bootstrap-5',
                tags: tags,
                allowClear: true,
                placeholder: '--Wybierz--',
                ajax: {
                    url: function () {
                        const serializeDiv = $(this).parents('.select2-to-serialize');
                        if (serializeDiv) {
                            const formSerialize = serializeDiv.find(':input').serialize();
                            console.log(formSerialize);
                            return data_url + '&select2=1&' + formSerialize;
                        } else {
                            return data_url + '&select2=1&';
                        }
                    },

                    dataType: 'json'
                },
                createTag: function (params) {
                    var term = $.trim(params.term);

                    if (term === '') {
                        return null;
                    }

                    return {
                        id: term,
                        text: term
                    };
                },
            });
        });
    }

    if ($('.select2-simple').length) {
        $('.select2-simple').each(function () {
            let tags = false;
            if ($(this).hasClass('tags-enable')) {
                tags = true;
            }
            $(this).select2({
                theme: 'bootstrap-5',
                tags: tags
            });
        });

    }
    if ($('.datetimepicker-time').length) {
        $('.datetimepicker-time').daterangepicker({
                autoUpdateInput: false,
                timePicker: true,
                singleDatePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 5,
                drops: 'up',
                autoApply: true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm',
                    applyLabel: "OK",
                    cancelLabel: "Wyczyść",
                },
            }
        ).on('show.daterangepicker', function (ev, picker) {
            $(".auto-apply").remove();
        }).on('showCalendar.daterangepicker', function (ev, picker) {
            $(".auto-apply").remove();
        }).on('cancel.daterangepicker', function (ev, picker) {
            $(picker.element[0]).val('');
        }).on('apply.daterangepicker', function (ev, picker) {
            $(picker.element[0]).val(picker.startDate.format('YYYY-MM-DD HH:mm'));
        });
    }

    if ($('.daterangepicker').length) {
        $('.daterangepicker').daterangepicker({
            // singleDatePicker: true,
            timePicker: false,
            locale: {
                "format": "YYYY-MM-DD",
            },
            autoUpdateInput: false,
            autoApply: true
        });
    }

    $('.toggle').on("click", function () {
        const target = $(this).attr('data-toggle-target');
        if (target) {
            $("#" + target).toggle('fast', function () {
                if ($(this).is(':hidden')) {

                } else {
                    const prev = $(this).prev();
                    if (prev.hasClass('table-reload')) {
                        prev.click();
                    }
                }
            });
        }
    });

}

function addLoader(id) {
    $('body').prepend('<div id="' + id + '" style="position:absolute; top:50%; left:50%; z-index:99999;">' +
        '<div class="spinner-border" role="status">' +
        '<span class="visually-hidden">Loading...</span>' +
        '</div>' +
        '</div>');
}

function removeLoader(id) {
    $('#' + id).remove();
}

function getDT(id) {
    try {
        return eval($('table[data-id="' + id + '"]').attr('id'));

    } catch (e) {
    }
}

let ajaxReplaceTarget = '';
let ajaxAfterScripts = '';
ajaxOpen = function (src) {
    sendAjax = function (src) {
        if (typeof src.attr('method') !== 'undefined') {
            var type = src.attr('method').toLowerCase();
        } else {
            var type = 'get';
        }
        var url = src.attr('href');
        if (typeof url === 'undefined') {
            url = src.attr('data-url');
        }

        ajaxReplaceTarget = src.data('replaceTarget') ?? '';
        ajaxAfterScripts = src.data('afterScripts') ?? '';

        var params = {};

        let passGET = '';
        $.each(src[0].attributes, function (i, v) {
            if (v.name.indexOf('parame-') > -1) {
                params[v.name.replace('parame-', '')] = eval(v.value);
                passGET += '&' + v.name.replace('parame-', '') + '=' + params[v.name.replace('parame-', '')];
            }
            if (v.name.indexOf('param-') > -1) {
                params[v.name.replace('param-', '')] = v.value;
                passGET += '&' + v.name.replace('param-', '') + '=' + v.value;
            }
        });
        params['_token'] = $('input[name="_token"]').val();
        let sendParams = {};
        if (type === 'get') {
            url += passGET;
        } else {
            sendParams = JSON.stringify(params);
        }

        $('#loading').show();
        $.ajax({
            url: url,
            type: type,
            data: sendParams,
            dataType: 'json',
            processData: true,
            contentType: 'application/json',
            complete: function (resp) {
                let jResponse = resp.responseJSON;
                checkResponse(jResponse, src);
            }
        });

    }

    var cfrm = src.attr('confirm');

    if (typeof cfrm !== "undefined" && cfrm !== '') {

        Swal.fire({
            title: cfrm,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Tak',
            denyButtonText: 'Nie',
            cancelButtonText: 'Anuluj',
        }).then((result) => {
            if (result.isConfirmed) {
                sendAjax(src);
            } else if (result.isDenied) {
                next = false;
            }
        });
    } else {
        sendAjax(src);
    }

    return false;
};

checkResponse = function (jResponse, src) {
    try {
        if (jResponse.message) {
            if (jResponse.message.type === 'fail' || jResponse.message.type === 'error') {
                Notification.Error(jResponse.message.text);
            } else {
                Notification.Success(jResponse.message.text ?? jResponse.message);
                if (jResponse.reload) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else if (jResponse.redirect && jResponse.redirect !== '') {
                    setTimeout(function () {
                        window.location.href = jResponse.redirect;
                    }, 1000);
                }
            }
        } else if (jResponse.data && jResponse.data.errorsString) {
            let errors = [];
            Swal.fire(
                {
                    title: jResponse.data.message,
                    text: jResponse.data.errorsString,
                    type: 'error',
                    timer: 3000
                }
            )
            return false;
        } else if (jResponse.append && jResponse.append.html) {
            if (ajaxReplaceTarget !== '') {
                const target = $(ajaxReplaceTarget);
                if (target.length) {
                    target.html(jResponse.append.html);
                }
            }
            if (ajaxAfterScripts !== '') {
                setTimeout(function () {
                    console.log(ajaxAfterScripts);
                    eval(ajaxAfterScripts + '()');
                }, 100);
            }
        } else {
            // Notification.Error(jResponse.errors);
        }

    } catch (error) {
        console.log(error);
        refresh = false;
    }

    if (src && !$(src).hasClass('table-reload') && src.closest('.ajax-container')) {
        src.closest('.ajax-container').find('.table-reload').click();
    }

    return false;
}


Notification = {
    timeout: null,
    progressTime: null,
    progress: 0,
    Download: function (message) {
        Swal.fire(
            {
                title: 'Powiadomienie',
                text: message,
                type: 'info',
                showCancelButton: false,
                showConfirmButton: false
            }
        )
    },
    Push: function (type, message, delay = 3000) {
        Swal.fire(
            {
                title: 'Powiadomienie',
                text: message,
                type: type,
                timer: delay
            }
        )
    },
    Info: function (message, delay = 3000) {
        Swal.fire(
            {
                title: 'Info',
                text: message,
                type: 'info',
                timer: delay
            }
        )
    },
    Success: function (message, delay = 3000) {
        Swal.fire(
            {
                title: 'Sukces',
                text: message,
                type: 'success'
                // timer: delay
            }
        )
    },
    Error: function (message, delay = 3000) {
        Swal.fire(
            {
                title: 'Błąd',
                text: message,
                type: 'error',
                timer: delay
            }
        )
    },
    Warning: function (message, delay = 3000) {
        Swal.fire(
            {
                title: 'Ostrzeżenie',
                text: message,
                type: 'warning',
                timer: delay
            }
        )
    }
};

checkErrorResponse = function (form, error) {
    removeLoader('ajaxLoader123123');
    $(form).find('.invalid-feedback').remove();
    $(form).find('.is-invalid').removeClass('is-invalid');
    $(form).find('.bxs-error').remove();
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

            console.log(strKey);
            console.log(strKey2);

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
    }

    // this.enableSubmitButton(button);
    // this.removeSpinner(button);

    return error;
}

