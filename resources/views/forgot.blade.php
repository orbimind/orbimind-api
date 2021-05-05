<main style="display: block;
align-items: center;
width: 100%;">
    <section style="display: block;
    align-items: center;
    width: 30%;
    height: 100px;
    background-color: #0078D4;">
        <h1 style="color: white;
        text-align: center;
        padding: 40px 0;
        margin: 0;
        font-family: Poppins, Arial, Helvetica;
        font-weight: 400;">Hello, <span style="font-weight: 600;">{{$username}}!<span></h1>
    </section>
    <section style="display: block;
    width: 30%;">
        <p style="font-family: Poppins, Arial, Helvetica;">Greetings, <span style="font-weight: 600;">{{$name}}</span>!</p>
        <p style="font-family: Poppins, Arial, Helvetica;">You're receiving this message because a <span style="font-weight: 600;">{{$role}}</span> account associated with this email has recently requested a password reset.</p>
        <p style="font-family: Poppins, Arial, Helvetica;">If it wasn't you, please keep calm and <a href="{{$removeLink}}">click here</a> to delete the password reset request.</p>
        <p style="font-family: Poppins, Arial, Helvetica;">And if everything is under your control,</p>
        <a href="{{$resetLink}}" style="display:block;
        font-family: Poppins, Arial, Helvetica;
        text-align: center;
        width: 100%;
        height: 30px;
        padding-top: 15px;
        margin: 0;
        background-color: #006fc3;
        color: white;
        font-weight: 600;
        text-decoration: none;">Click here to change your password</a>
    </section>
    <section style="display: block;
    width: 30%;
    align-items: center;
    padding: 10px 0;
    background-color:#F0F0F0;">
        <p style="font-family: Poppins, Arial, Helvetica; text-align:center;">This message was sent automatically. You don't need to reply to it.<br>USOF system<br>Copyright © 2021 Paul Litovka. All rights reserved.</p>
    </section>
</main>
