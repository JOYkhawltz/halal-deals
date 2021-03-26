<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Store</title>
<style>      
    .gs li{margin-left:0px!important;}
</style>



<div style=" width:700px; padding:0px; margin:0px; background:#EBEBEB; font-family:Arial, Helvetica, sans-serif; margin:0 auto;">
    <div style="font-family:Open Sans,helvetica,arial,sans-serif;font-size:13px;font-style:normal;font-variant-ligatures:normal;font-variant-caps:normal;font-weight:normal;letter-spacing:normal;line-height:normal;text-align:start;text-indent:0px;text-transform:none;white-space:normal;word-spacing:0px;background-color: rgb(249, 249, 249);padding:20px 0px 60px; text-align:center;">
        <div style="padding:15px 0px;">
            <img src="{{ URL::asset('public/frontend/images/mail_logo.png') }}" style="width:175px;">
        </div>
        <table align="center" style="border: 5px solid #096802;     border: 3px solid #096802;border-radius: 6px;" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td>
                        <table align="center" style="border-radius:4px;width:580px;background-color:rgb(255,255,255);font-family:Open Sans,helvetica,arial,sans-serif;font-weight:400;color:rgb(68,68,68)" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr name="heading">
                                    <td style="padding:20px 40px 20px 25px"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td style="width:600px;color:rgb(85,85,85);line-height:1.4em;font-size:12px;padding:0px;text-align:left">
                                                        <h1 style="font-size: 16px;font-weight: normal;margin-top: 3px;margin-bottom: 7px;">Hii <span style="font-size: 15px;font-weight: bold;margin-bottom: 10px;color:#333;">{{$user->first_name}} {{$user->last_name}}</span></h1>
                                                        <p style="margin-top:0px;font-size: 16px;margin-bottom: 10px;color:#333;">Thank you for purchase</p>
                                                        <!-- <ul style="padding-left: 0px;list-style: none;color: #333;margin-top: 3px;">
                                                            <li style="font-size: 14px;font-weight: bold;margin-bottom: 5px;">
                                                                1886 Granville Lane
                                                                West Orange, NJ 07052																	
                                                            </li>
                                                        </ul> -->
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width:600px;color:rgb(85,85,85);line-height:1.4em;font-size:12px;padding:0px;text-align:left">
                                                        <h1 style="font-size: 16px;font-weight: normal;margin-top: 3px;margin-bottom: 7px;">Here are the details of your order:</h1>

                                                        <ul style="padding-left: 0px;list-style: none;color: #333;margin-top: 3px;">
                                                            <li style="font-size: 14px;font-weight: bold;margin-bottom: 5px;">
                                                                Order number: {{$order->order_number}}
                                                            </li>
                                                            <li style="font-size: 14px;font-weight: bold;margin-bottom: 5px;">
                                                                Order date: {{date('d F,Y',strtotime($order->created_at))}}
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table></td>
                                </tr>
                                @if(count($deal_details)>0)
                                <tr name="body-content" style="background-color:rgb(246,246,246)">
                                    <td style="padding:20px 30px 10px 30px;vertical-align:top">
                                        <table cellpadding="0" cellspacing="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td style="width:600px;color:rgb(85,85,85);line-height:1.4em;font-size:12px;padding:0px;text-align:left">
                                                        <h1 style="font-size: 18px;font-weight: bold;margin-bottom:10px;color: #3a5168;">This is your deal</h1>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="height: auto;background-color: #fff;padding: 5px 15px;">
                                                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                            <tbody>
                                                                @foreach($deal_details as $key=>$deal)
                                                                <?php
                                                                $product_image = App\ProductImage::where('prod_ID', '=', $deal->prod_ID)->first();
                                                                ?>
                                                                <tr id="product_list">
                                                                    <td style="width: 100px;padding: 10px 0px 10px;color: rgb(102,102,102);vertical-align: top;border-bottom: 1px solid #d1cbcb;"><img src="{{ URL::asset('public/uploads/frontend/product/preview/'.$product_image->image_name) }}" style="width: 80px;"></td>
                                                                    <td style="width:300px;line-height:1.4em;font-size:12px;padding: 10px 0px 10px;font-weight:400;color:rgb(102,102,102); vertical-align: top;border-bottom: 1px solid #d1cbcb;">
                                                                        <h1 style="font-size: 14px;font-weight: bold;margin-bottom: 5px;margin-top: 0;color: #333;">{{$deal->title}}</h1>
                                                                        <ul style="padding-left: 0px;list-style: none;color: #333;margin-top: 3px;">
                                                                            <li style="font-size: 13px;font-weight: 400;margin-bottom: 2px;color: #333;">
                                                                                <span style="font-weight:bold;">Quantity:</span> {{$deal->quantity}}
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                    <td style="width:100px;line-height:1.4em;font-size:12px;padding: 10px 0px 10px;font-weight:400;color:rgb(102,102,102); vertical-align:middle;text-align: right;border-bottom: 1px solid #d1cbcb;">
                                                                        <?php
                                                                        $total = 0;
                                                                        $total = $deal->item_price * $deal->quantity;
                                                                        ?>
                                                                        <h1 style="font-size: 16px;font-weight: bold;margin-bottom: 2px;color: #000;margin-top: 0;">£{{$total}}</h1>
                                                                    </td>
                                                                </tr>
                                                                
                                                                @endforeach
																<tr>
                                                                    <td style="width:600px;color:rgb(85,85,85);line-height:1.4em;font-size:12px;padding:0px;text-align:left">
                                                                        <h1 style="font-size: 18px;font-weight: bold;margin-bottom:10px;color: #3a5168;">This is your Voucher Number:</h1>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $voucher_ids = App\VoucherDetail::where('order_id', '=', $order->id)->get();
                                                                ?>
                                                                @foreach($voucher_ids as $ids)
																
                                                                <tr id="product_list">
                                                                    <td style="width:300px;line-height:1.4em;font-size:12px;padding: 10px 0px 10px;font-weight:400;color:rgb(102,102,102); vertical-align: top;border-bottom: 1px solid #d1cbcb;">
                                                                        <ul style="padding-left: 0px;list-style: none;color: #333;margin-top: 3px;">
                                                                            <li style="font-size: 13px;font-weight: 400;margin-bottom: 2px;color: #333;">
                                                                                <span style="font-weight:bold;">Voucher Code:</span> {{ $ids['voucher_ID']}}
                                                                            </li>

                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                
                                                                <!-- <tr id="product_list">
                                                                    <td style="width: 100px;padding: 10px 0px 10px;color: rgb(102,102,102);vertical-align: top;border-bottom: 1px solid #d1cbcb;"><img src="images/Award-cup-getty-image.jpg" style="width: 80px;"></td>
                                                                    <td style="width:300px;line-height:1.4em;font-size:12px;padding: 10px 0px 10px;font-weight:400;color:rgb(102,102,102); vertical-align: top;border-bottom: 1px solid #d1cbcb;">
                                                                        <h1 style="font-size: 14px;font-weight: bold;margin-bottom: 5px;margin-top: 0;color: #333;">Wrist Watch</h1>
                                                                        <ul style="padding-left: 0px;list-style: none;color: #333;margin-top: 3px;">
                                                                            <li style="font-size: 13px;font-weight: 400;margin-bottom: 2px;color: #333;">
                                                                                <span style="font-weight:bold;">Quantity:</span> 5
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                    <td style="width:100px;line-height:1.4em;font-size:12px;padding: 10px 0px 10px;font-weight:400;color:rgb(102,102,102); vertical-align:middle;text-align: right;border-bottom: 1px solid #d1cbcb;">
                                                                        <h1 style="font-size: 16px;font-weight: bold;margin-bottom: 2px;color: #000;margin-top: 0;">$7.5</h1>
                                                                    </td>
                                                                </tr> -->



                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table></td>
                                </tr>
                                @endif

                                <tr name="heading">
                                    <td style="padding:20px 40px 20px 25px"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td style="width:600px;color:rgb(85,85,85);line-height:1.4em;font-size:12px;padding:0px;text-align:center;">
                                                        <p style="margin-top:0px;font-size: 16px;margin-bottom: 10px;color:#333;margin-bottom: 0px;">If you have any problem, please <a href="#" style="text-decoration:none;color: #096802;font-weight: bold;margin-bottom: 0px;">Contact us</a></p>
                                                        <h1 style="font-size: 16px;margin-bottom: 12px;margin-top: 18px;">Regards</h1>
                                                        <img src="{{ URL::asset('public/frontend/images/mail_logo.png') }}" style="width:175px;">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

<!--                                <tr name="footer">
                                    <td style="padding:0px;height:auto"><table cellpadding="0" cellspacing="0" width="100%" style="background:#3a5168;">
                                            <tbody>
                                                <tr>
                                                    <td align="right"  style="color: rgb(58, 81, 104);line-height: 1.4em;font-size: 14px;padding: 10px 0px 10px 0px;text-align: center;"><a href="#" target="_blank"> <img src="images/footer-logo.png" alt="fysioradar" border="0" style="width: 133px;"/> </a> </td>
                                                </tr>
                                                <tr>
                                                    <td align="left" style="color: rgb(243, 243, 243);line-height: 1.4em;font-size: 14px;padding: 5px 20px 5px;text-align: center;background-color: #3a5168;"> Need to manage your account? <a style="color:rgb(0,176,227);text-decoration:none" href="#" target="_blank"> Log in here </a> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>-->


                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>

        <p style="font-size: 15px;color: #333;padding-top: 10px;"> Copyright © Halal-Deals. All rights reserved.</p>
    </div>
</div>