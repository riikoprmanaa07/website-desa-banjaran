@extends('layout.app')

@section('title', 'Kontak - Desa Banjaran')

@section('content')
<section class="bg-desa-600 py-20 text-white">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl font-bold mb-4">Hubungi Kami</h1>
        <p class="text-desa-100 text-lg">Kami siap melayani dan menjawab pertanyaan Anda</p>
    </div>
</section>

<section class="py-16 -mt-10">
    <div class="container mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 lg:grid-cols-2">
            
            <div class="bg-desa-800 p-10 text-white">
                <h2 class="text-2xl font-bold mb-6">Informasi Kontak</h2>
                <p class="text-desa-200 mb-10">Jangan ragu untuk menghubungi kami melalui saluran resmi desa.</p>
                
                <div class="space-y-8">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">📍</div>
                        <div>
                            <h3 class="font-bold text-lg">Alamat Kantor</h3>
                            <p class="text-desa-200 text-sm leading-relaxed">Jl. Raya Banjaran No. 123<br>Kec. Contoh, Kab. Contoh<br>Jawa Barat 40123</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">📞</div>
                        <div>
                            <h3 class="font-bold text-lg">Telepon / WA</h3>
                            <p class="text-desa-200 text-sm">(021) 1234-5678</p>
                            <p class="text-desa-200 text-sm">0812-3456-7890 (WhatsApp Pelayanan)</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-white/10 rounded-lg flex items-center justify-center text-2xl flex-shrink-0">✉️</div>
                        <div>
                            <h3 class="font-bold text-lg">Email</h3>
                            <p class="text-desa-200 text-sm">info@desabanjaran.id</p>
                            <p class="text-desa-200 text-sm">admin@desabanjaran.id</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-10 bg-white">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan</h2>
                <form action="#" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-desa-500 focus:border-desa-500 outline-none transition" required placeholder="Nama Anda">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">No. WhatsApp</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-desa-500 focus:border-desa-500 outline-none transition" placeholder="08XX-XXXX-XXXX">
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                        <input type="text" id="subject" name="subject" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-desa-500 focus:border-desa-500 outline-none transition" required placeholder="Perihal pesan">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                        <textarea id="message" name="message" rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-desa-500 focus:border-desa-500 outline-none transition" required placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-desa-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-desa-700 transition shadow-lg transform hover:-translate-y-1">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-12 rounded-xl overflow-hidden shadow-lg h-96 bg-gray-200">
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126907.08639209587!2d106.7865!3d-6.2297!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTMnNDYuOSJTIDEwNsKwNDcnMTEuNCJF!5e0!3m2!1sid!2sid!4v1635000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>
@endsection