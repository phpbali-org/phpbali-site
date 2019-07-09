<script>
const $deleteTopicBtn = document.querySelectorAll('.delete__topic');
$deleteTopicBtn.forEach( ($deleteBtn) => {
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
