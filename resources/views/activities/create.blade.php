<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.Add Activity') }}
            @if($selectedCompany)
                {{ __('for') }} {{ $selectedCompany->name }}
                @if($selectedContact)
                    ({{ $selectedContact->full_name }})
                @elseif($selectedDeal)
                    ({{ $selectedDeal->title }})
                @endif
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('activities.store') }}">
                        @csrf

                        @if($selectedCompany)
                            <input type="hidden" name="company_id" value="{{ $selectedCompany->id }}">
                            @if($selectedContact)
                                <input type="hidden" name="contact_id" value="{{ $selectedContact->id }}">
                                <input type="hidden" name="redirect_to_contact" value="1">
                            @elseif($selectedDeal)
                                <input type="hidden" name="deal_id" value="{{ $selectedDeal->id }}">
                                <input type="hidden" name="redirect_to_deal" value="1">
                            @else
                                <input type="hidden" name="redirect_to_company" value="1">
                            @endif
                        @else
                            <!-- Company -->
                            <div class="mb-4">
                                <x-input-label for="company_id" :value="__('Company')" />
                                <select id="company_id" name="company_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">{{ __('Select Company') }}</option>
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
                                <x-input-label for="contact_id" :value="__('Contact')" />
                                <select id="contact_id" name="contact_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">{{ __('Select Contact') }}</option>
                                    @if(old('company_id') && $contacts->count() > 0)
                                        @foreach($contacts as $contact)
                                            <option value="{{ $contact->id }}" {{ old('contact_id') == $contact->id ? 'selected' : '' }}>
                                                {{ $contact->full_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <x-input-error :messages="$errors->get('contact_id')" class="mt-2" />
                            </div>

                            <!-- Deal -->
                            <div class="mb-4">
                                <x-input-label for="deal_id" :value="__('Deal')" />
                                <select id="deal_id" name="deal_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">{{ __('Select Deal') }}</option>
                                    @if(old('company_id') && $deals->count() > 0)
                                        @foreach($deals as $deal)
                                            <option value="{{ $deal->id }}" {{ old('deal_id') == $deal->id ? 'selected' : '' }}>
                                                {{ $deal->title }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                <x-input-error :messages="$errors->get('deal_id')" class="mt-2" />
                            </div>
                        @endif

                        <!-- Type -->
                        <div class="mb-4">
                            <x-input-label for="type" :value="__('Type')" />
                            <select id="type" name="type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach(\App\Models\Activity::TYPES as $type)
                                    <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>
                                        {{ __(ucfirst($type)) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <!-- Title -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Scheduled At -->
                        <div class="mb-4">
                            <x-input-label for="scheduled_at" :value="__('Scheduled At')" />
                            <x-text-input id="scheduled_at" class="block mt-1 w-full" type="datetime-local" name="scheduled_at" :value="old('scheduled_at')" />
                            <x-input-error :messages="$errors->get('scheduled_at')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach(\App\Models\Activity::STATUSES as $status)
                                    <option value="{{ $status }}" {{ old('status', 'scheduled') == $status ? 'selected' : '' }}>
                                        {{ __(ucfirst($status)) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Outcome (only visible when status is completed) -->
                        <div id="outcome-container" class="mb-4" style="display: none;">
                            <x-input-label for="outcome" :value="__('Outcome')" />
                            <textarea id="outcome" name="outcome" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('outcome') }}</textarea>
                            <x-input-error :messages="$errors->get('outcome')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if($selectedCompany)
                                @if($selectedContact)
                                    <a href="{{ route('contacts.show', $selectedContact) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                        {{ __('Cancel') }}
                                    </a>
                                @elseif($selectedDeal)
                                    <a href="{{ route('deals.show', $selectedDeal) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                        {{ __('Cancel') }}
                                    </a>
                                @else
                                    <a href="{{ route('companies.show', $selectedCompany) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                        {{ __('Cancel') }}
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('activities.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                    {{ __('Cancel') }}
                                </a>
                            @endif
                            <x-primary-button>
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const companySelect = document.getElementById('company_id');
            const contactSelect = document.getElementById('contact_id');
            const dealSelect = document.getElementById('deal_id');
            const statusSelect = document.getElementById('status');
            const outcomeContainer = document.getElementById('outcome-container');

            // 会社選択時の処理
            if (companySelect) {
                companySelect.addEventListener('change', function() {
                    const companyId = this.value;
                    contactSelect.innerHTML = '<option value="">{{ __("Select Contact") }}</option>';
                    dealSelect.innerHTML = '<option value="">{{ __("Select Deal") }}</option>';

                    if (companyId) {
                        // 担当者を取得
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

                        // 商談を取得
                        fetch(`/api/companies/${companyId}/deals`)
                            .then(response => response.json())
                            .then(data => {
                                data.forEach(deal => {
                                    const option = document.createElement('option');
                                    option.value = deal.id;
                                    option.textContent = deal.title;
                                    dealSelect.appendChild(option);
                                });
                            });
                    }
                });
            }

            // ステータス変更時の処理
            statusSelect.addEventListener('change', function() {
                if (this.value === 'completed') {
                    outcomeContainer.style.display = 'block';
                } else {
                    outcomeContainer.style.display = 'none';
                }
            });

            // 初期表示時の処理
            if (statusSelect.value === 'completed') {
                outcomeContainer.style.display = 'block';
            }
        });
    </script>
</x-app-layout>
