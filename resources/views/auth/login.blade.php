<x-guest-layout>
	<x-slot:title>
		Login
	</x-slot:title>

	<div class="login">
			<div class="login__left">
				<a class="onix-logo" href="https://onix.kr.ua/"></a>
				<img src="img/form_runo_img.jpg"
					srcset="img/form_runo_img2x.jpg 2x" 
					alt="Runo img">
			</div>
			<div class="login__right">
				<div class="form-wrapper">
					<div class="logo-wrapper">
						<a href="index.html">RUNO</a>
					</div>
					<form class="form" action="{{ route('login.store') }}" method="POST">
						@csrf
						<fieldset>
							<legend>Login to your account</legend>

							<x-email-validation-errors/>

							<label for="email">Email</label>
							<input class="input"
							value="{{ old('email') }}"
							id="email" 
							type="email" 
							name="email"
							pattern="\S+@[a-z]+\.[a-z]+" autofocus required>
							<label for="pass">Password</label>
							<input class="input" 
							id="pass" 
							type="password" 
							name="password" 
							minlength="8" required>
							<div class="form__rf-wrapper">
								<label>
									<input type="checkbox" name="remember">
									<span>Remember me</span>
								</label>
								<a class="link" href="#">Forgot password?</a>
							</div>
							<input class="button" type="submit" value="Log in">
							<input class="button button_black" type="button" value="Sign in with Google">
							<div class="links-wrapper">
								<span>
									Don’t have an account?
								</span>
								<a class="link" href="{{ route('register.create') }}">Register</a>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
		
</x-guest-layout>