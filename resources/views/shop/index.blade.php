@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Daftar Produk</h1>

    <!-- Notifikasi Pesanan Berhasil -->
    @if(session('success'))
    <div id="flash-message" class="fixed top-10 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg animate-slide-down">
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



        <style>
            @keyframes slide-down {
                from { transform: translate(-50%, -100%); opacity: 0; }
                to { transform: translate(-50%, 0); opacity: 1; }
            }

            @keyframes fade-out {
                from { opacity: 1; }
                to { opacity: 0; }
            }

            .animate-slide-down { animation: slide-down 0.5s ease-out; }
            .animate-fade-out { animation: fade-out 1s ease-out; }
        </style>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white p-5 shadow-xl rounded-lg transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                <!-- Pastikan path gambar benar -->
                <img src="{{ asset('storage/' . $product->image) }}" 
     alt="{{ $product->name }}" 
     class="w-full h-50 object-cover rounded-t-lg">

                <h2 class="text-xl font-semibold mt-3 text-gray-800">{{ $product->name }}</h2>
                <p class="text-gray-600 font-medium">Harga: Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                <!-- Form Pembelian -->
                <form action="{{ route('shop.buy', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-2">
                        <label class="block text-sm text-gray-700">Nama:</label>
                        <input type="text" name="name" 
                               class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>

                    <div class="mb-2">
                        <label class="block text-sm text-gray-700">Kelas:</label>
                        <input type="text" name="class" 
                               class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               required>
                    </div>

                    <div class="mb-2">
                        <label class="block text-sm text-gray-700">Jumlah:</label>
                        <input type="number" name="quantity" 
                               class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                               min="1" required>
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
                        Beli Sekarang
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
