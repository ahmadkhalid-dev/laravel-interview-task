<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Given Code
    public function updateOld(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            return response()->json(['success' => 'User updated successfully']);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

    // Refactor Code and Improvements
    
    /*
        Validation: The original code lacked validation. I added validation rules to ensure the request data is correct. This can be further improved using a Form Request for cleaner controllers, as demonstrated in PostRequest.

        User Retrieval: Instead of manually checking if the user exists with an if statement, I used findOrFail. This method will throw a ModelNotFoundException if the user is not found, which is then caught in the catch block.

        Update Method: The update method is used to directly update the user's attributes, improving code readability and reducing manual input handling.

        Exception Handling: I also added try-catch block to handle potential exceptions and return appropriate error messages.

        Helper Functions: I used sendError and sendSuccess helper functions to standardize JSON responses, ensuring consistency and avoiding repetitive response formatting.
    */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            return sendError('Validation Errors', $validator->errors(), 422);
        }
        
        try {
            $user = User::findOrFail($id);
            $user->update($request->only('name', 'email'));

            return sendSuccess('User updated successfully');
        } catch (\Exception $e) {
            return sendError($e->getMessage(), null);
        }
    }
}
