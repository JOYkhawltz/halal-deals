/* global full_path, id */
var currentRequest = null;
function ajaxindicatorstart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #B40B2B;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
    }
    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });
    jQuery('#resultLoading .bg').css({
        'background': '#ffffff',
        'opacity': '0.8',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });
    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'
    });
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function ajaxindicatorstop() {
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}

if (logged_in == true) {
    function showResetPassModal() {
        $('.modal').modal('hide');
        $('#reset-password-form')[0].reset();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        $('#reset_password_modal').modal('show');
    }

    function showSocialModal() {
        $('.modal').modal('hide');
        $('#social-signup-form')[0].reset();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        $('#social_signup_modal').modal('show');
    }
}

function success_msg(msg) {
    $.iaoAlert({
        type: "success",
        position: "top-right",
        mode: "dark",
        msg: msg,
        autoHide: true,
        alertTime: "3000",
        fadeTime: "1000",
        closeButton: true,
        fadeOnHover: true,
    });
}
function  error_msg(msg) {
    $.iaoAlert({
        type: "error",
        position: "top-right",
        mode: "dark",
        msg: msg,
        autoHide: true,
        alertTime: "3000",
        fadeTime: "1000",
        closeButton: true,
        fadeOnHover: true,
    });
}

$(document).ready(function () {
    $(document).on('change', '.signup-business-type', function () {
        if ($(this).val() == 3) {
            $('#signup_business_name').html('<div class="row"><div class="col-sm-12"><div class="form-group">'
                    + '<input type="text" class="form-control" name="business_name" placeholder="Business name">'
                    + '<div class="help-block" id="error-business_name"></div></div></div></div>');
        } else {
            $('#signup_business_name').html('');
        }
    });
    $(".toggle-password").click(function () {
        $(this).find('i').toggleClass("fa-eye fa-eye-slash");
        var input = $('#signin_modal .password');
        if (input.attr('type') == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    if (logged_in == true && $('#forgot_token').val() != "") {
        showResetPassModal();
    }

    if ($('#social_type').length > 0) {
        if (window.location.hash === "#_=_") {
            history.replaceState ? history.replaceState(null, null, window.location.href.split("#")[0]) : window.location.hash = "";
        }
        showSocialModal();
    }

    $('#signup-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                    zIndex: '9999'
                });
                $('#signup-form')[0].reset();
                $('#signup_modal').modal('hide');
                $('#resend-activation-form').find('[name="id"]').val(resp.u_id);
                $('#resend_activation_modal').modal('show');
                window.location.reload();
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    $(document).on('submit', '#resend-activation-form', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $.iaoAlert({
                    type: (resp.status && resp.status === 200) ? "success" : "error",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    zIndex: '99999',
                    closeButton: true,
                    fadeOnHover: true,
                });
                window.location.reload();
                ajaxindicatorstop();
            }
        });
    });

    $('#social-signup-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                window.location.href = resp.link;
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#error_" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#signin-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                window.location.href = resp.link;
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#err-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#forgot-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $('#forgot-form')[0].reset();
                $('#forgot_modal').modal('hide');
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#er-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#reset-password-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $('#reset_password_modal').modal('hide');
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#erro-" + key).html(val[0]).closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });
    $('#customer-editprofile-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    if (key === 'prod_types[]') {
                        $("#customer-editprofile-form").find("#error_productType").html(val[0]);
                        $("#customer-editprofile-form").find("#error_productType").addClass('has-error');
                    }
                    $("#customer-editprofile-form").find("[name='" + key + "']").closest('.form-group').addClass('has-error');
                    $("#customer-editprofile-form").find("[name='" + key + "']").closest('.form-group').find('.help-block').html(val[0]);
                });
                ajaxindicatorstop();
            }
        });
    });
    $('#reset-password-frm').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $.iaoAlert({
                    type: "success",
                    position: "top-right",
                    mode: "dark",
                    msg: resp.msg,
                    autoHide: true,
                    alertTime: "3000",
                    fadeTime: "1000",
                    closeButton: true,
                    fadeOnHover: true,
                });
                $('#reset-password-frm')[0].reset();
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#reset-password-frm").find("[name='" + key + "']").closest('.form-group').addClass('has-error');
                    $("#reset-password-frm").find("[name='" + key + "']").closest('.form-group').find('.help-block').html(val[0]);
                });
                ajaxindicatorstop();
            }
        })
    });
    $(document).on('submit', '#add-product-form', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                success_msg(resp.msg);
                $('#add-product-form')[0].reset();
                setTimeout(function () {
                    window.location.href = resp.link;
                }, 2000);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    if (key === 'image') {
                        $("#add-product-form").find("#error_image").html(val[0]);
                        $("#add-product-form").find("#error_image").closest('.form-group').addClass('has-error');
                    }
                    $("#add-product-form").find("[name='" + key + "']").closest('.form-group').addClass('has-error');
                    $("#add-product-form").find("[name='" + key + "']").closest('.form-group').find('.help-block').html(val[0]);
                });
                ajaxindicatorstop();
            }
        })
    });
    $(document).on('submit', '#add-product-advert-form', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                success_msg(resp.msg);
                $('#add-product-advert-form')[0].reset();
                setTimeout(function () {
                    window.location.href = resp.link;
                }, 2000);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#add-product-advert-form").find("[name='" + key + "']").closest('.form-group').addClass('has-error');
                    $("#add-product-advert-form").find("[name='" + key + "']").closest('.form-group').find('.help-block').html(val[0]);
                });
                ajaxindicatorstop();
            }
        })
    });

    $(document).on('click', '.delete-product', function () {
        var id = $(this).data('id');
        $.confirm({
            title: 'Delete',
            content: 'Are you sure to delete this product?',
            buttons: {
                confirm: {
                    btnClass: 'btn-success',
                    action: function () {
                        var csrf_token = $('input[name=_token]').val();
                        ajaxindicatorstart();
                        $.ajax({
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': csrf_token},
                            url: full_path + "delete-product",
                            data: {id: id},
                            cache: false,
                            dataType: 'json',
                            success: function (resp) {
                                if (resp.status === 200) {
                                    $('[data-id="' + id + '"]').closest('tr').remove();
                                    if ($('.delete-product').length === 0) {
                                        window.location.reload();
                                    }
                                    success_msg(resp.msg);
                                } else {
                                    error_msg(resp.msg);
                                }
                                ajaxindicatorstop();
                            }
                        });
                    }
                },
                cancel: {
                    btnClass: 'btn-danger'
                            //
                }
            }
        });
    });
    $(document).on('click', '.delete-advert', function () {
        var id = $(this).data('id');
        $.confirm({
            title: 'End Deal Now',
            content: 'Are you sure to end this deal?',
            buttons: {
                confirm: {
                    btnClass: 'btn-success',
                    action: function () {
                        var csrf_token = $('input[name=_token]').val();
                        ajaxindicatorstart();
                        $.ajax({
                            type: 'DELETE',
                            headers: {'X-CSRF-TOKEN': csrf_token},
                            url: full_path + "delete-advert",
                            data: {id: id},
                            cache: false,
                            dataType: 'json',
                            success: function (resp) {
                                if (resp.status === 200) {
                                    $('[data-id="' + id + '"]').closest('tr').remove();
                                    if ($('.delete-advert').length === 0) {
                                        window.location.reload();
                                    }
                                    success_msg(resp.msg);
                                } else {
                                    error_msg(resp.msg);
                                }
                                ajaxindicatorstop();
                            }
                        });
                    }
                },
                cancel: {
                    btnClass: 'btn-danger'
                            //
                }
            }
        });
    });
    $(document).on('click', '.redeem-voucher', function () {
        var id = $(this).data('id');
        $.confirm({
            title: 'Redeem It Now',
            content: 'Are you sure to redeem this deal?',
            buttons: {
                confirm: {
                    btnClass: 'btn-success',
                    action: function () {
                        var csrf_token = $('input[name=_token]').val();
                        ajaxindicatorstart();
                        $.ajax({
                            type: 'GET',
                            headers: {'X-CSRF-TOKEN': csrf_token},
                            url: full_path + 'redeem-voucher',
                            data: {id: id},
                            cache: false,
                            dataType: 'json',
                            success: function (resp) {
                                if (resp.status === 200) {
                                    // $('[data-id="' + id + '"]').closest('tr').remove();
                                    // if ($('.redeem-voucher').length === 0) {
                                    //     window.location.reload();
                                    // }
                                    window.location.reload();

                                    success_msg(resp.msg);
                                } else {
                                    error_msg(resp.msg);
                                }
                                ajaxindicatorstop();
                            }
                        });
                    }
                },
                cancel: {
                    btnClass: 'btn-danger'
                            //
                }
            }
        });
    });




    $(document).on('click', '.category-coupon-checkbox-find', function () {
        var category = [];
        $('.category-coupon-checkbox-find:checked').each(function (i, val) {
            category[i] = $(this).val();
        });
        ajaxindicatorstart();
        $.ajax({
            type: 'GET',
            url: full_path + "fetch-head-subcategory",
            data: {category: category},
            dataType: 'json',
            success: function (resp) {
                if (resp.sub_categories) {
                    $('#fetch-subcategory').html(resp.sub_categories);
                    $('#fetch-subcategory').closest('.filter_box').removeClass('d-none');
                } else {
                    $('#fetch-subcategory').closest('.filter_box').addClass('d-none');
                }
                ajaxindicatorstop();
            }
        });
    });
    $(document).on('click', '.category-coupon-checkbox', function () {

        var category = [];
        $('.category-coupon-checkbox:checked').each(function (i, val) {
            category[i] = $(this).val();

        });
        var sc = $('#sc').val();
        ajaxindicatorstart();
        $.ajax({
            type: 'GET',
            url: full_path + "fetch-subcategory",
            data: {category: category, sc: sc},
            dataType: 'json',
            success: function (resp) {
                if (resp.sub_categories) {
                    $('#left-fetch-subcategory').html(resp.sub_categories);
                    $('#left-fetch-subcategory').closest('.filter_box').removeClass('d-none');
                } else {
                    $('#left-fetch-subcategory').closest('.filter_box').addClass('d-none');
                }
                ajaxindicatorstop();
            }
        });
    });
    $(document).on('keyup keypress', '.filterbykeyword', function () {
        loadProducts(0);
    });

    $('#payment-checkout-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $("#address-form").hide();
                $("#payment-form").show();
                $("#confirm").hide();
                $("#pay").show();
                $("#pay_with_paypal").show();
                $("#OR").show();
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#payment-checkout-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#payment-checkout-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $('#card-checkout-form').submit(function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('').closest('.form-group').removeClass('has-error');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        data.append('name', $('#payment-checkout-form').find('input[name="name"]').val());
        data.append('phone', $('#payment-checkout-form').find('input[name="phone"]').val());
        data.append('address', $('#payment-checkout-form').find('input[name="address"]').val());
        data.append('city', $('#payment-checkout-form').find('input[name="city"]').val());
        data.append('country', $('#payment-checkout-form').find('option:selected').val());
        data.append('zipcode', $('#payment-checkout-form').find('input[name="zip"]').val());
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                if (resp.status && resp.status === 200) {
                    $.iaoAlert({
                        type: "success",
                        position: "top-right",
                        mode: "dark",
                        msg: resp.msg,
                        autoHide: true,
                        alertTime: "3000",
                        fadeTime: "1000",
                        closeButton: true,
                        fadeOnHover: true,
                    });

                    setInterval(function () {
                        window.location.href = resp.link;
                    }, 3000);
                } else if (resp.status && resp.status === 400) {
                    $.iaoAlert({
                        type: "error",
                        position: "top-right",
                        mode: "dark",
                        msg: resp.msg,
                        autoHide: true,
                        alertTime: "3000",
                        fadeTime: "1000",
                        closeButton: true,
                        fadeOnHover: true,
                    });
                }
                ajaxindicatorstop();

            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#card-checkout-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#card-checkout-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        })
    });

    $(document).on('submit', '#contact-us-form', function (event) {
        event.preventDefault();
        ajaxindicatorstart();
        $('.help-block').html('');
        var url = $(this).attr('action');
        var csrf_token = $('input[name=_token]').val();
        var data = new FormData($(this)[0]);
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: data,
            success: function (resp) {
                $('#contact-us-form')[0].reset();
                success_msg(resp.msg, 5000);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $('#contact-us-form').find('[name="' + key + '"]').closest('.form-group').find('.help-block').html(val[0]);
                    $('#contact-us-form').find('[name="' + key + '"]').closest('.form-group').addClass('has-error');
                });
                ajaxindicatorstop();
            }
        });
    });

    $("#normal_price").on("change keyup paste", function(){
    // $('#discount').prop('selectedIndex',0);
    getdiscountprice();
    });

});

