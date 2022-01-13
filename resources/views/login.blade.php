<?php
$title = "Login";
?>
@include('header')
<div class="login">
    <?php
    if (!empty($notice)) { ?>
        <div class="alert-success"><?php echo $notice ?></div>
     <?php
    }
    ?>
    <h1>Log in</h1>
    <form action="{{ route('postLogin') }}" method="post">
        @csrf
        @if ($errors->any())
            <div class="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p>Email</p><input value="{{old('login')}}" type="email" name="email" placeholder="Enter Email" >
        <p>Password</p><input type="password" name="password" placeholder="Enter Password" >

        <input id="buttonSubmit" type="submit" name="submit" value="Log in">
    </form>

    <a href="{{ route('showRegister') }}">Registration</a>
    <a href="{{ route('password.request') }}">You forgot a password?</a>
</div>

@include('foter')
