<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Trivia Quiz</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('form.submit') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" name="fullName" id="fullName" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="numQuestions">Number of Questions</label>
            <input type="number" class="form-control" name="numQuestions" id="numQuestions" min="1" max="49" required>
        </div>
        <div class="form-group">
            <label for="difficulty">Select Difficulty</label>
            <select class="form-control" name="difficulty" id="difficulty" required>
                <option value="easy">Easy</option>
                <option value="medium">Medium</option>
                <option value="hard">Hard</option>
            </select>
        </div>
        <div class="form-group">
            <label for="type">Select Type</label>
            <select class="form-control" name="type" id="type">
                <option value="multiple">Multiple Choice</option>
                <option value="boolean">True/False</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
