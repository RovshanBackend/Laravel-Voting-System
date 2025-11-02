<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    // Adminin bütün səsvermələri görməsi
    public function index()
    {
        $polls = Poll::all();
        return view('admin.polls', compact('polls'));
    }

    // Yeni səsvermə əlavə etmə formu
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        Poll::create($request->all());

        return redirect()->back()->with('success', 'Səsvermə uğurla əlavə edildi!');
    }
}
