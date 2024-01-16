<!DOCTYPE html>
<html>
    <head>
        <title>Log in page</title>
        <meta charset="UTF-8">

        <style>
            .form{
                padding-inline: 30%;
                padding-top:  15%;
            }
            .third{
                font-size: 20px;
                margin-left:9%;
            }
        </style>
    </head>
    <body>
        <div  class="form">
         <fieldset style="width:270px">
            <b style="font-size: 18px; color:red;">{{ session('message1') }}</b>
            <br>
            <b style="font-size: 18px; color:red">{{ session('message2') }}</b>
                    <legend>Log in  </legend>
                    <form action="/login" method="POST">
                        @csrf
                        <br>
                        <label for="1"><strong>email : </strong></label>
                        <input type="text" id=1 name="email" value="{{ old('email') }}"
                                required autofocus placeholder="...@...com">
                        <br>
                        <br>
                        <label for="2"><strong>password :</strong></label>
                        <input type="password" id=2 name="password" required>        
                        <br>
                        <br>
                        <input style="margin-left: 110px" type="submit" value=login>
                    </form>
                </fieldset>
                <div class="third">
                    <p><b><i>Don't have account ? <a href="/signup">sign up</a></i></b></p>
                </div>
        </div>
    </body>
</html>