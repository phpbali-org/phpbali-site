@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/snackbar.css') }}">
@endsection

@section('content')
    <h1 class="text-3xl text-center mt-4">PENGGUNA</h1>
    <hr class="my-8 border-b-2 border-gray-200 w-3/4 md:w-1/2">
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

    <div class="flex flex-col align-end fixed z-1000" style="bottom: 24px; right: 24px;">
        <a href="users/create" class="relative rounded-full shadow border bg-white hover:bg-gray-100 text-gray-800 border-gray-400 py-4 px-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fill-current w-5 h-5">
                <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
            </svg>
        </a>
    </div>

    {{-- Snackbar --}}
    <div id="snackbar"></div>

    @include('components.modal.modal')
@endsection

@section('script')
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
    console.log(filter);

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

const $deleteUserBtn = document.querySelectorAll('.delete__user');
if ($deleteUserBtn !== null) {
    $deleteUserBtn.forEach( ($deleteBtn) => {
        $deleteBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const $warningDialog = document.getElementById('warningDialog');
            const $warningDialogCloseBtn = document.getElementById('warningDialogCloseBtn');
            const $warningDialogConfirmBtn = document.getElementById('warningDialogConfirmBtn');
            const $warningDialogCancelBtn = document.getElementById('warningDialogCancelBtn');
            const $warningDialogTitle = document.getElementById('warningDialogTitle');
            const $warningDialogMessage = document.getElementById('warningDialogMessage')
            $warningDialog.classList.remove('hidden');
            $warningDialog.classList.add('block');
            $warningDialogTitle.textContent = `Menghapus User?`;
            $warningDialogMessage.textContent = `Anda akan menghapus user bernama ${$deleteBtn.getAttribute('data-name')} dan tidak dapat dikembalikan lagi. Anda yakin?`;
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
</script>
@endsection
