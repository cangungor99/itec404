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
    public function index(Club $club): View
    {
        $this->authorizeLeader($club);

        $votings = $club->votings()->with('options')->latest()->get();
        return view('leader.votes.index', compact('club', 'votings'));
    }

    public function create(Club $club): View
    {
        $this->authorizeLeader($club);
        return view('leader.votes.create', compact('club'));
    }

    public function store(Request $request, Club $club): RedirectResponse
    {
        $this->authorizeLeader($club);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
        ]);

        $voting = Voting::create([
            'clubID' => $club->clubID,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'created_at' => now(),
        ]);

        foreach ($validated['options'] as $option) {
            VotingOption::create([
                'votingID' => $voting->votingID,
                'option_text' => $option,
            ]);
        }

        return redirect()->route('leader.votes.index', $club->clubID)->with('success', 'Voting created.');
    }

    public function destroy(Club $club, Voting $voting): RedirectResponse
    {
        $this->authorizeLeader($club);

        if ($voting->clubID !== $club->clubID) {
            abort(403);
        }

        $voting->delete();
        return back()->with('success', 'Voting deleted.');
    }

    public function edit(Club $club, Voting $voting): View
    {
        $this->authorizeLeader($club);

        if ($voting->clubID !== $club->clubID) {
            abort(403);
        }

        $options = $voting->options()->get();
        return view('leader.votes.edit', compact('club', 'voting', 'options'));
    }

    public function update(Request $request, Club $club, Voting $voting): RedirectResponse
    {
        $this->authorizeLeader($club);

        if ($voting->clubID !== $club->clubID) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'options' => 'required|array|min:2',
            'options.*.id' => 'nullable|integer|exists:voting_options,optionID',
            'options.*.text' => 'required|string|max:255',
        ]);

        $voting->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
        ]);

        // Seçenek güncelleme ve ekleme
        foreach ($validated['options'] as $option) {
            if (!empty($option['id'])) {
                // Güncelle
                VotingOption::where('optionID', $option['id'])->update([
                    'option_text' => $option['text'],
                ]);
            } else {
                // Yeni seçenek
                VotingOption::create([
                    'votingID' => $voting->votingID,
                    'option_text' => $option['text'],
                ]);
            }
        }

        return redirect()->route('leader.votes.index', $club->clubID)->with('success', 'Voting updated.');
    }

    public function results(Club $club, Voting $voting): View
    {
        $this->authorizeLeader($club);

        if ($voting->clubID !== $club->clubID) {
            abort(403);
        }

        $options = $voting->options()->withCount('votes')->get();
        $totalVotes = $options->sum('votes_count');

        return view('leader.votes.results', compact('club', 'voting', 'options', 'totalVotes'));
    }

    protected function authorizeLeader(Club $club): void
    {
        if (Auth::id() !== $club->leaderID) {
            abort(403);
        }
    }
}