function address_confirm()
{
    $('#payment-checkout-form').trigger('submit');
}

function Pay_product()
{
    $('#card-checkout-form').trigger('submit');
}

function GetCardType(number)
{
    // visa
    var re = new RegExp("^4");
    if (number.match(re) != null)
        return "Visa";

    // Mastercard 
    // Updated for Mastercard 2017 BINs expansion
    if (/^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$/.test(number))
        return "Mastercard";

    // AMEX
    re = new RegExp("^3[47]");
    if (number.match(re) != null)
        return "AMEX";

    // Discover
    re = new RegExp("^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)");
    if (number.match(re) != null)
        return "Discover";

    // Diners
    re = new RegExp("^36");
    if (number.match(re) != null)
        return "Diners";

    // Diners - Carte Blanche
    re = new RegExp("^30[0-5]");
    if (number.match(re) != null)
        return "Diners - Carte Blanche";

    // JCB
    re = new RegExp("^35(2[89]|[3-8][0-9])");
    if (number.match(re) != null)
        return "JCB";

    // Visa Electron
    re = new RegExp("^(4026|417500|4508|4844|491(3|7))");
    if (number.match(re) != null)
        return "Visa Electron";

    return "";
}

function CartUpdate(value, obj) {

    ajaxindicatorstart();
                    var csrf_token = $('input[name=_token]').val();
                    var advert_type = $(obj).data('advert_type');
                    var advert_id = $(obj).data('advert_id');
                    var cart_quantity = value;

                    var q =document.getElementById("quanti_"+advert_id);
                    var result = (cart_quantity - Math.floor(cart_quantity)) !== 0;
                    
                   if(cart_quantity < 1 || result ){ 
                       cart_quantity=1;
                   }
                    
                    currentRequest = $.ajax({
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        url: full_path + 'cart-update',
                        dataType: 'json',
                        data: {advert_id: advert_id , advert_type: advert_type, cart_quantity: cart_quantity},
                        beforeSend: function () {
                            if (currentRequest !== null) {
                                currentRequest.abort();
                            }
                        },
                        success: function (resp) {
                            if (resp.type === 1) {
                               // $(obj).closest('tr').remove();
                                  q.value=cart_quantity;
                               
                               //$('#quanti').html(resp.cart_quantity);
                               $('#cart_count').html(resp.cart_count);
                               $('#total_price').html(resp.total);
                               $('#sub_total_price').html(resp.sub_total);
                                
                                success_msg(resp.msg);
                            } else {
                                error_msg(resp.msg);
                            }
                            ajaxindicatorstop();
                        }
                    });

}

