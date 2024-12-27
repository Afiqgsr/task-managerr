<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Judul task harus diisi',
            'status.in' => 'Status harus salah satu dari: pending, in_progress, completed',
            'due_date.after_or_equal' => 'Tanggal jatuh tempo harus hari ini atau setelahnya',
        ];
    }
}