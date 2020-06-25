<html>
    <head>
        <title>Login | {{ env("APP_TITLE") }}</title>
        @include("includes")
    </head>

    <body>
        <main class="container">
            <div class="row justify-content-md-center mt-5">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <strong>ADMIN LOGIN</strong>
                        </div>

                        <div class="card-body">
                            <form method="post" action="/admin/auth">
                                @csrf

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Masukan username" required/>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Masukan password" required/>
                                </div>

                                <button type="submit" class="btn btn-success">LOGIN</button>
                            </form>

                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger">
                                    <li>{{ $error }}</li>
                                </div>
                            @endforeach

                            @if(session("errorLogin"))
                                <div class="alert alert-danger">
                                    {{ session("errorLogin") }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>