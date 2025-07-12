<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $company->name }}
            </h2>
            <div>
                <a href="{{ route('companies.edit', $company) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                    {{ __('messages.Edit') }}
                </a>
                <form class="inline-block" action="{{ route('companies.destroy', $company) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this company?') }}');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        {{ __('messages.Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- 企業情報 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('messages.Company Information') }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Industry') }}</p>
                            <p class="font-medium">{{ $company->industry ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Phone') }}</p>
                            <p class="font-medium">{{ $company->phone ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Website') }}</p>
                            <p class="font-medium">
                                @if($company->website)
                                    <a href="{{ $company->website }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ $company->website }}</a>
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Address') }}</p>
                            <p class="font-medium">{{ $company->address ?? '-' }}</p>
                        </div>
                    </div>

                    @if($company->notes)
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">{{ __('messages.Notes') }}</p>
                            <p class="font-medium">{{ $company->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- 担当者一覧 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">{{ __('Contacts') }}</h3>
                        <a href="{{ route('contacts.create', ['company_id' => $company->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('messages.Add Contact') }}
                        </a>
                    </div>

                    @if($contacts->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Position') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Email') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Phone') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('contacts.show', $contact) }}" class="text-indigo-600 hover:text-indigo-900">{{ $contact->full_name }}</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $contact->position ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $contact->email ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $contact->phone ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('contacts.edit', $contact) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('No contacts found.') }}</p>
                    @endif
                </div>
            </div>

            <!-- 商談一覧 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">{{ __('Deals') }}</h3>
                        <a href="{{ route('deals.create', ['company_id' => $company->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('messages.Add Deal') }}
                        </a>
                    </div>

                    @if($deals->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Amount') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Expected Closing') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($deals as $deal)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('deals.show', $deal) }}" class="text-indigo-600 hover:text-indigo-900">{{ $deal->title }}</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ number_format($deal->amount) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ __(ucfirst(str_replace('_', ' ', $deal->status))) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $deal->expected_closing_date ? $deal->expected_closing_date->format('Y-m-d') : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('deals.edit', $deal) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('Edit') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('No deals found.') }}</p>
                    @endif
                </div>
            </div>

            <!-- 活動履歴 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">{{ __('Activities') }}</h3>
                        <a href="{{ route('activities.create', ['company_id' => $company->id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('messages.Add Activity') }}
                        </a>
                    </div>

                    @if($activities->count() > 0)
                        <div class="space-y-4">
                            @foreach($activities as $activity)
                                <div class="border-l-4 {{ $activity->status === 'completed' ? 'border-green-400' : ($activity->status === 'cancelled' ? 'border-red-400' : 'border-indigo-400') }} pl-4 py-2">
                                    <div class="flex justify-between">
                                        <p class="font-semibold">{{ $activity->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $activity->created_at->format('Y-m-d H:i') }}</p>
                                    </div>
                                    <p class="text-sm text-gray-600">{{ __('Type') }}: {{ __(ucfirst($activity->type)) }}</p>
                                    @if($activity->scheduled_at)
                                        <p class="text-sm text-gray-600">{{ __('Scheduled at') }}: {{ $activity->scheduled_at->format('Y-m-d H:i') }}</p>
                                    @endif
                                    @if($activity->contact)
                                        <p class="text-sm text-gray-600">
                                            {{ __('Contact') }}:
                                            <a href="{{ route('contacts.show', $activity->contact) }}" class="text-indigo-600 hover:text-indigo-900">{{ $activity->contact->full_name }}</a>
                                        </p>
                                    @endif
                                    @if($activity->deal)
                                        <p class="text-sm text-gray-600">
                                            {{ __('Deal') }}:
                                            <a href="{{ route('deals.show', $activity->deal) }}" class="text-indigo-600 hover:text-indigo-900">{{ $activity->deal->title }}</a>
                                        </p>
                                    @endif
                                    @if($activity->description)
                                        <p class="text-sm text-gray-600 mt-2">{{ $activity->description }}</p>
                                    @endif
                                    <div class="mt-2">
                                        <a href="{{ route('activities.edit', $activity) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">{{ __('Edit') }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('No activities found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
