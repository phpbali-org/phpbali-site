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
    $dialogWindow.querySelector('#dialog__title').textContent = el.dataset.dialogTitle;
    // Set body of dialog
    $dialogWindow.querySelector('#dialog__body').textContent = el.dataset.dialogBody;
    $dialogConfirmBtn.addEventListener('click', () => {
        fetch(el.dataset.href, {
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
                const notyf = new Notyf({
                    position: {
                        x: 'center',
                        y: 'bottom'
                    }
                });
                notyf.success(data.message);
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