<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deals = Deal::with(['company', 'contact'])->orderBy('expected_closing_date')->paginate(10);
        return view('deals.index', compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $companies = Company::orderBy('name')->get();
        $selectedCompany = null;
        $selectedContact = null;

        if ($request->has('company_id')) {
            $selectedCompany = Company::find($request->company_id);

            if ($request->has('contact_id')) {
                $selectedContact = Contact::where('company_id', $selectedCompany->id)
                    ->where('id', $request->contact_id)
                    ->first();
            }
        }

        return view('deals.create', compact('companies', 'selectedCompany', 'selectedContact'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:' . implode(',', Deal::STATUSES),
            'expected_closing_date' => 'nullable|date',
            'probability' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        $deal = Deal::create($validated);

        if ($request->has('redirect_to_company') && $request->redirect_to_company) {
            return redirect()->route('companies.show', $deal->company_id)
                ->with('success', __('Deal created successfully.'));
        } elseif ($request->has('redirect_to_contact') && $request->redirect_to_contact) {
            return redirect()->route('contacts.show', $deal->contact_id)
                ->with('success', __('Deal created successfully.'));
        }

        return redirect()->route('deals.show', $deal)
            ->with('success', __('Deal created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal)
    {
        $activities = $deal->activities()->latest()->get();

        return view('deals.show', compact('deal', 'activities'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal)
    {
        $companies = Company::orderBy('name')->get();
        $contacts = Contact::where('company_id', $deal->company_id)->orderBy('last_name')->get();

        return view('deals.edit', compact('deal', 'companies', 'contacts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:' . implode(',', Deal::STATUSES),
            'expected_closing_date' => 'nullable|date',
            'probability' => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $deal->update($validated);

        return redirect()->route('deals.show', $deal)
            ->with('success', __('Deal updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal)
    {
        $companyId = $deal->company_id;
        $contactId = $deal->contact_id;
        $deal->delete();

        if (request()->has('redirect_to_company') && request()->redirect_to_company) {
            return redirect()->route('companies.show', $companyId)
                ->with('success', __('Deal deleted successfully.'));
        } elseif (request()->has('redirect_to_contact') && request()->redirect_to_contact) {
            return redirect()->route('contacts.show', $contactId)
                ->with('success', __('Deal deleted successfully.'));
        }

        return redirect()->route('deals.index')
            ->with('success', __('Deal deleted successfully.'));
    }
}
