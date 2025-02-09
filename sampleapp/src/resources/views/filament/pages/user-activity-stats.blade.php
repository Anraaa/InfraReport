<x-filament-panels::page>
    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <x-heroicon-o-clock class="w-6 h-6 text-blue-600" /> Recent Activities
            </h2>
            
            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <table class="w-full bg-white text-left text-sm text-gray-700">
                    <thead class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                        <tr>
                            <th class="px-6 py-4 font-semibold uppercase">User</th>
                            <th class="px-6 py-4 font-semibold uppercase">Activity Type</th>
                            <th class="px-6 py-4 font-semibold uppercase">Description</th>
                            <th class="px-6 py-4 font-semibold uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($activities as $activity)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-semibold">
                                        {{ strtoupper(substr($activity->user->name, 0, 1)) }}
                                    </div>
                                    <span class="font-medium text-gray-700">{{ $activity->user->name }}</span>
                                </td>
                                <td class="px-6 py-4 text-gray-600 font-medium">{{ $activity->activity_type }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $activity->description }}</td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ optional($activity->created_at)->format('d M Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No activities found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-filament-panels::page>