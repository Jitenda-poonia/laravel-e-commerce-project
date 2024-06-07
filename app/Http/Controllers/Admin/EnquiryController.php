<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
  public function index()
  {
    $enquires = Enquiry::all();
    return view('admin.enquiry', compact('enquires'));
  }
  public function store(Request $request)
  {
    $data = $request->validate([
      'name' => 'required|max:25',
      'email' => 'required|email',
      'phone' => 'required|max:15|min:10',
      'message' => 'required',
    ]);
    // dd($data);
    Enquiry::create($data);
    return redirect("contact")->with("success", "Data submit Successfully");

  }
  public function status(Request $request)
  {
    $enqId = $request->enqueryId;
    Enquiry::where("id", $enqId)->update(["status" => 2]);
    echo '<button class="btn btn-success">Read</button>';


  }

  public function destroy($id)
  {
    $enqry = Enquiry::findOrFail($id);
    $enqry->delete();
    return back()->with('success', 'Data delete Successfully');
  }

}
