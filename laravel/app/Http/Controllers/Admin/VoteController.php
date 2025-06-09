<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Models\VotingOption;

class VoteController extends Controller
{

    public function index()
    {
        $votings = DB::table('votings')
            ->join('clubs', 'votings.clubID', '=', 'clubs.clubID')
            ->select(
                'votings.votingID',
                'votings.title',
                'votings.description',
                'votings.start_date',
                'votings.end_date',
                'votings.clubID',
                'clubs.name as club_name'
            )
            ->orderByDesc('votings.created_at')
            ->get();

        $clubs = DB::table('clubs')->select('clubID', 'name')->get();

        return view('admin.manage_votes', compact('votings', 'clubs'));
    }



    public function create()
    {
        $clubs = DB::table('clubs')->select('clubID', 'name')->get();
        return view('admin.create_vote', compact('clubs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'clubID' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'options' => 'required|array|min:1',
            'options.*' => 'required|string|max:255',
        ]);

        $votingID = DB::table('votings')->insertGetId([
            'clubID' => $request->clubID,
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d H:i'),
            'end_date'   => Carbon::parse($request->end_date)->format('Y-m-d H:i'),
        ]);


        foreach ($request->options as $option) {
            DB::table('voting_options')->insert([
                'votingID' => $votingID,
                'option_text' => $option
            ]);
        }

        return redirect()->route('admin.manage_votes')->with('success', 'Voting created successfully!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'clubID' => 'required|integer'
        ]);

        DB::table('votings')->where('votingID', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d H:i'),
            'end_date' => Carbon::parse($request->end_date)->format('Y-m-d H:i'),
            'clubID' => $request->clubID,
        ]);

        return redirect()->route('admin.manage_votes')->with('success', 'Voting updated successfully!');
    }


    public function results($id): JsonResponse
    {
        $options = VotingOption::where('votingID', $id)
            ->withCount('votes')
            ->get();

        $totalVotes = $options->sum('votes_count');

        $data = $options->map(function ($option) use ($totalVotes) {
            return [
                'option' => $option->option_text,
                'votes' => $option->votes_count,
                'percent' => $totalVotes > 0 ? round(($option->votes_count / $totalVotes) * 100) : 0,
            ];
        });

        return response()->json([
            'total' => $totalVotes,
            'results' => $data,
        ]);
    }
}
