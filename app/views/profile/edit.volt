<h1 class="page-header" id="forms">
    Your Profile
</h1>

{{ content() }}

<div class="profile">
    {{ form('profile/edit', 'id': 'profileForm', 'class': 'form-horizontal') }}
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Full Name:</label>
            <div class="col-sm-10">
                {{ text_field("name", "size": "30", "class": "form-control") }}
                <span id="helpBlock2" class="help-block">Please enter your full name</span>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email:</label>
            <div class="col-sm-10">
                {{ text_field("email", "size": "30", "class": "form-control") }}
                <span id="helpBlock2" class="help-block">Please enter your email</span>
            </div>
        </div>

         <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Password:</label>
                    <div class="col-sm-10">
                        {{ password_field("password", "size": "30", "class": "form-control") }}
                        <span id="helpBlock2" class="help-block">Please enter your new password</span>
                    </div>
         </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="button" value="Update" class="btn btn-success btn-large">
                &nbsp;
                {{ link_to('dashboard', 'Cancel', 'class': 'btn btn-default btn-large', 'role': 'button') }}
            </div>
        </div>
    </form>
</div>
