<x-guest-layout>
    <style>
        :root {
            --primary-color: #3f51b5;
            --secondary-color: #06a3c3;
            --accent-color: #ff6b6b;
            --text-color: #2d3748;
            --light-gray: #f7fafc;
        }


        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-out;
        }

        .auth-header {
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .auth-title {
            color: var(--primary-color);
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .auth-description {
            color: var(--text-color);
            font-size: 0.95rem;
            line-height: 1.5;
            opacity: 0.9;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-label {
            display: block;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .text-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: white;
        }

        .text-input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(6, 163, 195, 0.2);
        }

        .input-error {
            color: #e53e3e;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .auth-session-status {
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            background-color: #ebf8ff;
            color: #2b6cb0;
            border-radius: 8px;
            font-size: 0.95rem;
        }

        .primary-button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 0.875rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .primary-button:hover {
            background-color: #0594b0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .primary-button:active {
            transform: translateY(0);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .guest-container {
                padding: 1.5rem;
            }
            
            .auth-card {
                padding: 2rem 1.5rem;
            }
            
            .auth-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 1.75rem 1.25rem;
            }
            
            .primary-button {
                width: 100%;
                padding: 1rem;
            }
        }
    </style>

    <div class="">
        <div class="auth-card">
            <div class="auth-header">
                <h1 class="auth-title">{{ __('Reset Password') }}</h1>
                <p class="auth-description">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="auth-session-status" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="input-group">
                    <x-input-label for="email" :value="__('Email')" class="input-label" />
                    <x-text-input id="email" class="text-input" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="input-error" />
                </div>

                <div class="flex items-center justify-end">
                    <x-primary-button>
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>