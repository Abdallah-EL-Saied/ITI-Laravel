<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ __("You're logged in!") }}

                    @if (!auth()->user()->hasVerifiedEmail())
                        <div class="mt-4 p-4 bg-yellow-100 text-yellow-800 rounded">
                            Please verify your email to access all features.
                            <form method="POST" action="{{ route('verification.send') }}" class="inline">
                                @csrf
                                <button type="submit" class="underline text-blue-600 hover:text-blue-900">
                                    Resend verification email
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>