function AddtoCart(obj) {
    ajaxindicatorstart();
    var advert_id = $(obj).data('advert_id');
    var advert_type = $(obj).data('advert_type');
    var csrf_token = $('input[name=_token]').val();
    currentRequest = $.ajax({
        type: 'POST',
        headers: {'X-CSRF-TOKEN': csrf_token},
        url: full_path + 'add-cart',
        dataType: 'json',
        data: {advert_id: advert_id, advert_type: advert_type},
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
            if (resp.type === 1) {
                $('#cart_count').html(resp.cart_count);
                success_msg(resp.msg);
            } else {
                error_msg(resp.msg);
            }
            ajaxindicatorstop();
        }
    });
}
function removeCart(id, obj) {
    $.confirm({
        title: 'Delete',
        content: 'Are you sure to delete this product from cart?',
        buttons: {
            confirm: {
                btnClass: 'btn-success',
                action: function () {
                    ajaxindicatorstart();
                    var csrf_token = $('input[name=_token]').val();
                    $.ajax({
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        url: full_path + 'remove-cart',
                        dataType: 'json',
                        data: {advert_id: id},
                        success: function (resp) {
                            if (resp.type === 1) {
                                $(obj).closest('tr').remove();
                                $('#cart_count').html(resp.cart_count);
                                $('#total_price').html(resp.total);
                                $('#sub_total_price').html(resp.sub_total);
                                if (resp.content) {
                                    location.reload();
                                }
                                success_msg(resp.msg);
                            } else {
                                error_msg(resp.msg);
                            }
                            ajaxindicatorstop();
                        }
                    });
                }
            },
            cancel: {
                btnClass: 'btn-danger'
                        //
            },
        }
    });
}

