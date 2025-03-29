@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
        <!-- Heading with animation -->
        <div class="text-center mb-12 animate-fade-down">
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-700 mb-2">Daftar Produk</h1>
            <div class="h-1 w-24 bg-gradient-to-r from-blue-400 to-indigo-500 mx-auto rounded-full"></div>
        </div>

        <!-- Notifikasi Pesanan Berhasil -->
        @if(session('success'))
        <div id="flash-message" class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl shadow-2xl z-50 animate-slide-down flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                const flashMessage = document.getElementById('flash-message');
                if (flashMessage) {
                    flashMessage.classList.add('animate-fade-out');
                    setTimeout(() => flashMessage.remove(), 1000);
                }
            }, 5000);
        </script>
        @endif

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
          
                <!-- Image with overlay hover effect -->
                <div class="relative w-full h-64 overflow-hidden group">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-start p-4">
                        <span class="text-white font-bold">{{ $product->name }}</span>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Product details -->
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $product->name }}</h2>
                        <p class="text-lg font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        <div class="w-12 h-1 bg-gray-200 rounded-full mt-3"></div>
                    </div>

                    <!-- Form Pembelian -->
                    <form action="{{ route('shop.buy', $product->id) }}" method="POST" class="mt-4 space-y-3">
                        @csrf
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Nama:</label>
                            <input type="text" name="name" 
                                class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Kelas:</label>
                            <input type="text" name="class" 
                                class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                required>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Jumlah:</label>
                            <div class="relative">
                                <input type="number" name="quantity" 
                                    class="w-full border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    min="1" required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-3 rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all transform active:scale-95 font-medium flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                            </svg>
                            Beli Sekarang
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    /* Base styles */
    body {
        font-family: 'Poppins', 'Segoe UI', sans-serif;
    }
    
    /* Animation keyframes */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideDown {
        from { 
            transform: translate(-50%, -100%); 
            opacity: 0; 
        }
        to { 
            transform: translate(-50%, 0); 
            opacity: 1; 
        }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }
    
    /* Applied animations */
    .animate-fade-up {
        animation: fadeUp 0.6s ease-out forwards;
    }
    
    .animate-fade-down {
        animation: fadeDown 0.6s ease-out forwards;
    }
    
    .animate-slide-down {
        animation: slideDown 0.5s ease-out;
    }
    
    .animate-fade-out {
        animation: fadeOut 1s ease-out;
    }
    
    /* Styling for flash message */
    #flash-message {
        position: fixed;
        top: 5%;
        left: 50%;
        transform: translate(-50%, 0);
        z-index: 9999;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    /* Enhance hover transitions */
    input:focus, button:focus {
        outline: none;
    }
</style>
@endsection