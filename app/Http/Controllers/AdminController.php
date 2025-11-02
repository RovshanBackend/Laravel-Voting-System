<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Poll;
use App\Models\Vote;

class AdminController extends Controller
{
    public function index()
    {
        $polls = Poll::latest()->get();
        return view('admin.dashboard', compact('polls'));
    }

    public function createPoll()
    {
        return view('admin.create_poll');
    }

    public function storePoll(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'end_date' => 'required|date|after:today',
        ]);

        Poll::create($request->only(['title', 'description', 'start_date','end_date']));

        return redirect()->route('admin.polls')->with('success', 'Səsvermə uğurla yaradıldı!');
    }

    public function polls()
    {
    $polls = Poll::latest()->get();
    return view('admin.polls', compact('polls'));
    }


        // İstifadəçilər səhifəsi
    public function users()
    {
        $users = User::all(); // bütün istifadəçiləri gətir
        return view('admin.users', compact('users'));
    }

    // Yeni istifadəçi yarat
    public function storeUser(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        // User yarat
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'Yeni istifadəçi uğurla əlavə olundu!');
    }

    // Redaktə səhifəsini göstər
    public function editUser(User $user)
    {
    return view('admin.edit_user', compact('user'));
    }

    // User yenilə
    public function updateUser(Request $request, User $user)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,

        'role' => 'required|in:admin,user',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()->route('admin.users')->with('success', 'İstifadəçi uğurla yeniləndi!');
    }

    // User sil
    public function deleteUser(User $user)
    {
    $user->delete();
    return redirect()->route('admin.users')->with('success', 'İstifadəçi silindi!');
    }

    // Səsvermə Redaktə səhifəsini göstər
    public function editPoll(Poll $poll)
    {
    return view('admin.edit_poll', compact('poll'));
    }

    // Səsvermə yenilə
    public function updatePoll(Request $request, Poll $poll)
    {
    $request->validate([
    'title' => 'required|string|max:255',
    'description' => 'nullable|string',
    ]);

    $poll->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.polls')->with('success', 'Səsvermə uğurla yeniləndi!');
    }

    // Poll sil
    public function deletePoll(Poll $poll)
    {
    $poll->delete();
    return redirect()->route('admin.polls')->with('success', 'Səsvermə silindi!');
    }

public function pollResults($id)
{
    $poll = Poll::with('votes')->findOrFail($id);

    $lehinə = $poll->votes->where('choice', 'lehinə')->count();
    $əleyhinə = $poll->votes->where('choice', 'əleyhinə')->count();
    $bitərəf = $poll->votes->where('choice', 'bitərəf')->count();
    $total = $poll->votes->count() ?: 1; // sıfıra bölünmə üçün təhlükəsiz

    // faizləri hesablayaq
    $lehinəPercent = round(($lehinə / $total) * 100, 1);
    $əleyhinəPercent = round(($əleyhinə / $total) * 100, 1);
    $bitərəfPercent = round(($bitərəf / $total) * 100, 1);

    // nəticələri ayrıca array kimi ötürə bilərik, əgər istəyirsənsə
    $results = [
        'title' => $poll->title,
        'end_date' => $poll->end_date,
        'lehinə' => $lehinə,
        'əleyhinə' => $əleyhinə,
        'bitərəf' => $bitərəf,
        'lehinəPercent' => $lehinəPercent,
        'əleyhinəPercent' => $əleyhinəPercent,
        'bitərəfPercent' => $bitərəfPercent,
        'total' => $total,
    ];

    return view('admin.poll_results', compact('poll', 'results'));
}





    public function dashboard()
    {
    $totalUsers = User::count(); // Ümumi istifadəçi sayı
    $totalPolls = Poll::count(); // Ümumi səsvermə sayı
    $totalVotes = Vote::count(); // Ümumi səs sayı

    return view('admin.dashboard', compact('totalUsers','totalPolls','totalVotes'));
    }

}