function loadmorenoti() {
    var row = Number($('#row').val());
    var allcount = Number($('#all').val())
    var rowperpage = 5;
    row = row + rowperpage;
    if (row <= allcount) {
        var csrf_token = $('input[name=_token]').val();
        $("#row").val(row);
        $.ajax({
            url: full_path + 'load-notification',
            type: 'get',
            dataType: 'json',
            data: {row: row},
            beforeSend: function () {
                $("#loadmore").text("Loading...");
            },
            success: function (resp) {

                $("#loadnoti").append(resp.html);
                setTimeout(function () {
                    var rowno = row + rowperpage;
                    if (rowno > allcount) {
                        $('#loadmore').hide();
                    } else {
                        $("#loadmore").text("Load more");
                    }
                }, 2000);

            }
        });
    }
}

function showSignupModal() {
    $('.modal').modal('hide');
    $('.help-block').html('').closest('.form-group').removeClass('has-error');
    $('#signup-form')[0].reset();
    $('#signup_modal').modal('show');
}

function showSigninModal() {
    $('.modal').modal('hide');
    $('.help-block').html('').closest('.form-group').removeClass('has-error');
    $('#signin-form')[0].reset();
    $('#signin_modal').modal('show');
}

function showForgotModal() {
    $('.modal').modal('hide');
    $('.help-block').html('').closest('.form-group').removeClass('has-error');
    $('#forgot-form')[0].reset();
    $('#forgot_modal').modal('show');
}
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function chooseImage(id) {
    $("#is_default").attr("value", id);
}
function removehidden(id) {
    $("#image_" + id).remove();
    if ($('.product-image').html() === '' || $('#img_' + id).is(":checked"))
        $('#is_default').val('0');
}

