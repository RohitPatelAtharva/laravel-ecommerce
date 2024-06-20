<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;

class AdminAgentController extends Controller
{
    public function index()
    {
        $agents = Agent::all();
        return view('admin.agent.list', compact('agents'));
    }

    public function create()
    {
        return view('admin.agent.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:agents',
            'phone' => 'required|string|max:15|unique:agents',
        ]);

        Agent::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 'approved',
        ]);

        return redirect()->route('admin.agents.index')->with('success', 'Agent registered successfully.');
    }

    public function edit($id)
    {
        $agent = Agent::findOrFail($id);
        return view('admin.agent.edit', compact('agent'));
    }
    public function update(Request $request, $id)
    {
        $agent = Agent::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email,' . $id,
            'phone' => 'required|string|max:20',
            // Add more validation rules as needed
        ]);

        $agent->update($validatedData);

        return redirect()->route('admin.agents.index')->with('success', 'Agent updated successfully.');
    }
    public function destroy($id)
    {
        $agent = Agent::find($id);

        if (!$agent) {
            session()->flash('error', 'Agent not found.');
            return response()->json([
                'status' => false,
                'message' => 'Agent not found.',
            ]);
        }

        $agent->delete();

        session()->flash('success', 'Agent deleted successfully.');
        return response()->json([
            'status' => true,
            'message' => 'Agent deleted successfully.',
        ]);
    }
    public function approve($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->status = 'approved';
        $agent->save();

        return redirect()->route('admin.agents.index')->with('success', 'Agent approved successfully.');
    }

    public function block($id)
    {
        $agent = Agent::findOrFail($id);
        $agent->status = 'blocked';
        $agent->save();

        return redirect()->route('admin.agents.index')->with('success', 'Agent blocked successfully.');
    }
}
