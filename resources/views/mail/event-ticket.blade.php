<html>
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body
    style="margin:0px; padding:0px; border: 0 none; background-color: red; font-size: 9px; font-family: verdana, sans-serif;">
<div style="background-color:#e9ecef">
    <table height="100%" style="border-collapse: collapse !important;" class="table-design">
        <tr>
            <td valign="top" align="left" background="#ffffff" class="table-td">
                <table style="width: 700px; margin: 50px auto 50px auto; box-shadow: -2px -2px 1px 1px #00b757f5;
  border-radius: 50px 0 50px 0; background: #fff; font-size: 11px; font-family: verdana, sans-serif;" align="center"
                       class="table2">
                    <tbody style=" box-shadow: 1px 1px 20px 2px #aa862285;
          border-radius: 50px 0 50px 0;">
                    <!-- start logo -->
                    <tr>
                        <td align="center" bgcolor="#ffffff" style="border-radius: 50px 0 0 0;" class="table2-td">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"
                                   class="table3">
                                <tr style="display: flex;
                justify-content: space-between;
                align-items: center;">
                                    <td align="center" valign="top" style="padding: 36px 24px;" class="table3-td">
                                        <a href="" style="display: inline-block;">
                                            <img src="{{ asset('assets/img/mail/logo.png') }}" alt="Logo" border="0"
                                                 width="48"
                                                 style="display: block; width: 100px; max-width: 100px; min-width: 48px;"
                                                 class="table3-td-img">
                                        </a>
                                    </td>
                                    <td align="center" valign="top" style="padding: 36px 24px;" class="table3-td">
                          <span style="text-decoration: none; display: inline-block; font-size: 25px; font-weight: 700;
                          " class="text-color">{{ $event->name }}</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- end logo -->

                    <!-- data table start -->
                    <tr>
                        <td align="center" bgcolor="#ffffff" class="table2-td">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"
                                   class="table3">
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            PAYMENT STATUS:<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $payment->status }}</span></p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            INVOICE ID:<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $payment->invoice_id }}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px; ">
                                            Name:<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $registration->name }}</span></p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            Phone :<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $registration->phone }}</span></p></td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; "
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            Cadet Number :<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $registration->cadet_number }}</span></p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; "
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            Email :<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $registration->email }}</span></p></td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; "
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            Address :<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $registration->address }}</span></p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; "
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;"></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- data table end -->

                    <!---person information-->
                    <tr>
                        <td align="center" bgcolor="#ffffff" class="table2-td">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"
                                   class="table3">
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            Participation Type</p>
                                    </td>

                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            QTY</p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            UNIT PRICE</p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            TOTAL</p>
                                    </td>
                                </tr>
                                @foreach($guests as $guest)
                                    <tr>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 16px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                            class="table4-td">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                                {{ $guest->type == 'other' ? 'guest' : $guest->type }} {{ $guest->type === 'kid' ? ($guest->age <=6 ? '(Below6)' : '(Above6)') : null }}</p>
                                        </td>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 16px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                            class="table4-td">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                                {{ $guest->quantity }}</p>
                                        </td>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 16px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                            class="table4-td">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                                {{ $guest->amount }}</p>
                                        </td>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 16px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                            class="table4-td">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                                {{ $guest->type == 'couple' ? $guest->amount :( $guest->amount * $guest->quantity)}}</p>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            Total </p>
                                    </td>

                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            {{ $payment->quantity }}</p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                        </p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                            {{ $payment->amount }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!---person information-->

                    <!--event Information-->
                    <tr>
                        <td align="center" bgcolor="#ffffff" class="table2-td">
                            <table border="0" cellpadding="0" bgcolor="#ffffff" cellspacing="0" width="100%"
                                   style="max-width: 600px; margin-top: 20px;" class="table3">
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px; text-align: center;">
                                            EVENT DETAILS</p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px; text-align: center;">
                                            TERMS & CONDITIONS</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;">
                                            OFA ANNUAL PICNIC, 2022</p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;">
                                            FAUJDARHAT CADET COLLEGE</p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;">
                                            12/30/2022</p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;">
                                            10:00 AM</p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;">
                                            OLD FAUJIANS ASSOCIATION CENTRAL GOVERNING BODY (CGB)</p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;">
                                            01943400600</p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;">
                                            info.octaglory@gmail.com</p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 3px solid #d4dadf; width: 50%;"
                                        class="table4-td">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;"></p>
                                    </td>
                                </tr>

                            </table>
                        </td>
                    </tr>
                    <!---event Information-->
                    <!-- start footer -->
                    <tr>
                        <td align="center" bgcolor="#ffffff" style="border-radius: 0 0 50px 0;" class="table2-td">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;"
                                   class="table3">
                                <tr style="display: flex;
                justify-content: space-between;
                align-items: center;">

                                    <td align="center" valign="top" style="padding: 36px 24px; width: 50%;"
                                        class="table3-td">
                                        <span style="text-decoration: none; display: inline-block; font-size: 20px;">REGISTRATION PARTNER</span>
                                    </td>
                                    <td align="center" valign="top" style="padding: 36px 24px; width: 50%;"
                                        class="table3-td">
                                        <a href="" style="display: inline-block;">
                                            <img src="{{ asset('assets/img/mail/octaglory.png') }}" alt="Logo"
                                                 border="0" width="48"
                                                 style="display: block; width: 250px; max-width: 250px; min-width: 48px;"
                                                 class="table3-td-img">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- end footer -->
                    </tbody>
                </table>

            </td>
        </tr>
    </table>
</div>
</body>
</html>
