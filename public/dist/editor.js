(function(){

window.history.replaceState(null, null, window.location.href);

const textarea = document.querySelector('textarea');

textarea.addEventListener('keydown', event => {
    if(event.keyCode === 9) {
        event.preventDefault();

        textarea.setRangeText(
            '    ',
            textarea.selectionStart,
            textarea.selectionStart,
            'end'
        );
    }
});

textarea.addEventListener('input', () => {
    textarea.style.height = '5px';
    textarea.style.height = textarea.scrollHeight + 2 + 'px';
});

window.addEventListener('DOMContentLoaded', () => {
    textarea.style.height = '5px';
    textarea.style.height = textarea.scrollHeight + 2 + 'px';
});

})();