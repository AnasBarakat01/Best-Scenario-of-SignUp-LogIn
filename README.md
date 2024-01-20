# Best-Scenario-of-SignUp-LogIn
# Description :    
  In this tutorial I'm talking about the best way user can enter your webiste and create an account.      
  How to validate the data user has entered in the sign up process ? How can you guarantee that email-address user has entered ,while creating a new account, is his own and this email is real (Email Verification) ? As you will see email Verification can done by several methods. I'm using the method of "Activation Link" sent to user mail.    
  I also use Activity Diagrams to provide you with a full imagination of the Sign up and Login scenario.
  What edits should be made to my database for the Email Verification process ?    
  Actually I'm a web developer not designer, so my design of web pages is not so good.I use PHP and Laravel framework.
  
# Table of Contents 
[Front-end](#Front-end)   
[Activity-Diagrams](#Activity-Diagrams)    
[Users-Table](#Users-Table)    
[Sign-Up-Contoller](#Sign-Up-Contoller)    
[Sending-The-Activation-Link](#Sending-The-Activation-Link)    
[User-Activate-His-Account](#User-Activate-His-Account)    
[Check-Activation](#Check-Activation)    
[Log-In](#Log-In)




## Front-end
![00](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/eed69399-c837-4f5f-a56e-a131d14b8053)
![01](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/3b75795a-0164-4613-8c84-07586ec988ea)

- Putting HTML elements beside each others through **CSS**.
- I used "bootstrap 5" library of  **CSS** to display list of errors provided to user when entered data is invalid.
- I used **JavaScript** to preview choosen image from user (before submit).
- Prevent frequent submissions of the form through disabling the submit button after one click through **JavaScript**.
- The “address” filed consists of 2 select elements. their values are connected to each other using **JavaScript**.
- for example, when user choose "Cairo" in the first field the following cities are displayed "Nase City","6th October", "Mariotia" and "Ramsis" in the second field.
- I made 2 fields for password to ensure that user entered it correctly.
  
![4](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/8bfdcaf8-9858-4fc5-b490-fbe92ef01de1)    

- Background using **CSS**.
- "Resend" button is available only one-time for press, so that user don't press the button many times for fun, making load to my server. I did this through "onclick" attribute of **JavaScript**.    

![image](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/22ea8bb7-81b5-4d27-bfaa-d9d67f117942)     
![03](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/89b336dd-5682-4505-b8fd-abeaf01368b8)

## Activity Diagrams
### a) Sign Up :       
![signnUpActivityDiagarm](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/2a17b9be-7cda-4918-ab8b-4fc35b899ec9)

### b) Log In :       
![LogInActivityDiagarm](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/bf7f9e80-b520-4d91-9a3e-0157366abefa)

## Users Table
I built my table in the database using **migration** of Laravel.    
Use the foolowing command to create the migration `php artisan make:migration create_users_table --create="users"`  then `php artisan migrate`   

![table](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/2fa84eb0-08c5-40c1-a6fc-39c09468ad19)

I wanna discuss 3 columns in this table.  
      1. "activated" : "0" -> meaning this account is not activated yet (default value). "1" -> this account is activated.  
      2. "activation_code" : here I put the activation code created for this user, so that when user press the activation link I compare the activation code stored in the database with the one came from user.  
      3. "activation_expiry" : the activation code is valid only for one day.   


## Sign Up Contoller
- I made a **controller** of Laravel to recieve requests from user and deal with it. to create the controller use the following  command : `php artisan make:controller SignUpController`   
- a sign up page is displayed with a button navigating to the login page if user already have account.
- I used the **validate** function of Laravel to validate the input data.
  - I handle the "birth date" field, so that user don't enter a date after or equal today. this is done using **DateTime** class of         Laravel.
  - what about "password" field ?
    - "password" must have uppercase characters, lowercase characters, numbers and specail characters. I used **Regex** of PHP for this process as following :         
 `'regex:/(?=.{6,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[#@\-!%\$\*\&])/'`
    - "password_confirmation field making the user reenter password.
    - hasing password for security using **Hash** facade of Laravel.    
- In case of validation has failed, I redirect the user to the sign up page with the data he has entered. by storing these data in the **session** of Laravel. in addition to this a list of error messages is diplayed to the user.
- User can upload his profile picture, I save it in my website to display it later for the user. as following :
  - picture name consists of the **time** where the picture has been uploaded ,and **extension** of it.   `$imageName = time().'.'.$req->profilePhoto->extension();`
  - store the picture in the public path '/images' of Laravel using **move()** function.                
 `$req->profilePhoto->move(public_path('images'), $imageName);`
- Generate the activation code using **random_bytes()** function to generate random numbers. then I used **bin2hex()** function to convert the code to "hexadecimal", so that I have characters in addition to numbers in my code.
- For more security the activation code is valid only for one day. I used **time()** function, which returns the current time by seconds. then adding to it one day by seconds which is "1*24*60*60". after that converting this date to "Y-m-d H:i:s"  format of **DateTime** class using the **date()** function of Laravel. `date( 'Y-m-d H:i:s',  time() + 1*24*60*60 )`
- Store user data and activation data in the database through the **Model** of Laravel. model name is "User".   
- Generate the activation link (which will be sent to user) consisting of website URL, user email and activation code. something like that `http://localhost:8000/signup/anas.barakat.1434@gmail.com/85d4eb341d83fa8eca73752eb976fb83` its route is `/signup/{email}/{actvitationCode}`.  as you can see I used **route parameters**, so that when user clicks the activation link I access values of email and activation code through these route parameters.


## Sending The Activation Link 

- I uesd **SMTP** protocol to send email to user.
- I also used **sendmail server** from Google to send emails. here are steps to connfig your google account for sending mails :     
              1  Go to your Google account
              2. Security.   
              3. 2-step verification     
              4. App passwords     
              5. Give name for your application then copy the given password, which consists of 16 digit    
              6. Configure your website. go to **".env"** file and edit the following variables :  `MAIL_DRIVER=sendmail` `MAIL_HOST=smtp.gmail.com`    `MAIL_PORT=587`    `MAIL_USERNAME=..your gamil account..`     `MAIL_PASSWORD=..given password..`   `MAIL_ENCRYPTION=tls`

 - Sending email in Laravel is done using the **Mail** class     
    `Mail::to('$req->email')->send(new ActivationMail($activationLink) )`
 - What is "ActivationMail" ?
    - Its the **Mailable Class** ,provided from Laravel, which represents the message sent to the user mail.
    - To create it use the following command  `php artisan make:mail ActivationMail`
    - I pass "$activationLink" variable to the object of Mailable class through its constructor    
      `new ActivationMail($activationLink)`
    - "ActivationMail" has 2 important dunctions :
       - **envelope()**, where I determine the subject of the message
       - **content()**, where I determine the view file (of '.blade.php' extension), that will be sent to the user. I can design it as I want using HTML, CSS, JavaScript, ...
         In my case the view file that will be sent is the "message.blade.php" file.

     
## User Activate His Account

- After user has signed up and I sent the activation link to his mail, I am telling him to press the activation link on his mail to activate his account.
- I had explained design of this page above. name of this file is "tellingUser.blade.php".
- In case of user didn't recieve message on his mail, he could click the "Resend" button. then I resend the message to his mail.    
  I put in this button user email and his activation code ,as route parameters, so that I recieve values of them when he clicks the button, to put them in the activation link that will be resend.   
  A function called "resendVerificationEmail()" will be executed when clicking this button. this function exists in the "SignUpController".   
  Its route is
  `Route::get('resendVerificationEmail/{email}/{ActvitationCode}'
        ,'App\Http\Controllers\ShowingController@resendVerificationEmail');`    
  I put constrain on this button as I explained in the "front-end" section, which is making it available only one-time for clicking (using JavaScript). So that I ensures user doesn't clcik it many times for fun and making load to my server.


## Check Activation
  As I explaiend before I recieve 'email' and 'activation code' of user through the route parameters in the activation link. then I compare them with the values in the database.
  - If I didn't found the email address in the database, I redirect user to the sign up page telling him "Create a new acoount as yours doesn\'t exist anymore".
  - If the activation code is expired, I delete his account from my database telling him "Your activation link is expired ! Sign up again".
  - If the activation code doesn't match mine in the database, I delete his account telling him "Your activation link is invalid ! Sign up again".
  - Otherwise, the activation link is valid, as the activation code matches mine in the database and it's not expired. so I redirect him to the "Login" page.

Why I do redirect user to the "Login" page after he finished Signing Up ?   
User enter email and password while they are fresh in his mind. then browser save them for further login.   

## Log In
- The function responsible for login  is located in the "SignUpContoller" as name of "postLogInPage()".
- User enter his email address and password. then I compare them with the values stored in the database.
- If user account is not activated, I redirect him to the "Login" page telling him
  "Your account in not activated ! Press the activation link sent to your mail" .
- I am using **Hash::check()** of Laravel to copmare the two hashed passwords, the first one stored in the database and the second one user enetering in the login form.
- If the log in is valid, I redirect the user to "home" page.

