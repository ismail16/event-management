<html>
<head>
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
</head>
<body style="margin:0px; padding:0px; border: 0 none; font-size: 9px; font-family: verdana, sans-serif; ">
<div style="background-color:#e9ecef; ">
    <p style=" font-size: 20px; font-family: semibold; margin: 10px 90px 10px 90px; text-align: justify; padding-top: 50px; line-height: 30px;">
      <span style=" display: block; margin-bottom: 10px;">Dear Ofn {{ $registration->name }} ,</span>  Payment BDT {{ $payment->amount }} Received.Thank you for confirming your participation in {{ $event->name }}. See you on 1st April at {{ $event->venue }} . -OFA
    </p>
    <table height="100%" width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td valign="top" align="left" background="#ffffff">
                <table style="width: 90%; margin: 50px auto 50px auto; width: 1122.24px; height: 793.92px;
                 background: #fff; font-size: 11px; font-family: verdana, sans-serif;" align="center">
                    <tbody>
                    <!-- start logo -->
                    <tr>
                        <td align="center" bgcolor="#ffffff" style="border-radius: 50px 0 0 0;">
                            <table cellpadding="0" cellspacing="0" width="100%"
                                   style="max-width: 95%; border-bottom: 3px solid #000000 !important; margin-bottom: 10px; ">
                                <tr style="display: flex;
                                    justify-content: space-between;
                                    align-items: center;">
                                    <td align="center" valign="top">
                                        <a href="" style="display: inline-block;">
                                            <img src="{{ asset('assets/img/mail/email_logo.png') }}" alt="Logo"
                                                 border="0" width="48"
                                                 style="display: block; width: 145px; max-width: 300px; min-width: 48px; margin-bottom: 10px;">
                                        </a>
                                    </td>
                                    <td align="center" valign="top" style="padding: 36px 24px;">
                                    <span style="text-decoration: none; display: inline-block; font-size: 25px; font-weight: 700;
                                    color: black;">{{ $event->name }}</span>
                                        <span style=" display: block; ">April 1, 2023</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- end logo -->

                    <!-- data table start -->
                    <tr>
                        <td align="center" bgcolor="#ffffff">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                   style="max-width: 90%; margin-top: 50px;">
                                <tr style="width: 30%;">
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; ">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 30px; border-top: 1px solid #d4dadf; border-left: 1px solid #d4dadf; border-right: 1px solid #d4dadf; text-align: center; max-width: 90%; padding-left: 10px;">
                                            PERSONAL INFORMATION</p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; ">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 30px; border-top: 1px solid #d4dadf; border-left: 1px solid #d4dadf; border-right: 1px solid #d4dadf; text-align: center;max-width: 90%;margin-left: 10%; padding-left: 10px;">
                                            PAYMENT INFORMATION</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; ">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 30px; border-top: 1px solid #d4dadf; border-left: 1px solid #d4dadf; border-right: 1px solid #d4dadf; max-width: 90%; padding-left: 10px;">
                                            NAME:<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $registration->name }}</span></p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; ">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 30px; border-top: 1px solid #d4dadf; border-left: 1px solid #d4dadf; border-right: 1px solid #d4dadf; max-width: 90%;margin-left: 10%; padding-left: 10px;">
                                            INVOICE ID:<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $payment->invoice_id }}</span></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; ">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 30px;  border-left: 1px solid #d4dadf; border-right: 1px solid #d4dadf;max-width: 90%; padding-left: 10px;">
                                            PHONE :<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $registration->phone }}</span></p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; ">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 30px; border-left: 1px solid #d4dadf; border-right: 1px solid #d4dadf; max-width: 90%;margin-left: 10%; padding-left: 10px;">
                                            PAYMENT STATUS:<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $payment->status }}</span></p></td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; ">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 30px; border-left: 1px solid #d4dadf; border-right: 1px solid #d4dadf; max-width: 90%; padding-left: 10px;">
                                            EMAIL :<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $registration->email }}</span></p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; ">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 30px; border-left: 1px solid #d4dadf; border-right: 1px solid #d4dadf; max-width: 90%;margin-left: 10%; padding-left: 10px;">
                                            PAYMENT DATE :<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">{{ $registration->payment->paid_at ? $registration->payment->paid_at->toDateString() : null }}</span>
                                        </p></td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; ">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 30px; border-left: 1px solid #d4dadf; border-right: 1px solid #d4dadf; border-bottom: 1px solid #d4dadf; max-width: 90%; padding-left: 10px; ">
                                            ADDRESS :<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;"></span></p></td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; ">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 30px; border-left: 1px solid #d4dadf; border-right: 1px solid #d4dadf; border-bottom: 1px solid #d4dadf; max-width: 90%;margin-left: 10%; padding-left: 10px;">
                                            PAYMENT METHOD:<span style="color: hsl(240deg 8% 46%);
                                            margin-left: 8px;">SSLCommerz</span></p></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- data table end -->

                    <!---person information-->
                    <tr>
                        <td align="center" bgcolor="#ffffff">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                   style="max-width: 87%; margin-top: 35px;">
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                            Participation Type</p>
                                    </td>

                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                            QTY</p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                            UNIT PRICE</p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                            TOTAL</p>
                                    </td>
                                </tr>
                                @foreach($guests as $guest)
                                    @if($guest->type === \App\Models\Registration::TYPE_GUEST_KID_ABOVE || $guest->type === \App\Models\Registration::TYPE_GUEST_KID_BELOW || !$guest->quantity )
                                        @continue
                                    @endif
                                    @php
                                        $type = $guest->type === \App\Models\Registration::TYPE_GUEST_STUDENT || $guest->type === \App\Models\Registration::TYPE_GUEST_GENERAL ? 'Member' : ucfirst($guest->type);
                                    @endphp
                                    <tr>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                {{ $guest->type == 'other' ? 'Guest' : $type }} {{ $guest->type === 'kid' ? ($guest->age <=6 ? '(Below6)' : '(Above6)') : null }}</p>
                                        </td>

                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                {{ $guest->quantity }}</p>
                                        </td>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                {{ $guest->amount }}</p>
                                        </td>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                {{ $guest->type == 'couple' ? $guest->amount :( $guest->amount * $guest->quantity)}}</p>
                                        </td>
                                    </tr>
                                @endforeach

                                @if($countKidsBelowSix)
                                    <tr>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                kid (Below6)</p>
                                        </td>

                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                {{ $kidsBelowSix['quantity'] }}</p>
                                        </td>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                {{ $kidsBelowSix['amount']}}</p>
                                        </td>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                {{ $kidsBelowSix['amount'] * $countKidsBelowSix }}</p>
                                        </td>
                                    </tr>
                                @endif

                                @if($countKidsAboveSix)
                                    <tr>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                kid (Above6)</p>
                                        </td>

                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                {{ $kidsAboveSix['quantity'] }}</p>
                                        </td>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                {{ $kidsAboveSix['amount'] }}</p>
                                        </td>
                                        <td align="left" bgcolor="#ffffff"
                                            style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                            <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                                {{ $kidsAboveSix['amount'] * $countKidsAboveSix  }}</p>
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                            TOTAL</p>
                                    </td>

                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                            {{ $payment->quantity }}</p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;"></p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border: 1px solid #d4dadf;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 35px;">
                                            {{ $payment->amount }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!---person information-->

                    <!--event Information-->
                    <tr>
                        <td align="center" bgcolor="#ffffff">
                            <table border="0" cellpadding="0" bgcolor="#ffffff" cellspacing="0" width="100%"
                                   style="max-width: 87%; margin-top: 20px; margin-top: 50px;">
                                <!-- <tr>

                                    <td align="left" bgcolor="#ffffff" style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;  width: 50%;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px; text-align: center;">TERMS & CONDITIONS</p>
                                      </td>
                                      <td align="left" bgcolor="#ffffff" style="padding: 0 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;  width: 50%;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; line-height: 48px; text-align: center;">EVENT DETAILS</p>
                                      </td>
                                  </tr> -->
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding:  0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;  width: 50%;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;">
                                            Faujian Iftar Together ,2023</p></td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding:  0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;  width: 50%;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;">
                                            April 1, 2023</p></td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding:  0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;  width: 50%;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;">
                                            5 PM Onwards</p></td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding:  0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;  width: 50%;">
                                        <p style="margin: 0; font-size: 16px; font-weight: 700; letter-spacing: -1px; padding: 10px 5px;">
                                            Hall Lamda, Gulshan Club</p></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!---event Information-->
                    <!-- start footer -->
                    <tr>
                        <td align="center" bgcolor="#ffffff" style="border-radius: 0 0 50px 0;">
                            <table cellpadding="0" cellspacing="0" width="100%"
                                   style="max-width: 90%; border-top: 3px solid #000000 !important ; ">
                                <tr style="display: flex;
                justify-content: space-between;
                align-items: center;">

                                    <td valign="top" style="padding: 15px 24px; width: 50%;">
                                        <span style="text-decoration: none; display: inline-block; font-size: 20px;">REGISTRATION PARTNER</span>
                                    </td>
                                    <td align="right" valign="top" style="padding: 15px 24px; width: 50%;">
                                        <a href="" style="display: inline-block;">
                                            <img src="{{ asset('assets/img/mail/octaglory-logo.png') }}" alt="Logo"
                                                 border="0" width="48"
                                                 style="display: block; width: 250px; max-width: 250px; min-width: 48px;">
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
