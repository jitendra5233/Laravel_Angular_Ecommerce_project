<?php

namespace App\Http\Controllers\Enquiry;

use App\Http\Controllers\Controller;
use App\Models\Gforce\BookingModel;

use Illuminate\Http\Request;

class Booking extends Controller
{
    public function index()
    {
       
        // This function get all data from database and send it list blade file

        $tableData = BookingModel::orderBy('id', 'DESC')->get();

        return view('content.Enquiry.allBookingView')->with('tableData',$tableData);
        
    }

    public function getSingleBooking($id)
    {
      // This function is get data from database on behalf of Requested Id and Redirect it Details Blade file

        $tableData = BookingModel::where('id',$id)->get();
        return view('content.Enquiry.singleBookingView')->with('booking',$tableData);

    }
}
