@props(['status','reason'=>""])

@php
    switch($status) {
        case 'approved':
            $bg = 'bg-green-100';
            $text = 'text-green-800';
            $border = 'border-green-400';
            $icon = '✓';
            $label = 'Approved';
            break;
        case 'rejected':
            $bg = 'bg-red-100';
            $text = 'text-red-800';
            $border = 'border-red-400';
            $icon = '✗';
            $label = 'Rejected';
            break;
        case 'pending':
        default:
            $bg = 'bg-yellow-100';
            $text = 'text-yellow-800';
            $border = 'border-yellow-400';
            $icon = '…';
            $label = 'Pending';
            break;
    }
@endphp

<div class="flex items-center p-4 mb-4 text-sm font-semibold rounded-lg {{ $bg }} {{ $text }} border-l-4 {{ $border }}">
    <span class="mr-2">{{ $icon }}</span>
    <span>{{ $label }}</span>
</div>
