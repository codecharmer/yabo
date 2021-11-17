<x-main-layout>
    <div id="auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-12 mx-auto">
                    <div class="card pt-4 mt-lg-5">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <h1 class="font-weight-bold">{{ config('app.name', 'Laravel') }}</h1>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <label class="form-label" for="email">{{ __('Email Address') }}</label>
                                    <div class="position-relative">
                                        <input type="text"
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            id="email" name="email" autocomplete="email" autofocus placeholder="email"
                                            value="{{ old('email') }}">
                                        <div class="form-control-icon">
                                            <i data-feather="user"></i>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <label for="password">{{ __('Password') }}</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" id="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            placeholder="your password" autocomplete="current-password">
                                        <div class="form-control-icon">
                                            <i data-feather="lock"></i>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Remember Me -->
                                <div class="block mt-4">
                                    <label for="remember_me" class="inline-flex items-center">
                                        <input id="remember_me" type="checkbox"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm" name="remember">
                                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                    </label>
                                </div>

                                <button class="btn btn-primary btn-block btn-lg mt-3" type="submit" name="LoginAdmin"
                                    value="LogIn">
                                    {{ __('Log in') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-main-layout>
