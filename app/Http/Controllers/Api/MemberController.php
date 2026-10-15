<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Models\Hobbies;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index(){
        $members = User::with('hobbies')->get();
        return MemberResource::collection($members);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email'=> 'required|string|email',
            'hobbies' => 'required|string'
        ]);

        $member = DB::transaction(function() use ($request){
            $member = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => 'user123'
            ]);

            $member->hobbies()->createMany(
                array_map(fn ($hobbies) => [
                    'name' => trim($hobbies),
                    'user_id'=> $member->id,
                ], explode(',', $request->hobbies))
            );

            return $member;
        });

        return response()->json([
            'message' => 'success',
            'data' => new MemberResource($member)
        ], 201);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
            'email'=> 'required|string|email',
            'hobbies' => 'required|string'
        ]);

        $member = DB::transaction(function() use ($id, $request){
            $member = User::findOrFail($id);
            $member->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $member->hobbies()->delete();

            $member->hobbies()->createMany(
                array_map(fn ($hobbies) => [
                    'name' => trim($hobbies),
                    'user_id'=> $member->id,
                ], explode(',', $request->hobbies))
            );

            return $member;
        });

        return response()->json([
            'message' => 'success',
            'data' => new MemberResource($member)
        ], 200);
    }

    public function destroy($id){
        $member = User::findOrFail($id);
        $member->delete();

        $member->hobbies()->delete();

        return response()->json(['message' => 'success', 'data' => new MemberResource($member)], 204);
    }
}
