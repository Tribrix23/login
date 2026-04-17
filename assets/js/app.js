function route(page) {
    window.location.href = `proxy.php?page=${page}`;
}

document.addEventListener('DOMContentLoaded', () => {
    console.log('Script loaded');
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password');

    confirmPassword.addEventListener('input', () => {
        const cP = confirmPassword.value;

        if (cP !== password) {

        } else {

        }
    })
});