<?php

namespace App\Http\Controllers\API\Crud;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\API\BaseController as BaseController;


class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();

        if (is_null($user)) {
            return $this->sendError('There are any user.');
        }
    
        return $this->sendResponse(UserResource::collection($user), 'Users retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name'     => 'required | string',
            'email'    => 'required | email',
            'password' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input['password'] = bcrypt($input['password']);

        $user = User::create([
            'name'        => $input['name'],
            'email'       => $input['email'],
            'password'    => $input['password']
        ]);

        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User register successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
  
        if (is_null($user)) {
            return $this->sendError('User not found.');
        }
   
        return $this->sendResponse(new UserResource($user), 'User retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name'     => 'string',
            'email'    => 'email',
            'password' => '',
        ]);
    
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
    
        $input['password'] = bcrypt($input['password']);

        $user->name      = $input['name'];
        $user->email     = $input['email'];
        $user->password  = $input['password'];
        $user->save();
   
        return $this->sendResponse(new UserResource($user), 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
   
        return $this->sendResponse([], 'User deleted successfully.');
    }
}
