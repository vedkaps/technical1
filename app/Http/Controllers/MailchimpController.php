<?php

namespace App\Http\Controllers;

use App\External\MailchimpApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MailchimpController extends Controller
{
    public function home(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'list_id' => 'required',
            'email' => 'required',
            'api_key' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $response = (new MailchimpApi)
            ->subscribe($request->input('list_id'), $request->input('email'), $request->input('api_key'));

        return $response;
    }
}
