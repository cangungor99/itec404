<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Voting;
use App\Models\Vote;
use App\Models\VotingOption;

class StudentVoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $clubIDs = $user->memberships()->pluck('clubID');

        $votings = Voting::whereIn('clubID', $clubIDs)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->with('club')
            ->latest()
            ->get();

        return view('students.votes.index', compact('votings'));
    }

    public function show(Voting $voting)
    {
        $hasVoted = Vote::where('userID', Auth::id())->where('votingID', $voting->votingID)->exists();
        $options = $voting->options()->withCount('votes')->get();
        $totalVotes = $options->sum('votes_count');

        return view('students.votes.show', compact('voting', 'options', 'hasVoted', 'totalVotes'));
    }

    public function vote(Request $request, Voting $voting)
    {
        $request->validate([
            'option_id' => 'required|exists:voting_options,optionID',
        ]);

        $userID = Auth::id();

        $alreadyVoted = Vote::where('userID', $userID)->where('votingID', $voting->votingID)->exists();
        if ($alreadyVoted) {
            return back()->with('error', 'You have already voted.');
        }

        Vote::create([
            'votingID' => $voting->votingID,
            'userID' => $userID,
            'optionID' => $request->option_id,
            'timestamp' => now(),
        ]);

        return redirect()->route('students.votes.show', $voting->votingID)->with('success', 'Your vote has been submitted.');
    }
}
