<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * ==================================
     * Display Users
     * ==================================
     */

    public function index(Request $request)
    {
        session([
    'users_notification_seen_at' => now(),
]);
        $query = User::query();


        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('username', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');

            });

        }


        if ($request->filled('role')) {

            $query->where('role', $request->role);

        }


        if ($request->filled('status')) {

            $query->where('status', $request->status);

        }


        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        return view(
            'admin.users.index',
            compact('users')
        );
    }



    /**
     * ==================================
     * Create
     * ==================================
     */

    public function create()
    {
        return view('admin.users.create');
    }



    /**
     * ==================================
     * Store
     * ==================================
     */

    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();

        try {

            $data = $request->validated();


            /*
            | Upload Avatar
            */

            if ($request->hasFile('avatar')) {


                $file = $request->file('avatar');


                $filename = time() . '.' .
                    $file->getClientOriginalExtension();


                $file->move(
                    public_path('images/users'),
                    $filename
                );


                $data['avatar'] = $filename;

            }



            /*
            | Password
            */

            $data['password'] = Hash::make($data['password']);



            /*
            | Email Verification
            */

            $data['email_verified_at'] =
                $request->boolean('email_verified')
                    ? now()
                    : null;



            /*
            | Active
            */

           $data['status'] =
    $request->status ?? 'active';



            User::create($data);


            DB::commit();


            return redirect()
                ->route('admin.users.index')
                ->with(
                    'success',
                    'User created successfully.'
                );


        } catch (\Throwable $e) {


            DB::rollBack();


            return back()
                ->withInput()
                ->with(
                    'error',
                    'Something went wrong while creating the user.'
                );

        }
    }



    /**
     * ==================================
     * Edit
     * ==================================
     */

    public function edit(User $user)
    {
        return view(
            'admin.users.edit',
            compact('user')
        );
    }




    /**
     * ==================================
     * Update
     * ==================================
     */

  /**
 * ==================================
 * Update
 * ==================================
 */
public function update(
    UpdateUserRequest $request,
    User $user
) {
    DB::beginTransaction();

    try {

        $data = $request->validated();


        /*
        |--------------------------------------------------------------------------
        | ORIGINAL AVATAR
        |--------------------------------------------------------------------------
        */

        $oldAvatar = $user->avatar;


        /*
        |--------------------------------------------------------------------------
        | REMOVE AVATAR
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('remove_avatar')) {

            $data['avatar'] = null;

        }


        /*
        |--------------------------------------------------------------------------
        | NEW AVATAR
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');


            /*
            |--------------------------------------------------------------------------
            | Generate Filename
            |--------------------------------------------------------------------------
            */

            $filename =
                time()
                . '_'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension();


            /*
            |--------------------------------------------------------------------------
            | Move New Avatar
            |--------------------------------------------------------------------------
            */

            $file->move(
                public_path('images/users'),
                $filename
            );


            /*
            |--------------------------------------------------------------------------
            | Set New Avatar
            |--------------------------------------------------------------------------
            */

            $data['avatar'] = $filename;

        }


        /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        */

        if (!empty($data['password'])) {

            $data['password'] =
                Hash::make($data['password']);

        } else {

            unset($data['password']);

        }


        /*
        |--------------------------------------------------------------------------
        | Email Verified
        |--------------------------------------------------------------------------
        */

        $data['email_verified_at'] =
            $request->boolean('email_verified')
                ? ($user->email_verified_at ?? now())
                : null;


        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $data['status'] =
            $request->status ?? $user->status;


        /*
        |--------------------------------------------------------------------------
        | Update User
        |--------------------------------------------------------------------------
        */

        $user->update($data);


        /*
        |--------------------------------------------------------------------------
        | DELETE OLD AVATAR
        |--------------------------------------------------------------------------
        |
        | Only delete the old file after the database update succeeds.
        |
        */

        if (
            $oldAvatar &&
            isset($data['avatar']) &&
            $data['avatar'] !== $oldAvatar
        ) {

            $oldAvatarPath =
                public_path(
                    'images/users/' . $oldAvatar
                );


            if (file_exists($oldAvatarPath)) {

                unlink($oldAvatarPath);

            }

        }


        DB::commit();


        return redirect()
            ->route('admin.users.index')
            ->with(
                'success',
                'User updated successfully.'
            );


    } catch (\Throwable $e) {

        DB::rollBack();


        return back()
            ->withInput()
            ->with(
                'error',
                'Something went wrong while updating the user: '
                . $e->getMessage()
            );

    }
}




    /**
     * ==================================
     * Show
     * ==================================
     */

    public function show(User $user)
    {
        return view(
            'admin.users.show',
            compact('user')
        );
    }




    /**
     * ==================================
     * Destroy
     * ==================================
     */

    public function destroy(User $user)
    {


        if (auth()->id() === $user->id) {


            return back()->with(
                'error',
                'You cannot delete your own account.'
            );


        }




        if ($user->role === 'super_admin') {


            $superAdmins = User::where(
                'role',
                'super_admin'
            )->count();



            if ($superAdmins <= 1) {


                return back()->with(
                    'error',
                    'The last Super Admin cannot be deleted.'
                );


            }


        }




        DB::beginTransaction();


        try {



            /*
            | Delete Avatar
            */

            if ($user->avatar) {


                $avatar =
                    public_path('images/users/' . $user->avatar);


                if (file_exists($avatar)) {

                    unlink($avatar);

                }


            }



            $user->delete();



            DB::commit();



            return redirect()
                ->route('admin.users.index')
                ->with(
                    'success',
                    'User deleted successfully.'
                );



        } catch (\Throwable $e) {


            DB::rollBack();


            return back()->with(
                'error',
                'Unable to delete this user.'
            );


        }

    }
}
