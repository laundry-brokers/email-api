<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Models\ImmediateDelivery;
use App\Http\Controllers\Controller;

class ImmediateDeliveryController extends Controller
{
    protected $model;

    public function __construct(ImmediateDelivery $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        $params = $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'email' => 'required|email|max:255',
            'state' => 'required|string|max:255',
            'city'  => 'required|string|max:255'
        ]);

        $sendEmailDelivery = $this->model->create($params);

        if($sendEmailDelivery) {
            Mail::to('prueba@thelaundrystations.com', 'otro@thelaundrystations.com')->send(new ContactFormMail($params));

            return response()->json([
                'status' => true,
                'email' => $sendEmailDelivery
            ]);
        } else {

        }
    }
}
