<div id="warningDialog" role="dialog" class="hidden rounded fixed z-1 pt-32 inset-0 w-full h-screen overflow-auto" style="background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4);">
    <div class="modal__content rounded shadow m-auto p-5 w-4/5 md:w-2/5" style="border: 1px solid #888; background-color: #fefefe;">
        <button class="text-gray-600 float-right text-2xl font-bold hover:text-black hover:no-underline focus:text-black focus:no-underline" id="warningDialogCloseBtn">&times;</button>
        <h3 id="warningDialogTitle" class="text-xl text-center font-bold mb-6"></h3>
        <p id="warningDialogMessage"></p>
        <div class="flex flex-col md:flex-row justify-between mt-6">
            <button type="button" id="warningDialogConfirmBtn" class="bg-red-600 hover:bg-red-500 text-white font-semibold py-2 px-8 md:px-12 border border-red-600 rounded shadow mb-6 md:mb-0">Ya</button>
            <button type="button" id="warningDialogCancelBtn" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-8 md:px-12 border border-gray-400 rounded shadow">Tidak</button>
        </div>
    </div>
</div>
