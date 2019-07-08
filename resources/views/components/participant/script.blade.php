<script>
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
</script>
