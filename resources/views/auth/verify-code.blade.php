<x-guest-layout>

    <div class="mb-4 text-sm text-gray-600">
        {{ __('A 6-digit verification code has been sent to the email address you provided during registration.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification code has been sent to your email address.') }}
        </div>
    @endif

    {{-- Form to submit the 6-digit code --}}
    <form method="POST" action="{{ route('verification.verify') }}">
        @csrf

        <div class="mt-4">
            <x-input-label for="code" :value="__('Verification Code')" />

            <x-text-input 
                id="code" 
                class="block mt-1 w-full text-center tracking-widest text-xl" 
                type="text" 
                name="code" 
                required 
                autofocus 
                placeholder="Enter 6-digit code"
                maxlength="6"
            />

            <x-input-error :messages="$errors->get('code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verify Account') }}
            </x-primary-button>
        </div>
    </form>

    {{-- Form to resend the code --}}
    <form method="POST" action="{{ route('verification.send') }}" class="mt-4">
        @csrf

        <div class="flex items-center justify-between">
            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Resend Verification Code') }}
            </button>

            <button form="logout-form" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </div>
    </form>
    
    {{-- Hidden form for Log Out --}}
    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>

</x-guest-layout>