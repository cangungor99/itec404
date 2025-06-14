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
    protected function ensureApprovedMemberOfClub($clubID)
    {
        $user = auth()->user();

        $isMember = $user->memberships()
            ->where('clubID', $clubID)
            ->where('status', 'approved')
            ->exists();

        if (! $isMember) {
            abort(403, 'You are not an approved member of this club.');
        }
    }

    public function index()
    {
        $user = Auth::user();
        $clubIDs = $user->memberships()
            ->where('status', 'approved')
            ->pluck('clubID');


        $votings = Voting::whereIn('clubID', $clubIDs)
            ->where('start_date', '<=', now())
            ->with('club')
            ->latest()
            ->get();

        return view('students.votes.index', compact('votings'));
    }

    public function show(Voting $voting)
    {
        $this->ensureApprovedMemberOfClub($voting->clubID);

        $hasVoted = Vote::where('userID', Auth::id())
            ->where('votingID', $voting->votingID)
            ->exists();
        $isVotingEnded = now()->gt($voting->end_date);

        $options = $voting->options()->withCount('votes')->get();
        $totalVotes = $options->sum('votes_count');

        return view('students.votes.show', compact('voting', 'options', 'hasVoted', 'totalVotes', 'isVotingEnded'));
    }


    public function vote(Request $request, Voting $voting)
    {
        $this->ensureApprovedMemberOfClub($voting->clubID);

        $request->validate([
            'option_id' => 'required|exists:voting_options,optionID',
        ]);

        $userID = Auth::id();

        $alreadyVoted = Vote::where('userID', $userID)
            ->where('votingID', $voting->votingID)
            ->exists();

        if ($alreadyVoted) {
            return back()->with('error', 'You have already voted.');
        }

        if (now()->gt($voting->end_date)) {
            return back()->with('error', 'Voting has ended.');
        }

        $option = VotingOption::where('optionID', $request->option_id)
            ->where('votingID', $voting->votingID)
            ->first();

        if (! $option) {
            return back()->with('error', 'Invalid voting option.');
        }

        Vote::create([
            'votingID' => $voting->votingID,
            'userID' => $userID,
            'optionID' => $option->optionID,
            'timestamp' => now(),
        ]);

        return redirect()->route('students.votes.show', $voting->votingID)
            ->with('success', 'Your vote has been submitted.');
    }
}
