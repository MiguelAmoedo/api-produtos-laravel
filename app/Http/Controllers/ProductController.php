<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Método para listar todos os produtos com paginação e busca
   
   public function index(Request $request)
   {
       $query = Product::query()
           ->select('products.*', 'categories.name as category_name') 
           ->join('categories', 'products.category_id', '=', 'categories.id'); 
       
       // Aplicar busca por nome e descrição
       if ($request->has('search')) {
           $search = $request->input('search');
           $query->where(function($q) use ($search) {
               $q->where('products.name', 'LIKE', "%{$search}%")
                 ->orWhere('products.description', 'LIKE', "%{$search}%");
           });
       }

       // Paginação dos resultados
       $products = $query->paginate(50);

       // Transformar os produtos para combinar `category_id` e `category_name` em uma única chave
       $products->getCollection()->transform(function($product) {
           return [
               'id' => $product->id,
               'name' => $product->name,
               'description' => $product->description,
               'price' => $product->price,
               'expiry_date' => $product->expiry_date,
               'image' => $product->image,
               'category' => [
                   'id' => $product->category_id,
                   'name' => $product->category_name
               ]
           ];
       });

       return response()->json($products);
   }



    // Método para criar um novo produto
    public function store(Request $request)
    {
        $categoryId = $request->input('category_id');
        
        // Verifica se a categoria existe
        if (!Category::find($categoryId)) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Cria o produto
        $product = Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'expiry_date' => $request->input('expiry_date'),
            'image' => $request->input('image'),
            'category_id' => $categoryId
        ]);

        // Carrega a categoria associada ao produto
        $product->load('category');

        // Retorna a resposta com a categoria incluída
        return response()->json([
            'product' => $product,
            'category' => $product->category->name
        ], 201);
    }

     // Método para atualizar um produto existente
     public function update(Request $request, $id)
     {
         $product = Product::find($id);
         if (!$product) {
             return response()->json(['error' => 'Product not found,olaa'], 404);
         }
         $categoryId = $request->input('category_id');
         if ($categoryId && !\App\Models\Category::find($categoryId)) {
             return response()->json(['error' => 'Category not found'], 404);
         }
         $product->update([
             'name' => $request->input('name', $product->name),
             'description' => $request->input('description', $product->description),
             'price' => $request->input('price', $product->price),
             'expiry_date' => $request->input('expiry_date', $product->expiry_date),
             'image' => $request->input('image', $product->image),
             'category_id' => $categoryId ? $categoryId : $product->category_id
         ]);
 
         return response()->json($product);
     }
     // Método para excluir um produto existente
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
