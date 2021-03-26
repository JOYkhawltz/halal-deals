<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{{env('PROJECT_NAME', 'Demo')}}</title>
    </head>
    <body>
        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" style="background:#f3f3f3;height:100%!important;margin:0;padding:0;width:100%!important" bgcolor="#F3F3F3">
            <tbody><tr>
                    <td align="center" valign="top" style="border-collapse:collapse;">
                        <table border="0" cellpadding="0" cellspacing="0" width="80%" style="background:#ffffff;border: 10px solid #eee;margin-top:10px" bgcolor="#FFFFFF">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top" style="border-collapse:collapse;">
                                        <table border="0" cellpadding="23" cellspacing="0" width="100%" style="background:#ffffff;border-bottom-width:0" bgcolor="#FFFFFF">
                                            <tbody>
                                                <tr>
                                                    <td style="border-collapse:collapse;text-align:left;vertical-align:top ;background-color:#171f2b; padding-left: 100px;" align="left" valign="top">
                                                        <a href="{{ URL('/') }}" style="color:#a30046;font-weight:normal;text-decoration:none" target="_blank">
                                                            <img alt="{{env('PROJECT_NAME', 'Demo')}}" src="{{ URL::asset('public/frontend/images/mail_logo.png') }}" style="border:0;min-height:auto;line-height:100%;max-width:162px;outline:none;text-decoration:none" class="CToWUd">
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" style="border-collapse:collapse;background-color:#f6f7f8;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="80%">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" style="background:#ffffff;border-collapse:collapse" bgcolor="#FFFFFF">
                                                       [[email_message]]
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" valign="top" style="border-collapse:collapse;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="80%" style="background:#ffffff;border-top-width:0" bgcolor="#FFFFFF">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" style="border-collapse:collapse">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="23px" style="border-collapse:collapse"></td>
                                                                    <td valign="middle" style="background:#ffffff;border-collapse:collapse;border:0" bgcolor="#FFFFFF"></td>
                                                                    <td width="23px" style="border-collapse:collapse"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="0" cellpadding="10" cellspacing="0" width="100%" style="border-collapse:collapse;background-color:#f6f7f8;">
                                            <tbody>
                                                <tr>
                                                    <td valign="top" style="border-collapse:collapse">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="middle" style="border-collapse:collapse;color:#999;display:block;font-family:Arial;font-size:10px;font-weight:normal;line-height:130%">
                                                                        <div>
                                                                            <font>
                                                                                <font>
                                                                                    Please do not reply to this e-mail because e-mail is sent automatically by the system.
                                                                                </font>

                                                                            </font>
                                                                            <br>
                                                                                <font>
                                                                                    <font>
                                                                                        You obtain the service E-mail this because of your membership in {{ env('APP_NAME', 'Laravel') }}.
                                                                                    </font>

                                                                                </font>
                                                                                <span style="color:inherit;text-decoration:none">
                                                                                    <font>
                                                                                        <font>
                                                                                            <address><p class="copyright">{{ date('Y') }} &copy; {{ env('APP_NAME', 'Laravel') }}. All rights reserved.</p></address>
                                                                                        </font>
                                                                                    </font>
                                                                                </span>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>