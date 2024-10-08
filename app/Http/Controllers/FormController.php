<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\SearchHistory;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form');
    }

    public function submitForm(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'numQuestions' => 'required|integer|min:1|max:49',
            'difficulty' => 'required|string',
            'type' => 'nullable|string', // Type is optional
        ]);

        // Handle validation failure
        if ($validator->fails()) {
            return redirect()->route('form.show')
                ->withErrors($validator)
                ->withInput();
        }

        // Prepare the API URL
        $amount = $request->numQuestions;
        $difficulty = $request->difficulty;
        $type = $request->type ?? 'multiple';
        $url = "https://opentdb.com/api.php?amount={$amount}&difficulty={$difficulty}&type={$type}";

        // Make the API call
        $response = Http::withOptions([
            'verify' => false, // You can remove this line if SSL issues are resolved
        ])->get($url);

        // Check if response is successful
        if ($response->successful()) {
            $data = $response->json();

            // Filter and sort the data
            $filteredQuestions = collect($data['results'])->filter(function ($question) {
                return $question['category'] !== 'Entertainment: Video Games';
            });

            $sortedQuestions = $filteredQuestions->sortBy('category')->values()->all();

            // Store valid search in the database
            SearchHistory::create([
                'full_name' => $request->fullName,
                'email' => $request->email,
                'num_questions' => $request->numQuestions,
                'difficulty' => $request->difficulty,
                'type' => $request->type,
            ]);

            // Store questions in session
            session(['questions' => $sortedQuestions, 'currentQuestionIndex' => 0, 'userAnswers' => []]);

            return redirect()->route('questions.show');
        } else {
            return redirect()->route('form.show')->with('error', 'Failed to fetch data from the API');
        }
    }

    public function showQuestions(Request $request)
    {
        $questions = session('questions', []);
        $currentQuestionIndex = session('currentQuestionIndex', 0);
        $userAnswers = session('userAnswers', []);

        if ($currentQuestionIndex < count($questions)) {
            $currentQuestion = $questions[$currentQuestionIndex];

            return view('questions', compact('currentQuestion', 'currentQuestionIndex', 'userAnswers'));
        } else {
            return view('results', compact('userAnswers'));
        }
    }

    public function nextQuestion(Request $request)
    {
        $questions = session('questions', []);
        $currentQuestionIndex = session('currentQuestionIndex', 0);
        $userAnswers = session('userAnswers', []);

        // Store user answer
        $userAnswers[] = $request->input('answer');
        session(['userAnswers' => $userAnswers]);

        // Move to the next question
        $currentQuestionIndex++;
        session(['currentQuestionIndex' => $currentQuestionIndex]);

        return redirect()->route('questions.show');
    }
}

