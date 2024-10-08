<?php

use App\Http\Controllers\FormController;

Route::get('/', [FormController::class, 'showForm'])->name('form.show');
Route::post('/submit', [FormController::class, 'submitForm'])->name('form.submit');
Route::get('/questions', [FormController::class, 'showQuestions'])->name('questions.show');
Route::post('/questions/next', [FormController::class, 'nextQuestion'])->name('questions.next');
