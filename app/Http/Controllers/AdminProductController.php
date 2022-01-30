<?php

    namespace App\Http\Controllers;


    use App\Models\Category;
    use App\Models\Product;
    use Illuminate\Http\Request;

    class AdminProductController extends Controller {
        /**
         * Display a listing of the resource.
         *
         *
         */
        public function index () {
            $products = Product::paginate(5);
            return view('admin.adminProducts', compact('products'));
        }

        /**
         * Show the form for creating a new resource.
         *
         *
         */
        public function create () {
            $categories = Category::all();
            return view('admin.adminProductEdit', compact('categories'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request

         */
        public function store (Request $request) {
            $input = $request->all();
            $file = $request->file('picture');

            unset($input['picture']);
            if ($file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . rand(1000, 9999) . '.' . $ext;
                $file->storeAs('public/img/products/', $fileName);

                $input['picture'] = $fileName;
            }

            Product::create($input);
            return redirect(route('adminProduct.index'));


        }

        /**
         * Display the specified resource.
         *
         * @param int $id
         *
         */
        public function show ($id) {
            $product = Product::find($id);
//            $category=$product->category();
//            dd($category);
            return view('admin.adminProductShow', compact('product'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id

         */
        public function edit ($id) {
            $product = Product::find($id);
            $categories = Category::all();
            return view('admin.adminProductEdit', compact('product','categories'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id

         */
        public function update (Request $request, $id) {

            $product = Product::find($id);
            $input = $request->all();
            $file = $request->file('picture');


            if ($file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . rand(1000, 9999) . '.' . $ext;
                $file->storeAs('public/img/products/', $fileName);

                $product->picture = $fileName;
            }


            $product->name = $input['name'];
            $product->description = $input['description'];
            $product->save();


            session()->flash('productUpdated');
            return redirect(route('adminProduct.index'));
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id

         */
        public function destroy ($id) {
            $product = Product::find($id);
            $product->delete();
            return redirect()->route('adminProduct.index');
            //
        }
    }
