var currentRequest = null;
function ajaxindicatorstart() {
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #2ec6d0;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
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

function success_msg(msg) {
    $.iaoAlert({
        type: "success",
        position: "bottom-right",
        mode: "dark",
        msg: msg,
        autoHide: true,
        alertTime: "3000",
        fadeTime: "1000",
        closeButton: true,
        fadeOnHover: true,
    });
}
function error_msg(msg) {
    $.iaoAlert({
        type: "error",
        position: "bottom-right",
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

    if ($('.datatable').length === 1) {

        $('#cms-table').DataTable({
            processing: false,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: full_path + 'cms',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'page_name', name: 'page_name'},
                {data: 'type', name: 'type'},
                {data: 'content_name', name: 'content_name'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#contact-table').DataTable({
            processing: false,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: full_path + 'contact',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'phone_no', name: 'phone_no'},
                {data: 'created_at', name: 'created_at'},
                {data: 'reply_status', name: 'reply_status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#seo-table').DataTable({
            processing: false,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: full_path + 'seo',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'route', name: 'route'},
                {data: 'title', name: 'title'},
                {data: 'keyword', name: 'keyword'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#product-type-table').DataTable({
            processing: false,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: full_path + 'product-type',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#static-page-table').DataTable({
            processing: false,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: full_path + 'static-page',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'page_name', name: 'page_name'},
                {data: 'content', name: 'content'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#customer-table').DataTable({
            processing: false,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: full_path + 'customer',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'last_login_at', name: 'last_login_at'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#product-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'admin-products-list-datatable',
            order: [[6, "desc"]],
            columns: [
                {data: 'prod_ID', name: 'prod_ID'},
                {data: 'vendor_name', name: 'vendor_name'},
                {data: 'name', name: 'name'},
                {data: 'normal_price', name: 'normal_price'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#advert-deal-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'advertdeal-list-datatable',
            order: [[6, "desc"]],
            columns: [
                {data: 'advert_ID', name: 'advert_ID'},
                {data: 'product_name', name: 'product_name'},
                {data: 'cost_price', name: 'cost_price'},
                {data: 'hd_price', name: 'hd_price'},
//                {data: 'date_start', name: 'date_start'},
//                {data: 'date_finish', name: 'date_finish'},
                {data: 'deal_start', name: 'deal_start'},
                {data: 'deal_end', name: 'deal_end'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#advert-voucher-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'advertvoucher-list-datatable',
            order: [[0, "desc"]],
            columns: [
                {data: 'voucher_ID', name: 'voucher_ID'},
                {data: 'advert_ID', name: 'advert_ID'},
                {data: 'purchasing_user', name: 'purchasing_user'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'redeem', name: 'redeem'}
            ],
        });
        var id = $('#advert-voucherdetails-management').data('id');
        $('#advert-voucherdetails-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'advertvoucherdetail-list-datatable/'+id,
            order: [[0, "desc"]],
            columns: [
                {data: 'advert_ID', name: 'advert_ID'},
                {data: 'voucher_ID', name: 'voucher_ID'},
                {data: 'redeem', name: 'redeem'},
                {data: 'purchasing_user', name: 'purchasing_user'},
                {data: 'status', name: 'status'},
                
            ]
        });
        $('#order-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'admin-orderlist-datatable',
            order: [[0, "desc"]],
            columns: [
                {data: 'id', name: 'id'},
                {data: 'order_number', name: 'order_number'},
                {data: 'users.first_name', name: 'users.first_name'},
                {data: 'payment_gateway', name: 'payment_gateway'},
                {data: 'pay_amount', name: 'pay_amount'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
                
            ]
        });
        
        var o_id = $('#order-detaillist-management').data('id');
        $('#order-detaillist-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'admin-orderdetail-datatable/'+o_id,
            order: [[0, "asc"]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'type', name: 'type'},
                {data: 'title', name: 'title'},
                {data: 'item_price', name: 'item_price'},
                {data: 'quantity', name: 'quantity'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
                
            ]
        });
        $('#wallet-management').DataTable({
            processing: false,
            serverSide: true,
            ajax: full_path + 'admin-withdrawlrequestlist-datatable',
            order: [[3, "asc"]],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false, searchable: false},
                {data: 'users.first_name', name: 'users.first_name'},
                {data: 'amount', name: 'amount'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
                
            ]
        })
        $('#vendor-table').DataTable({
            processing: false,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: full_path + 'vendor',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'last_login_at', name: 'last_login_at'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $('#staff-vendor-table').DataTable({
            processing: false,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: full_path + 'staff-vendor',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'last_login_at', name: 'last_login_at'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $('#admin-staff-table').DataTable({
            processing: false,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: full_path + 'admin-staff',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'last_login_at', name: 'last_login_at'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#admin-discount-table').DataTable({
            processing: false,
            serverSide: true,
            order: [[1, "asc"]],
            ajax: full_path + 'admin-discount',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'discount_rate', name: 'discount_rate'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    }

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
    $(document).on('submit', '#add-voucher-advert-form', function (event) {
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
                $('#add-voucher-advert-form')[0].reset();
               setTimeout(function () {
                   window.location.href = resp.link;
               }, 2000);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#add-voucher-advert-form").find("[name='" + key + "']").closest('.form-group').addClass('has-error');
                    $("#add-voucher-advert-form").find("[name='" + key + "']").closest('.form-group').find('.help-block').html(val[0]);
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

    $(document).on('submit', '#Update-Discount-Form', function (event) {
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
                $('#Update-Discount-Form')[0].reset();
               setTimeout(function () {
                   window.location.href = resp.link;
               }, 2000);
                ajaxindicatorstop();
            },
            error: function (resp) {
                $.each(resp.responseJSON.errors, function (key, val) {
                    $("#Update-Discount-Form").find("[name='" + key + "']").closest('.form-group').addClass('has-error');
                    $("#Update-Discount-Form").find("[name='" + key + "']").closest('.form-group').find('.help-block').html(val[0]);
                });
                ajaxindicatorstop();
            }
        })
    });

    $("#normal_price").on("change keyup paste", function(){
    // $('#discount').prop('selectedIndex',0);
    getdiscountprice();
    });


});

function checkcommissontype(){
   var val = $('input[name="commission_type"]:checked').val();
   if(val == 1){
    // console.log(val);
    $('#commission_rate').attr('style','display:block');
    $('#additional_rate').attr('style','display:block');
   }else{
    $('#commission_rate').attr('style','display:none');
    $('#additional_rate').attr('style','display:none');
   }
   
}

function getdiscountprice() {

//    if ($("#prod_ID").val() != '') {
//        $('#help-block_err_coupen').html('');
//    }
    $('#dicount_price').empty();
    // $('#dicount_price').addClass('d-none');
    $('#dicount_price').attr('style','display:none')
    var discount_id = $("#discount_id").val();
    // console.log(discount_id);
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
    // $('#discount').prop('selectedIndex',0);
    }
    if(normal_price !== "" && discount_id !== ""){
    $.ajax({
        url: full_path + 'get-discounted-price',
        type: 'GET',
        dataType: 'json',
        data: {discount_id : discount_id,normal_price : normal_price},
        success: function (resp) {
            // $('#dicount_price').removeClass('d-none');
            $('#dicount_price').attr('style','display:block')
            $('#dicount_price').html(resp.discounted_price);
        }
    });
    }
}


function getproduct(obj) {
    var id = $(obj).find('option:selected').data('id');
    jQuery.ajax({
            url: full_path + 'product-list',
            type: 'get',
            dataType: 'json',
            data: {id:id},

            success: function (data) {
                $('#product').removeClass('hide');
               $('#product_list').html(data.action_html);
            }
});
}
function adverttype(obj) {
    var a_type = $(obj).find('option:selected').val();
    if (a_type == 'deal') {
        $('#deal').removeClass('hide');
    } else {
        $('#deal').addClass('hide');
    }
    if (a_type == 'voucher') {
        $('#voucher_expiry').removeClass('hide');
    } else {
        $('#voucher_expiry').addClass('hide');
    }
}
function changePrice(obj) {
    var price = $(obj).find('option:selected').data('price');
    var id = $(obj).find('option:selected').data('id');
    if (price != undefined) {
        $('#normal-productprice').html('<div class="form-group"><label for="usr"><strong>Normal Price</strong></label><p>$ ' + price + '</p></div>');
    } else {
        $('#normal-productprice').html('');
    }

}


function discountcoupen(obj) {
    var form_data = $('#add-product-advert-form').serialize();

//    $("#output_price").addClass('d-none');
    $('#help-block_err_coupen').html('');
    if ($("#coupen_discount").val() == '') {
        $('#help-block_err_coupen').text('This coupen discount field is required.').closest('.form-group').addClass('has-error');
        $("#output_price").addClass('hide');
    } else {

        currentRequest = $.ajax({
            url: full_path + 'get-price',
            type: 'get',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function () {
                if (currentRequest !== null) {
                    currentRequest.abort();
                }
            },
            success: function (data) {
                if (data.status == "error") {
                    $('#help-block_err_coupen').text(data.error).closest('.form-group').addClass('has-error');
                    $("#output_price").addClass('hide');
                } else {
                    if (data.cost_price_error == "error") {
                        $("#output_price").addClass('hide');
                        $('#help-block_err_coupen').text('given commision rate high.').closest('.form-group').addClass('has-error');
                    } else {
                        $("#output_price").removeClass('hide');
                        $('#help-block_err_coupen').closest('.form-group').removeClass('has-error');
                        $('#cost_price').html('$ ' + data.cost_price);
                        $('#hd_price').html('$ ' + data.hd_price);
                    }

                }
            }
        });
    }

}
function additionaldiscount(obj) {
    var form_data = $('#add-product-advert-form').serialize();
    $('#help-block_err_addtionalcoupen').html('').closest('.form-group').removeClass('has-error');
    if ($("#additional_discount").val() == '') {
        $('#help-block_err_addtionalcoupen').html('');
    } 
        currentRequest = $.ajax({
            url: full_path + 'additonal-discount',
            type: 'get',
            dataType: 'json',
            processData: false,
            contentType: false,
            data: form_data,
            beforeSend: function () {
                if (currentRequest !== null) {
                    currentRequest.abort();
                }
            },
            success: function (data) {
                if (data.status == "error") {
                    $('#help-block_err_addtionalcoupen').text(data.error).closest('.form-group').addClass('has-error');
                    
                } else {
                    if (data.cost_price_error == "error") {
                        $("#output_price").addClass('d-none');
                        $('#help-block_err_addtionalcoupen').text('given additional rate high.').closest('.form-group').addClass('has-error');
                    } else {
                        $("#output_price").removeClass('d-none');
                        $('#help-block_err_addtionalcoupen').closest('.form-group').removeClass('has-error')
                        $('#cost_price').html('$ ' + data.cost_price);
                        $('#hd_price').html('$ ' + data.hd_price);
                    }

                }
            }
        });
    

}
function changenotistatus(id,obj) {
    var location = $(obj).data('location');
    $.ajax({
            url: full_path + 'changenotistatus',
            type: 'get',
            dataType: 'json',
            data: {id:id},
            success: function (data) {
                if (data.value == "success") {
               window.location.href = location;
            }
            }
        });
}
function loadmorenoti() {
    var row = Number($('#row').val());
    var allcount = Number($('#all').val())
    var rowperpage = 15;
    row = row + rowperpage;
    if(row <= allcount){
        var csrf_token = $('input[name=_token]').val();
        $("#row").val(row);
         $.ajax({
                url: full_path + 'load-notification',
                type: 'get',
                dataType: 'json',
                data: {row:row},
                beforeSend:function(){
                    $("#loadmore").text("Loading...");
                },
                success: function(resp){
                    
                    $("#loadnoti").append(resp.html);
                    setTimeout(function() {
                        var rowno = row + rowperpage;
                        if(rowno >= allcount){
                            $('#loadmore').hide();
                        }else{
                            $("#loadmore").text("Load more");
                        }
                    }, 2000);

                }
            });
    }
}
function totalsellsChart(obj) {
    ajaxindicatorstart();
    $.ajax({
        url: full_path + 'admin-total-sell',
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
function deleteCustomer(obj) {
    var id = $(obj).data("id");
    var url = full_path + 'customer/' + id;
    $("#deletecustomerFORM").attr("action", url);
    $("#deletecustomerModal").modal('show');
}

function deleteVendor(obj) {
    var id = $(obj).data("id");
    var url = full_path + 'vendor/' + id;
    $("#deletevendorFORM").attr("action", url);
    $("#deletevendorModal").modal('show');
}

function deleteProduct(obj) {
    var url = $(obj).data("href");
    $("#deleteproductFORM").attr("action", url);
    $("#deleteproductModal").modal('show');
}
function deleteAdvert(obj) {
    var url = $(obj).data("href");
    $("#deleteadvertFORM").attr("action", url);
    $("#deleteadvertModal").modal('show');
}
function deleteAdminStaff(obj) {
    var id = $(obj).data("id");
    var url = full_path + 'admin-staff/' + id;
    $("#deletestaffFORM").attr("action", url);
    $("#deletestaffModal").modal('show');
}
function removehidden(id) {
    $("#image_" + id).remove();
    if ($('.product-image').html() === '' || $('#img_' + id).is(":checked"))
        $('#is_default').val('0');
    $('.side-images').find('#is_side_' + id).remove();
}
function getSubtype(obj) {
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
function getType(obj) {
    var id = $(obj).find('option:selected').data('id');
    $.ajax({
        url: full_path + 'get-type',
        type: 'GET',
        dataType: 'json',
        data: {id: id},
        success: function (resp) {
            $('#type').html(resp.types);
        }
    });
}