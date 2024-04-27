<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
  public function AdminLoginRequest(Request $request){
    try {
      $this->validate($request,[
        'email' => 'required|email',
        'password' => 'required', // Assuming password is required
      ]);

      // Attempt to authenticate the user
      $credentials = $request->only('email', 'password');
      $remember = $request->has('remember'); // Check if remember checkbox is checked
      if (Auth::attempt($credentials, $remember)) {
        // Authentication passed...
        return redirect()->intended('/admin'); // Redirect to the admin dashboard or any desired route
      } else {
        // Authentication failed...
        return redirect()->back()->with('error', 'Invalid credentials')->withInput();
      }

    }catch (ValidationException $validationException){
      return redirect()->back()->with(['error'=>$validationException->getMessage()],422)->withInput();
    } catch (\Exception $exception){
      return redirect()->back()->with(['error'=>$exception->getMessage()],500)->withInput();
    }
  }
}
