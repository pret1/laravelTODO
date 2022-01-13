<?php
$title = "register";

?>
@include('header')
<div class="registration">
    <h1>Registration</h1>
    <form action="{{ route('postRegister') }}" method="post">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <p>Name</p><input type="text" name="login" placeholder="Enter Login" value="{{old('login')}}">
        <p>Email</p><input type="email" name="email" placeholder="Enter Email" value="{{old('email')}}">
        <p>Password</p><input type="password" name="password" placeholder="Password">
        <p>Confirm password</p><input type="password" name="confirm_password" placeholder="Confirm Password">

        <input id="buttonSubmit" type="submit" name="submit" value="Registration">
    </form>
    <div>
        <a href="{{ route('login') }}">Log in</a>
    </div>
</div>

@include('foter')
