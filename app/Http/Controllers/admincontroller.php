<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Tbladmin;
use Illuminate\Http\Request;
class admincontroller extends Controller
{
  public function form()
  {
    return view('form');
  }
  public function register(Request $request)
  {
    $data = Tbladmin::Create(
      [
      'name' => $request->name,
      'contact' => $request->contact,
      'email' => $request->email,
      'password' => $request->password,  
    ]);
    return redirect()->route('viewdata');
  }
  public function view()
  {
    return view('view');
  }
  public function viewdata(Request $request)
  {
    $data = Tbladmin::all();
    return $data;
  }
  public function deleteData(Request $request)
  {
    $deleterecords = Tbladmin::find($request->id);     
    $deleterecords -> delete();
    return  1;
  } 
  public function edit(Request $request)
  {
       $edit=Tbladmin::find($request->id);
       return $edit;
  }
  public function editData(Request $request)
  {
    $data= array(
      'name' => $request->name,
      'contact' => $request->contact,
      'email' => $request->email,
      'password' => $request->password,
);
      Tbladmin::where('id', $request->id)->update($data);

      return 1;
  }
  public function search(Request $request) {
    $name = $request->text;
    $data = Tbladmin::where('name', 'LIKE', "%$name%")->get();
    return $data;
}
}