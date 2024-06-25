<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return response()->json($members);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_student' => 'required|string|max:255|unique:members',
            'prefix' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
            'tel' => 'required|string|max:255|unique:members',
            'id_level' => 'required|exists:levels,id_level',
            'id_course' => 'required|exists:courses,id_course',
            'username' => 'required|string|max:255|unique:members',
            'password' => 'required|string|min:8',
            'account_status' => 'required|string|max:255',
        ]);

        $member = Member::create($request->all());
        return response()->json($member, 201);
    }

    public function show(Member $member)
    {
        return response()->json($member);
    }

    public function edit(Member $member)
    {
        //
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'prefix' => 'sometimes|required|string|max:255',
            'name' => 'sometimes|required|string|max:255',
            'surname' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:members,email,' . $member->id_student . ',id_student',
            'tel' => 'sometimes|required|string|max:255|unique:members,tel,' . $member->id_student . ',id_student',
            'id_level' => 'sometimes|required|exists:levels,id_level',
            'id_course' => 'sometimes|required|exists:courses,id_course',
            'username' => 'sometimes|required|string|max:255|unique:members,username,' . $member->id_student . ',id_student',
            'password' => 'sometimes|nullable|string|min:8',
            'account_status' => 'sometimes|required|string|max:255',
        ]);

        $member->update($request->all());
        return response()->json($member);
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return response()->json(null, 204);
    }
}