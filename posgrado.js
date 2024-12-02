document.querySelectorAll('.btnMostrarMas').forEach(button => {
    button.addEventListener('click', function() {
        this.closest('.apartadoGrado').classList.toggle('open');
    });
});
