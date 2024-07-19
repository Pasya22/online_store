<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <style>
        .ganti {
            background-image: url(https://i.pinimg.com/564x/40/6f/88/406f88c010945a1664cb3184b7da7e49.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
            height: 100vh;
        }

        .signin {
            position: absolute;
            width: 400px;
            height: 400px;
            background: #222;
            z-index: 1000;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            border-radius: 4px;
            box-shadow: 0 15px 35px aqua;
        }



        .signin .content {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 40px;
        }

        .signin .content h2 {
            font-size: 2em;
            color: aqua;
            text-transform: uppercase;
        }

        .signin .content .form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .signin .content .form .inputBox {
            position: relative;
            width: 100%;
            border: 0.2px solid aqua;
        }

        .signin .content .form .inputBox input {
            position: relative;
            width: 100%;
            background: #333;
            border: none;
            outline: none;
            padding: 25px 10px 7.5px;
            border-radius: 4px;
            color: #fff;
            font-weight: 500;
            font-size: 1em;
        }

        .signin .content .form .inputBox i {
            position: absolute;
            left: 0;
            padding: 15px 10px;
            font-style: normal;
            color: #aaa;
            transition: 0.5s;
            pointer-events: none;
        }

        .signin .content .form .inputBox input:focus~i,
        .signin .content .form .inputBox input:valid~i {
            transform: translateY(-7.5px);
            font-size: 0.8em;
            color: #fff;
        }

        .signin .content .form .links {
            position: relative;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }

        .signin .content .form .links a {
            color: #fff;
            text-decoration: none;
        }

        .signin .content .form .links a:nth-child(2) {
            color: aqua;
            font-weight: 600;
        }

        .signin .content .form .inputBox input[type="submit"] {
            padding: 10px;
            background: aqua;
            color: #000;
            font-weight: 600;
            font-size: 1.35em;
            letter-spacing: 0.05em;
            cursor: pointer;
        }

        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');
        @import url("https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }

        body {
            /* display: flex;
  /* justify-content: center;
  align-items: center; */
            /* min-height: 100vh; */
            background-color: #ffff;
        }

        section {
            position: absolute;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
            margin: 7% 34%;
            flex-wrap: wrap;
            overflow: hidden;
            position: relative;
            width: 200px;
            height: 200px;
            background-color: transparent;
        }

        section span {
            position: relative;
            display: block;
            width: calc(6.25vw - 2px);
            height: calc(6.25vw - 2px);
            background: #181818;
            z-index: 2;
            transition: 1.5s;
        }

        section span:hover {
            background: aqua;
            transition: 0s;
        }

        input[type="submit"]:active {
            opacity: 0.6;
        }

        @media (max-width: 900px) {
            section span {
                width: calc(10vw - 2px);
                height: calc(10vw - 2px);
            }
        }

        @media (max-width: 600px) {
            section span {
                width: calc(20vw - 2px);
                height: calc(20vw - 2px);
            }
        }
    </style>
</head>

<body>
    <div class="ganti">
        <section class="signin">
            <form action="{{ route('loginsubmit') }}" method="POST">
                @csrf
                <div class="content">
                    <h2>Sign in</h2>
                    <div class="form">
                        <div class="inputBox">
                            <input type="text" name="username" required />
                            <i>Username</i>
                        </div>
                        <div class="inputBox">
                            <input type="password" name="password" required />
                            <i>Password</i>
                        </div>
                        <div class="links">
                            <a href="#">Forgot Password?</a>
                            <a href="{{ route('register') }}">Signup</a>
                        </div>
                        <a href="dashboard">
                            <div class="inputBox">
                                <input type="submit" value="Login" />
                            </div>
                        </a>
                    </div>
                </div>
            </form>
        </section>
    </div>

</body>

</html>