function adverttype(obj) {
    var a_type = $(obj).find('option:selected').val();
    if (a_type == 'deal') {
        $('#deal').removeClass('d-none');
    } else {
        $('#deal').addClass('d-none');
    }
    if (a_type == 'voucher') {
        $('#voucher_expiry').removeClass('d-none');
    } else {
        $('#voucher_expiry').addClass('d-none');
    }
}
// function Additional(obj) {
//     var additional = $(obj).find('option:selected').val();
//     if (additional == 'spctime') {
//         $('#spctime').removeClass('d-none');
//     } else {
//         $('#spctime').addClass('d-none');
//     }
//     if (additional == 'newcstmer') {
//         $('#newcstmer').removeClass('d-none');
//     } else {
//         $('#newcstmer').addClass('d-none');
//     }
// }
function changeprice(obj) {

//    if ($("#prod_ID").val() != '') {
//        $('#help-block_err_coupen').html('');
//    }
    var price = $(obj).find('option:selected').data('price');
    var discount_price = $(obj).find('option:selected').data('discount-price');
    // console.log(discount_price);
    var id = $(obj).find('option:selected').data('id');
    if (price != undefined) {
        $('#normal-productprice').html('<div class="form-group"><label for="usr"><strong>Normal Price</strong></label><p><i class="icofont-pound"></i> ' + price + '</p></div>');
    } else {
        $('#normal-productprice').html('');
    }
    if(discount_price != '' && discount_price != undefined){
        $('#discount-productprice').html('<div class="form-group"><label for="usr"><strong>Discounted Price</strong></label><p><i class="icofont-pound"></i> ' + discount_price + '</p></div>');
    }else{
        $('#discount-productprice').html('');
    }
    if(discount_price != '' && discount_price != undefined){
    price = discount_price;
    // console.log('discount');
    fetch_cost_price(id, price);
    }else{
    // console.log('not discount');
    fetch_cost_price(id, price);
    }
}
function getSubtype(obj) {

//    if ($("#prod_ID").val() != '') {
//        $('#help-block_err_coupen').html('');
//    }
    var id = $(obj).find('option:selected').data('id');
    $.ajax({
        url: full_path + 'get-subtype',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
        success: function (resp) {
            $('#subtype').html(resp.subtypes);
        }
    });
}


