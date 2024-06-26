<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return  view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions',
        ]);
        $permission = Permission::create($request->all());
        
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El permiso se creó correctamente',
        ]);
 
        return redirect()->route('admin.permissions.edit', $permission);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //

        // $permission = Permission::find($permission->id);
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
       $request->validate([
           'name' => 'required|unique:permissions,name,' . $permission->id,
       ]);

       $permission->update($request->all());
       
       session()->flash('swal', [
           'icon' => 'success',
           'title' => '¡Bien hecho!',
           'text' => 'El permiso se actualizó correctamente',
       ]);
       
       return redirect()->route('admin.permissions.edit', $permission);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El permiso se eliminó correctamente',
        ]);

        return redirect()->route('admin.permissions.index');
    }
}
