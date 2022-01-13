<?php
$title = "forgot";
?>
@include('/header')
<div class="forgot">
    <h2>Enter login to reset your password</h2>
    <form action="{{ route('password.email') }}" method="post">
        @csrf
        <p>Email</p><input type="text" name="email" placeholder="Enter Email">
        <input id="buttonSubmit" type="submit" name="submit" value="Send">
    </form>

    <a href="{{ route('login') }}">Log in</a>

</div>

@include('/foter')
