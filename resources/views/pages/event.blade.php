@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/snackbar.css') }}">
@endpush

@section('content')
    @if (!empty($event))
        <div class="my-16">
            <div class="text-center">
                <h1 class="text-3xl font-bold mb-4" id="eventTitle">
                    {{ $event->name }}
                </h1>

                <div class="my-4">
                    <div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">
                        <time>{{ $event->eventDate() }} {{ $event->eventTime() }}</time>
                    </div>
                    <address class="mt-2 text-gray-600 mx-4">
                        <strong>{{ $event->place_name }}</strong> . {{ $event->address }}
                    </address>
                </div>
            </div>

            <p class="text-justify break-words mx-4" id="eventDesc">{{ $event->desc }}</p>
        </div>

        <div class="my-8">
            <h1 class="text-3xl mb-4 text-center">TOPIK</h1>
            <hr class="my-8 border-b-2 border-gray-200 w-3/4 md:w-1/2 m-auto">

            <div class="flex flex-col items-center">
                @foreach ($topics as $topic)
                    @include('components.topic.card', [
                        'event' => $event,
                        'topic' => $topic
                    ])
                @endforeach
            </div>
        </div>

        <div class="my-16">
            <h1 class="text-3xl mb-4 text-center">PARTISIPAN</h1>
            <hr class="my-8 border-b-2 border-gray-200 w-3/4 md:w-1/2 m-auto">
            @if (auth()->check() && (auth()->user()->isStaff() || auth()->user()->isAdmin()))
                <div class="flex flex-col items-center">
                    <input type="text" id="participantFilter" class="shadow appearance-none border rounded w-3/4 p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Cari nama partisipan...">
                    @foreach ($event->reservations()->get()->sortByDesc('created_at') as $participant)
                        @include('components.participant.card', ['participant' => $participant])
                    @endforeach
                </div>
            @else
                {{-- Jika user telah mendaftar dan kegiatan belum berlangsung maka kalimatnya: "X orang telah mendaftar"
                Jika user telah hadir dan kegiatan sedang/sudah berlangsung maka kalimatnya: "X orang telah hadir" --}}
                @if ($event->isOngoing() || $event->hasFinished())
                    @if (empty($event->totalAttendance()))
                        <p class="text-center text-2xl font-bold m-8">Belum ada yang hadir. Cepat datang!</p>
                    @else
                        <div class="text-center my-8">
                            <p class="text-4xl font-bold">{{ $event->totalAttendance() }}</p>
                            <p>Orang telah hadir</p>
                        </div>
                    @endif
                @else
                    <div class="text-center my-8">
                        <p class="text-4xl font-bold">{{ $event->totalReservation() }}</p>
                        <p>Orang telah mendaftar</p>
                    </div>
                    {{-- Cek apakah user sudah mendaftar atau belum --}}
                    @if (auth()->check())
                        @if ($event->reservations()->where('user_id', auth()->user()->id)->get()->isEmpty())
                            <h2 class="text-2xl text-center mt-8">Silahkan daftar di sini!</h2>
                            {{-- Tampilkan form ini jika kegiatan belum berlangsung --}}
                            <div class="flex flex-col items-center m-4">
                                <form action="{{ $event->path() . "/register" }}" method="POST">
                                    <input type="hidden" name="_method" value="PUT">
                                    @csrf
                                    <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mb-4">Daftar</button>
                                </div>
                            </div>
                        @endif
                    @else
                        <h2 class="text-2xl text-center mt-8">Silahkan daftar di sini!</h2>
                        {{-- Tampilkan form ini jika kegiatan belum berlangsung --}}
                        <div class="flex flex-col items-center m-4">
                            <a href="/register/github" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mb-4">Login with Github</a>
                        </div>
                    @endif
                @endif
            @endif
        </div>

        <div class="flex flex-col items-end fixed z-1000" style="bottom: 24px; right: 24px;">
            @if (!$event->hasFinished())
                @if (auth()->check())
                    @if (auth()->user()->isAdmin())
                        <a href="{{ $event->path() . "/edit" }}" class="relative rounded-full shadow border bg-white hover:bg-gray-100 text-gray-800 border-gray-400 py-4 px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="fill-current w-5 h-5"><path d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/></svg>
                        </a>
                        <a href="{{ $event->path() . "/topics/create" }}" class="relative rounded-full shadow border bg-white hover:bg-gray-100 text-gray-800 border-gray-400 py-4 px-4 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="fill-current w-5 h-5">
                                <path d="M48 48a48 48 0 1 0 48 48 48 48 0 0 0-48-48zm0 160a48 48 0 1 0 48 48 48 48 0 0 0-48-48zm0 160a48 48 0 1 0 48 48 48 48 0 0 0-48-48zm448 16H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H176a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h320a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"/>
                            </svg>
                        </a>
                    @endif
                    @if (auth()->user()->isAdmin() || auth()->user()->isStaff())
                        <a href="{{ $event->path() . "/attendees/create" }}" class="relative rounded-full shadow border bg-white hover:bg-gray-100 text-gray-800 border-gray-400 py-4 px-4 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="fill-current w-5 h-5"><path d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64-64 28.7-64 64 28.7 64 64 64zm32 32h-64c-17.6 0-33.5 7.1-45.1 18.6 40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64zm-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32 208 82.1 208 144s50.1 112 112 112zm76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2zm-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4z"/></svg>
                        </a>
                    @endif
                @endif
            @endif

            <button type="button" id="shareBtn" class="relative rounded-full shadow border bg-white hover:bg-gray-100 text-gray-800 border-gray-400 p-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fill-current w-5 h-5">
                    <path d="M352 320c-22.608 0-43.387 7.819-59.79 20.895l-102.486-64.054a96.551 96.551 0 0 0 0-41.683l102.486-64.054C308.613 184.181 329.392 192 352 192c53.019 0 96-42.981 96-96S405.019 0 352 0s-96 42.981-96 96c0 7.158.79 14.13 2.276 20.841L155.79 180.895C139.387 167.819 118.608 160 96 160c-53.019 0-96 42.981-96 96s42.981 96 96 96c22.608 0 43.387-7.819 59.79-20.895l102.486 64.054A96.301 96.301 0 0 0 256 416c0 53.019 42.981 96 96 96s96-42.981 96-96-42.981-96-96-96z"/>
                </svg>
            </button>
        </div>
    @endif

    {{-- Snackbar --}}
    <div id="snackbar"></div>

    @include('components.modal')
