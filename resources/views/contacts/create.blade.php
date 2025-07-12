<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.Add Contact') }}
            @if($selectedCompany)
                {{ __('messages.for') }} {{ $selectedCompany->name }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('contacts.store') }}">
                        @csrf

                        @if($selectedCompany)
                            <input type="hidden" name="company_id" value="{{ $selectedCompany->id }}">
                            <input type="hidden" name="redirect_to_company" value="1">
                        @else
                            <!-- Company -->
                            <div class="mb-4">
                                <x-input-label for="company_id" :value="__('messages.Company')" />
                                <select id="company_id" name="company_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">{{ __('messages.Select Company') }}</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                            {{ $company->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                            </div>
                        @endif

                        <!-- First Name -->
                        <div class="mb-4">
                            <x-input-label for="first_name" :value="__('messages.First Name')" />
                            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                        </div>

                        <!-- Last Name -->
                        <div class="mb-4">
                            <x-input-label for="last_name" :value="__('messages.Last Name')" />
                            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required />
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                        </div>

                        <!-- Position -->
                        <div class="mb-4">
                            <x-input-label for="position" :value="__('messages.Position')" />
                            <x-text-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')" />
                            <x-input-error :messages="$errors->get('position')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('messages.Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <x-input-label for="phone" :value="__('messages.Phone')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <!-- Mobile -->
                        <div class="mb-4">
                            <x-input-label for="mobile" :value="__('messages.Mobile')" />
                            <x-text-input id="mobile" class="block mt-1 w-full" type="text" name="mobile" :value="old('mobile')" />
                            <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('messages.Notes')" />
                            <textarea id="notes" name="notes" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            @if($selectedCompany)
                                <a href="{{ route('companies.show', $selectedCompany) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                                    {{ __('messages.Cancel') }}
                                </a>
                            @else
                                <a href="{{ route('contacts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 focus:bg-gray-400 active:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
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
</x-app-layout>
