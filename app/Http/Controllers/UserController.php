<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\Vote;

class UserController extends Controller
{
public function index()
{
    $polls = Poll::where('is_active', true)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('user.dashboard', compact('polls'));
}

public function dashboard()
{

    $userId = auth()->id();

    // Aktiv səsvermələr (hələ səs ve
    $polls = Poll::where('is_active', true)
        ->whereDoesntHave('votes', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
        ->latest()
        ->get();

    // İştirak etdiyi səsvermələr
    $votedPolls = Poll::whereHas('votes', function ($query) use ($userId) {
        $query->where('user_id', $userId);
    })
        ->latest()
        ->get();

    return view('user.dashboard', compact('polls', 'votedPolls'));
}

public function vote(Request $request)
{
    $request->validate([
        'poll_id' => 'required|exists:polls,id',
        'choice' => 'required|in:lehinə,əleyhinə,bitərəf',
    ]);

    $pollId = $request->poll_id;
    $user = auth()->user();

    $existingVote = Vote::where('poll_id', $pollId)
        ->where('user_id', $user->id)
        ->first();

    if ($existingVote) {
        return redirect()->back()->with('error', 'Bu səsvermədə artıq iştirak etmisiniz!');
    }

    $poll = Poll::find($pollId);

    Vote::create([
        'poll_id'     => $pollId,
        'poll_title'  => $poll->title, // yeni sütun
        'user_id'     => $user->id,
        'user_name'   => $user->name,  // yeni sütun
        'choice'      => $request->choice,
    ]);

    return redirect()->back()->with('success', 'Səsiniz uğurla qeydə alındı!');
}



}
