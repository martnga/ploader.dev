<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Uploads;
use Dingo\Api\Routing\Helpers;

class UploadsController extends Controller
{
    //
	use Helpers;

	public function index()
	{
	   $uploads = Uploads::get();
	    return  $uploads->toArray();
		
	}

	public function store(Request $request)
	{
	   
	    $uploads = new Uploads;

	   // $uploads->files_path = $request->get('files_path');


	    $destinationPath = 'assets/uploads'; // upload path
	    $extension = $request->file('file')->getClientOriginalExtension(); // getting image extension
	    $fileName = $request->file('file')->getClientOriginalName();
            $request->file('file')->move($destinationPath, $fileName); // uploading file to given path
	
            $uploads->files_path = $fileName;
	    
	    if($uploads->save())
		return $this->response->created();
	    else
		return $this->response->error('could_not_save_file', 500);
	}
}
