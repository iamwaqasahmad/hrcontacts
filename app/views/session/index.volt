{{ content() }}

<div class="row">
    <div class="col-md-6">
        <div class="page-header">
            <h2 id="login-header">Log In</h2>
        </div>
        {{ form('session/start', 'role': 'form') }}
            <fieldset>
                <div class="form-group">
                    <label for="email">Username/Email</label>
                    <div class="controls">
                        {{ text_field('email', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="controls">
                        {{ password_field('password', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    {{ submit_button('Login', 'class': 'btn btn-primary btn-large', 'id': 'btn-signin') }}
                </div>
            </fieldset>
        </form>
    </div>

    <div class="col-md-6">

        <div class="page-header">
            <h2 id="signup-header">Don't have an account yet? </h2>
            <h5>Register Now</h5>
        </div>

        <p>Create an account offers the following advantages:</p>
        <ul>
            <li>Create, track and export your Contact List online</li>
            <li>Gain critical insights into how your business is doing</li>
        </ul>

        <div class="clearfix center">

            {{ form('session/register', 'id': 'registerForm', 'onbeforesubmit': 'return false') }}

                <fieldset>

                    <div class="form-group">
                        <label for="email">Name</label>
                            <div class="controls">
                                {{ text_field('name', 'class': "form-control") }}
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Username</label>
                            <div class="controls">
                                {{ text_field('username', 'class': "form-control") }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                            <div class="controls">
                                {{ text_field('email', 'class': "form-control") }}
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                            <div class="controls">
                                {{ password_field('password', 'class': "form-control") }}
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Repeat Password</label>
                        <div class="controls">
                            {{ password_field('repeatpassword', 'class': "form-control") }}
                        </div>
                    </div>

                    <div class="form-actions">
                        {{ submit_button('Register', 'class': 'btn btn-primary', 'onclick': 'return SignUp.validate();') }}
                        <p class="help-block">By signing up, you accept terms of use and privacy policy.</p>
                    </div>

                </fieldset>
            </form>
        </div>
    </div>

</div>
