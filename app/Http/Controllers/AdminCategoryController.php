<?php

    namespace App\Http\Controllers;

    use App\Models\Category;
    use Illuminate\Http\Request;

    class AdminCategoryController extends Controller {
        /**
         * Display a listing of the resource.
         *
         */
        public function index () {
            $categories = Category::all();
            return view('admin.adminCategories', compact('categories'));
        }

        /**
         * Show the form for creating a new resource.
         *
         *
         */
        public function create () {
            return view('admin.adminCategoryEdit');
        }

        /**
         * Store a newly created resource in storage.
         *
         */
        public function store (Request $request) {
            $input = $request->all();
            $file = $request->file('picture');

            unset($input['picture']);
            if ($file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . rand(1000, 9999) . '.' . $ext;
                $file->storeAs('public/img/categories/', $fileName);

                $input['picture'] = $fileName;
            }
            Category::create($input);
            return redirect(route('adminCategories.index'));

        }

        /**
         * Display the specified resource.
         *
         * @param int $id
         *
         */
        public function show ($id) {
            $category = Category::find($id);
            return view('admin.adminCategoryShow', compact('category'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         *
         */
        public function edit ($id) {
            $category = Category::find($id);
            return view('admin.adminCategoryEdit', compact('category'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update (Request $request, $id) {
            $category = Category::find($id);
            $input = $request->all();
            $file = $request->file('picture');


            if ($file) {
                $ext = $file->getClientOriginalExtension();
                $fileName = time() . rand(1000, 9999) . '.' . $ext;
                $file->storeAs('public/img/categories/', $fileName);

                $category->picture = $fileName;
            }


            $category->name = $input['name'];
            $category->description = $input['description'];
            $category->save();


            session()->flash('categoryUpdated');
            return redirect(route('adminCategories.index'));


        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         */
        public function destroy ($id) {
            $category = Category::find($id);
            $category->delete();
            return redirect()->route('adminCategories.index');
        }
    }
