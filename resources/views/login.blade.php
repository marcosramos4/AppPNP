<link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap');
    html, body {
        height: 100%;
    }
    body {
        font-family: 'Roboto', sans-serif;

    }
    .demo-container {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .btn-lg {
        padding: 12px 26px;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    ::placeholder {
        font-size:14px;
        letter-spacing:0.5px;
    }
    .form-control-lg {
        font-size: 16px;
        padding: 25px 20px;
    }
    .font-500{
        font-weight:500;
    }
    .image-size-small{
        width:140px;
        margin:0 auto;
    }
    .image-size-small img{
        width:140px;
        margin-bottom:-70px;
    }
    .icon-camera{
        position: absolute;
        right: -1px;
        top: 21px;
        width: 30px;
        height: 30px;
        background-color: #FFF;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    </style>
<link rel="stylesheet" href="https://cdn.lineicons.com/2.0/LineIcons.css">
<div class="demo-container">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-8 mx-auto">
                <div class="text-center image-size-small position-relative">
                    <img src="https://annedece.sirv.com/Images/user-vector.jpg" class="rounded-circle p-2 bg-white">

                </div>
                <div class="p-5 bg-white rounded shadow-lg">
                    <h3 class="mb-2 text-center pt-5">Bienvenido</h3>
                    @if(session()->has('mensaje'))
                    <div class="alert alert-danger" role="alert">
                        {{session()->get('mensaje')}}
                    </div>
                    @endif
                    <form method="POST">
                        @csrf
                        <label class="font-500">Usuario</label>
                        <input name="name" class="form-control p-3 mb-2" type="text">
                        <label class="font-500">Password</label>
                        <input name="password" class="form-control p-3" type="password">
                        <p class="m-0 py-4"><a href="" class="text-muted">Olvidaste tu Contraseña?</a></p>
                        <button class="btn btn-primary btn-lg w-100 shadow-lg">INICIAR</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>

