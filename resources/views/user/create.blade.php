<x-subLayout>
    <div class="center-form-div loginform">
        <form action="/signup" method="post" enctype="multipart/form-data">
            @csrf
            <h1>Sign Up</h1>
            <input class="text-field" type="text" placeholder="Name" name="name">
            <input class="text-field" type="email" placeholder="Email" name="email">
            <input class="text-field" type="text" placeholder="User Name" name="user_name">
            <input class="text-field" type="password" name="password" placeholder="Password">
            <input class="text-field" type="password" name="password_confirmation" placeholder="Confirm Password">
            <input type="file" name="profile_url" placeholder="Choose profile pic" class="file-field">
            <button type="submit">Sign Up</button>
        </form>

    </div>

</x-subLayout>