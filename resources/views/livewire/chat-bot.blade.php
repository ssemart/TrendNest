<div>
    <!-- Chat Trigger Button -->
    <button wire:click="toggleChat" class="fixed bottom-4 right-4 bg-indigo-600 text-white rounded-full p-3 shadow-lg hover:bg-indigo-700 transition-colors z-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
        </svg>
    </button>

    <!-- Chat Window -->
    <div class="fixed bottom-20 right-4 w-96 bg-white rounded-lg shadow-xl z-50 transition-all duration-300 transform {{ $isOpen ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0 pointer-events-none' }}">
        <!-- Chat Header -->
        <div class="bg-indigo-600 text-white p-4 rounded-t-lg flex justify-between items-center">
            <h3 class="text-lg font-semibold">Customer Support</h3>
            <button wire:click="toggleChat" class="hover:text-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Chat Messages -->
        <div class="p-4 h-96 overflow-y-auto">
            <div class="space-y-4">
                @foreach($messages as $message)
                    <div class="flex {{ $message['type'] === 'user' ? 'justify-end' : 'justify-start' }}">
                        <div class="{{ $message['type'] === 'user' ? 'bg-indigo-600 text-white' : 'bg-gray-100 text-gray-800' }} rounded-lg px-4 py-2 max-w-[80%]">
                            {{ $message['content'] }}
                        </div>
                    </div>
                @endforeach
                @if($loading)
                    <div class="flex justify-start">
                        <div class="bg-gray-100 rounded-lg px-4 py-2">
                            <div class="flex space-x-2">
                                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                                <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Chat Input -->
        <div class="border-t p-4">
            <form wire:submit.prevent="sendMessage" class="flex space-x-2">
                <input type="text" wire:model.live="query" class="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Type your message...">
                <button type="submit" class="bg-indigo-600 text-white rounded-lg px-4 py-2 hover:bg-indigo-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
