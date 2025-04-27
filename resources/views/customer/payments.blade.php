@extends('layouts.app')

@section('content')
<div class="container py-6">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold mb-6">Payment Methods</h2>
        
        <div class="bg-white shadow-sm rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Add New Payment Method</h3>
            <form action="{{ route('customer.payment.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Card Number</label>
                        <input type="text" name="card_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Card Holder Name</label>
                        <input type="text" name="card_holder" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Expiry Date</label>
                        <input type="text" name="expiry" placeholder="MM/YY" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">CVV</label>
                        <input type="text" name="cvv" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>
                </div>
                <button type="submit" class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Add Payment Method
                </button>
            </form>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <h3 class="text-lg font-semibold p-6 border-b">Saved Payment Methods</h3>
            
            @if($paymentMethods->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($paymentMethods as $method)
                        <div class="p-6 flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    @if($method->type === 'visa')
                                        <svg class="h-8 w-8" viewBox="0 0 36 36" fill="none">
                                            <!-- Add card type icon here -->
                                        </svg>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">
                                        •••• •••• •••• {{ substr($method->card_number, -4) }}
                                    </p>
                                    <p class="text-sm text-gray-500">
                                        Expires {{ $method->expiry }}
                                    </p>
                                </div>
                            </div>
                            <form action="{{ route('customer.payment.delete', $method->id) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                    Remove
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    No payment methods saved yet
                </div>
            @endif
        </div>
    </div>
</div>
@endsection