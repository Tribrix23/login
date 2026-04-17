//Routing
function route(page) {
    window.location.href = `proxy.php?page=${page}`;
}

//Checking Password
document.addEventListener('DOMContentLoaded', () => {
    console.log('Script loaded');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const alertMessage = document.getElementById('passwordMatch');
    const first_name = document.getElementById('first_name');
    const last_name = document.getElementById('last_name');
    const email = document.getElementById('email');

    confirmPassword.addEventListener('input', () => {
        const cP = confirmPassword.value;
        const p = password.value;

        if (cP !== p) {
            alertMessage.classList.remove('hidden');
        } else {
            alertMessage.classList.add('hidden');
        }
    })



    //Register
    document.getElementById('registerForm').addEventListener('submit', async (e) => {
    e.preventDefault();
        const cP = confirmPassword.value;
        const p = password.value;
        const fname = first_name.value;
        const lname = last_name.value;
        const em = email.value;

        if (cP !== p) {
            return
        }

        try {

            const res = await fetch ("proxy.php?page=reg", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                first_name: fname,
                last_name: lname,
                email: em,
                password: p
                })
            })

            const text = await res.text();
            console.log('Response status:', res.status);
            console.log('Response text:', text);
            
            const data = JSON.parse(text);

            console.log(data);
        } catch (err) {
            console.error("Request failed:", err);
        }
    })

    //Login
});
