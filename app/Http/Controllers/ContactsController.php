<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use App\Models\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContactsController extends Controller
{

    public function index()
    {
        return view('contacts.index');
    }

    public function getContacts(Request $request)
    {
        $request->get('phone');
        $model = Contacts::where(['phone' => $request->get('phone')])->get()->toArray();

        if ($request->get('type') === 'html') {
            return view('contacts.result', compact('model'));
        }

        return response()->json($model);
    }

    public function setContacts(ContactsRequest $request)
    {

        $data = $request->json()->all();

        $dataItems = [];
        foreach ($data['items'] as $item) {
            $contactItem = [
                'name' => $item['name'],
                'phone' => Contacts::phoneFormat($item['phone']),
                'email' => $item['email'],
                'source_id' => $data['source_id'],
                'created_at' => date('Y-m-d', time())
            ];

            $validator = Validator::make(
                $contactItem,
                [
                    'name' => 'required',
                    'created_at' => 'required',
                    'source_id' => 'required',
                    'phone' => ['required', Rule::unique('contacts')->where(function ($query) use ($contactItem) {
                        return $query->where('phone', $contactItem['phone'])
                            ->where('created_at', $contactItem['created_at'])
                            ->where('source_id', $contactItem['source_id']);
                    }),],
                    'email' => 'required|email'
                ]
            );

            if ($validator->fails()) {
                // error validation
            } else {
                $dataItems[] = $contactItem;
            }
        }

        Contacts::insert($dataItems);

        return count($dataItems);
    }
}
