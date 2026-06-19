<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ListCountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // hien thi danh sach len view
    public function index()
    {
        $countries = Country::all();
        return view('admin.country.index', compact('countries'));
    }

    public function add()
    {
        return view('admin.country.add');
    }

    // Lưu country mới
    public function list(ListCountryRequest $rq)
    {
        Country::create(['name' => $rq->name]);
        return redirect()->route('country.index')->with('success', 'Added national succeed!');
    }

    // Xóa country
    public function delete($id)
    {
        Country::findOrFail($id)->delete();
        return redirect()->route('country.index')->with('success', 'Deleted national succeed!');
    }
}
