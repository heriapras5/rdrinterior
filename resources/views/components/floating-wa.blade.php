@php $_waNum = ($_globalSettings['whatsapp_number'] ?? null) ?: ''; @endphp
@if ($_waNum)
    <a href="https://wa.me/{{ $_waNum }}?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20produk%20{{ urlencode($_globalSiteName) }}"
       target="_blank" rel="noopener noreferrer"
       class="fixed bottom-6 right-6 z-40 w-14 h-14 bg-emerald-500 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-emerald-600 hover:shadow-xl hover:scale-105 transition-all duration-300 group"
       aria-label="WhatsApp {{ $_globalSiteName }}">
        <i class="fab fa-whatsapp text-2xl"></i>
        <span class="absolute right-full mr-3 top-1/2 -translate-y-1/2 bg-aluminium-900 text-white text-xs rounded-lg px-3 py-1.5 whitespace-nowrap opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">Chat via WhatsApp</span>
    </a>
@endif
