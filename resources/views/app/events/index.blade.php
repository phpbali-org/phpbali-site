@extends('layouts.app')

@section('content')
    <h1 class="text-center text-3xl mt-4">DAFTAR KEGIATAN</h1>
    <hr class="my-8 border-b-2 border-gray-200 w-3/4 md:w-1/2">
    @foreach ($events as $event)
        @include('components.event.card', ['event' => $event])
    @endforeach

    @if (auth()->check() && auth()->user()->isAdmin())
        <div class="flex flex-col align-end fixed z-1000" style="bottom: 24px; right: 24px;">
            <a href="events/create" class="relative rounded-full shadow border bg-white hover:bg-gray-100 text-gray-800 border-gray-400 py-4 px-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fill-current w-5 h-5">
                    <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                </svg>
            </a>
        </div>
    @endif
@endsection

@section('script')
<script>
const $deleteEventBtn = document.querySelectorAll('.delete__event');
$deleteEventBtn.forEach( ($deleteBtn) => {
    $deleteBtn.addEventListener('click', (e) => {
        e.preventDefault();
        fetch(e.target.getAttribute('data-href'), {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            method: 'DELETE',
            credentials: 'same-origin',
        })
        .then(response => {
            return response.json()
        })
        .then(data => {
            if (data.status === "ok") {
                window.location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error(error);
        })
    });
});
</script>
@endsection
