<div {{ $attributes->merge(['class' => 'flex items-center gap-3']) }}>
    <img src="{{ asset('assets/images/Logo_balam.png') }}" alt="Logo Bandar Lampung" class="size-10 object-contain">
    <div>
        <h1 class="text-xl font-bold text-gray-900 dark:text-white leading-none">{{ $title ?? 'LAPIS' }}</h1>
        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium">{{ $subtitle ?? 'Disdukcapil Bandar Lampung' }}
        </p>
    </div>
</div>
