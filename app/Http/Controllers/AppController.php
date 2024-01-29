<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Obligation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    /**
     * Start the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		return view('index');
    }

    /**
     * Start the application.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getObligations()
    {
        $obligations = Obligation::all();
        $response = array('success' => true, 'obligations' => $obligations);
        return response()->json($response,200);
    }
	
	/**
     *  The application Login.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public static function login(Request $request)
    {
        /*User::create([
            'name' => 'Tony',
            'last_name' => 'Machado García',
            'user' => 'superadmin',
            'password'=> Hash::make('webmaster'),
            'rol' => 'Superadmin'
        ]);*/

        // Validate user
        if(User::where('user',$request->user)->exists()){
            
            $user = User::where('user', $request->user)->first();
            if (Hash::check($request->pass, $user->password)) {
                $response = array(
                                'success' => true, 
                                'user' => $user->user,
                                'name' => $user->name,
                                'rol' => $user->rol
                            );
            }
            else {
                $response = array("failure" => true, 'message' => 'El Usuario o Contraseña no es válida. Por favor, vuelva a intentarlo. Verifique que la tecla Mayuscula (CAPS LOCK) no se encuentre activada.');
            }
        }
        else {
            $response = array("failure" => true, 'message' => 'El Usuario o Contraseña no es válida. Por favor, vuelva a intentarlo. Verifique que la tecla Mayuscula (CAPS LOCK) no se encuentre activada.');
        }
        
        // Clear Entire Cache
        //    \Cache::forget('regcash');
        \Cache::flush();

        return response()->json($response,200);
    }
}