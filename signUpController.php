<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
// use Illuminate\Support\Stringable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Mail;
use App\Mail\ActivitationMail;
use Illuminate\Support\Facades\View;
use App\Models\Veify;



class SignUPController extends Controller
{

 public function postSignUpPage(Request $req) 
    {
        //                              PART 1 
        // validation
        $today= new Datetime();
        $today= $today->format('d-m-Y');
        $req->validate([
            'firstName'=> 'required|between:3,15|alpha',
            'lastName'=>'required|between:3,15|alpha',
            'email'=>'required|unique:users,email|regex:/[a-z0-9A-Z](\@)/',
            'gender'=>'required',
            'birthDate'=>"required|date|before:$today",
            'profilePhoto'=>'nullable|mimes:png,jpg,jpeg|max:1024',
            'phone'=>'required|regex:/\d{10}$/',
            'password'=>'required|regex:/(?=.{6,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[#@\-!%\$\*\&])/',
            'passwordConfirmation'=>'required|same:password'
            ]);

        //                              PART 2
        // Save image uploaded from user 
        $imageName = null;
        if($req->profilePhoto){
            $imageName = time().'.'.$req->profilePhoto->extension();
            $req->profilePhoto->move(public_path('images'), $imageName);
        }
        

        //                              PART 3
        // generate activation code
        $activationCode = bin2hex(random_bytes(16));
        //calaculate the expiration date
        $expiry = date('Y-m-d H:i:s',  time() + 1*24*60*60 /*one day */);
        
        // store data in the database
        $obj= User::create(['firstName'=>$req->firstName , 'lastName'=>$req->lastName,
            'gendr'=>$req->gender,'birthDate'=> $req->birthDate,'email'=> $req->email ,
            'profilePhoto'=>$imageName,'region'=>$req->region,'city'=> $req->city,
            'phone'=>$req->phone,'password'=> Hash::make($req->password),
            'activation_code'=>$activationCode,'activation_expiry'=>$expiry ]);

        //                              PART 4
        // create the ectiviation link
        $ActivationLink = $req->url()."/".$req->email."/".$activationCode;
        Mail::to($req->email)->send(new ActivitationMail($ActivationLink));
        // Tell user we have sent a message to his email address. open it
        // verify your account 
        return view('verifyEmail',
                ['email'=> $req->email, 'activationCode'=>$activationCode]);
    }







public function resendVerificationEmail($email, $activationCode)
    {
        $ActivationLink = 'http://'.$_SERVER['HTTP_HOST'].'/'.'signup/'.$email.'/'.$activationCode;
        Mail::to($email)->send(new ActivitationMail($ActivationLink));
        return view('verifyEmail',
                ['email'=> $email, 'activationCode'=>$activationCode]);
    }                          


    public function checkActivation($email, $userActvitationCode)
    {
        // if this account doesn't exist
        if( ! User::where('email',$email)->first() )
        {
            echo "<h1>11</h1>";
            return redirect('/signup')->with('noAccount',
                                 'Create a new acoount as yours doesn\'t exist anymore');   
        }
        // get the activationCode of the desired user from the database 
        // as you can see through his email address
        $correctactivationCode = ($obj= User::where('email',$email)->first())->activation_code;

        // expiration date of the activation code
        $activationCodeExpiration = ($obj= User::where('email',$email)->first())->activation_expiry;

        // convert it to DateTime object
        $activationCodeExpiration = DateTime::createFromFormat('Y-m-d',$activationCodeExpiration);
        
        // subtract one day from the activationCodeExpiration
        $sub= DateInterval::createFromDateString('1 day');
        $sub2= date_sub( $activationCodeExpiration, $sub);

        // NOTE : all dates that will be compared to each other shold be
        // at the same format. I will use "Y-m-d"
        $activationCodeExpiration = $activationCodeExpiration->format('Y-m-d');
        $sub2 = $sub2->format('Y-m-d');

        // generate current date & convert it to the same format
        $currentDate = new DateTime();
        $currentDate = $currentDate->format('Y-m-d');

        // check the Activation values
        if ($correctactivationCode == $userActvitationCode &&
             ($currentDate == $activationCodeExpiration || $currentDate == $sub2))   
        {
            $obj = User::where('email',$email)->first();
            $obj->activated = true;
            $obj->save();
            // mark user as logged in
            return redirect('/login')->with(['message1'=> "Thanks for verification"]);
        }
        elseif ($currentDate != $activationCodeExpiration && $currentDate != $sub2)
        {
            // Expired !!
            // So delete this account
            User::where('email',$email)->first()->delete();
            return "<h3>Your activation link is expired<br> Sign up again.";
        }     
        else 
        {
            // Delete this account ...
            User::where('email',$email)->first()->delete();
            return "<h3>Your activation link is in valid<br> Sign up again.";
        }
    }
    
}


public function postLogInPage(Request $req)
    {
        foreach( User::all() as  $account)
        {
            if($req->email == $account->email)
                if($account->activated)
                    if(Hash::check( $req->password,$account->password))
                    {
                        session(['loggedIn'=> true]);
                        return redirect('/');
                    }
                    else 
                        return redirect('/login')->withInput()
                               ->with(['message1'=> "Incorrect password"]);
                else
                    return redirect('/login')->withInput()
                           ->with(['message1'=> "Your account in not activated !",
                                   'message2'=> "Press the activation link sent to your mail"]);
        }
        return redirect('/login')->with(['message1' => "No account found !",
                                         'message2'=>"Create a new one if you don't have"]);
    }
?>
