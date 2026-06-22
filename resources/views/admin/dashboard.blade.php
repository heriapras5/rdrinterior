@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin RDR Interior Aluminium')
@section('header', 'Dashboard')

@push('styles')
<style>
    .stat-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .stat-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px -12px rgba(0,0,0,0.15); }
    .stat-icon { transition: transform 0.3s ease; }
    .stat-card:hover .stat-icon { transform: scale(1.08); }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
@endpush

@section('content')
    @php
        $hour = now()->hour;
        if ($hour >= 5 && $hour < 12) $greeting = 'Selamat Pagi';
        elseif ($hour >= 12 && $hour < 15) $greeting = 'Selamat Siang';
        elseif ($hour >= 15 && $hour < 18) $greeting = 'Selamat Sore';
        else $greeting = 'Selamat Malam';
        $userName = Auth::user()->name ?? 'Admin';
    @endphp

    <div class="mb-8">
        <h2 class="text-2xl font-bold text-aluminium-800">{{ $greeting }}, {{ $userName }}</h2>
        @if ($_globalSiteName)
        <p class="text-sm text-aluminium-400 mt-1">Ringkasan kunjungan {{ $_globalSiteName }}.</p>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-5 mb-8">
        <a href="{{ route('admin.products.index') }}" class="stat-card bg-white rounded-2xl shadow-sm border border-aluminium-200 p-5 md:p-6 flex items-center gap-4 group">
            <div class="stat-icon w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100/80 flex items-center justify-center text-blue-600 text-xl shrink-0">
                <i class="fas fa-box"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] text-aluminium-400 font-medium tracking-wider uppercase">Produk Aktif</p>
                <p class="text-3xl font-bold text-aluminium-800 mt-0.5">{{ $stats['total_products'] ?? 0 }}</p>
            </div>
            <div class="ml-auto text-aluminium-300 group-hover:text-aluminium-500 transition-colors">
                <i class="fas fa-arrow-right text-sm"></i>
            </div>
        </a>
        <a href="{{ route('admin.messages.index') }}" class="stat-card bg-white rounded-2xl shadow-sm border border-aluminium-200 p-5 md:p-6 flex items-center gap-4 group">
            <div class="stat-icon w-12 h-12 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100/80 flex items-center justify-center text-orange-600 text-xl shrink-0">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] text-aluminium-400 font-medium tracking-wider uppercase">Pesan Baru</p>
                <p class="text-3xl font-bold text-aluminium-800 mt-0.5">{{ $stats['messages'] ?? 0 }}</p>
            </div>
            <div class="ml-auto text-aluminium-300 group-hover:text-aluminium-500 transition-colors">
                <i class="fas fa-arrow-right text-sm"></i>
            </div>
        </a>
        <div class="stat-card bg-white rounded-2xl shadow-sm border border-aluminium-200 p-5 md:p-6 flex items-center gap-4 cursor-default">
            <div class="stat-icon w-12 h-12 rounded-2xl bg-gradient-to-br from-green-50 to-green-100/80 flex items-center justify-center text-green-600 text-xl shrink-0">
                <i class="fas fa-globe"></i>
            </div>
            <div class="min-w-0">
                <p class="text-[11px] text-aluminium-400 font-medium tracking-wider uppercase">Pengunjung Website</p>
                <p class="text-3xl font-bold text-aluminium-800 mt-0.5">{{ $stats['visitors_total'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 md:gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-5 md:p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-sm font-semibold text-aluminium-800 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-aluminium-500"></span>
                    Kunjungan 7 Hari Terakhir
                </h3>
            </div>
            <div class="relative">
                <canvas id="visitorChart" height="240"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-5 md:p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-sm font-semibold text-aluminium-800 flex items-center gap-2">
                    <i class="fas fa-fire text-aluminium-600"></i>
                    Produk Paling Sering Dilihat
                </h3>
                <span class="text-xs text-aluminium-400 bg-aluminium-50 px-2.5 py-1 rounded-lg font-medium">Top 5</span>
            </div>
            @if(isset($topProducts) && count($topProducts))
                <div class="space-y-2">
                    @foreach($topProducts as $i => $item)
                        @php
                            $rankColors = ['text-yellow-500', 'text-aluminium-400', 'text-amber-600', 'text-aluminium-300', 'text-aluminium-300'];
                            $rankIcons = ['fa-trophy', 'fa-medal', 'fa-medal', 'fa-circle', 'fa-circle'];
                        @endphp
                        <div class="flex items-center justify-between py-2.5 px-3 rounded-xl {{ !$loop->last ? 'border-b border-aluminium-100' : '' }} hover:bg-aluminium-50/50 transition-colors">
                            <div class="flex items-center gap-3 min-w-0 flex-1">
                                <span class="text-sm {{ $rankColors[$i] ?? 'text-aluminium-300' }} w-5 shrink-0 text-center">
                                    <i class="fas {{ $rankIcons[$i] ?? 'fa-circle' }}"></i>
                                </span>
                                @if ($item->image)
                                    <img src="{{ $item->image }}" alt="{{ $item->name }}" class="w-9 h-9 rounded-lg object-cover shrink-0">
                                @else
                                    <div class="w-9 h-9 rounded-lg bg-aluminium-50 flex items-center justify-center text-aluminium-300 shrink-0 border border-aluminium-100">
                                        <i class="fas fa-box text-sm"></i>
                                    </div>
                                @endif
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-medium text-aluminium-700 truncate">{{ $item->name }}</p>
                                    <div class="flex items-center gap-1.5 mt-1">
                                        <div class="flex-1 h-1.5 bg-aluminium-100 rounded-full overflow-hidden max-w-[100px]">
                                            <div class="h-full rounded-full bg-aluminium-500/60" style="width: {{ min(100, ($item->total / max($topProducts[0]->total, 1)) * 100) }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-aluminium-50 text-aluminium-700 shrink-0 ml-3">
                                <i class="fas fa-eye text-[10px]"></i>
                                {{ $item->total }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12 text-aluminium-300">
                    <i class="fas fa-chart-line text-3xl mb-3"></i>
                    <p class="text-sm text-aluminium-400">Belum ada data kunjungan produk</p>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-aluminium-200 p-5 md:p-6">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-sm font-semibold text-aluminium-800 flex items-center gap-2">
                <i class="fas fa-envelope text-aluminium-600"></i>
                Pesan Masuk Terbaru
            </h3>
            <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-aluminium-600 hover:text-aluminium-700 transition-colors">
                Lihat Semua
                <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
        @if(isset($recentMessages) && $recentMessages->count())
            <div class="space-y-1">
                @foreach($recentMessages->take(5) as $message)
                    <a href="{{ route('admin.messages.show', $message) }}"
                       class="flex items-center gap-4 py-3 px-4 rounded-xl {{ !$loop->last ? 'border-b border-aluminium-100' : '' }} hover:bg-aluminium-50/70 transition-colors group">
                        <div class="w-9 h-9 rounded-full {{ $message->is_read ? 'bg-aluminium-100' : 'bg-aluminium-100' }} flex items-center justify-center shrink-0">
                            <i class="fas fa-user text-sm {{ $message->is_read ? 'text-aluminium-400' : 'text-aluminium-700' }}"></i>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-aluminium-800">{{ $message->name }}</span>
                                @if(!$message->is_read)
                                    <span class="w-1.5 h-1.5 rounded-full bg-aluminium-500 shrink-0"></span>
                                @endif
                            </div>
                            <p class="text-xs text-aluminium-400 truncate mt-0.5">{{ $message->subject ?? 'Tidak ada subjek' }}</p>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-xs text-aluminium-400">{{ $message->created_at ? $message->created_at->diffForHumans() : '-' }}</p>
                            <span class="text-aluminium-600 opacity-0 group-hover:opacity-100 transition-opacity text-xs inline-flex items-center gap-1 mt-0.5">
                                Baca <i class="fas fa-arrow-right text-[10px]"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-12 text-aluminium-300">
                <i class="fas fa-inbox text-3xl mb-3"></i>
                <p class="text-sm text-aluminium-400">Belum ada pesan masuk</p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var rawLabels = {!! json_encode(($visitorChart ?? collect())->keys()->toArray()) !!};
        var data = {!! json_encode(($visitorChart ?? collect())->values()->toArray()) !!};

        var days = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        var labels = rawLabels.map(function(d) {
            var parts = d.split('-');
            var date = new Date(parts[0], parts[1] - 1, parts[2]);
            return days[date.getDay()] + ', ' + parseInt(parts[2]) + ' ' + months[parseInt(parts[1]) - 1];
        });

        var ctx = document.getElementById('visitorChart').getContext('2d');
        var gradient = ctx.createLinearGradient(0, 0, 0, 240);
        gradient.addColorStop(0, 'rgba(100, 116, 139, 0.25)');
        gradient.addColorStop(1, 'rgba(100, 116, 139, 0.01)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Kunjungan',
                    data: data,
                    borderColor: '#64748b',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.35,
                    pointBackgroundColor: '#64748b',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: '#475569',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: { size: 12, weight: '600' },
                        bodyFont: { size: 15, weight: 'bold' },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' kunjungan';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#94a3b8',
                            font: { size: 11 },
                            padding: 8
                        },
                        grid: { color: '#f1f5f9', drawBorder: false }
                    },
                    x: {
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 11 },
                            maxTicksLimit: 7,
                            maxRotation: 0
                        },
                        grid: { display: false }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                animation: {
                    duration: 800,
                    easing: 'easeOutQuart',
                }
            }
        });
    });
</script>
@endpush
