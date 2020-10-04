<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="./css/recover-password.css">
</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
	<div style="width: 100%; background-color: #f1f1f1;">
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
      &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
      <table role="presentation" cellspacing="0" cellpadding="0" width="100%" style="margin: auto;">
      	<tr>
          <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
          	<table role="presentation" cellpadding="0" cellspacing="0" width="100%">
          		<tr>
          			<td class="logo" style="text-align: center;">
			            <h1><a href="#">e-Verify</a></h1>
			          </td>
          		</tr>
          	</table>
          </td>
	      </tr>
	      <tr>
          <td valign="middle" class="hero bg_white" style="padding: 3em 0 2em 0;">
            <img src="./image/email.png" alt="" style="width: 300px; max-width: 600px; height: auto; margin: auto; display: block;">
          </td>
	      </tr>
		    <tr>
          <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
            <table>
            	<tr>
            		<td>
            			<div class="text" style="padding: 0 2.5em; text-align: center;">
            				<h2>Please verify your email</h2>
                            <h3>Seu codigo de verificação é: {{$code}}</h3>
            				<p><a href="127.0.0.1/" class="btn btn-primary">Click aqui para confirmar</a></p>
            			</div>
            		</td>
            	</tr>
            </table>
          </td>
	      </tr>
      </table>
    </div>
</div>
</body>
</html>