function getdiscountprice() {

//    if ($("#prod_ID").val() != '') {
//        $('#help-block_err_coupen').html('');
//    }
    $('#dicount_price').empty();
    $('#dicount_price').addClass('d-none');
    var discount_id = $("#discount").find('option:selected').val();
    // console.log(val);
    var normal_price = $("#normal_price"). val();
    // console.log(normal_price);
    if(normal_price === ""){
        $.iaoAlert({
                        type: "error",
                        position: "top-right",
                        mode: "dark",
                        msg: "Please Provide Product Price First.",
                        autoHide: true,
                        alertTime: "3000",
                        fadeTime: "1000",
                        closeButton: true,
                        fadeOnHover: true,
                    });
    $('#discount').prop('selectedIndex',0);
    }
    if(normal_price !== "" && discount_id !== ""){
    $.ajax({
        url: full_path + 'get-discounted-price',
        type: 'GET',
        dataType: 'json',
        data: {discount_id : discount_id,normal_price : normal_price},
        success: function (resp) {
            $('#dicount_price').removeClass('d-none');
            $('#dicount_price').html(resp.discounted_price);
        }
    });
    }
}


function fetch_cost_price(id, price) {
    $.ajax({
        url: full_path + 'get-price',
        type: 'GET',
        dataType: 'json',
        data: {id: id, price: price},
        success: function (resp) {
            $("#output_price").removeClass('d-none');
            $('#cost_price').html('<i class="icofont-pound"></i> ' + resp.cost_price);
            $('#hd_price').html('<i class="icofont-pound"></i> ' + resp.hd_price);
            console.log(resp);
            if(resp.commission_type != '' && resp.commission_type == 2){
                // console.log('true');
                $("#commission_type_check").removeClass('d-none');
            }else{
                // console.log('false');
                $("#commission_type_check").addClass('d-none');
            }
        }
    });

}

function sortByCoupon(obj) {
    var value = $(obj).val();
    $('#filterCouponForm').find('[name="sortby"]').val(value);
    loadProducts(0);
}

function loadHotOffers(set_offset)
{
    $('#loadmoreForm').submit(function (e) {
        e.preventDefault();
    });
    ajaxindicatorstart();
    if (set_offset === 0) {
        $('#offset').val(0);
    }
    $(".search_load_btn").addClass('d-none');
    var data = new FormData($('#loadmoreForm')[0]);
    var csrf_token = $('input[name=_token]').val();
    currentRequest = $.ajax({
        url: $('#loadmoreForm').attr('action'),
        headers: {'X-CSRF-TOKEN': csrf_token},
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
            if (resp.type === 'success') {
                if (set_offset === 1) {
                    $('#fetchhotdealResults').append(resp.content);
                } else {
                    $('#fetchhotdealResults').html(resp.content);
                }
                $('#offset').val(resp.offset);
                if (resp.total <= resp.limit) {
                    $(".search_load_btn").removeAttr('onclick');
                    $(".search_load_btn").addClass('d-none');
                } else {
                    $(".search_load_btn").attr('onclick', 'loadHotOffers(1);');
                    $(".search_load_btn").removeClass('d-none');
                }
            } else {
                $('#fetchhotdealResults').html(resp.content);
            }
            ajaxindicatorstop();
        }
    });
}

