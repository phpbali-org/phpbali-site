@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/snackbar.css') }}">
@endpush

@section('content')
    <div class="my-16 md:w-1/2 m-auto">
        <h1 class="text-3xl text-center mt-4 font-bold">PENGGUNA</h1>
        <hr class="my-8 border-b-2 border-gray-300 w-1/2 m-auto">
        <div class="flex flex-col items-center">
            <input type="text" id="userFilter" class="shadow appearance-none border rounded w-3/4 p-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Cari nama pengguna...">
            <div class="inline-block relative w-3/4 mt-4">
                <select id="authorityFilter" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Akses pengguna</option>
                    <option value="1">Admin & staf</option>
                    <option value="2">Admin</option>
                    <option value="3">Staf</option>
                </select>
            </div>
            @foreach ($users as $user)
                @include('components.user.card', ['user' => $user])
            @endforeach
        </div>
    </div>

    <div class="flex flex-col align-end fixed z-1000" style="bottom: 24px; right: 24px;">
        <a href="users/create" class="relative rounded-full shadow border bg-white hover:bg-gray-100 text-gray-800 border-gray-400 py-4 px-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fill-current w-5 h-5">
                <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
            </svg>
        </a>
    </div>

    {{-- Snackbar --}}
    <div id="snackbar"></div>

    @include('components.modal')
@endsection

@push('script')
<script>
const $userFilter = document.getElementById('userFilter');
if ($userFilter !== null) {
    $userFilter.addEventListener('keyup', (e) => {
        const filter = e.target.value.toUpperCase();

        $userIdentity = document.querySelectorAll('.user__identity');
        for (var i = 0; i < $userIdentity.length; i++) {
            const name = $userIdentity[i].querySelector('.user__name').textContent.trim();
            if (name.toUpperCase().indexOf(filter) > -1) {
                $userIdentity[i].style.display = "";
            } else {
                $userIdentity[i].style.display = "none";
            }
        }
    });
}

const $authorityFilter = document.getElementById('authorityFilter');
$authorityFilter.onchange = (e) => {
    const filter = e.target.value;

    $userIdentity = document.querySelectorAll('.user__identity');
    for (var i = 0; i < $userIdentity.length; i++) {
        const value = $userIdentity[i].querySelector('.user__authority').textContent.trim();
        if (value.indexOf(filter) > -1) {
            $userIdentity[i].style.display = "";
        } else {
            $userIdentity[i].style.display = "none";
        }
    }
}

const KEYCODE = {
    ESC: 27
}
const $dialog = document.querySelector('.dialog');
const $dialogWindow = $dialog.querySelector('.dialog__window');
const $dialogConfirmBtn = $dialogWindow.querySelector('#dialog__confirm__btn');
const $dialogCancelBtn = $dialogWindow.querySelector('#dialog__cancel__btn');
const $dialogMask = $dialog.querySelector('.dialog__mask');
let $previousActiveElement;

const deleteBtn = document.querySelectorAll('.delete__btn');
deleteBtn.forEach( ($btn) => {
    $btn.addEventListener('click', (e) => {
        openDialog(e, $btn);
    });
});

trapFocus($dialogWindow);

function openDialog(e, el) {
    // Grab a reference to the previous activeElement.
    // We'll want to restore this when we close the dialog.
    $previousActiveElement = document.activeElement;

    // Make the dialog visible.
    $dialog.classList.add('opened');
    // Hide scrolling body element
    document.body.style.overflow = "hidden";
    // Set title of dialog
    $dialogWindow.querySelector('#dialog__title').textContent = 'Menghapus user?';
    // Set body of dialog
    $dialogWindow.querySelector('#dialog__body').textContent = `
        Anda akan menghapus ${el.getAttribute('data-name')} dan tidak dapat dikembalikan lagi. Anda yakin?
    `;
    $dialogConfirmBtn.addEventListener('click', () => {
        fetch(
            el.getAttribute('data-href'), {
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
                closeDialog();
                const $snackbar = document.getElementById('snackbar');
                $snackbar.textContent = data.message;
                $snackbar.className = "show";
                setTimeout( () => {
                    $snackbar.className = $snackbar.className.replace("show", "");
                }, 2000);
                if (data.status === "ok") {
                    setTimeout( () => {
                        window.location.reload();
                    }, 500);
                }
            })
            .catch(error => {
                console.error(error);
            });
    });

    // Listen for things that should close the dialog
    $dialogMask.addEventListener('click', closeDialog);
    $dialogCancelBtn.addEventListener('click', closeDialog);
    document.addEventListener('keydown', checkCloseDialog);

    // Finally, move focus into the first button of dialog.
    $dialog.querySelector('button').focus();
}

function checkCloseDialog(e) {
    if (e.keyCode === KEYCODE.ESC || e.key === 'Escape') {
        closeDialog();
    }
}

function closeDialog() {
    // Clean up any event listeners.
    $dialogMask.removeEventListener('click', closeDialog);
    $dialogCancelBtn.removeEventListener('click', closeDialog);
    document.removeEventListener('keydown', checkCloseDialog);

    // Remove Hide the dialog.
    $dialog.classList.remove('opened');
    // Remove Hide scrolling body element
    document.body.style.overflow = "visible";
    // Set title of dialog
    $dialogWindow.querySelector('#dialog__title').textContent = '';
    // Set body of dialog
    $dialogWindow.querySelector('#dialog__body').textContent = '';

    // Restore focus to the previous active element.
    $previousActiveElement.focus();
}

function trapFocus(element) {
    const focusableEls = element.querySelectorAll('a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), input[type="radio"]:not([disabled]), input[type="checkbox"]:not([disabled]), select:not([disabled])');
    const $firstFocusableEl = focusableEls[0];
    const $lastFocusableEl = focusableEls[focusableEls.length - 1];
    const KEYCODE_TAB = 9;

    element.addEventListener('keydown', (e) => {
        const isTabPressed = (e.key === 'Tab' || e.keyCode === KEYCODE_TAB);

        if (!isTabPressed) {
            return;
        }

        if (e.shiftKey) { /* shift + tab */
            if (document.activeElement === $firstFocusableEl) {
                $lastFocusableEl.focus();
                e.preventDefault();
            }
        } else /* tab */ {
            if (document.activeElement === $lastFocusableEl) {
                $firstFocusableEl.focus();
                e.preventDefault();
            }
        }
    });
}
</script>
<script src="{{ asset('js/lazy-avatar.js') }}"></script>
@endpush
