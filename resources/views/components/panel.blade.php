<div class="px-5 py-6 bg-gray-200 border border-gray-300 rounded-lg w-80">
    @if (isset($heading))
        <div class="font-bold text-lg mb-4">{{ $heading }}</div>
    @endif

    {{ $slot }}
</div>
