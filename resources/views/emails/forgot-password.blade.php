<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Aung Myin Clinic Manager</title>

    <style type="text/css">
        a,
        a[href],
        a:hover,
        a:link,
        a:visited {
            text-decoration: none !important;
            color: #0000EE;
        }

        .link {
            text-decoration: underline !important;
        }

        p,
        p:visited {
            font-size: 15px;
            line-height: 24px;
            font-family: 'Helvetica', Arial, sans-serif;
            font-weight: 300;
            text-decoration: none;
            color: #000000;
        }

        h1 {
            font-size: 22px;
            line-height: 24px;
            font-family: 'Helvetica', Arial, sans-serif;
            font-weight: normal;
            text-decoration: none;
            color: #000000;
        }

        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td {
            line-height: 100%;
        }

        .ExternalClass {
            width: 100%;
        }
    </style>

</head>

<body style="text-align: center; margin: 0; padding-top: 10px; padding-bottom: 10px; padding-left: 0; padding-right: 0; -webkit-text-size-adjust: 100%;background-color: #f2f4f6; color: #000000" align="center">
    <div style="text-align: center;">

        <!-- Start container for logo -->
        <table align="center" style="background-color: {{config('app.color')}}; text-align: center; vertical-align: top; width: 600px; max-width: 600px;">
            <tbody>
                <tr>
                    <td style="width: 596px; vertical-align: top; padding-left: 0; padding-right: 0; padding-top: 15px; padding-bottom: 15px;" width="596">
                        <img src="{{ asset('images/web-photos/aung-myin.png') }}" style="width: 180px; max-width: 180px; text-align: center; color: #ffffff;" alt="Logo" align="center">
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Start single column section -->
        <table align="center" style="text-align: center; vertical-align: top; width: 600px; max-width: 600px; background-color: #ffffff;" width="600">
            <tbody>
                <tr>
                    <td style="width: 596px; vertical-align: top; padding-left: 30px; padding-right: 30px; padding-top: 30px; padding-bottom: 40px;" width="596">

                        <h1 style="font-size: 20px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 600; text-decoration: none; color: #000000;">Reset Password</h1>

                        <p style="font-size: 15px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 400; text-decoration: none; color: #919293;">You can reset your password from this link: <a target="_blank" style="text-decoration: underline; color: #000000;" href="{{ route('password.reset', $token) }}"><small style="text-decoration: underline;">Reset Password</small></a></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End single column section -->

        <!-- Start footer -->
        <table align="center" style="text-align: center; vertical-align: top; width: 600px; max-width: 600px; background-color: #000000;" width="600">
            <tbody>
                <tr>
                    <td style="width: 596px; vertical-align: top; padding-left: 30px; padding-right: 30px; padding-top: 30px; padding-bottom: 30px;" width="596">

                        <img style="width: 180px; max-width: 180px; height: 85px; max-height: 85px; text-align: center; color: #ffffff;" alt="Logo" src="{{ asset('images/web-photos/aung-myin.png') }}" align="center" width="180">

                        <p style="font-size: 13px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 400; text-decoration: none; color: #ffffff;">
                            Aung Myin Clinic Manager
                        </p>

                        <p style="margin-bottom: 0; font-size: 10px; line-height: 24px; font-family: 'Helvetica', Arial, sans-serif; font-weight: 400; text-decoration: none; color: #ffffff;">
                            <a target="_blank" style="text-decoration: underline; color: #ffffff;" href="https://test.aungmyin.io/">
                                Visit Aung Myin
                            </a>
                        </p>

                    </td>
                </tr>
            </tbody>
        </table>
        <!-- End footer -->

    </div>
</body>

</html>