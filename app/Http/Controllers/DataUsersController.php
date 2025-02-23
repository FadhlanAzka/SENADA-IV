<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class DataUsersController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::all();
        return view('datausers.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View
     */
    public function create(): View
    {
        return view('datausers.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate($this->validationRules());

        User::create(array_merge($request->all(), ['password' => bcrypt($request->password)]));
        return redirect()->route('datausers.index')->with('success', 'User berhasil dibuat.');
    }

    /**
     * Display the specified user.
     *
     * @param  string $id
     * @return View
     */
    public function show(string $id): View
    {
        $user = User::findOrFail($id);
        return view('datausers.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  string $id
     * @return View
     */
    public function edit(string $id): View
    {
        $user = User::findOrFail($id);
        return view('datausers.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  Request $request
     * @param  string $id
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $request->validate($this->validationRules($user->id));

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return redirect()->route('datausers.index')->with('success', 'User berhasil diubah!');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('datausers.index')->with('success', 'User berhasil dihapus.');
    }

    /**
     * Get validation rules for user creation and update.
     *
     * @param  int|null $userId
     * @return array
     */
    protected function validationRules(int $userId = null): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
            'password' => 'nullable|string|min:8',
            'privilege' => 'required|string|in:Admin,Super Admin',
        ];
    }
}
