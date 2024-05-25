<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DrinkSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DrinkSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = DrinkSize::paginate(10);
        return view('admin.drinks.sizes.index', [
            'sizes' => $sizes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        $size = DrinkSize::findOrFail($id);

        return view('admin.drinks.sizes.edit', [
            'size' => $size
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $size_name= $request->input('size_name');
        $price = $request->input('price');

        // Проверка данных
        $validator = Validator::make($request->all(), [
            'size_name' => 'required|string|max:255',
            'price' => 'required|numeric|max:10000',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Нахождение и обновление типа напитка
        try {
            $drinkSize = DrinkSize::findOrFail($id);
            $drinkSize->size_name = $size_name;
            $drinkSize->price = $price;
            $drinkSize->save();

            return redirect()->route('drink_sizes.index')
                ->with('success', 'Цена успешно обновлена!');
        } catch (\Exception $e) {
            return back()->withErrors('Ошибка обновления: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
