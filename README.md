# Best-Scenario-of-SignUp-LogIn
# Description : ...........
# Table of Contents 
[Front-end](#Front-end)   
[Activity-Diagrams](#Activity-Diagrams)  




## Front-end
![00](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/eed69399-c837-4f5f-a56e-a131d14b8053)
![01](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/3b75795a-0164-4613-8c84-07586ec988ea)

• Putting HTML elements beside each others through **CSS**.

• I used "bootstrap 5" library of  **CSS** to display list of errors provided to user when entered data is invalid.

• I used **JavaScript** to preview choosen image from user (before submit).

• Prevent frequent submissions of the form through disabling the submit button after one click through **JavaScript**.

• The “address” filed consists of 2 select elements. their values are connected to each other using **JavaScript**.
  for example, when user choose "Cairo" in the first field the following cities are displayed "Nase City","6th October",
  "Mariotia" and "Ramsis" in the second field.

• I made 2 fields for password to ensure that user entered it correctly.

![4](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/8bfdcaf8-9858-4fc5-b490-fbe92ef01de1)

• Background using **CSS**.

• "Resend" button is available only one-time for press, so that user don't press the button many times for fun, making load to my server. I did this through "onclick" attribute of **JavaScript**.


![04](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/e058d2ff-583b-4097-83f6-6b340de31dd9)
![03](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/89b336dd-5682-4505-b8fd-abeaf01368b8)

## Activity Diagrams
### Sign Up 
![signnUpActivityDiagarm](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/2a17b9be-7cda-4918-ab8b-4fc35b899ec9)

### Log In
![LogInActivityDiagarm](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/bf7f9e80-b520-4d91-9a3e-0157366abefa)

## Users Table
I built my table in the database using **migration** of Laravel.    
Use the foolowing command to create the migration `php artisan make:migration create_users_table --create="users"`  then `php artisan migrate`   

![table](https://github.com/AnasBarakat01/Best-Scenario-of-SignUp-LogIn/assets/155667484/2fa84eb0-08c5-40c1-a6fc-39c09468ad19)

I wanna discuss 3 columns in this table.  
a) "activated" : "0" -> meaning this account is not activated yet (default value). "1" -> this account is activated.  
b) "activation_code" : here I put the activation code we created for this user, so that when user press the activation link I compare the activation code stored in the database with the one came from user.  
c) "activation_expiry" : the activation code is valid only for one day.   


## Sign Up
## Email Verification
## Log In
