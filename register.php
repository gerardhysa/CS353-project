<?php
include "layout.php";

?>
<!doctype html>
<html lang="en">
<head>
    <h2 style="margin-top: 50px" align="center">Create a new Account</h2>

    <script type="text/javascript">

        function checkbox_control() {

            document.getElementById('ck0').addEventListener('change', disableInput, false);
            document.getElementById('ck1').addEventListener('change', disableInput, false);
            document.getElementById('ck2').addEventListener('change', disableInput, false);
            document.getElementById('ck3').addEventListener('change', disableInput, false);


            function disableInput() {

                var ck0 = document.getElementById('ck0');
                var ck1 = document.getElementById('ck1');
                var ck2 = document.getElementById('ck2');
                var ck3 = document.getElementById('ck3');


                if(ck1.checked && ck2.checked){
                    ck0.disabled=true;
                    ck3.disabled=true;
                }else if(ck1.checked && ck3.checked){
                    ck0.disabled=true;
                    ck2.disabled=true;
                }else if(ck0.checked){
                    ck1.disabled=true;
                    ck2.disabled=true;
                    ck3.disabled=true;
                }else if (ck1.checked) {
                    ck0.disabled=true;
                }else if (ck2.checked){
                    ck0.disabled=true;
                    ck3.disabled=true;
                }else if(ck3.checked){
                    ck0.disabled=true;
                    ck2.disabled=true;
                }else{
                    ck0.disabled=false;
                    ck1.disabled=false;
                    ck2.disabled=false;
                    ck3.disabled=false;
                }
            }
            }
    </script>


</head>
<body>
<div class="container" style="margin-top: 50px">
    <div class="row">
        <div class="col-md-12 col-md-offset-2" align="center">

                    <form class="form-horizontal" method="POST" action="controller.php" name="register-form">

                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>
                            </div>

                            <label for="lastname" class="col-md-4 control-label">Lastname</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" required autofocus>
                            </div>

                            <label for="email_address" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email_address" type="email" class="form-control" name="email_address" required>

                            </div>

                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                            </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group">

                            <label for="role" class="col-md-4 control-label">Account Type</label>

                        <div class="row">

                            <div class="col-md-6">

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="role[]" value="0" onclick="checkbox_control()" id="ck0">User
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="role[]" value="1" onclick="checkbox_control()" id="ck1">Author
                                </label>
                            </div>

                            </div>

                            <div class="col-md-6">

                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="role[]" value="2" onclick="checkbox_control()" id="ck2">Editor
                                </label>
                            </div>

                            <div class="form-check ">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="role[]" value="3" onclick="checkbox_control()" id="ck3">Reviewer
                                </label>
                            </div>
                            </div>
                        </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button  type="submit" class="btn btn-primary" name="register-button">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
</body>
</html>
