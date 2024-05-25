<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DrinkType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrinkTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $types = DrinkType::paginate(10);
        return view('admin.drinks.types.index', [
            'types' => $types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.drinks.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $type_name = $request->input('type_name');

        $request->validate([
            'type_name' => 'required|string|max:255',
        ]);

        $type = DrinkType::where('type_name', $type_name)->first();

        if ($type) {
            return redirect()->route('drink_types.index')->with('error', 'The drink type already exists.');
        }

        $type = new DrinkType();
        $type->type_name = $type_name;
        $type->save();

        return redirect()->route('drink_types.index')->with('success', 'New drink type created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $type = DrinkType::findOrFail($id);

        return view('admin.drinks.types.show', [
            'type' => $type
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $type = DrinkType::findOrFail($id);

        return view('admin.drinks.types.edit', [
            'type' => $type
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $type_name = $request->input('type_name');

        // Проверка данных
        $validator = Validator::make($request->all(), [
            'type_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Нахождение и обновление типа напитка
        try {
            $drinkType = DrinkType::findOrFail($id);
            $drinkType->type_name = $type_name;
            $drinkType->save();

            return redirect()->route('drink_types.index')
            ->with('success', 'Тип напитка успешно обновлен!');
        } catch (\Exception $e) {
            return back()->withErrors('Ошибка обновления: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $type = DrinkType::destroy($id);

        if (!$type){
            return redirect()->route('drink_types.index')->with(['error' => 'Ошибка']);
        }

        return redirect()->route('drink_types.index')->with(['success' => 'Успешно!']);
    }
}
