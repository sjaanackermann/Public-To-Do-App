<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google font link -->
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

    <!-- Favicon link -->
    <link rel="shortcut icon" href="#">

    <!-- CSS link -->
    <link rel="stylesheet" href="styles/index.css">

    <!-- jQuery link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- JS link -->
    <script src="scripts/script.js" defer></script>

    <title>To Do</title>
</head>

<body>
    <main>
        <!-- ----------------------------DESKTOP LOGIN VIEW---------------------------- -->
        <div class="form_outer">
            <div class="form_back">
                <div class="form_back_left">
                    <div class="back_left_container">
                        <h2>Don't have an account?</h2>
                        <hr>
                        <p>Take a minute and register!</p>
                        <button id="signin" type="button" onclick="moveBack()">sign-up</button>
                    </div>
                </div>

                <div class="form_back_right">
                    <div class="back_right_container">
                        <h2>Have an account?</h2>
                        <hr>
                        <p>Log into your profile!</p>
                        <button id="login" type="button" onclick="move()">login</button>
                    </div>
                </div>
            </div>

            <div id="moveable" class="form_front">
                <form action="login_user.php" method="post" id="login_form" class="form_data">
                    <h2>Login</h2>
                    <hr>
                    <input name="username" id="username" type="text" placeholder="username" spellcheck="false" minlength="8" maxlength="30" autocomplete="off" required>
                    <input name="password" id="password" type="password" placeholder="password" spellcheck="false" minlength="8" maxlength="30" required>
                    <button class="orange margin_top" type="submit">login</button>
                </form>

                <form id="register_form" class="inactive" action="../private/new_user.php" method="post">
                    <h2>Register</h2>
                    <hr>
                    <input name="name" type="text" placeholder="name" spellcheck="false" minlength="8" maxlength="30" autocomplete="off" required>
                    <input name="username" type="text" placeholder="username" spellcheck="false" minlength="8" maxlength="30" autocomplete="off" required>
                    <input name="password" type="password" placeholder="password" spellcheck="false" minlength="8" maxlength="30" required>
                    <button class="orange margin_top" name="register" type="submit">register</button>
                </form>
            </div>
        </div>


        <!-- ----------------------------MOBILE LOGIN VIEW---------------------------- -->
        <div class="form_outer_mobile">
            <div class="form_back">
                <div class="form_back_left">
                    <div class="back_left_container">
                        <h2 class="padding_top">Do you have an account?</h2>
                        <hr>
                        <p>Login or register!</p>
                        <button id="login_mobile" class="button_mobile margin_bottom" type="button" onclick="displLogMob()">login</button>
                        <button id="signup_mobile" class="button_mobile" type="button" onclick="displRegMob()">sign-up</button>
                    </div>
                </div>

                <div class="form_back_right">
                    <div id="switchable" class="form_front_mobile">
                        <form action="login_user.php" method="post" id="login_form_mobile" class="form_data">
                            <h2>Login</h2>
                            <hr>
                            <input name="username" type="text" placeholder="username" spellcheck="false" minlength="8" maxlength="30" autocomplete="off" required>
                            <input name="password" type="password" placeholder="password" spellcheck="false" minlength="8" maxlength="30" required>
                            <button class="button_mobile orange margin_top" type="submit">login</button>
                        </form>

                        <form id="register_form_mobile" class="inactive" action="../private/new_user.php" method="post">
                            <h2>Register</h2>
                            <hr>
                            <input name="name" type="text" placeholder="name" spellcheck="false" minlength="8" maxlength="30" autocomplete="off" required>
                            <input name="username" type="text" placeholder="username" spellcheck="false" minlength="8" maxlength="30" autocomplete="off" required>
                            <input name="password" type="password" placeholder="password" spellcheck="false" minlength="8" maxlength="30" autocomplete="off" required>
                            <button class="button_mobile orange margin_top" name="register" type="submit" name="register">register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>