function loadProducts(set_offset) {
    $('#filterCouponForm').submit(function (e) {
        e.preventDefault();
    });
    ajaxindicatorstart();
    if (set_offset === 0) {
        $('#offset').val(0);
    }
    $(".search_load_btn").addClass('d-none');
    var data = new FormData($('#filterCouponForm')[0]);
    var csrf_token = $('input[name=_token]').val();
    currentRequest = $.ajax({
        url: $('#filterCouponForm').attr('action'),
        headers: {'X-CSRF-TOKEN': csrf_token},
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
            if (resp.type === 'success') {
                if (set_offset === 1) {
                    $('#fetchCouponResults').append(resp.content);
                } else {
                    $('#fetchCouponResults').html(resp.content);
                }
                $('#offset').val(resp.offset);
                if (resp.total <= resp.limit) {
                    $(".search_load_btn").removeAttr('onclick');
                    $(".search_load_btn").addClass('d-none');
                } else {
                    $(".search_load_btn").attr('onclick', 'loadProducts(1);');
                    $(".search_load_btn").removeClass('d-none');
                }
            } else {
                $('#fetchCouponResults').html(resp.content);
            }
            ajaxindicatorstop();
        }
    });
}
//function discountcoupen(obj) {
//    var form_data = $('#add-product-advert-form').serialize();
//    $("#output_price").addClass('d-none');
//    $('#help-block_err_coupen').html('');
//    if ($("#coupen_discount").val() == '') {
//        $('#help-block_err_coupen').text('This coupen discount field is required.');
//        $("#output_price").addClass('d-none');
//    } else {
//        currentRequest = $.ajax({
//
//            url: full_path + 'get-price',
//            type: 'get',
//            dataType: 'json',
//            processData: false,
//            contentType: false,
//            data: form_data,
//            beforeSend: function () {
//                if (currentRequest !== null) {
//                    currentRequest.abort();
//                }
//            },
//            success: function (data) {
//                if (data.status == "error") {
//                    $('#help-block_err_coupen').text(data.error);
//                    $("#output_price").addClass('d-none');
//                } else {
//                    if (data.cost_price_error == "error") {
//                        $("#output_price").addClass('d-none');
//                        $('#help-block_err_coupen').text('given commision rate high.');
//                    } else {
//                        $("#output_price").removeClass('d-none');
//                        $('#cost_price').html('$ ' + data.cost_price);
//                        $('#hd_price').html('$ ' + data.hd_price);
//                    }
//
//                }
//            }
//        });
//    }
//
//}
//
//function additionaldiscount(obj) {
//    var form_data = $('#add-product-advert-form').serialize();
//    $("#output_price").addClass('d-none');
//    $('#help-block_err_addtionalcoupen').html('');
//    if ($("#additional_discount").val() == '') {
//        $('#help-block_err_addtionalcoupen').html('');
//    }
//    currentRequest = jQuery.ajax({
//        url: full_path + 'additonal-discount',
//        type: 'get',
//        dataType: 'json',
//        processData: false,
//        contentType: false,
//        data: form_data,
//        beforeSend: function () {
//            if (currentRequest !== null) {
//                currentRequest.abort();
//            }
//        },
//        success: function (data) {
//            if (data.status == "error") {
//                $('#help-block_err_addtionalcoupen').text(data.error);
//
//            } else {
//                if (data.cost_price_error == "error") {
//                    $("#output_price").addClass('d-none');
//                    $('#help-block_err_addtionalcoupen').text('given additional rate high.');
//                } else {
//                    $("#output_price").removeClass('d-none');
//                    $('#cost_price').html('$ ' + data.cost_price);
//                    $('#hd_price').html('$ ' + data.hd_price);
//                }
//
//            }
//        }
//    });
//
//
//}

