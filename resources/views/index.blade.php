<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite('resources/js/app.js')
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-10 offset-1">
                <h1 class="mb-4">Messages</h1>
                <a href="/employee">Employee</a><br>
                <form action="/create" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <input type="text" name="text" placeholder="Enter your message" class="form-control mt-2">
                        @error('text') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <input type="file" name="image" class="form-control">
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

                <ul id="messageList" class="mt-5 list-group">
                    @foreach ($messages as $message)
                    <li class="list-group-item">
                        <strong>{{ $message->text }}</strong><br>
                        <img src="{{ $message->image }}" alt="Image" class="img-fluid mt-2" style="max-width: 200px;">
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>

@vite('resources/js/app.js')

</html>