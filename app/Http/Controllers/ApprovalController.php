<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Approval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $approvers = User::where('role', 'approver')->pluck('name', 'id');

        if ($user->role === 'admin') {
            $approvals = Approval::with(['booking', 'approver'])->when($request->approver_id, function ($query) use ($request) {
                return $query->where('approved_by', $request->approver_id);
            })->get();
        } else {
            $approvals = Approval::where('approved_by', $user->id)->with('booking')->get();
        }

        Log::info('Accessed approvals index', [
            'user_id' => $user->id,
            'role' => $user->role,
            'approver_id' => $request->approver_id,
        ]);

        return view('approvals.index', compact('approvals', 'approvers'));
    }

    public function create()
    {
        Log::info('Accessed create approval page', [
            'user_id' => Auth::id(),
        ]);

        return view('approvals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'approved' => 'required|boolean',
        ]);

        $approval = Approval::create($request->all());

        Log::info('Created new approval', [
            'approval_id' => $approval->id,
            'user_id' => Auth::id(),
            'request_data' => $request->all(),
        ]);

        return redirect()->route('approvals.index')->with('success', 'Approval created successfully.');
    }

    public function show(Approval $approval)
    {
        $booking = $approval->booking()->with(['vehicle', 'driver', 'approvals.approver'])->first();

        Log::info('Viewed approval details', [
            'approval_id' => $approval->id,
            'user_id' => Auth::id(),
        ]);

        return view('approvals.show', compact('approval', 'booking'));
    }

    public function edit(Approval $approval)
    {
        Log::info('Accessed edit approval page', [
            'approval_id' => $approval->id,
            'user_id' => Auth::id(),
        ]);

        return view('approvals.edit', compact('approval'));
    }

    public function update(Request $request, Approval $approval)
    {
        $request->validate([
            'approval_id' => 'required',
            'status' => 'required|in:approved,rejected',
            'notes' => 'nullable|string',
        ]);

        Log::info('Updating approval', [
            'approval_id' => $approval->id,
            'old_status' => $approval->status,
            'old_notes' => $approval->notes,
            'request_data' => $request->all(), 
            'user_id' => Auth::id(),
        ]);

        $approval->update([
            'status' => $request->status,
            'notes' => $request->status === 'rejected' ? $request->notes : null, 
        ]);


        $booking = $approval->booking; 

        $approvedCount = Approval::where('booking_id', $booking->id)
                                ->where('status', 'approved')
                                ->count();

        
        if ($approvedCount === 2) {
            $booking->update(['status' => 'approved']);
            Log::info('Booking status updated to approved', ['booking_id' => $booking->id, 'user_id' => Auth::id()]);
        }

        Log::info('Approval updated', [
            'approval_id' => $approval->id,
            'new_status' => $approval->status,
            'new_notes' => $approval->notes,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('approvals.index')->with('success', 'Approval updated successfully.');
    }

    public function destroy(Approval $approval)
    {
        $approval->delete();

        Log::info('Deleted approval', [
            'approval_id' => $approval->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('approvals.index')->with('success', 'Approval deleted successfully.');
    }
}
