<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\RegistrationFormRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Sentinel;

class RegistrationController extends Controller
{

    /**
     * @var $user
     */
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('registration.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(RegistrationFormRequest $request)
    {
        $input = $request->only('email', 'password', 'first_name', 'last_name');
          $roley = $request->input('role');
        $user = Sentinel::registerAndActivate($input);

        if ($roley == 'visa') {


        // Find the role using the role name
        $usersRole = Sentinel::findRoleByName('Users');

        // Assign the role to the users
        $usersRole->users()->attach($user);

        return redirect('login')->withFlashMessage('User Successfully Created!visa');

        }

        elseif ($roley == 'mastercard') {


        // Find the role using the role name
        $usersRole = Sentinel::findRoleByName('Coaches');

        // Assign the role to the users
        $usersRole->coaches()->attach($user);

        return redirect('login')->withFlashMessage('Coach Successfully Created!master');

        }
        
        else {
        // Find the role using the role name
        $usersRole = Sentinel::findRoleByName('Admins');

        // Assign the role to the users
        $usersRole->users()->attach($user);

        return redirect('login')->withFlashMessage('Admin Successfully Created!');
        } 
    }
}
