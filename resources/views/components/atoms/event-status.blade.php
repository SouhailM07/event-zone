@props(['status'=>"hello"])
@php
    // Define color classes for each status
    $statusClasses = [
        'pending'  => 'bg-yellow-100 text-yellow-800',
        'approved' => 'bg-green-100 text-green-800',
        'rejected' => 'bg-red-100 text-red-800',
    ];

    // Get class for the current status or default
    $classes = $statusClasses[$status] ?? 'bg-gray-100 text-gray-800';
@endphp

<span class="px-3 py-1 rounded-full text-sm font-semibold {{ $classes }}">
    {{ $status }}
</span>

