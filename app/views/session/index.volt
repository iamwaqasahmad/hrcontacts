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

            {{ form('session/index', 'id': 'registerForm', 'onbeforesubmit': 'return false') }}

                <fieldset>

                    <div class="control-group">
                        {{ form.label('registration_name', ['class': 'control-label']) }}
                        <div class="controls">
                            {{ form.render('registration_name', ['class': 'form-control']) }}
                            <p class="help-block">(required)</p>
                            <div class="alert alert-warning" id="name_alert">
                                <strong>Warning!</strong> Please enter your full name
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        {{ form.label('registration_username', ['class': 'control-label']) }}
                        <div class="controls">
                            {{ form.render('registration_username', ['class': 'form-control']) }}
                            <p class="help-block">(required)</p>
                            <div class="alert alert-warning" id="username_alert">
                                <strong>Warning!</strong> Please enter your desired user name
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        {{ form.label('registration_email', ['class': 'control-label']) }}
                        <div class="controls">
                            {{ form.render('registration_email', ['class': 'form-control']) }}
                            <p class="help-block">(required)</p>
                            <div class="alert alert-warning" id="email_alert">
                                <strong>Warning!</strong> Please enter your email
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        {{ form.label('registration_password', ['class': 'control-label']) }}
                        <div class="controls">
                            {{ form.render('registration_password', ['class': 'form-control']) }}
                            <p class="help-block">(minimum 8 characters)</p>
                            <div class="alert alert-warning" id="password_alert">
                                <strong>Warning!</strong> Please provide a valid password
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="repeatPassword">Repeat Password</label>
                        <div class="controls">
                            {{ password_field('registration_repeatPassword', 'class': 'input-xlarge') }}
                            <div class="alert" id="repeatPassword_alert">
                                <strong>Warning!</strong> The password does not match
                            </div>
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
