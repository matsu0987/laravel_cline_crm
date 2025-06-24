<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Activities') }}
            </h2>
            <a href="{{ route('activities.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('messages.Add Activity') }}
            </a>
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
                    @if($activities->count() > 0)
                        <div class="space-y-4">
                            @foreach($activities as $activity)
                                <div class="border-l-4 {{ $activity->status === 'completed' ? 'border-green-400' : ($activity->status === 'cancelled' ? 'border-red-400' : 'border-indigo-400') }} pl-4 py-2">
                                    <div class="flex justify-between">
                                        <div>
                                            <a href="{{ route('activities.show', $activity) }}" class="font-semibold text-indigo-600 hover:text-indigo-900">{{ $activity->title }}</a>
                                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full
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
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $activity->created_at->format('Y-m-d H:i') }}
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-600">{{ __('Type') }}: {{ __(ucfirst($activity->type)) }}</p>
                                    <p class="text-sm text-gray-600">
                                        {{ __('Company') }}:
                                        <a href="{{ route('companies.show', $activity->company) }}" class="text-indigo-600 hover:text-indigo-900">{{ $activity->company->name }}</a>
                                    </p>
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
                                    @if($activity->scheduled_at)
                                        <p class="text-sm text-gray-600">{{ __('Scheduled at') }}: {{ $activity->scheduled_at->format('Y-m-d H:i') }}</p>
                                    @endif
                                    @if($activity->description)
                                        <p class="text-sm text-gray-600 mt-2">{{ $activity->description }}</p>
                                    @endif
                                    <div class="mt-2 flex space-x-2">
                                        <a href="{{ route('activities.edit', $activity) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">{{ __('Edit') }}</a>
                                        <form class="inline-block" action="{{ route('activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this activity?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm">{{ __('Delete') }}</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            {{ $activities->links() }}
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('No activities found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
