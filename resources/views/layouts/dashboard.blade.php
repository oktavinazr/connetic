@extends('layouts.dashboard')
@section('title', 'Dashboard — Connetic')

@section('styles')
    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-bottom: 32px;
        }

        .stat-card {
            padding: 20px;
        }

        .stat-label {
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 800;
            margin-top: 4px;
        }

        .stat-value .unit {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
        }

        /* Progress */
        .progress-section {
            padding: 24px;
            margin-bottom: 32px;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .progress-header span {
            font-size: 14px;
            font-weight: 600;
        }

        .progress-header small {
            font-size: 13px;
            color: var(--text-muted);
        }

        .bar-track {
            width: 100%;
            height: 10px;
            background: var(--pink-50);
            border-radius: 999px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--pink-400), var(--pink-600));
            border-radius: 999px;
            transition: width 1s ease;
        }

        /* Pertemuan */
        .section-label {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 14px;
        }

        .pertemuan-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .p-card {
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s;
            cursor: pointer;
        }

        .p-card:hover {
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            transform: translateY(-1px);
        }

        .p-num {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-weight: 800;
            font-size: 16px;
        }

        .p-num.done {
            background: linear-gradient(135deg, var(--pink-500), var(--pink-600));
            color: #fff;
        }

        .p-num.active {
            background: var(--pink-100);
            color: var(--pink-600);
        }

        .p-num.locked {
            background: #f3f4f6;
            color: #b0b5bf;
        }

        .p-info {
            flex: 1;
            min-width: 0;
        }

        .p-info h3 {
            font-size: 14px;
            font-weight: 600;
        }

        .p-info p {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .p-badge {
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .p-badge.done {
            background: #ecfdf5;
            color: #059669;
        }

        .p-badge.active {
            background: var(--pink-50);
            color: var(--pink-600);
        }

        .p-badge.locked {
            background: #f3f4f6;
            color: #9ca3af;
        }

        .p-arrow {
            color: #d1d5db;
            font-size: 16px;
            flex-shrink: 0;
        }

        @media (max-width: 700px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 420px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <div class="page-title">Dashboard</div>
    <div class="page-sub">Halo, {{ Auth::user()->profile?->full_name ?? 'User' }}! Pantau progres belajarmu.</div>

    <div class="stats-grid">
        <div class="card stat-card">
            <div class="stat-label">Pertemuan Selesai</div>
            <div class="stat-value">{{ $stats['pertemuan_selesai'] }}</div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">Aktivitas Selesai</div>
            <div class="stat-value">{{ $stats['aktivitas_selesai'] }}</div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">Rata-Rata Nilai</div>
            <div class="stat-value">{{ $stats['rata_nilai'] }} <span class="unit">/ 100</span></div>
        </div>
        <div class="card stat-card">
            <div class="stat-label">Progress Total</div>
            <div class="stat-value">{{ $stats['progress_total'] }}<span class="unit">%</span></div>
        </div>
    </div>

    <div class="card progress-section">
        <div class="progress-header">
            <span>Progress Keseluruhan</span>
            <small>{{ $stats['progress_total'] }}% selesai</small>
        </div>
        <div class="bar-track">
            <div class="bar-fill" style="width: {{ $stats['progress_total'] }}%"></div>
        </div>
    </div>

    <div class="section-label">Daftar Pertemuan</div>
    <div class="pertemuan-list">
        @foreach ($pertemuan as $item)
            <div class="card p-card" onclick="window.location='{{ route('pertemuan.show', $item['id']) }}'">
                <div
                    class="p-num {{ $item['status'] === 'selesai' ? 'done' : ($item['status'] === 'berlangsung' ? 'active' : 'locked') }}">
                    {{ $item['nomor'] }}
                </div>
                <div class="p-info">
                    <h3>Pertemuan {{ $item['nomor'] }}: {{ $item['judul'] }}</h3>
                    <p>{{ $item['deskripsi'] }}</p>
                </div>
                <div
                    class="p-badge {{ $item['status'] === 'selesai' ? 'done' : ($item['status'] === 'berlangsung' ? 'active' : 'locked') }}">
                    @if ($item['status'] === 'selesai')
                        Selesai
                    @elseif($item['status'] === 'berlangsung')
                        {{ $item['selesai'] }}/{{ $item['total'] }}
                    @else
                        Belum Mulai
                    @endif
                </div>
                <div class="p-arrow">›</div>
            </div>
        @endforeach

    </div>
@endsection