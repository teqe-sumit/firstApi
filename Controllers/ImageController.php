<?php

namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


// public function store(Request $request)
// {
//     $student = new Student;
//     $student->name = $request->input('name');

//     if($request->hasfile('image'))
//     {
//         $file = $request->file('image');
//         $extenstion = $file->getClientOriginalExtension();
//         $filename = time().'.'.$extenstion;
//         $file->move('uploads/students/', $filename);
//         $student->image = $filename;
//     }

//     $student->save();
//     return redirect()->back()->with('message','Student Image Upload Successfully');
// }


class ImageController extends Controller
{
    public function upload(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:png,jpg,jpeg,gif'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fix errors bro',
                'errors' => $validator->errors()
            ]);
        }

        $img = $request->file('image'); // Use file() method instead of direct access
        $ext = $img->getClientOriginalExtension();
        $imageName = time().'.'.$ext;
        $img->move(public_path('uploads'), $imageName); // Remove extra slash from the path

        return response()->json([
            'status' => true,
            'message' => 'Uploaded successfully',
            'path' => asset('uploads/'.$imageName), // Remove extra slash from the path
            'data' => $imageName // Assuming you want to return the filename
        ]);
    }
}
