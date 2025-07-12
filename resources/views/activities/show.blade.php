<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $activity->title }}
            </h2>
            <div>
                <a href="{{ route('activities.edit', $activity) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                    {{ __('messages.Edit') }}
                </a>
                <form class="inline-block" action="{{ route('activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this activity?') }}');">
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($activity->status === 'completed')
                                bg-green-100 text-green-800
                            @elseif($activity->status === 'cancelled')
                                bg-red-100 text-red-800
                            @else
                                bg-blue-100 text-blue-800
                            @endif
                        ">
                            {{ __(ucfirst($activity->status)) }}
                        </span>
                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            {{ __(ucfirst($activity->type)) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Company') }}</p>
                            <p class="font-medium">
                                <a href="{{ route('companies.show', $activity->company) }}" class="text-indigo-600 hover:text-indigo-900">{{ $activity->company->name }}</a>
                            </p>
                        </div>

                        @if($activity->contact)
                            <div>
                                <p class="text-sm text-gray-600">{{ __('messages.Contact') }}</p>
                                <p class="font-medium">
                                    <a href="{{ route('contacts.show', $activity->contact) }}" class="text-indigo-600 hover:text-indigo-900">{{ $activity->contact->full_name }}</a>
                                </p>
                            </div>
                        @endif

                        @if($activity->deal)
                            <div>
                                <p class="text-sm text-gray-600">{{ __('messages.Deal') }}</p>
                                <p class="font-medium">
                                    <a href="{{ route('deals.show', $activity->deal) }}" class="text-indigo-600 hover:text-indigo-900">{{ $activity->deal->title }}</a>
                                </p>
                            </div>
                        @endif

                        @if($activity->scheduled_at)
                            <div>
                                <p class="text-sm text-gray-600">{{ __('messages.Scheduled at') }}</p>
                                <p class="font-medium">{{ $activity->scheduled_at->format('Y-m-d H:i') }}</p>
                            </div>
                        @endif

                        @if($activity->completed_at)
                            <div>
                                <p class="text-sm text-gray-600">{{ __('messages.Completed at') }}</p>
                                <p class="font-medium">{{ $activity->completed_at->format('Y-m-d H:i') }}</p>
                            </div>
                        @endif

                        <div>
                            <p class="text-sm text-gray-600">{{ __('messages.Created by') }}</p>
                            <p class="font-medium">{{ $activity->user->name }}</p>
                        </div>
                    </div>

                    @if($activity->description)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">{{ __('messages.Description') }}</h3>
                            <p>{{ $activity->description }}</p>
                        </div>
                    @endif

                    @if($activity->outcome)
                        <div>
                            <h3 class="text-lg font-semibold mb-2">{{ __('messages.Outcome') }}</h3>
                            <p>{{ $activity->outcome }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
