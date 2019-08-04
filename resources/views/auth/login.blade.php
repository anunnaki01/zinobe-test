@include('auth.head')
<form class="form-signin" method="POST" action="/login">
    <div class="form-label-group">
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required
               autofocus>
        <label for="inputEmail">Email address</label>
    </div>

    <div class="form-label-group">
        <input type="password" id="inputPassword" name='password' class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
    </div>

    @if(isset($_SESSION['error']))
        <span>
            {{$_SESSION['error']}}
            <?php unset($_SESSION['error']); ?>
        </span>
    @endif

    <br><a href="/register">Registrarse</a>


    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>

@include('auth.footer')