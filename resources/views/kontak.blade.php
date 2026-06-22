@extends('layouts.app')

@section('title', 'Hubungi Kami - ' . ($_globalSiteName ?? 'RDR Interior Aluminium'))
@section('meta_description', 'Hubungi RDR Interior Aluminium untuk konsultasi, pertanyaan, atau pemesanan produk interior aluminium.')

@section('content')
    <section class="py-16 gradient-hero text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-in">
            <h1 class="text-4xl md:text-5xl font-bold">Hubungi Kami</h1>
            <p class="text-white/70 mt-3 max-w-2xl mx-auto">Kami siap membantu Anda. Silakan hubungi kami melalui form di bawah atau langsung via WhatsApp.</p>
        </div>
    </section>

    <section class="py-14 bg-white" data-aos="slide-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <div data-aos="slide-right">
                    <h2 class="text-2xl font-bold text-aluminium-900 mb-6">Kirim Pesan</h2>

                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                             class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-5 py-4 rounded-xl">
                            <i class="fas fa-check-circle text-emerald-500"></i>
                            <span class="flex-1 text-sm font-medium">{{ session('success') }}</span>
                            <button @@click="show = false" class="text-emerald-400 hover:text-emerald-600"><i class="fas fa-times"></i></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                             class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                            <span class="flex-1 text-sm font-medium">{{ session('error') }}</span>
                            <button @@click="show = false" class="text-red-400 hover:text-red-600"><i class="fas fa-times"></i></button>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-aluminium-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama Anda"
                                   class="w-full px-4 py-3 border border-aluminium-200 rounded-xl focus:ring-2 focus:ring-aluminium-400 focus:border-aluminium-400 outline-none transition-all duration-200 @error('name') border-red-300 @enderror">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-aluminium-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda"
                                   class="w-full px-4 py-3 border border-aluminium-200 rounded-xl focus:ring-2 focus:ring-aluminium-400 focus:border-aluminium-400 outline-none transition-all duration-200 @error('email') border-red-300 @enderror">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-aluminium-700 mb-1">Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Nomor telepon (opsional)"
                                   class="w-full px-4 py-3 border border-aluminium-200 rounded-xl focus:ring-2 focus:ring-aluminium-400 focus:border-aluminium-400 outline-none transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-aluminium-700 mb-1">Subjek</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Subjek pesan"
                                   class="w-full px-4 py-3 border border-aluminium-200 rounded-xl focus:ring-2 focus:ring-aluminium-400 focus:border-aluminium-400 outline-none transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-aluminium-700 mb-1">Pesan <span class="text-red-500">*</span></label>
                            <textarea name="message" rows="5" placeholder="Tulis pesan Anda di sini..."
                                      class="w-full px-4 py-3 border border-aluminium-200 rounded-xl focus:ring-2 focus:ring-aluminium-400 focus:border-aluminium-400 outline-none transition-all duration-200 resize-none @error('message') border-red-300 @enderror">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="btn-primary w-full">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                @php $_kontakSettings = $_globalSettings ?? []; @endphp
                <div data-aos="slide-left">
                    <h2 class="text-2xl font-bold text-aluminium-900 mb-6">Informasi Kontak</h2>
                    <div class="space-y-5">
                        <div class="flex items-start space-x-4 p-5 bg-white rounded-xl shadow-sm border border-aluminium-200">
                            <div class="w-12 h-12 bg-aluminium-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-aluminium-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-aluminium-900">Alamat</h3>
                                <p class="text-aluminium-500 text-sm">{{ $_kontakSettings['address'] ?? 'Alamat perusahaan' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 p-5 bg-white rounded-xl shadow-sm border border-aluminium-200">
                            <div class="w-12 h-12 bg-aluminium-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-aluminium-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-aluminium-900">Telepon / WhatsApp</h3>
                                <p class="text-aluminium-500 text-sm">{{ $_kontakSettings['phone'] ?? 'Nomor telepon' }}</p>
                                @php $_waKontak = $_kontakSettings['whatsapp_number'] ?? ''; @endphp
                                @if ($_waKontak)
                                <a href="https://wa.me/{{ $_waKontak }}" target="_blank" class="text-aluminium-600 hover:text-aluminium-800 text-sm font-medium transition-colors duration-200">Chat via WhatsApp &rarr;</a>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 p-5 bg-white rounded-xl shadow-sm border border-aluminium-200">
                            <div class="w-12 h-12 bg-aluminium-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-aluminium-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-aluminium-900">Email</h3>
                                <p class="text-aluminium-500 text-sm">{{ $_kontakSettings['email'] ?? 'email@perusahaan.com' }}</p>
                                <a href="mailto:{{ $_kontakSettings['email'] ?? '' }}" class="text-aluminium-600 hover:text-aluminium-800 text-sm font-medium transition-colors duration-200">Kirim Email &rarr;</a>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 p-5 bg-white rounded-xl shadow-sm border border-aluminium-200">
                            <div class="w-12 h-12 bg-aluminium-100 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-aluminium-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                                <div>
                                    <h3 class="font-semibold text-aluminium-900">Jam Operasional</h3>
                                    @php $_hours = explode("\n", $_kontakSettings['operational_hours'] ?? "Senin - Jumat: 08:00 - 17:00\nSabtu: 08:00 - 14:00"); @endphp
                                    @foreach ($_hours as $_h)
                                        @if (trim($_h))
                                            <p class="text-aluminium-500 text-sm">{{ trim($_h) }}</p>
                                        @endif
                                    @endforeach
                                </div>
                        </div>
                    </div>

                    @if (!empty($_kontakSettings['maps_embed']))
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-aluminium-900 mb-4">Lokasi Kami</h3>
                        <div class="rounded-xl overflow-hidden shadow-sm border border-aluminium-200">
                            <iframe src="{{ $_kontakSettings['maps_embed'] }}" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="py-14 bg-aluminium-800 text-white text-center">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold mb-4">Lebih Nyaman Chat via WhatsApp?</h2>
            <p class="text-white/70 mb-8">Kami siap merespon pertanyaan Anda dengan cepat</p>
            @php $_waKontak2 = ($_globalSettings['whatsapp_number'] ?? null) ?: ''; @endphp
            @if ($_waKontak2)
            <a href="https://wa.me/{{ $_waKontak2 }}?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20produk%20{{ urlencode($_globalSiteName) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-8 py-4 bg-white text-aluminium-800 font-semibold rounded-xl shadow-lg hover:bg-aluminium-50 transition-all duration-300">
                <i class="fab fa-whatsapp text-lg mr-2"></i>
                Hubungi via WhatsApp
            </a>
            @endif
        </div>
    </section>
@endsection
