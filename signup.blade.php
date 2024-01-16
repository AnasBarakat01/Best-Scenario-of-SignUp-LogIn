<!DOCTYPE html>
<html>
    <head>
        <title>Sign up page</title>
        <link rel="icon" href="assets/img/shoppingLogo.jpeg">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

        <style>
            .form{
                /* width: 90%;
                height: 60%; */
                font-size: 16px;
                /* padding-inline: 30%; */
                margin-top:  6%;
                margin-left: 6%;
                /* border-style: double; */
            }
            .first{
                float: left;
                margin-left:20%;
            }
            .second{
                float: left;
                width: 360px;
                margin-left:7%;
            }
            .third{
                font-size: 20px;
                margin-left:52%;
                margin-top:30%;
            }
        </style>
    </head>
    <body>


<h4 style="color: red"> {{ session('noAccount') }}</h4>
        <div  class="form">
        <fieldset>
                    <legend style="margin-left: 20%; font-size: 32px;">Sign Up  </legend>
                    <form action="signup" method="post" enctype="multipart/form-data"
                          onsubmit="xx.disabled=true; return true;">
                          {{-- Error Message --}}
                          <div id="errors" style="width: 85%; padding-left: 20%;">
                            @if ($errors->any())
                            <div class="alert alert-danger" >
                                <ul>
                                    @foreach ($errors->all() as $key=>$error)
                                        <li>{{  $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
        
                            @endif
                            </div> 
                        @csrf
                        <br>
                        <div class=first>
                        <label for="1"><strong>first name : </strong></label>
                        <input type="text" id=1 name="firstName" required  value={{ old('firstName')}}>
                        <br>
                        <br>
                        <label for="9"><strong>last name : </strong></label>
                        <input type="text" id=9 name="lastName" required  value={{ old('lastName')}}>
                        <br>
                        <br>
                        <label for="2"><strong>email : </strong></label>
                        <input type="text" id=2 name="email"
                                required autofocus placeholder="...@...com" value={{ old('email')}}>
                        <br>
                        <br>
                        <strong>gender : </strong>
                        <br>
                        @if (old('gender') == null)
                            <input type="radio" id="6" name="gender" value="male">
                            <label for="6">male</label><br>
                            <input type="radio" id=7  name="gender" value="female">
                            <label for="7">female</label><br>
                        @elseif (old('gender') == 'male')
                            <input type="radio" id="6" name="gender" value="male" checked>
                            <label for="6">male</label><br>
                            <input type="radio" id=7  name="gender" value="female">
                            <label for="7">female</label><br>
                        @else
                            <input type="radio" id="6" name="gender" value="male" >
                            <label for="6">male</label><br>
                            <input type="radio" id=7  name="gender" value="female" checked>
                            <label for="7">female</label><br>
                        @endif
                        <br>
                        <label for="6"><strong>birth date : </strong></label>
                        <input type="date" id=6 name="birthDate" required value={{ old('birthDate') }}>
                        <br>
                        <br>
                        <label for="8"><strong>profile photo : </strong></label>
                        <input type="file" id=8 name="profilePhoto" accept="image/*" onchange="loadFile(event)">
                        <div style="max-height: 50px; max-width: 40px; padding-top: 6%; ">
                            <img id="preview"  width="450%" height="650%"/>
                        </div>
                    </div>

                    <div class=second>
                        <label for="3"><strong>address : </strong></label>
                        <select name="region" id="x1" onchange="giveSelection(this.value)">
                            @if (old('region') == 'Cairo' || old('region') == null)
                                <option value="Cairo" selected>Cairo</option>
                                <option value="Gharbia">Gharbia</option>
                                <option value="Sharqia">Sharqia</option>
                            @elseif (old('region') == 'Gharbia')
                                <option value="Cairo">Cairo</option>
                                <option value="Gharbia" selected>Gharbia</option>
                                <option value="Sharqia">Sharqia</option>
                            @else
                                <option value="Cairo">Cairo</option>
                                <option value="Gharbia">Gharbia</option>
                                <option value="Sharqia" selected>Sharqia</option>
                            @endif
                        </select>
                        <select name="city" id="x2">
                            @if (old('city') == "Naser city" || old('city') == null)
                                <option data-option="Cairo" value="Naser city" selected>Naser city</option>
                                <option data-option="Cairo" value="6th October">6th October</option>
                                <option data-option="Cairo" value="Mariotia">Mariotia</option>
                                <option data-option="Cairo" value="Ramsis">Ramsis</option>
                                <option data-option="Gharbia" value="Tanta">Tanta</option>
                                <option data-option="Gharbia" value="Qotour">Qotour</option>
                                <option data-option="Gharbia" value="Mahlla">Mahlla</option>
                                <option data-option="Sharqia" value="Menia Elqameh">Menia Elqameh</option>
                                <option data-option="Sharqia" value="Enshas">Enshas</option>
                            @elseif (old('city') == "6th October")
                                <option data-option="Cairo" value="Naser city">Naser city</option>
                                <option data-option="Cairo" value="6th October" selected>6th October</option>
                                <option data-option="Cairo" value="Mariotia">Mariotia</option>
                                <option data-option="Cairo" value="Ramsis">Ramsis</option>
                                <option data-option="Gharbia" value="Tanta">Tanta</option>
                                <option data-option="Gharbia" value="Qotour">Qotour</option>
                                <option data-option="Gharbia" value="Mahlla">Mahlla</option>
                                <option data-option="Sharqia" value="Menia Elqameh">Menia Elqameh</option>
                                <option data-option="Sharqia" value="Enshas">Enshas</option>
                            @elseif (old('city') == "Mariotia")
                                <option data-option="Cairo" value="Naser city">Naser city</option>
                                <option data-option="Cairo" value="6th October" >6th October</option>
                                <option data-option="Cairo" value="Mariotia" selected>Mariotia</option>
                                <option data-option="Cairo" value="Ramsis">Ramsis</option>
                                <option data-option="Gharbia" value="Tanta">Tanta</option>
                                <option data-option="Gharbia" value="Qotour">Qotour</option>
                                <option data-option="Gharbia" value="Mahlla">Mahlla</option>
                                <option data-option="Sharqia" value="Menia Elqameh">Menia Elqameh</option>
                                <option data-option="Sharqia" value="Enshas">Enshas</option>
                            @elseif (old('city') == "Ramsis")
                                <option data-option="Cairo" value="Naser city">Naser city</option>
                                <option data-option="Cairo" value="6th October" >6th October</option>
                                <option data-option="Cairo" value="Mariotia">Mariotia</option>
                                <option data-option="Cairo" value="Ramsis" selected>Ramsis</option>
                                <option data-option="Gharbia" value="Tanta">Tanta</option>
                                <option data-option="Gharbia" value="Qotour">Qotour</option>
                                <option data-option="Gharbia" value="Mahlla">Mahlla</option>
                                <option data-option="Sharqia" value="Menia Elqameh">Menia Elqameh</option>
                                <option data-option="Sharqia" value="Enshas">Enshas</option>
                            @elseif (old('city') == "Tanta")
                                <option data-option="Cairo" value="Naser city">Naser city</option>
                                <option data-option="Cairo" value="6th October" >6th October</option>
                                <option data-option="Cairo" value="Mariotia">Mariotia</option>
                                <option data-option="Cairo" value="Ramsis">Ramsis</option>
                                <option data-option="Gharbia" value="Tanta" selected>Tanta</option>
                                <option data-option="Gharbia" value="Qotour">Qotour</option>
                                <option data-option="Gharbia" value="Mahlla">Mahlla</option>
                                <option data-option="Sharqia" value="Menia Elqameh">Menia Elqameh</option>
                                <option data-option="Sharqia" value="Enshas">Enshas</option>
                            @elseif (old('city') == "Qotour")
                                <option data-option="Cairo" value="Naser city">Naser city</option>
                                <option data-option="Cairo" value="6th October" >6th October</option>
                                <option data-option="Cairo" value="Mariotia">Mariotia</option>
                                <option data-option="Cairo" value="Ramsis">Ramsis</option>
                                <option data-option="Gharbia" value="Tanta">Tanta</option>
                                <option data-option="Gharbia" value="Qotour" selected>Qotour</option>
                                <option data-option="Gharbia" value="Mahlla">Mahlla</option>
                                <option data-option="Sharqia" value="Menia Elqameh">Menia Elqameh</option>
                                <option data-option="Sharqia" value="Enshas">Enshas</option>
                            @elseif (old('city') == "Mahlla")
                                <option data-option="Cairo" value="Naser city">Naser city</option>
                                <option data-option="Cairo" value="6th October" >6th October</option>
                                <option data-option="Cairo" value="Mariotia">Mariotia</option>
                                <option data-option="Cairo" value="Ramsis">Ramsis</option>
                                <option data-option="Gharbia" value="Tanta">Tanta</option>
                                <option data-option="Gharbia" value="Qotour">Qotour</option>
                                <option data-option="Gharbia" value="Mahlla" selected>Mahlla</option>
                                <option data-option="Sharqia" value="Menia Elqameh">Menia Elqameh</option>
                                <option data-option="Sharqia" value="Enshas">Enshas</option>
                            @elseif (old('city') == "Menia Elqameh")
                                <option data-option="Cairo" value="Naser city">Naser city</option>
                                <option data-option="Cairo" value="6th October" >6th October</option>
                                <option data-option="Cairo" value="Mariotia">Mariotia</option>
                                <option data-option="Cairo" value="Ramsis">Ramsis</option>
                                <option data-option="Gharbia" value="Tanta">Tanta</option>
                                <option data-option="Gharbia" value="Qotour">Qotour</option>
                                <option data-option="Gharbia" value="Mahlla">Mahlla</option>
                                <option data-option="Sharqia" value="Menia Elqameh" selected>Menia Elqameh</option>
                                <option data-option="Sharqia" value="Enshas">Enshas</option>
                            @elseif (old('city') == "Enshas")
                                <option data-option="Cairo" value="Naser city">Naser city</option>
                                <option data-option="Cairo" value="6th October" >6th October</option>
                                <option data-option="Cairo" value="Mariotia">Mariotia</option>
                                <option data-option="Cairo" value="Ramsis">Ramsis</option>
                                <option data-option="Gharbia" value="Tanta">Tanta</option>
                                <option data-option="Gharbia" value="Qotour">Qotour</option>
                                <option data-option="Gharbia" value="Mahlla">Mahlla</option>
                                <option data-option="Sharqia" value="Menia Elqameh">Menia Elqameh</option>
                                <option data-option="Sharqia" value="Enshas" selected>Enshas</option>
                            @endif
                        </select>
                        <br>
                        <br>
                        <label for="4"><strong>phone number : </strong></label>
                        <input type="text" id=4 name="phone" value="{{ old('phone') }}" required>
                        
                        <br>
                        <br>
                        <label for="5"><strong>password :</strong></label>
                        <input type="password" id=5 name="password"
                                placeholder="6 characters at least" required>
                        <p>your password should contain lowercase char, uppercase char, number, special char</p>
                        <br>
                        <label for="7"><strong>confirm password :</strong></label>
                        <input type="password" id=7 name="passwordConfirmation" required>
                        <br><br>
                        <input type="submit" id=11 name=xx value="Click Me">
                    </div>
                    <div class="third">
                        <p><b><i>Already have account ?<a href="/login">Log in</a></i></b></p>
                    </div>
                    </form>
                </fieldset>
 

                <script>
                    var x1 = document.querySelector('#x1');
                    var x2 = document.querySelector('#x2');
                    var options2 = x2.querySelectorAll('option');

                    function giveSelection(selValue) {
                        x2.innerHTML = '';
                    for(var i = 0; i < options2.length; i++) {
                        if(options2[i].dataset.option === selValue) {
                            x2.appendChild(options2[i]);
                        }
                    }
                    }

                    giveSelection(x1.value);

                /////////////////////////////////////////////////////////////////////

                    var loadFile = function(event) {
                    var preview = document.getElementById('preview');
                    preview.src = URL.createObjectURL(event.target.files[0]);
                    preview.onload = function() {
                    URL.revokeObjectURL(preview.src) // free memory
                        }
                    };
                </script>

                
                                
        </div>
    </body>
</html>
