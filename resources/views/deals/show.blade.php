<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $deal->title }}
            </h2>
            <div>
                <a href="{{ route('deals.edit', $deal) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                    {{ __('messages.Edit') }}
                </a>
                <form class="inline-block" action="{{ route('deals.destroy', $deal) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this deal?') }}');">
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

            <!-- 商談情報 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('messages.Deal Information') }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Company') }}</p>
                            <p class="font-medium">
                                <a href="{{ route('companies.show', $deal->company) }}" class="text-indigo-600 hover:text-indigo-900">{{ $deal->company->name }}</a>
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Contact') }}</p>
                            <p class="font-medium">
                                @if($deal->contact)
                                    <a href="{{ route('contacts.show', $deal->contact) }}" class="text-indigo-600 hover:text-indigo-900">{{ $deal->contact->full_name }}</a>
                                @else
                                    -
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Amount') }}</p>
                            <p class="font-medium">{{ number_format($deal->amount) }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Status') }}</p>
                            <p class="font-medium">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($deal->status === 'closed_won')
                                        bg-green-100 text-green-800
                                    @elseif($deal->status === 'closed_lost')
                                        bg-red-100 text-red-800
                                    @else
                                        bg-blue-100 text-blue-800
                                    @endif
                                ">
                                    {{ __(ucfirst(str_replace('_', ' ', $deal->status))) }}
                                </span>
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Expected Closing Date') }}</p>
                            <p class="font-medium">{{ $deal->expected_closing_date ? $deal->expected_closing_date->format('Y-m-d') : '-' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Probability') }}</p>
                            <p class="font-medium">{{ $deal->probability }}%</p>
                        </div>
                    </div>

                    @if($deal->description)
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">{{ __('messages.Description') }}</p>
                            <p class="font-medium">{{ $deal->description }}</p>
                        </div>
                    @endif

                    @if($deal->notes)
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">{{ __('messages.Notes') }}</p>
                            <p class="font-medium">{{ $deal->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- 活動履歴 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">{{ __('Activities') }}</h3>
                        <a href="{{ route('activities.create', ['deal_id' => $deal->id, 'company_id' => $deal->company_id, 'contact_id' => $deal->contact_id]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                                    @if($activity->contact && $activity->contact_id != $deal->contact_id)
                                        <p class="text-sm text-gray-600">
                                            {{ __('Contact') }}:
                                            <a href="{{ route('contacts.show', $activity->contact) }}" class="text-indigo-600 hover:text-indigo-900">{{ $activity->contact->full_name }}</a>
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
