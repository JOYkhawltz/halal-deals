@extends('staff::mail.layouts.template')
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
                                        <p><strong><span style="color:#B22222"><span style="font-size:18px"><span style="font-family:arial,helvetica,sans-serif">Hello</span>&nbsp;{{ $model->full_name }},</span></span></strong></p>
                                        <p><span style="font-size:14px">Your account has been created by staff. Please see the below credentials to login your account.</span></p>
                                        <p><span style="font-size:14px">Email:&nbsp;<span style="color:#000000"><strong>{{ $model->email }}</strong></span></span></p>
                                        <p><span style="font-size:14px">Password:&nbsp;<span style="color:#000000"><strong>{{ $password }}</strong></span></span></p>
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