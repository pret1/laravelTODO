<?php
$title = "forgot";
?>
@include('/header')
<div class="forgot">
    <h2>Enter email and new password</h2>
    <form action="{{ route('password.update' )}}" method="post">
        @csrf
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <p>Email</p><input type="email" name="email" placeholder="Enter Email">
        <p>New password</p><input type="password" name="password" placeholder="Enter new password">
        <p>Confirm new password</p><input type="password" name="password_confirmation" placeholder="Enter confirm new password">
        <input id="buttonSubmit" type="submit" name="submit" value="Send">
    </form>

    <a href="{{ route('login') }}">Log in</a>

</div>


@include('/foter')


