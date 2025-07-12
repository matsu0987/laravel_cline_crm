<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.Add Deal') }}
            @if($selectedCompany)
                {{ __('messages.for') }} {{ $selectedCompany->name }}
                @if($selectedContact)
                    ({{ $selectedContact->full_name }})
                @endif
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('deals.store') }}">
                        @csrf

                        @if($selectedCompany)
                            <input type="hidden" name="company_id" value="{{ $selectedCompany->id }}">
                            @if($selectedContact)
                                <input type="hidden" name="contact_id" value="{{ $selectedContact->id }}">
                                <input type="hidden" name="redirect_to_contact" value="1">
                            @else
                                <input type="hidden" name="redirect_to_company" value="1">
                            @endif
                        @else
                            <!-- Company -->
                            <div class="mb-4">
                                <x-input-label for="company_id" :value="__('messages.Company')" />
                                <select id="company_id" name="company_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">{{ __('messages.Select Company') }}</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                            </div>

                            <!-- Contact -->
                            <div class="mb-4">
                                <x-input-label for="contact_id" :value="__('messages.Contact')" />
                                <select id="contact_id" name="contact_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">{{ __('messages.Select Contact') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('contact_id')" class="mt-2" />
                            </div>
                        @endif

                        <!-- Title -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('messages.Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Amount -->
                        <div class="mb-4">
                            <x-input-label for="amount" :value="__('messages.Amount')" />
                            <x-text-input id="amount" class="block mt-1 w-full" type="number" name="amount" :value="old('amount')" required step="0.01" min="0" />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('messages.Status')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach(\App\Models\Deal::STATUSES as $status)
                                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                        {{ __(ucfirst(str_replace('_', ' ', $status))) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Expected Closing Date -->
                        <div class="mb-4">
                            <x-input-label for="expected_closing_date" :value="__('messages.Expected Closing Date')" />
                            <x-text-input id="expected_closing_date" class="block mt-1 w-full" type="date" name="expected_closing_date" :value="old('expected_closing_date')" />
                            <x-input-error :messages="$errors->get('expected_closing_date')" class="mt-2" />
                        </div>

                        <!-- Probability -->
                        <div class="mb-4">
                            <x-input-label for="probability" :value="__('messages.Probability (%)')" />
                            <x-text-input id="probability" class="block mt-1 w-full" type="number" name="probability" :value="old('probability', 50)" required min="0" max="100" />
                            <x-input-error :messages="$errors->get('probability')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('messages.Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('messages.Notes')" />
                            <textarea id="notes" name="notes" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if($selectedCompany)
                                @if($selectedContact)
                                    <a href="{{ route('contacts.show', $selectedContact) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                        {{ __('messages.Cancel') }}
                                    </a>
                                @else
                                    <a href="{{ route('companies.show', $selectedCompany) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                        {{ __('messages.Cancel') }}
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('deals.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                    {{ __('messages.Cancel') }}
                                </a>
                            @endif
                            <x-primary-button>
                                {{ __('messages.Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(!$selectedCompany)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const companySelect = document.getElementById('company_id');
                const contactSelect = document.getElementById('contact_id');

                companySelect.addEventListener('change', function() {
                    const companyId = this.value;
                    contactSelect.innerHTML = '<option value="">{{ __("messages.Select Contact") }}</option>';

                    if (companyId) {
                        fetch(`/api/companies/${companyId}/contacts`)
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(contact => {
                                    const option = document.createElement('option');
                                    option.value = contact.id;
                                    option.textContent = contact.full_name;
                                    contactSelect.appendChild(option);
                                });
                            });
                    }
                });
            });
        </script>
    @endif
</x-app-layout>
