<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Email;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    protected $model;

    public function __construct(Email $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $emails = $this->model::all();

        if(count($emails) > 0) {
            return response()->json([
                'status' => true,
                'emails' => $emails,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'emails' => [],
            ]);
        }
    }

    public function filterWithEmails()
    {
        return $this->model::filterEmails();
    }

    public function filterEmail(Request $request)
    {
        $params = $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $email = $params['email'];

        if($email) {
            $this->model::filterEmail($email);

            return response()->json([
                'status' => true,
                'email' => $email,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'email' => [],
            ]);
        }
    }

    public function sendEmail(Request $request)
    {
        $params = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|string|max:11',
            'laundry' => 'required|string|max:150',
            'range' => 'required|string|max:150',
            'state' => 'nullable|string|max:150',
            'city' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:255',
        ]);

        $email = $this->model->create($params);

        if($email) {
            Mail::to('prueba@thelaundrystations.com')->send(new ContactFormMail($params));

            return response()->json([
                'status' => true,
                'email' => $email
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Error al enviar el correo electronico.',
                'email' => [],
            ]);
        }
    }

    public function delete(Request $request)
    {
        $params = $request->validate([
            'id' => 'required|int|min:1|max:999999|exists:emails,id'
        ]);

        $deleteEmail = $this->model::where('id', $params['id'])->delete();

        if($deleteEmail > 0) {
            return response()->json([
                'status' => true,
                'email' => $deleteEmail,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'email' => [],
            ]);
        }
    }
}
