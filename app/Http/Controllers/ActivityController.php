<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Deal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::with(['company', 'contact', 'deal'])
            ->orderBy('scheduled_at', 'desc')
            ->paginate(15);

        return view('activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $companies = Company::orderBy('name')->get();
        $selectedCompany = null;
        $selectedContact = null;
        $selectedDeal = null;
        $contacts = collect();
        $deals = collect();

        if ($request->has('company_id')) {
            $selectedCompany = Company::find($request->company_id);
            $contacts = Contact::where('company_id', $selectedCompany->id)->orderBy('last_name')->get();
            $deals = Deal::where('company_id', $selectedCompany->id)->orderBy('title')->get();

            if ($request->has('contact_id')) {
                $selectedContact = Contact::where('company_id', $selectedCompany->id)
                    ->where('id', $request->contact_id)
                    ->first();
            }

            if ($request->has('deal_id')) {
                $selectedDeal = Deal::where('company_id', $selectedCompany->id)
                    ->where('id', $request->deal_id)
                    ->first();
            }
        }

        return view('activities.create', compact(
            'companies',
            'contacts',
            'deals',
            'selectedCompany',
            'selectedContact',
            'selectedDeal'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'deal_id' => 'nullable|exists:deals,id',
            'type' => 'required|in:' . implode(',', Activity::TYPES),
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'scheduled_at' => 'nullable|date',
            'status' => 'required|in:' . implode(',', Activity::STATUSES),
            'outcome' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->status === 'completed' && !isset($validated['completed_at'])) {
            $validated['completed_at'] = now();
        }

        $activity = Activity::create($validated);

        if ($request->has('redirect_to_company') && $request->redirect_to_company) {
            return redirect()->route('companies.show', $activity->company_id)
                ->with('success', __('Activity created successfully.'));
        } elseif ($request->has('redirect_to_contact') && $request->redirect_to_contact) {
            return redirect()->route('contacts.show', $activity->contact_id)
                ->with('success', __('Activity created successfully.'));
        } elseif ($request->has('redirect_to_deal') && $request->redirect_to_deal) {
            return redirect()->route('deals.show', $activity->deal_id)
                ->with('success', __('Activity created successfully.'));
        }

        return redirect()->route('activities.index')
            ->with('success', __('Activity created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        $companies = Company::orderBy('name')->get();
        $contacts = Contact::where('company_id', $activity->company_id)->orderBy('last_name')->get();
        $deals = Deal::where('company_id', $activity->company_id)->orderBy('title')->get();

        return view('activities.edit', compact('activity', 'companies', 'contacts', 'deals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'deal_id' => 'nullable|exists:deals,id',
            'type' => 'required|in:' . implode(',', Activity::TYPES),
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'scheduled_at' => 'nullable|date',
            'status' => 'required|in:' . implode(',', Activity::STATUSES),
            'outcome' => 'nullable|string',
        ]);

        // 完了ステータスに変更された場合、完了日時を設定
        if ($request->status === 'completed' && $activity->status !== 'completed') {
            $validated['completed_at'] = now();
        } elseif ($request->status !== 'completed') {
            $validated['completed_at'] = null;
        }

        $activity->update($validated);

        if ($request->has('redirect_to_company') && $request->redirect_to_company) {
            return redirect()->route('companies.show', $activity->company_id)
                ->with('success', __('Activity updated successfully.'));
        } elseif ($request->has('redirect_to_contact') && $request->redirect_to_contact) {
            return redirect()->route('contacts.show', $activity->contact_id)
                ->with('success', __('Activity updated successfully.'));
        } elseif ($request->has('redirect_to_deal') && $request->redirect_to_deal) {
            return redirect()->route('deals.show', $activity->deal_id)
                ->with('success', __('Activity updated successfully.'));
        }

        return redirect()->route('activities.index')
            ->with('success', __('Activity updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        $companyId = $activity->company_id;
        $contactId = $activity->contact_id;
        $dealId = $activity->deal_id;

        $activity->delete();

        if (request()->has('redirect_to_company') && request()->redirect_to_company) {
            return redirect()->route('companies.show', $companyId)
                ->with('success', __('Activity deleted successfully.'));
        } elseif (request()->has('redirect_to_contact') && request()->redirect_to_contact) {
            return redirect()->route('contacts.show', $contactId)
                ->with('success', __('Activity deleted successfully.'));
        } elseif (request()->has('redirect_to_deal') && request()->redirect_to_deal) {
            return redirect()->route('deals.show', $dealId)
                ->with('success', __('Activity deleted successfully.'));
        }

        return redirect()->route('activities.index')
            ->with('success', __('Activity deleted successfully.'));
    }
}
