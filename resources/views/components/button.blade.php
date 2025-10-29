@php
    // map sizes to padding/text classes
    $sizeClasses = match($size) {
        'sm' => 'px-3 py-1 text-sm',
        'lg' => 'px-6 py-3 text-lg',
        default => 'px-4 py-2 text-base'
    };

    $baseClasses = "inline-flex items-center justify-center font-semibold rounded-md transition-transform duration-150 ease-in-out {$sizeClasses} " . ($extra ?? '');
@endphp

@switch($type)
    @case('primary')
        @php $typeClasses = 'bg-blue-600 text-white hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600'; @endphp
        @break

    @case('secondary')
        @php $typeClasses = 'bg-gray-100 text-gray-800 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600'; @endphp
        @break

    @case('danger')
        @php $typeClasses = 'bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800'; @endphp
        @break

    @default
        @php $typeClasses = 'bg-gray-100 text-gray-800 hover:bg-gray-200'; @endphp
@endswitch

{{-- If href is provided and not empty -> render <a>, otherwise render <button type="submit"> --}}
@if (!is_null($href) && $href !== '')
    <a href="{{ $href }}" class="{{ $baseClasses }} {{ $typeClasses }}">
        @if($icon)
            <i class="{{ $icon }} mr-2"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="submit" class="{{ $baseClasses }} {{ $typeClasses }}">
        @if($icon)
            <i class="{{ $icon }} mr-2"></i>
        @endif
        {{ $slot }}
    </button>
@endif
