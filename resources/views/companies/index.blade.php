<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('messages.Companies') }}
            </h2>
            <a href="{{ route('companies.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('messages.Add Company') }}
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
                    @if($companies->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.Name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.Industry') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.Phone') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.Website') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($companies as $company)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('companies.show', $company) }}" class="text-indigo-600 hover:text-indigo-900">{{ $company->name }}</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $company->industry ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                {{ $company->phone ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($company->website)
                                                    <a href="{{ $company->website }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">{{ $company->website }}</a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('companies.edit', $company) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">{{ __('messages.Edit') }}</a>
                                                <form class="inline-block" action="{{ route('companies.destroy', $company) }}" method="POST" onsubmit="return confirm('{{ __('messages.Are you sure you want to delete this company?') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">{{ __('messages.Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $companies->links() }}
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('messages.No companies found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
