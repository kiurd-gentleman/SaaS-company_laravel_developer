<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Inventory;
use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventoryItems = InventoryItem::paginate(10);
        return view('inventory_item.index', compact('inventoryItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inventories = Inventory::all();
        return view('inventory_item.create', compact('inventories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'inventory_id' => 'required',
            'quantity' => 'required',
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $inventoryItem = InventoryItem::create($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $storeData = Storage::put('public/uploads/inventory_item', $image, 'public');
                $inventoryItem->images()->create([
                    'image'      => $storeData,
                    'path' => str_replace('public/', 'storage/', $storeData),
                ]);
            }
        }

        return redirect()->route('inventory-items.index')
            ->with('success', 'Inventory item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inventories = Inventory::all();
        $inventoryItem = InventoryItem::with('images','inventory')->find($id);
        return view('inventory_item.show', compact('inventoryItem','inventories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $inventories = Inventory::all();
        $inventoryItem = InventoryItem::with('images','inventory')->find($id);
        return view('inventory_item.edit', compact('inventoryItem','inventories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'inventory_id' => 'required',
            'quantity' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $inventoryItem = InventoryItem::find($id);
        $inventoryItem->update($request->all());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $storeData = Storage::put('public/uploads/inventory_item', $image, 'public');
                $inventoryItem->images()->create([
                    'image'      => $storeData,
                    'path' => str_replace('public/', 'storage/', $storeData),
                ]);
            }
        }

        return redirect()->route('inventory-items.index')
            ->with('success', 'Inventory item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventoryItem = InventoryItem::find($id);
        $inventoryItem->images()->delete();
        $inventoryItem->delete();
        return redirect()->route('inventory-items.index')
            ->with('success', 'Inventory item deleted successfully.');
    }


    public function destroyImage(string $id)
    {
        $image = Image::find($id);
        Storage::delete($image->path);
        $image->delete();
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
