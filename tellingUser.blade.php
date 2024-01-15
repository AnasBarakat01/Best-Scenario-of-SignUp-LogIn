<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
    <style>
        .img {
            border-radius: 50%;
        }
        .body  {
            background-image: url("data:image/jpeg;base64,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");
            background-color: #dde3dd82;
            background-repeat: no-repeat;
            opacity: 0.7;
            background-size: 700px 500px;
            
            }
        .anas{
            padding: 8px;
            opacity: 2;
        }

        .button {
  background-color: #0636f8; /* Green */
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 19px;
  margin: 8px 8px;
  cursor: pointer;
}

.button5 {border-radius: 50%;}
    </style>
</head>
<body class=body>
    <h3>
    <div class="anas">
        <p>We have sent an activation link to your email address <i style="color: blue">{{$email}}</i></p>
    </div>
    <p style="padding-left: 5px;"> Click it to verify your account</p>
    <p style="padding-left: 5px;">didn't recieve an email ??
        @php
            $activationLink = '/'.'resendVerificationEmail/'.$email.'/'.$activationCode;
        @endphp
    </p>

    <form action={{ $activationLink }} method="GET" >
        <input type="button" id="myButton" class="button button5"
            value="Resend" onclick="doSomething()">
    </form>
    <script>
        function doSomething () {
          // Disable the button
          document.getElementById("myButton").disabled = true;
  
        }
    </script>
</h3>
</body>
</html>