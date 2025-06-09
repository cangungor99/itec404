<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Club;
use App\Models\Voting;
use App\Models\VotingOption;
use Illuminate\Support\Facades\Auth;

class LeaderVoteController extends Controller
{
    protected function authorizeClubAccess(Club $club): void
    {
        $userID = auth()->id();

        if ($club->leaderID === null || $club->managerID === null) {
            $club = Club::select('clubID', 'leaderID', 'managerID')->find($club->clubID);
        }

        if ($club->leaderID != $userID && $club->managerID != $userID) {
            abort(403, 'You are not authorized to access this club.');
        }
    }

    public function index(Club $club): View
    {
        $this->authorizeClubAccess($club);

        $votings = $club->votings()->with('options')->latest()->get();
        return view('leader.votes.index', compact('club', 'votings'));
    }

    public function create(Club $club): View
    {
        $this->authorizeClubAccess($club);
        return view('leader.votes.create', compact('club'));
    }

    public function store(Request $request, Club $club): RedirectResponse
    {
        $this->authorizeClubAccess($club);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
        ]);

        $start = \Carbon\Carbon::parse($validated['start_date']);
        $end = \Carbon\Carbon::parse($validated['end_date']);

        if ($end->lte($start)) {
            return back()->withErrors(['end_date' => 'End date must be after the start date and time.'])->withInput();
        }

        $voting = Voting::create([
            'clubID' => $club->clubID,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $start,
            'end_date' => $end,
            'created_at' => now(),
        ]);

        foreach ($validated['options'] as $option) {
            VotingOption::create([
                'votingID' => $voting->votingID,
                'option_text' => $option,
            ]);
        }

        // 🟡 Yeni Eklenen Bildirim Kısmı
        $user = auth()->user();

        $notification = \App\Models\Notification::create([
            'clubID'    => $club->clubID,
            'creatorID' => $user->userID,
            'title'     => 'New Voting Session: ' . $validated['title'],
            'content'   => 'A new voting has been started. Visit to voting page.',
        ]);

        $memberIDs = \App\Models\Membership::where('clubID', $club->clubID)
            ->where('status', 'approved')
            ->pluck('userID');

        $notification->readers()->syncWithPivotValues($memberIDs->toArray(), ['is_read' => false]);


        $prefix = auth()->user()->hasRole('manager') ? 'manager' : 'leader';
        return redirect()
            ->route($prefix . '.votes.index', $club->clubID)
            ->with('success', 'Voting created and members have been notified.');
    }



    public function destroy(Club $club, Voting $voting): RedirectResponse
    {
        $this->authorizeClubAccess($club);

        if ($voting->clubID !== $club->clubID) {
            abort(403);
        }

        $voting->delete();
        return back()->with('success', 'Voting deleted.');
    }

    public function edit(Club $club, Voting $voting): View
    {
        $this->authorizeClubAccess($club);

        if ($voting->clubID !== $club->clubID) {
            abort(403);
        }

        $options = $voting->options()->get();
        return view('leader.votes.edit', compact('club', 'voting', 'options'));
    }

    public function update(Request $request, Club $club, Voting $voting): RedirectResponse
    {
        $this->authorizeClubAccess($club);

        if ($voting->clubID !== $club->clubID) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'options' => 'required|array|min:2',
            'options.*.id' => 'nullable|integer|exists:voting_options,optionID',
            'options.*.text' => 'required|string|max:255',
        ]);

        $start = \Carbon\Carbon::parse($validated['start_date']);
        $end = \Carbon\Carbon::parse($validated['end_date']);

        if ($end->lte($start)) {
            return back()->withErrors(['end_date' => 'End date must be after the start date and time.'])->withInput();
        }

        $voting->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $start,
            'end_date' => $end,
        ]);

        foreach ($validated['options'] as $option) {
            if (!empty($option['id'])) {
                VotingOption::where('optionID', $option['id'])->update([
                    'option_text' => $option['text'],
                ]);
            } else {
                VotingOption::create([
                    'votingID' => $voting->votingID,
                    'option_text' => $option['text'],
                ]);
            }
        }

        $prefix = auth()->user()->hasRole('manager') ? 'manager' : 'leader';

        return redirect()->route($prefix . '.votes.index', $club->clubID)
            ->with('success', 'Voting updated.');
    }


    public function results(Club $club, Voting $voting): View
    {
        $this->authorizeClubAccess($club);

        if ($voting->clubID !== $club->clubID) {
            abort(403);
        }

        $options = $voting->options()->withCount('votes')->get();
        $totalVotes = $options->sum('votes_count');

        return view('leader.votes.results', compact('club', 'voting', 'options', 'totalVotes'));
    }
}
