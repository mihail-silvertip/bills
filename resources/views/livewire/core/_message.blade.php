@if (session()->has('message'))
    <div class="bg-red-100 border border-red-400 text-green-700 px-4 py-3 rounded relative"
        role="alert">
        <div class="flex">
            <div>
                <p class="text-sm">{{ session('message') }}</p>
            </div>
        </div>
    </div>
@endif