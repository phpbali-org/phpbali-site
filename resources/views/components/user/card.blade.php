<div class="rounded-lg overflow-hidden bg-white shadow p-4 m-4 w-3/4 user__identity">
    <div class="flex flex-col md:flex-row items-center">
        <div class="md:flex-shrink-0">
            <img data-src="{{ $user->avatar() }}" alt="Attendee's avatar" class="rounded-full m-4 md:w-16 max-w-xs" width="50">
        </div>
        <div class="flex flex-col md:ml-4 mt-4 md:mt-0 items-center md:items-start">
            <p class="user__name">
                {{ $user->name }}
            </p>
            <p class="text-gray-600 text-sm">
                {{ $user->email }}
            </p>
            @if ($user->isAdmin() && $user->isStaff())
                <p>Admin dan staf</p>
                <span hidden class="user__authority">1</span>
            @elseif ($user->isAdmin())
                <p>Admin</p>
                <span hidden class="user__authority">2</span>
            @elseif ($user->isStaff())
                <p>Staf</p>
                <span hidden class="user__authority">3</span>
            @else
                <span hidden class="user__authority">0</span>
            @endif
        </div>
    </div>
    @if (auth()->check() && auth()->user()->isAdmin())
        <div class="flex justify-end">
            @if (auth()->user()->id !== $user->id)
                <button type="button" data-href="{{ $user->path() }}" data-name="{{ $user->name }}" class="btn delete__btn">Hapus</button>
            @endif
            <a href="{{ route('user.edit', ['user' => $user]) }}" class="btn default__btn">Edit</a>
        </div>
    @endif
</div>
