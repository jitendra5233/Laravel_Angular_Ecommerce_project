<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class SendMailController extends Controller
{
    public function send_mail(Request $request)
    {
    
        $data["email"] = "jitendra.techies@gmail.com";
        $data["title"] = "Gforce";
        // $data['name']=$request->name;
        // $data['phone'] =$request->phone;
        // $data['email'] =$request->email;
        // $data['message'] =$request->message;
    
        //  $file= $request->file('resume');
        
        // $filename = date('YmdHi').rand().$file->getClientOriginalName();
        // $path=public_path('attachments');
        // $files= $file->move($path,$filename);
        
        //  $files = [
        //     public_path('attachments/blog-page.pdf'),
        //     public_path('attachments/blog-page.pdf'),
        // ];
        
          Mail::send('mail.Test_mail', $data, function($message)use($data, $files) {
            $message->to($data["email"])
                    ->subject($data["title"]);
 
            foreach ($files as $file){
                $message->attach($file);
            }            
        });
       
        // Mail::send('mail.Test_mail',$data, function($message)use($data, $files) {
        //     $message->to($data["email"])
        //             ->subject($data["title"]);
        //             $message->attach($files);    

        // });

        // echo "Mail send successfully !!";
    }
}