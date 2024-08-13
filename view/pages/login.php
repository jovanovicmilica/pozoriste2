<?php

?>

<main>
    <div class="container my-5 ">
        <div class="row justify-content-center divLogReg">
            <div class="col-5 mx-auto" id="logDiv">
                <h1 class="text-center">Log In</h1>
                <form action="#" onSubmit="return login()">
                    <div>
                        <label for="email">E-mail</label>
                        <input type="text" id="email" class="form-control">
                        <p>E-mail formats: petar.petrovic.123.21@ict.edu.rs or petar@gmail.com.</p>
                    </div>
                    <div>
                        <label for="pass">Password</label>
                        <input type="password" id="password" class="form-control">
                        <p>Password must be at least 8 characters long.</p>
                    </div>
                    <div id="messageLogin" class="my-2"></div>
                    <div class="my-3">
                        <input type="submit" id="btnLogin" value="Login" class="btn">
                    </div>
                    <div class="text-center">
                        <a href="#" id="regBtn" class="green">Don't have an account? Sign up</a>
                    </div>
                </form>
            </div>

            <div class="col-5 mx-auto d-none" id="regDiv">
                <h2 class="text-center">Sign Up</h2>
                <form action="#" onSubmit="return register()"> 
                    <div>
                        <label for="fname">First name</label>
                        <input type="text" id="firstName" class="form-control">
                        <p>First name has capital letter,3 letter minimum, 30maximum</p>
                    </div>
                    <div>
                        <label for="lName">Last name</label>
                        <input type="text" id="lastName" class="form-control">
                        <p>Last name has capital letter,3 letter minimum, 30maximum</p>
                    </div>
                    <div>
                        <label for="email">E-mail</label>
                        <input type="text" id="emailReg" class="form-control">
                        <p>E-mail formats: petar.petrovic.123.21@ict.edu.rs or petar@gmail.com</p>
                    </div>
                    <div>
                        <label for="pass">Password</label>
                        <input type="password" id="pass" class="form-control">
                        <p>Password must be at least 8 characters long.</p>
                    </div>
                    <div>
                        <label for="passConfirm">Confirm password</label>
                        <input type="password" id="passConfirm" class="form-control">
                        <p>Passwords do not match</p>
                    </div>
                    <div id="messageRegister" class="my-2"></div>
                    <div class="my-3">
                        <input type="submit" id="btnRegister" value="Register" class="btn">
                    </div>
                    <div class="text-center">
                        <a href="#" id="logBtn" class="green">Have an account? Log in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>