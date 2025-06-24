<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('messages.Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- 統計情報 -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-2">{{ __('messages.Companies') }}</h3>
                        <p class="text-3xl font-bold">{{ $counts['companies'] }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-2">{{ __('messages.Contacts') }}</h3>
                        <p class="text-3xl font-bold">{{ $counts['contacts'] }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-2">{{ __('messages.Deals') }}</h3>
                        <p class="text-3xl font-bold">{{ $counts['deals'] }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-2">{{ __('messages.Won Deals') }}</h3>
                        <p class="text-3xl font-bold">{{ $counts['won_deals'] }}</p>
                    </div>
                </div>
            </div>

            <!-- 進行中の商談 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">{{ __('messages.Active Deals') }}</h3>

                    @if($activeDeals->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.Title') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.Company') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.Amount') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.Status') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.Expected Closing') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($activeDeals as $deal)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('deals.show', $deal) }}" class="text-indigo-600 hover:text-indigo-900">{{ $deal->title }}</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('companies.show', $deal->company) }}" class="text-indigo-600 hover:text-indigo-900">{{ $deal->company->name }}</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ number_format($deal->amount) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ __('messages.' . ucfirst(str_replace('_', ' ', $deal->status))) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $deal->expected_closing_date ? $deal->expected_closing_date->format('Y-m-d') : '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('messages.No active deals found.') }}</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('deals.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('messages.New Deal') }}
                        </a>
                    </div>
                </div>
            </div>

            <!-- 今後の予定 -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">{{ __('messages.Upcoming Activities') }}</h3>

                        @if($upcomingActivities->count() > 0)
                            <div class="space-y-4">
                                @foreach($upcomingActivities as $activity)
                                    <div class="border-l-4 border-indigo-400 pl-4 py-2">
                                        <div class="flex justify-between">
                                            <p class="font-semibold">{{ $activity->title }}</p>
                                            <p class="text-sm text-gray-500">{{ $activity->scheduled_at->format('Y-m-d H:i') }}</p>
                                        </div>
                                        <p class="text-sm text-gray-600">{{ __('messages.Type') }}: {{ __('messages.' . ucfirst($activity->type)) }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ __('messages.Related to') }}:
                                            <a href="{{ route('companies.show', $activity->company) }}" class="text-indigo-600 hover:text-indigo-900">{{ $activity->company->name }}</a>
                                            @if($activity->contact)
                                                / <a href="{{ route('contacts.show', $activity->contact) }}" class="text-indigo-600 hover:text-indigo-900">{{ $activity->contact->full_name }}</a>
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">{{ __('messages.No upcoming activities found.') }}</p>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('activities.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('messages.New Activity') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 最近の活動 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">{{ __('messages.Recent Activities') }}</h3>

                        @if($recentActivities->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentActivities as $activity)
                                    <div class="border-l-4 border-gray-300 pl-4 py-2">
                                        <div class="flex justify-between">
                                            <p class="font-semibold">{{ $activity->title }}</p>
                                            <p class="text-sm text-gray-500">{{ $activity->created_at->diffForHumans() }}</p>
                                        </div>
                                        <p class="text-sm text-gray-600">{{ __('messages.Type') }}: {{ __('messages.' . ucfirst($activity->type)) }}</p>
                                        <p class="text-sm text-gray-600">
                                            {{ __('messages.Related to') }}:
                                            <a href="{{ route('companies.show', $activity->company) }}" class="text-indigo-600 hover:text-indigo-900">{{ $activity->company->name }}</a>
                                            @if($activity->contact)
                                                / <a href="{{ route('contacts.show', $activity->contact) }}" class="text-indigo-600 hover:text-indigo-900">{{ $activity->contact->full_name }}</a>
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">{{ __('messages.No recent activities found.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
