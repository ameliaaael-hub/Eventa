<x-default_layout>
<div class="mt-10">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Event Approval Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                    <li class="mr-2">
                        <button class="inline-block p-4 border-b-2 border-purple-600 text-purple-600" id="pendingTab">
                            Pending Events ({{ $pendingEvents->count() }})
                        </button>
                    </li>
                    <li class="mr-2">
                        <button class="inline-block p-4 border-b-2 border-transparent hover:border-gray-300" id="approvedTab">
                            Approved Events ({{ $approvedEvents->count() }})
                        </button>
                    </li>
                    <li class="mr-2">
                        <button class="inline-block p-4 border-b-2 border-transparent hover:border-gray-300" id="rejectedTab">
                            Rejected Events ({{ $rejectedEvents->count() }})
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Pending Events -->
            <div id="pendingContent" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Pending Events</h3>
                    @if($pendingEvents->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Event Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created By</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($pendingEvents as $event)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('acara.show', $event->id) }}" class="text-purple-600 hover:underline">
                                                {{ $event->Nama }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $event->Tanggal }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                {{ $event->Kategori }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <form action="{{ route('admin.events.approve', $event->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                                                    Approve
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.events.reject', $event->id) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                                    Reject
                                                </button>
                                            </form>
                                            <a href="{{ route('acara.show', $event->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded inline-block">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No pending events</p>
                    @endif
                </div>
            </div>

            <!-- Similar for approved and rejected events -->
        </div>
    </div>
</div>
    <script>
        // Tab functionality
        const tabs = {
            pending: document.getElementById('pendingTab'),
            approved: document.getElementById('approvedTab'),
            rejected: document.getElementById('rejectedTab')
        };
        
        const contents = {
            pending: document.getElementById('pendingContent'),
            approved: document.getElementById('approvedContent'),
            rejected: document.getElementById('rejectedContent')
        };

        function switchTab(activeTab) {
            Object.keys(tabs).forEach(tab => {
                if (tab === activeTab) {
                    tabs[tab].classList.add('border-purple-600', 'text-purple-600');
                    tabs[tab].classList.remove('border-transparent');
                    contents[tab].classList.remove('hidden');
                } else {
                    tabs[tab].classList.remove('border-purple-600', 'text-purple-600');
                    tabs[tab].classList.add('border-transparent');
                    contents[tab].classList.add('hidden');
                }
            });
        }

        tabs.pending.addEventListener('click', () => switchTab('pending'));
        tabs.approved.addEventListener('click', () => switchTab('approved'));
        tabs.rejected.addEventListener('click', () => switchTab('rejected'));
    </script>
</x-default_layout>