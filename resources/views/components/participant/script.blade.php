<script>
const $participants = document.getElementsByName('participant_id');
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
</script>
