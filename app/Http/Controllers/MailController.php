<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ace\Customize;
use App\Models\Gforce\CarrerModel;
class MailController extends Controller
{

    public function sendMail(Request $req){
        
        
             $file = $req->file('resume');
             $resume =$file->getClientOriginalName();
             $file->move('attachments',$resume);

            $file1 = $req->file('coverlatter');
            $coverlatter =$file1->getClientOriginalName();
            $file1->move('attachments',$coverlatter);
        
        
        $data=new CarrerModel();
        $data->name=$req->name;
        $data->email=$req->email;
        $data->phone=$req->phone;
        $data->message =$req->message;
        $data->intrestedin=$req->intrestedin;
        $data->resume=$resume;
        $data->coverlatter=$coverlatter;
        $res=$data->save();
         if($res==1)
         {
            
            // Recipient 
        $result = Customize::orderBy('id', 'DESC')->take(1)->get();
         foreach($result as $row)
         {
           $carrermail=$row->creersEmail;  
         }
         
      $to=$carrermail;
     
    // Sender 
    $from = $req->email; 
    $fromName = $req->name; 
     
    $subject = "Query Coming From Career Page"; 
 
    $htmlContent = ' 
                        <html> 
                        <head> 
                            <title>Welcome to Ace Capital</title> 
                        </head> 
                        <body> 
                            <h1>Thanks you for joining with us!</h1> 
                            <div class="card">
                  <h5 class="card-header">Query Coming from Carrer Page</h5>
                  <div class="table-responsive text-nowrap">
                  <table class="table" id="example" class="table display">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th></th>
                          <th>Email</th>
                           <th></th>
                          <th>Phone</th>
                           <th></th>
                          <th>Message</th>
                           <th></th>
                          <th>Intrested In</th>
                           <th></th>
                            <th>Resume</th>
                           <th></th>
                            <th>Cover Letter</th>
                           <th></th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0" id="mydata">
                        <tr>
                          <td>'.$req->name.'</td>
                          <td></td>
                          <td>'.$req->email.'</td>
                          <td></td>
                          <td>'.$req->phone.'</td>
                          <td></td>
                          <td>'.$req->message.'</td>
                          <td></td>
                          <td>'.$req->intrestedin.'</td>
                          <td></td>
                          <td><a href=https://gforce.techiespreview.website/admin/attachments/'.$resume.'>Resume</a></td> 
                           <td></td>
                          <td><a href=https://gforce.techiespreview.website/admin/attachments/'.$coverlatter.'>Cover Letter</a></td> 
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            
        </body> 
        </html>'; 
 
        // Set content-type header for sending HTML email 
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
        // $cc_mail=env('CC_MAIL');
        // $bcc_mail=env('BCC_MAIL');
        // Additional headers 
        $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
        // $headers .= 'Cc: '.$cc_mail.' ' . "\r\n"; 
        // $headers .= 'Cc: '.$bcc_mail.' ' . "\r\n"; 
        // Send email 
        if(mail($to, $subject, $htmlContent, $headers)){ 
          return 1; 
        }else{ 
          return 0;
        }
                 } 
                 
         
}
    
      
}
