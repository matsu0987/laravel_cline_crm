<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::with('company')->orderBy('last_name')->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $companies = Company::orderBy('name')->get();
        $selectedCompany = null;

        if ($request->has('company_id')) {
            $selectedCompany = Company::find($request->company_id);
        }

        return view('contacts.create', compact('companies', 'selectedCompany'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        $contact = Contact::create($validated);

        if ($request->has('redirect_to_company') && $request->redirect_to_company) {
            return redirect()->route('companies.show', $contact->company_id)
                ->with('success', __('Contact created successfully.'));
        }

        return redirect()->route('contacts.show', $contact)
            ->with('success', __('Contact created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        $activities = $contact->activities()->latest()->get();
        $deals = $contact->deals()->latest()->get();

        return view('contacts.show', compact('contact', 'activities', 'deals'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $companies = Company::orderBy('name')->get();
        return view('contacts.edit', compact('contact', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $contact->update($validated);

        return redirect()->route('contacts.show', $contact)
            ->with('success', __('Contact updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $companyId = $contact->company_id;
        $contact->delete();

        if (request()->has('redirect_to_company') && request()->redirect_to_company) {
            return redirect()->route('companies.show', $companyId)
                ->with('success', __('Contact deleted successfully.'));
        }

        return redirect()->route('contacts.index')
            ->with('success', __('Contact deleted successfully.'));
    }
}
