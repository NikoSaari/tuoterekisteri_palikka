<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            "name" => ["required", "string"],
            "price" => ["required", "numeric", "min:0", "decimal:0,2"],
            "image" => ["required", "image"]
        ], [
            "name.required" => "Tuotenimi puuttuu.",
            "price.required" => "Hinta puuttuu.",
            "image.required" => "Kuva puuttuu.",
            "price.numeric" => "Hinta täytyy olla numero.",
            "price.min" => "Hinta täytyy olla vähintään 0 €.",
            "price.decimal" => "Hinta pitää olla sentin (sadasosan) tarkkuudella.",
            "image.image" => "Kuva on virheellisessä muodossa.",
        ]);

        $product = new Product;
        
        $product->name = $request->input("name");
        $product->price = $request->input("price");
        
        $image = ImageManager::imagick()->read($request->file("image"));

        $image = $image->cover(128, 128)->toPng();

        $name = time() . Str::random(5) . ".png";

        Storage::disk("public")->put("images/".$name, $image);

        $product->image = $name;
        $product->save();

        return redirect()->intended("/")->withSuccess("Tuote lisätty.");
    }

    public function destroy(Request $request) {
        $request->validate([
            "product" => ["required", "exists:products,id"]
        ], [
            "product.required" => "Tuote puuttuu.",
            "product.exists" => "Tuotetta ei ole."
        ]);

        $product = Product::where("id", $request->input("product"))->get()->first();

        Storage::disk("public")->delete("images/".$product->image);

        $product->delete();

        return redirect()->intended("/")->withSuccess("Tuote poistettu.");
    }

    public function edit(Request $request) {
        $request->validate([
            "product" => ["required", "exists:products,id"],
            "name" => ["sometimes", "string"],
            "price" => ["sometimes", "numeric", "min:0", "decimal:0,2"],
            "image" => ["sometimes", "image"]
        ], [
            "product.required" => "Tuote puuttuu.",
            "product.exists" => "Tuotetta ei ole.",
            "price.numeric" => "Hinta täytyy olla numero.",
            "price.min" => "Hinta täytyy olla vähintään 0 €.",
            "price.decimal" => "Hinta pitää olla sentin (sadasosan) tarkkuudella.",
            "image.image" => "Kuva on virheellisessä muodossa.",
        ]);

        $product = Product::where("id", $request->input("product"))->get()->first();

        if ($request->input("name")) {
            $product->name = $request->input("name");
        }

        if ($request->input("price")) {
            $product->price = $request->input("price");
        }

        if ($request->file("image")) {
            Storage::disk("public")->delete("images/".$product->image);

            $image = ImageManager::imagick()->read($request->file("image"));

            $image = $image->cover(128, 128)->toPng();
    
            $name = time() . Str::random(5) . ".png";
    
            Storage::disk("public")->put("images/".$name, $image);
    
            $product->image = $name;    
        }

        $product->save();
        
        return redirect()->intended("/")->withSuccess("Tuote muokattu.");
    }
}
