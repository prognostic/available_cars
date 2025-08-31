<html>
    <body>
        @auth
        <p>Good day</p>
        <form action="logout" method="POST">
            @csrf
            <button>Log out</button>
        </form>
        @else
        <div>
        <h2>Register</h2>
        <form action="register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button>Register</button>
        </form>
        </div>
        <h2>Login</h2>
        <form action="login" method="POST">
            @csrf
            <input name="loginname" type="text" placeholder="name">
            <input name="loginpassword" type="password" placeholder="password">
            <button>Login</button>
        </form>
        </div>
        @endauth
    </body>
</html>