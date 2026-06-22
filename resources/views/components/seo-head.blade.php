@props(['type' => 'Organization', 'name' => null])

@php
    $_seoSettings = $_globalSettings ?? [];
    $_siteName = $name ?? ($_seoSettings['site_name'] ?? 'RDR Interior Aluminium');
    $_logoUrl = $_globalLogo ?? asset('images/logo.png');
    $_description = $_seoSettings['site_description'] ?? 'Solusi interior aluminium berkualitas untuk hunian dan komersial.';
@endphp

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "{{ $type }}",
    "name": {{ json_encode($_siteName) }},
    "url": "{{ url('/') }}",
    "logo": "{{ $_logoUrl }}",
    "description": {{ json_encode($_description) }},
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "{{ $_seoSettings['whatsapp_number'] ?? '' }}",
        "contactType": "customer service"
    },
    "sameAs": [
        "{{ $_seoSettings['facebook_url'] ?? '' }}",
        "{{ $_seoSettings['instagram_url'] ?? '' }}",
        "{{ $_seoSettings['tiktok_url'] ?? '' }}"
    ]
}
</script>
