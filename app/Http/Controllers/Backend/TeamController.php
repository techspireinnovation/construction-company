<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreRequest;
use App\Http\Requests\Team\UpdateRequest;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected TeamRepository $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function index()
    {
        $teams = $this->teamRepository->all();
        return view('admin.teams.index', compact('teams'));
    }

    public function create()
    {
        return view('admin.teams.create');
    }

    public function store(StoreRequest $request)
    {
        $this->teamRepository->store($request->validated());

        return redirect()->route('admin.teams.index')
            ->with('success', 'Team member created successfully.');
    }

    public function edit($id)
    {
        $team = $this->teamRepository->find($id);
        return view('admin.teams.edit', compact('team'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->teamRepository->update($request->validated(), $id);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Team member updated successfully.');
    }

    public function destroy($id)
    {
        $this->teamRepository->delete($id);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Team member deleted successfully.');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate(['ids' => 'required|string']);

        $ids = array_map('intval', explode(',', $request->ids));

        $this->teamRepository->bulkDestroy($ids);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Selected team members deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $this->teamRepository->toggleStatus($id);

        return redirect()->route('admin.teams.index')
            ->with('success', 'Status updated successfully.');
    }
    public function updateOrder(Request $request)
    {
        $this->teamRepository->updateOrder($request->order);

        return response()->json(['success' => true]);
    }

}
