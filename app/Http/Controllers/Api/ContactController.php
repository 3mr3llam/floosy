<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function contact(ContactRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        $contact = Contact::create($data);

        return response()->json([
            'status' => 'success',
            'message' => __('pages.send_successfully'),
            'data' => [],
        ], Response::HTTP_OK);
    }
}