function loadMore() {
    ajaxindicatorstart();
    var data = new FormData($('#filterCouponForm')[0]);
    var csrf_token = $('input[name=_token]').val();
    $(".search_load_btn").addClass('d-none');
    currentRequest = $.ajax({
        type: 'POST',
        url: $('#filterCouponForm').attr('action'),
        headers: {'X-CSRF-TOKEN': csrf_token},
        dataType: 'json',
        data: data,
        beforeSend: function () {
            if (currentRequest !== null) {
                currentRequest.abort();
            }
        },
        success: function (resp) {
            $('#fetchCouponResults').append(resp.content)
            $('img').on("error", function () {
                this.src = $(this).data('src');
            });
            $('[name="offset"]').val(resp.offset);
            if (resp.total <= resp.offset) {
                $(".search_load_btn").removeAttr('onclick');
                $(".search_load_btn").addClass('d-none');
            } else {
                $(".search_load_btn").attr('onclick', 'loadMore();');
                $(".search_load_btn").removeClass('d-none');
            }
            ajaxindicatorstop();
        }
    });
}
//additional details tooltip
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
$(document).on('submit', '#update-order-status', function (event) {
    event.preventDefault();
    ajaxindicatorstart();
    $('.help-block').html('').closest('.form-group').removeClass('has-error');
    var url = $(this).attr('action');
    var csrf_token = $('input[name=_token]').val();
    var status = $("input[name='status']:checked").val();

    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': csrf_token},
        type: 'POST',
        dataType: 'json',
//            processData: false,
//            contentType: false,
        data: {status: status},
        success: function (resp) {
            success_msg(resp.msg);
            $('#update-order-status')[0].reset();
            setTimeout(function () {
                window.location.href = resp.link;
            }, 2000);
            ajaxindicatorstop();
        }
    })
});
$(document).on('submit', '#cash-withdrawal-form', function (event) {
    event.preventDefault();
    ajaxindicatorstart();
    $('.help-block').html('').closest('.form-group').removeClass('has-error');
    var url = $(this).attr('action');
    var csrf_token = $('input[name=_token]').val();
    var data = new FormData($(this)[0]);
    $.ajax({
        url: url,
        headers: {'X-CSRF-TOKEN': csrf_token},
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: data,
        success: function (resp) {
            success_msg(resp.msg);
            $('#cash-withdrawal-form')[0].reset();
            setTimeout(function () {
                window.location.href = resp.link;
            }, 2000);
            ajaxindicatorstop();
        },
        error: function (resp) {
            $.each(resp.responseJSON.errors, function (key, val) {
                $("#cash-withdrawal-form").find("[name='" + key + "']").closest('.form-group').addClass('has-error');
                $("#cash-withdrawal-form").find("[name='" + key + "']").closest('.form-group').find('.help-block').html(val[0]);
            });
            ajaxindicatorstop();
        }
    })
});
function showwithdrawlform() {
    if ($('#showwithdrawlform').hasClass('d-none')) {
        $('#showwithdrawlform').removeClass('d-none');
        $('#history').addClass('d-none');
    } else {
        $('#showwithdrawlform').addClass('d-none');
        $('#history').removeClass('d-none');
    }

}
function totalsellsChart(obj) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + 'total-sell',
        type: 'GET',
        dataType: 'json',
        data: {year: $(obj).val()},
        success: function (resp) {
            if (resp.status && resp.status === 200) {
                $('#leadchartContainer').html(resp.content);
            }
            ajaxindicatorstop();
        }
    });
}
function profitpermonth(obj) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + 'profit-per-month',
        type: 'GET',
        dataType: 'json',
        data: {year: $(obj).val()},
        success: function (resp) {
            if (resp.status && resp.status === 200) {
                $('#profitPerMonth').html(resp.content);
            }
            ajaxindicatorstop();
        }
    });
}

function Pay_With_PayPal(){
        event.preventDefault();
        ajaxindicatorstart();
        var csrf_token = $('input[name=_token]').val();
        var total_amount = $('#total_payble_amount').text();
        var name = $('#payment-checkout-form').find('input[name="name"]').val();
        var phone = $('#payment-checkout-form').find('input[name="phone"]').val();
        var address = $('#payment-checkout-form').find('input[name="address"]').val();
        var city = $('#payment-checkout-form').find('input[name="city"]').val();
        var country = $('#payment-checkout-form').find('option:selected').val();
        var zipcode = $('#payment-checkout-form').find('input[name="zip"]').val();
        // return false;
        // console.log(name);
        $.ajax({
            url: full_path + 'paypal-checkout',
            headers: {'X-CSRF-TOKEN': csrf_token},
            type: 'POST',
            dataType: 'json',
            data: {total_amount:total_amount,name:name,phone:phone,address:address,city:city,country:country,zipcode:zipcode},
            success: function (resp) {
                if (resp.status && resp.status === 200) {
                    console.log(1);
                    $.iaoAlert({
                        type: "success",
                        position: "top-right",
                        mode: "dark",
                        msg: resp.msg,
                        autoHide: true,
                        alertTime: "3000",
                        fadeTime: "1000",
                        closeButton: true,
                        fadeOnHover: true,
                    });

                    setInterval(function () {
                        window.location.href = resp.link;
                    }, 2000);
                } else if (resp.status && resp.status === 400) {
                    $.iaoAlert({
                        type: "error",
                        position: "top-right",
                        mode: "dark",
                        msg: resp.msg,
                        autoHide: true,
                        alertTime: "3000",
                        fadeTime: "1000",
                        closeButton: true,
                        fadeOnHover: true,
                    });
                }
                ajaxindicatorstop();

            },
            error: function (resp) {
                console.log('error');
                ajaxindicatorstop();
            }
        });
}