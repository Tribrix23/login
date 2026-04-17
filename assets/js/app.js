// Routing
function route(page) {
    window.location.href = `proxy.php?page=${page}`;
}

// Go Back
function goLogin() {
    window.location.href = `./proxy.php?page=login`;
}

// Toggle Password Visibility
function togglePassword(inputId, buttonId) {
    const input = document.getElementById(inputId);
    const button = document.getElementById(buttonId);
    if (input.type === 'password') {
        input.type = 'text';
        button.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
            </svg>
        `;
    } else {
        input.type = 'password';
        button.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        `;
    }
}

// Toast Notification System
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');
    if (!container) return;
    
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
    
    setTimeout(() => {
        toast.classList.remove('translate-x-96');
    }, 10);
    
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
                <p class="text-gray-700 font-medium">Loading...</p>
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
                <span>Loading...</span>
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
    
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const alertMessage = document.getElementById('passwordMatch');
    const firstName = document.getElementById('first_name');
    const lastName = document.getElementById('last_name');
    const email = document.getElementById('email');
    const registerButton = document.querySelector('button[type="submit"]');

    // Password matching (only on register page)
    if (confirmPassword && password && alertMessage) {
        confirmPassword.addEventListener('input', () => {
            if (confirmPassword.value !== password.value) {
                alertMessage.classList.remove('hidden');
            } else {
                alertMessage.classList.add('hidden');
            }
        });
    }

    // Session check
    try {
        const sessionRes = await fetch("proxy.php?page=session", {
            credentials: "include"
        });
        const text = await sessionRes.text();
        let sessionData;
        try {
            sessionData = JSON.parse(text);
        } catch(e) {
            sessionData = { loggedIn: false };
        }
        
        if (sessionData.loggedIn && !window.location.href.includes('page=home')) {
            route("home");
        }
    } catch (err) {
    }

    // Registration form
    const registerForm = document.getElementById('registerForm');
    if (registerForm && confirmPassword && firstName && lastName && email && registerButton) {
        registerForm.addEventListener('submit', async(e) => {
            e.preventDefault();
            
            const cP = confirmPassword.value;
            const p = password.value;
            const fname = firstName.value;
            const lname = lastName.value;
            const em = email.value;

            if (cP !== p) {
                showToast('Passwords do not match', 'error');
                return;
            }

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
                let data;
                try {
                    data = JSON.parse(text);
                } catch (e) {
                    data = { success: false, message: 'Invalid response from server' };
                }

                if (data.success) {
                    showToast('✓ ' + data.message, 'success');
                    setTimeout(() => {
                        document.getElementById('registerForm').reset();
                        route('login');
                    }, 2000);
                } else {
                    const errorMsg = data.message || 'Registration failed';
                    if (errorMsg.toLowerCase().includes('already')) {
                        showToast('✗ This email is already registered', 'error');
                    } else {
                        showToast('✗ ' + errorMsg, 'error');
                    }
                }
            } catch (err) {
                showToast('Network error. Please try again.', 'error');
            } finally {
                hideLoading();
                setButtonLoading(registerButton, false);
            }
        });
    }

    // Login form
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', async(e) => {
            e.preventDefault();

            const em = document.getElementById('email').value;
            const pass = document.getElementById('password').value;

            showLoading();

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
                });

                const text = await res.text();
                let data;
                try {
                    data = JSON.parse(text);
                } catch (e) {
                    data = { success: false, message: 'Invalid response from server' };
                }

                if (data.success) {
                    route('home');
                } else {
                    showToast('✗ ' + data.message, 'error');
                }
            } catch (err) {
            } finally {
                hideLoading();
            }
        });
    }

    //Forgot Password
    const ForgotPasswordForm = document.getElementById('FPForm');
    if(ForgotPasswordForm){
        ForgotPasswordForm.addEventListener('submit', async(e) => {
            e.preventDefault();

            const em = document.getElementById('email').value;

            try{

                const res = await fetch("proxy.php/page=FP", {
                    method: 'POST',
                    headers: ({
                        'Content-Type': 'application/json'
                    }),
                    body: JSON.stringify({email: em})
                })

                const data = await res.json();
                

            } catch (err) {}
            finally{

            }
        })
    }
});