document.addEventListener('DOMContentLoaded', async(e) => {
    e.preventDefault();

    const userName = document.getElementById('userName');

    const res = await fetch("proxy.php?page=profile", {
        credentials: 'include'
    })

    const data = await res.json();

    const user = data[0];

    userName.textContent = `${user.first_name} ${user.last_name}`;
})