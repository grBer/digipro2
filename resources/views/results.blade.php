<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Answers</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Your Answers</h2>
    <ul class="list-group">
        @foreach (session('userAnswers', []) as $index => $answer)
            <li class="list-group-item">Question {{ $index + 1 }}: {{ $answer }}</li>
        @endforeach
    </ul>
    <a href="{{ route('form.show') }}" class="btn btn-primary mt-3">Start Over</a>
</div>
</body>
</html>