@endsection

@push('script')
<script>
document.onreadystatechange = function() {
    if (document.readyState === 'complete') {
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

        @if (!empty($event))
        const $participants = document.getElementsByName('participant_id');
        const $participantFilter = document.getElementById('participantFilter');

        if ($participants !== null) {
            $participants.forEach( ($participant) => {
                $participant.addEventListener('click', (e) => {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const url = '{{ $event->path().'/attendees/attendance' }}';
                    if (e.target.checked) {
                        const PRESENT = 1;
                        fetch(url, {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json, text-plain, */*",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": token
                            },
                            method: 'POST',
                            credentials: 'same-origin',
                            body: JSON.stringify({
                                has_attended: PRESENT,
                                participant_id: e.target.value
                            })
                        })
                        .then( response => {
                            return response.json()
                        })
                        .then( data => {
                            const $snackbar = document.getElementById('snackbar');
                            $snackbar.textContent = data.message;
                            $snackbar.className = "show";
                            setTimeout( () => {
                                $snackbar.className = $snackbar.className.replace("show", "");
                            }, 3000);
                            console.log(data)
                        })
                        .catch( error => {
                            console.error(error)
                        });
                    } else {
                        const NOT_PRESENT = 0;
                        fetch(url, {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json, text-plain, */*",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": token
                            },
                            method: 'POST',
                            credentials: 'same-origin',
                            body: JSON.stringify({
                                has_attended: NOT_PRESENT,
                                participant_id: e.target.value
                            })
                        })
                        .then( response => {
                            return response.json()
                        })
                        .then( data => {
                            const $snackbar = document.getElementById('snackbar');
                            $snackbar.textContent = data.message;
                            $snackbar.className = "show";
                            setTimeout( () => {
                                $snackbar.className = $snackbar.className.replace("show", "");
                            }, 3000);
                            console.log(data)
                        })
                        .catch( error => {
                            console.error(error)
                        });
                    }
                })
            })
        }

        if ($participantFilter !== null) {
            $participantFilter.addEventListener('keyup', (e) => {
                const filter = e.target.value.toUpperCase();

                $participantIdentity = document.querySelectorAll('.participant__identity');
                for (var i = 0; i < $participantIdentity.length; i++) {
                    const name = $participantIdentity[i].querySelector('.participant__name').textContent.trim();
                    if (name.toUpperCase().indexOf(filter) > -1) {
                        $participantIdentity[i].style.display = "";
                    } else {
                        $participantIdentity[i].style.display = "none";
                    }
                }
            });
        }
        @endif

        const $deleteTopicBtn = document.querySelectorAll('.delete__topic');
        if ($deleteTopicBtn !== null) {
            $deleteTopicBtn.forEach( ($deleteBtn) => {
                $deleteBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    document.body.style.overflow = "hidden";
                    document.querySelector('div.menu-underlay').style.display = "block";
                    const $warningDialog = document.getElementById('warningDialog');
                    const $warningDialogCloseBtn = document.getElementById('warningDialogCloseBtn');
                    const $warningDialogConfirmBtn = document.getElementById('warningDialogConfirmBtn');
                    const $warningDialogCancelBtn = document.getElementById('warningDialogCancelBtn');
                    const $warningDialogTitle = document.getElementById('warningDialogTitle');
                    const $warningDialogMessage = document.getElementById('warningDialogMessage')
                    $warningDialog.classList.remove('hidden');
                    $warningDialog.classList.add('block');
                    $warningDialog.style.zIndex = 1;
                    $warningDialogTitle.textContent = `Menghapus Topik?`;
                    $warningDialogMessage.textContent = `Anda akan menghapus topik dengan judul ${$deleteBtn.getAttribute('data-title')} dan tidak dapat dikembalikan lagi. Anda yakin?`;
                    $warningDialogCloseBtn.addEventListener('click', (e) => {
                        $warningDialog.classList.remove('block');
                        $warningDialog.classList.add('hidden');
                    });
                    window.onclick = (e) => {
                        if (e.target === $warningDialog) {
                            $warningDialog.classList.remove('block');
                            $warningDialog.classList.add('hidden');
                        }
                    }
                    $warningDialogCancelBtn.addEventListener('click', (e) => {
                        document.body.style.overflow = "visible";
                        document.querySelector('div.menu-underlay').style.display = "none";
                        $warningDialog.style.zIndex = "auto";
                        $warningDialog.classList.remove('block');
                        $warningDialog.classList.add('hidden');
                    });
                    $warningDialogConfirmBtn.addEventListener('click', (e) => {
                        fetch(
                        $deleteBtn.getAttribute('data-href'), {
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
                                $warningDialog.classList.remove('block');
                                $warningDialog.classList.add('hidden');
                                const $snackbar = document.getElementById('snackbar');
                                $snackbar.textContent = data.message;
                                $snackbar.className = "show";
                                setTimeout( () => {
                                    $snackbar.className = $snackbar.className.replace("show", "");
                                }, 2000);
                                setTimeout( () => {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                $warningDialog.classList.remove('block');
                                $warningDialog.classList.add('hidden');
                                const $snackbar = document.getElementById('snackbar');
                                $snackbar.textContent = data.message;
                                $snackbar.className = "show";
                                setTimeout( () => {
                                    $snackbar.className = $snackbar.className.replace("show", "");
                                }, 2000);
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        })
                    })
                });
            });
        }
    }
}
</script>
<script src="{{ asset('js/lazy-avatar.js') }}" defer></script>
@endpush
