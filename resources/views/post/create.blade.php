<x-layout>
    <div class="center-form-div">
        <form action="/newpost" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" hidden placeholder="Uploader's Name" value="{{auth()->user()->user_name}}" name="uploaded_by">
            <input type="file" class="file-field" name="file_url" id="file">
            <input class="text-field" type="text" placeholder="Caption" name="caption">
            <button type="submit">Post</button>
        </form>
    </div>
</x-layout>