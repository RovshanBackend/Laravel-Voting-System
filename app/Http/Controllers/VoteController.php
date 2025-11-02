<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index()
    {
        $polls = Poll::where('is_active', true)->get();
        return view('user.polls', compact('polls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'poll_id' => 'required|exists:polls,id',
            'choice' => 'required|in:lehinə,əleyhinə,bitərəf',
        ]);

        $user = Auth::user();

        // Birdən çox səsin qarşısını al
        $existingVote = Vote::where('user_id', $user->id)
            ->where('poll_id', $request->poll_id)
            ->first();

        if ($existingVote) {
            return back()->with('error', 'Bu səsvermədə artıq iştirak etmisiniz.');
        }

        Vote::create([
            'user_id' => $user->id,
            'poll_id' => $request->poll_id,
            'choice' => $request->choice,
        ]);

        return back()->with('success', 'Səsiniz qeydə alındı!');
    }
}
