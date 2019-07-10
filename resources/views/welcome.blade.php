@extends('layouts.app')

@section('style')
    @include('components.snackbar.style')
@endsection

@section('content')
    @if (!empty($event))
        @include('components.event.detail', [
            'event' => $event,
            'topics' => $topics
        ])

        <div class="flex flex-col items-end fixed z-1000" style="bottom: 24px; right: 24px;">
            @include('components.fab-action', [
                'event' => $event
            ])
            <button type="button" id="shareBtn" class="relative rounded-full shadow border bg-white hover:bg-gray-100 text-gray-800 border-gray-400 p-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fill-current w-5 h-5">
                    <path d="M352 320c-22.608 0-43.387 7.819-59.79 20.895l-102.486-64.054a96.551 96.551 0 0 0 0-41.683l102.486-64.054C308.613 184.181 329.392 192 352 192c53.019 0 96-42.981 96-96S405.019 0 352 0s-96 42.981-96 96c0 7.158.79 14.13 2.276 20.841L155.79 180.895C139.387 167.819 118.608 160 96 160c-53.019 0-96 42.981-96 96s42.981 96 96 96c22.608 0 43.387-7.819 59.79-20.895l102.486 64.054A96.301 96.301 0 0 0 256 416c0 53.019 42.981 96 96 96s96-42.981 96-96-42.981-96-96-96z"/>
                </svg>
            </button>
        </div>
    @endif

    {{-- Snackbar --}}
    <div id="snackbar"></div>
@endsection

@section('script')
<script>
const title = document.getElementById('eventTitle').textContent.trim();
const text = document.getElementById('eventDesc').textContent.trim();
const url = document.querySelector('link[rel=canonical]') && document.querySelector('link[rel=canonical]').href || window.location.href;
const $shareBtn = document.getElementById('shareBtn');
if ($shareBtn !== null) {
    $shareBtn.addEventListener('click', () => {
        if (navigator.share) {
            navigator.share({
                title,
                text,
                url
            })
            .then(() => {
                if (window.ga && ga.create) {
                    ga('send', 'event', 'Button', 'share', 'Share Event PHPBali');
                }
                console.log('Successful share');
            })
            .catch((error) => {
                console.log('Error sharing', error);
            })
        } else {
            console.log('Not supported, sorry');
        }
    });
}
</script>
    @if (!empty($event))
        @include('components.participant.script', [
            'event' => $event
        ])
    @endif
@endsection
