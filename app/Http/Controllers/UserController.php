<?php

namespace App\Http\Controllers;

use CSV;
use App\Models\User;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use ProtoneMedia\Splade\SpladeTable;
use Spatie\QueryBuilder\QueryBuilder;
use ProtoneMedia\Splade\Facades\Toast;
use Spatie\QueryBuilder\AllowedFilter;
use ProtoneMedia\Splade\Facades\Splade;

class UserController extends Controller
{
    private $model;

    public function __construct(UserService $userService)
    {
        $this->model = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhere('email', 'LIKE', "%{$value}%");
                });
            });
        });
        $users = QueryBuilder::for(User::class)
            ->defaultSort('name')
            ->allowedSorts(['name', 'email'])
            ->allowedFilters(['name', 'email', $globalSearch])
            ->paginate()
            ->withQueryString();
        return view('user.index', [
            'users' => SpladeTable::for($users)
                ->defaultSort('name')
                ->column('name', sortable: true, searchable: true, canBeHidden: false)
                ->column('email', sortable: true, searchable: true)
                ->withGlobalSearch()
                // ->rowLink(fn (User $user) => route('user.show', $user))
                ->column('created_at')
                ->column('action')
                ->selectFilter('name', [
                    'name' => 'name',
                    'email' => 'email'
                ])

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email'
        ]);
        $user = User::create($request->all());
        Splade::toast('User created successfully')->autoDismiss(5);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email'
        ]);
        $user->update($request->all());
        // Toast::title('User updated successfully')
        //     ->message('No space left')
        //     ->autoDismiss(5);
        Splade::toast('User updated successfully')->autoDismiss(5);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function try()
    {
        return View('user.try', ['users' => User::all()]);
    }
    public function tryStore(Request $request)
    {
        dd($request->all());
        $request->validate([]);

        Splade::toast('Users created successfully')->autoDismiss(5);
        return redirect()->back();
    }


    /**
     * familyMembers
     *
     * @return void
     */
    public function familyMembers()
    {
        $families = $this->model->getFamilies();
        return view('bakid.student.family_members', compact('families'));
    }

    public function familyCards()
    {
        $families = $this->model->getFamilies();
        return view('bakid.student.family_cards', compact('families'));
    }
}
