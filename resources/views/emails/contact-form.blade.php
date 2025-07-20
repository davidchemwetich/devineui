<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Contact Form Submission</title>
    <style>
        @media only screen and (max-width: 620px) {
            table.body h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }

            table.body p,
            table.body ul,
            table.body ol,
            table.body td,
            table.body span,
            table.body a {
                font-size: 16px !important;
            }

            table.body .wrapper,
            table.body .article {
                padding: 10px !important;
            }

            table.body .content {
                padding: 0 !important;
            }

            table.body .container {
                padding: 0 !important;
                width: 100% !important;
            }

            table.body .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            table.body .btn table {
                width: 100% !important;
            }

            table.body .btn a {
                width: 100% !important;
            }

            table.body .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }
    </style>
</head>
<body style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f6f6f6; width: 100%;" width="100%" bgcolor="#f6f6f6">
        <tr>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
            <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;" width="580" valign="top">
                <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;">
                    <table role="presentation" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border-radius: 3px; width: 100%;" width="100%">
                        <tr>
                            <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;" valign="top">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                                    <tr>
                                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">
                                            <h1 style="color: #000000; font-family: sans-serif; font-weight: 300; line-height: 1.4; margin: 0; margin-bottom: 30px; font-size: 35px; text-align: center; text-transform: capitalize;">New Contact Form Submission</h1>
                                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">You have received a new message from your church website's contact form. Here are the details:</p>
                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="details" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; margin-bottom: 20px;" width="100%">
                                                <tr>
                                                    <td width="30%" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding: 5px; font-weight: bold;" valign="top">Full Name:</td>
                                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding: 5px;" valign="top">{{ $formData['fullname'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding: 5px; font-weight: bold;" valign="top">Email:</td>
                                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding: 5px;" valign="top">{{ $formData['email'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding: 5px; font-weight: bold;" valign="top">Phone:</td>
                                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding: 5px;" valign="top">{{ $formData['phone'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding: 5px; font-weight: bold;" valign="top">Preferred Communication:</td>
                                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding: 5px;" valign="top">{{ $formData['communicationType'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="30%" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding: 5px; font-weight: bold;" valign="top">Subject:</td>
                                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding: 5px;" valign="top">{{ $formData['subject'] }}</td>
                                                </tr>
                                            </table>
                                            <h3 style="color: #000000; font-family: sans-serif; font-weight: 400; line-height: 1.4; margin: 0; margin-bottom: 10px; font-size: 18px;">Message:</h3>
                                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; padding: 10px; background-color: #f8f9fa; border-left: 4px solid #4338ca;">{{ $formData['message'] }}</p>
                                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px; margin-top: 30px; text-align: center; color: #666;">This is an automated email from your church website's contact form.</p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top">&nbsp;</td>
        </tr>
    </table>
</body>
</html>