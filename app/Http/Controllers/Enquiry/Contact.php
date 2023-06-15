<?php

namespace App\Http\Controllers\Enquiry;

use App\Http\Controllers\Controller;
use App\Models\Gforce\ContactModel;
use Illuminate\Http\Request;

class Contact extends Controller
{
   
    public function index()
    {
        $tableData = ContactModel::orderBy('id', 'DESC')->get();
        return view('content.Enquiry.allContactusView')->with('tableData',$tableData);
        
    }
    public function getSingleContact($id)
    {
        $tableData = ContactModel::where('id',$id)->get();
        return view('content.Enquiry.singleContactView')->with('contact',$tableData);

    }
    
    public function DeleteContact(Request $req)
    {
        
        $result=ContactModel::where('id',$req->id)->delete();
        return $result;
    }

    
    public function exportContactCSV()

    {

        $fileName = 'Contact.csv';

        $tableData = ContactModel::all();



        $headers = array(

            "Content-type"        => "text/csv",

            "Content-Disposition" => "attachment; filename=$fileName",

            "Pragma"              => "no-cache",

            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",

            "Expires"             => "0"

        );

        $columns = array('Id','Name', 'Email','Phone','Message','Created  Date','Created  Time');

        

        $callback = function() use($tableData, $columns) {

            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);



        foreach($tableData as $task){



            $row['id'] = $task->id;

            $row['name']=$task->name;
            $row['phone']=$task->phone;
            $row['email']=$task->email;
            $row['message']=$task->message;
        
            $dt=$task->created_at;

            $d = $dt->format('m/d/Y');

            $t = $dt->format('H:i A');

            $row['Created  Date']  =  $d;

            $row['Created  Time']  =  $t;

            fputcsv($file, array($row['id'], $row['name'], $row['email'], $row['phone'],$row['message'],$row['Created  Date'],$row['Created  Time']));

        }

        

        fclose($file);

    };

    return response()->stream($callback, 200, $headers);



    }


}
