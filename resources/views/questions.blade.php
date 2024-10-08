<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Trivia Question</h2>

    <h4>{{ $currentQuestion['question'] }}</h4>
    <form action="{{ route('questions.next') }}" method="POST">
        @csrf
        <input type="hidden" name="questionIndex" value="{{ session('currentQuestionIndex') }}">
        <div class="form-group">
            @foreach ($currentQuestion['incorrect_answers'] as $answer)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="answer" id="answer{{ $loop->index }}" value="{{ $answer }}">
                    <label class="form-check-label" for="answer{{ $loop->index }}">
                        {{ $answer }}
                    </label>
                </div>
            @endforeach
            <div class="form-check">
                <input class="form-check-input" type="radio" name="answer" id="answerCorrect" value="{{ $currentQuestion['correct_answer'] }}">
                <label class="form-check-label" for="answerCorrect">
                    {{ $currentQuestion['correct_answer'] }}
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Next</button>
    </form>
</div>
</body>
</html>
