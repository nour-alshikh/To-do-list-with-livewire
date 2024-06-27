<div>
    @if (session('error'))
        <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
            <p class="font-bold">{{ session('error') }}</p>
            <p>Something not ideal might be happening.</p>
        </div>
    @endif

    @if (session('success_update'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
            <p class="font-bold">{{ session('success_update') }}</p>
            <p>Something not ideal might be happening.</p>
        </div>
        <span class="text-green-500 text-xs">{{ }}</span>
    @endif
    @include('livewire.partials._create-todo-box')

    @include('livewire.partials._search-box')

    @include('livewire.partials._todo-list')

</div>
