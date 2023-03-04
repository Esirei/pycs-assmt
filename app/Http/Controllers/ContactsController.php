<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Enums\InformationType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactsController extends Controller
{
    public function index()
    {
        return Contact::paginate()->withQueryString();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'photo' => 'nullable|string|required',
            'company' => 'nullable|string|max:100',
            'information' => 'required|array',
            'information.*.type' => ['required', 'string', Rule::enum(InformationType::class)],
            'information.*.content' => 'required|string|max:100',
        ]);

        $contact = Contact::create($request->except(['information']));
        $contact->information()->createMany($request->input('information'));

        return response()->json(['message' => 'Contact created']);
    }

    public function show(Contact $contact)
    {
        $contact->load(['information']);

        return $contact;
    }

    public function update(Request $request, Contact $contact)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'last_name' => 'nullable|string|max:50',
            'photo' => 'nullable|string|required',
            'company' => 'nullable|string|max:100',
            'information' => 'required|array',
            'information.*.type' => ['required', 'string', Rule::enum(InformationType::class)],
            'information.*.content' => 'required|string|max:100',
        ]);

        $data = collect($data);

        $contact->update($data->except(['information'])->all());
        foreach ($data->get('information') as $info) {
            $contact->information()->firstOrCreate($info);
        }

        return response()->json(['message' => 'Contact updated']);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return response()->json(['message' => 'Contact deleted']);
    }
}
