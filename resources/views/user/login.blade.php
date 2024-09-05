<x-subLayout>

    <div class="center-form-div loginform">
    
        <form action="/login" method="post">
            @csrf
            <h1>Log In</h1>
            <input class="text-field" type="email" placeholder="email" name="email">
            <input class="text-field" type="password" placeholder="Password" name="password">
            <button type="submit">Login</button>
        </form>
        <p>Not registered yet? <a href="/register">register</a> </p>
    
    </div>
</x-subLayout>
