<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewLetter;
use App\Models\SendNewLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SendNewLetterController extends Controller
{
    /**
     * Created  by : Ebrahim Reda 
     * Created  Date : 12-oct-2024
     * Edit by : Ebrahim Reda 
     * Edit  Date : 22-oct-2024
     * 
     * Send New letters to user but email subscribtion by email only once 
     * @param  \Illuminate\Http\Request  $request  The current HTTP request instance .
     * @return \Illuminate\Http\JsonResponse  The JSON response containing the status, message, and product details or error message.
     */
     
  
        public function sendEmail(Request $request)
        {
    
            $rules=[
                'email'=>'required|email',
               
            ];
    
            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return response()->json([
                   'status' => 'error',
                   'message' => $validator->errors(),
                   'data' => [],
               ], Response::HTTP_UNPROCESSABLE_ENTITY);
           }
           
           $email = NewLetter::where('email', $request->email)->first();
           
           if($email)
                return response()->json([
                   'status' => 'error',
                   'message' => __('pages.email_exists'),
                   'data' => [],
               ], Response::HTTP_UNPROCESSABLE_ENTITY);
                
                
            $newLetter=NewLetter::create([
                'email'=>$request->email,
                 
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Email send successfully',
                'data' => $newLetter,
            ], Response::HTTP_OK);
    
        }
    
    
     
}
