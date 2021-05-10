<main style="display: block;
align-items: center;
width: 100%;">
    <section style="display: block;
    align-items: center;
    height: 100px;
    background-color: #0078D4;">
        <h1 style="color: white;
        text-align: center;
        padding: 40px 0;
        margin: 0;
        font-family: Poppins, Arial, Helvetica;
        font-weight: 400;">Hello, <span style="font-weight: 600;">{{$user->username}}!<span></h1>
    </section>
    <section style="display: block;">
        <p style="font-family: Poppins, Arial, Helvetica;">Greetings, <span style="font-weight: 600;">{{$user->name}}</span>!</p>
        <p style="font-family: Poppins, Arial, Helvetica;">{{$author}} recently left a comment under this post: <code>{{$post}}</code></p>
        <p style="font-family: Poppins, Arial, Helvetica;"><code>{{$content}}</code></p>
        <p style="font-family: Poppins, Arial, Helvetica;">Go check it out!</p>
    </section>
    <section style="display: block;
    align-items: center;
    padding: 10px 0;
    background-color:#F0F0F0;">
        <p style="font-family: Poppins, Arial, Helvetica; text-align:center;">You're receiving this message because a you are subscribed to email notifications about this post. You don't need to reply to it.<br>Unsubscribe<br>USOF system<br>Copyright © 2021 Paul Litovka. All rights reserved.</p>
    </section>
</main>
