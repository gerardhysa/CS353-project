<?php
include "layout.php";
session_start();

?>

<!doctype html>
<html lang="en">
<head>

    <h2 align="center" style="margin-top: 50px">Sign in</h2>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12" align="center" style="margin-top: 100px">
            <form class="form-horizontal" method="post" action="controller.php">
            <div class="col-md-4">

                <div class="form-inline">
                    <label for="email_address" class="col-md-4 control-label">Email Address</label>

                    <input id="emai_address" type="email" class="form-control" name="email_address" placeholder="Enter email address" required="required" autofocus>

                </div>

            </div>

            <div class="col-md-4">

                <div class="form-inline">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <input id="password" type="password" class="form-control" name="password" placeholder="Enter password" required="required" autofocus >
                </div>

            </div>
                <div class="col-md-4">
                    <label for="role" class="col-md-4 control-label">Sign in as</label>
                </div>
                    <div class="col-md-2">
                    <select class="form-control input-lg" name="admin">
                        <option name="admin[]" id="sel0" value="0">User</option>
                        <option name="admin[]" id="sel1" value="1">Author</option>
                        <option name="admin[]" id="sel2" value="2">Editor</option>
                        <option name="admin[]" id="sel3" value="3">Reviewer</option>
                    </select>
                </div>
                <button style="margin-top: 20px" type="submit" class="btn" name="loginButton">Sign In </button>

            </form>

        </div>
    </div>
</div>

</body>
</html>
