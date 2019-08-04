@include('auth.head')

<form class="form-signin" method="POST" action="/register">

    <h1 class="h3 mb-3 font-weight-normal">Registro</h1>

    <div class="form-label-group">
        <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" required
               autofocus>
        <label for="name">Nombre</label>
    </div>

    <div class="form-label-group">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email address" required
               autofocus>
        <label for="email">Correo</label>
    </div>

    <label for="country">País*</label>

    <div class="form-label-group">
        <select name="country" id="country" class="form-control" required>
            <option value=""></option>
            @foreach($countries as $country)
                <option value="{{$country['Code']}}"> {{$country['Name']}}</option>
            @endforeach
        </select>
    </div>


    <div class="form-label-group">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required
               autofocus>
        <label for="password">Contraseña</label>

    </div>
    <div class="form-label-group">
        <input type="password" name="confirm_password" id="confirm_password" class="form-control"
               placeholder="Password confirm" required
               autofocus>
        <label for="password">Confrimación</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Registrarse</button>

    @if(!empty($_SESSION['errors']))
        @foreach($_SESSION['errors'] as $error)
            {{$error}}<br>
        @endforeach
        <?php unset($_SESSION['errors']) ?>
    @endif

</form>
@include('auth.footer')