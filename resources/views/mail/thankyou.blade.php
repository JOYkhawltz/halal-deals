@extends('admin::mail.layouts.template')
@section('content')
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody><tr>
            <td valign="top" style="background:#ffffff;border-collapse:collapse" bgcolor="#FFFFFF">
                <table border="0" cellpadding="23" cellspacing="0" width="100%">
                    <tbody><tr>
                            <td valign="top" style="border-collapse:collapse">
                                <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;text-align:left" align="left">
                                    <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left" align="left">
                                    </div>
                                    <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left" align="left">
                                        <p><strong><span style="color:rgb(178, 34, 34)"><span style="font-size:18px"><span style="font-family:arial,helvetica,sans-serif">Hello</span>&nbsp;{{ $user->first_name }},</span></span></strong></p>
                                        <p>Congratulations!! You have successfully verify you account for The&nbsp;{{ env('APP_NAME', 'Laravel') }}.</p>
                                        <p><strong>Welcome to our website.Thank you for choosing us.</strong></p>
                                    </div>
                                    <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left" align="left">
                                    </div>
                                    <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;margin:5px 2px;text-align:left" align="left">
                                        <div style="color:#808080;font-family:Arial;font-size:14px;line-height:150%;text-align:left" align="left">
                                            <br>
                                            <font><font>
                                            Thank you for your attention and your trust 
                                            </font><a href="{{ URL('/') }}" style="color:#a30046;font-weight:normal;text-decoration:none" target="_blank"><strong><font>{{ env('APP_NAME', 'Laravel') }}.</font></strong></a></font><br>
                                            <br>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
@stop