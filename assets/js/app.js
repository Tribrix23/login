// Routing
function route(page) {
    window.location.href = `proxy.php?page=${page}`;
}

// Toast Notification System
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    
    const colors = {
        success: 'bg-green-500',
        error: 'bg-red-500',
        warning: 'bg-yellow-500',
        info: 'bg-blue-500'
    };
    
    const icons = {
        success: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>',
        error: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
        warning: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>',
        info: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
    };
    
    toast.className = `flex items-center gap-3 px-4 py-3 rounded-lg shadow-lg text-white ${colors[type]} transform transition-all duration-300 translate-x-96`;
    toast.innerHTML = `
        <div class="flex-shrink-0">${icons[type]}</div>
        <div class="flex-1 text-sm font-medium">${message}</div>
    `;
    
    container.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-96');
    }, 10);
    
    // Auto dismiss
    setTimeout(() => {
        toast.classList.add('translate-x-96', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}

// Show Loading Overlay
function showLoading() {
    let overlay = document.getElementById('loading-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'loading-overlay';
        overlay.className = 'fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center';
        overlay.innerHTML = `
            <div class="bg-white rounded-xl p-8 flex flex-col items-center gap-4 shadow-2xl">
                <div class="w-12 h-12 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"></div>
                <p class="text-gray-700 font-medium">Creating your account...</p>
            </div>
        `;
        document.body.appendChild(overlay);
    }
}

// Hide Loading Overlay
function hideLoading() {
    const overlay = document.getElementById('loading-overlay');
    if (overlay) {
        overlay.remove();
    }
}

// Set Button Loading State
function setButtonLoading(button, loading) {
    if (loading) {
        button.dataset.originalText = button.innerHTML;
        button.innerHTML = `
            <div class="flex items-center justify-center gap-2">
                <div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                <span>Creating Account...</span>
            </div>
        `;
        button.disabled = true;
        button.classList.add('opacity-70', 'cursor-not-allowed');
    } else {
        button.innerHTML = button.dataset.originalText;
        button.disabled = false;
        button.classList.remove('opacity-70', 'cursor-not-allowed');
    }
}

// Document Ready
document.addEventListener('DOMContentLoaded', async() => {
    console.log('Script loaded');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const alertMessage = document.getElementById('passwordMatch');
    const first_name = document.getElementById('first_name');
    const last_name = document.getElementById('last_name');
    const email = document.getElementById('email');
    const registerButton = document.querySelector('button[type="submit"]');

    // Password matching
    confirmPassword.addEventListener('input', () => {
        const cP = confirmPassword.value;
        const p = password.value;
        if (cP !== p) {
            alertMessage.classList.remove('hidden');
        } else {
            alertMessage.classList.add('hidden');
        }
    });

    // Sessions
    const res = await fetch("proxy.php?page=session", {
    credentials: "include"
    });

    const data = await res.json();

    if (data.loggedIn) {
        console.log("User is logged in:", data.user_id);
        router("home");
    } else {
        console.log("No session found");
        window.location.href = '/';
    }

    // Registration
    document.getElementById('registerForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const cP = confirmPassword.value;
        const p = password.value;
        const fname = first_name.value;
        const lname = last_name.value;
        const em = email.value;

        if (cP !== p) {
            showToast('Passwords do not match', 'error');
            return;
        }

        // Show loading state
        showLoading();
        setButtonLoading(registerButton, true);

        try {
            const res = await fetch("proxy.php?page=reg", {
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
            });

            const text = await res.text();
            console.log('Response status:', res.status);
            console.log('Response text:', text);
            
            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                data = { success: false, message: 'Invalid response from server' };
            }

            console.log(data);

            if (data.success) {
                showToast('✓ ' + data.message, 'success');
                // Reset form after success
                setTimeout(() => {
                    document.getElementById('registerForm').reset();
                    route('login');
                }, 2000);
            } else {
                const errorMsg = data.message || 'Registration failed. Please try again.';
                
                if (errorMsg.toLowerCase().includes('already exists') || errorMsg.toLowerCase().includes('already registered')) {
                    showToast('✗ This email is already registered', 'error');
                } else {
                    showToast('✗ ' + errorMsg, 'error');
                }
            }
        } catch (err) {
            console.error("Request failed:", err);
            showToast('Network error. Please check your connection and try again.', 'error');
        } finally {
            hideLoading();
            setButtonLoading(registerButton, false);
        }
    });

    // Login 
    document.getElementById('loginForm').addEventListener('submit', async(e) => {
        e.preventDefault();

        em = email.value;
        pass = password.value;

        try {
            const res = await fetch("proxy.php?page=log", {
                method: 'POST',
                credentials: 'include',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: em,
                    password: pass
                })
            })

            const data = await res.json();

            if(data.sucess) {
                route()
            }

        } catch (err) {
            console.error(err)
        }

    })


});
