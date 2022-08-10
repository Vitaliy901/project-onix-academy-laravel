<x-guest-layout>
	<x-slot:title>
		Register
	</x-slot:title>

	<div class="register">
		<div class="register__left">
			<a class="onix-logo" href="https://onix.kr.ua/"></a>
			<img src="img/form_runo_img.jpg" srcset="img/form_runo_img2x.jpg 2x" alt="Runo img">
		</div>
		<div class="register__right">
			<div class="form-wrapper">
				<div class="logo-wrapper logo-wrapper--padding-top">
					<a href="index.html">RUNO</a>
				</div>
				<form class="form" action="{{ route('register.store') }}" method="POST">
					@csrf
					<fieldset>
						<legend>Create account</legend>

						<x-email-validation-errors />

						<label for="email">Email</label>
						<input class="input" value="{{ old('email') }}" id="email" type="email" name="email" pattern="\S+@[a-z]+\.[a-z]+" autofocus required>

						<x-password-validation-errors />

						<label for="pass">Password</label>
						<input class="input" id="pass" type="password" name="password" minlength="8" required>
						<label class="label" for="pass">Confirm Password</label>
						<input class="input" id="confirm" type="password" name="password_confirmation" minlength="8" required>
						<input class="button" type="submit" value="Create account">
						<input class="button button_black" type="button" value="Sign up with Google">
						<div class="links-wrapper">
							<span>
								Already have an account?
							</span>
							<a class="link" href="{{ route('login.show') }}">Log In</a>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>

</x-guest-layout>