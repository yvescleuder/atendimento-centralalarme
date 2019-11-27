<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Company;
use App\Http\Requests\StoreCompanyRequest;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @return mixed
     */
    public function store(StoreCompanyRequest $request)
    {
        try {
            $logo = $request->file('logo');
            $name = time().'.'.$logo->getClientOriginalExtension();
            $logo_resize = Image::make($logo->getRealPath());
            $logo_resize->resize(120, 80);
            $logo_resize->save(public_path('/img/company/' .$name));

            list($r, $g, $b) = sscanf($request->color_hex, "#%02x%02x%02x");
            Company::create([
                'name' => $request->name,
                'logo' => $name,
                'color_hex' => $request->color_hex,
                'color_rgb' => "$r,$g,$b"
            ]);
        } catch (\Exception $exception) {
            return back()->withInput()->withError('Empresa não cadastrada! Verifique com o suporte.');
        }

        return redirect()->route('company.index')->withSuccess('Empresa cadastrada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Company $company)
    {
        $company = Company::findOrFail($company->id);
        return view('company.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return mixed
     */
    public function update(Request $request, Company $company)
    {
        try {

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $name = time() . '.' . $logo->getClientOriginalExtension();
                $logo_resize = Image::make($logo->getRealPath());
                $logo_resize->resize(120, 80);
                $logo_resize->save(public_path('/img/company/' . $name));
                \File::delete(public_path() . '/img/company/' . $company->logo);

                $company->update([
                    'logo' => $name
                ]);

            }

            list($r, $g, $b) = sscanf($request->color_hex, "#%02x%02x%02x");
            $company->update([
                'name' => $request->name,
                'color_hex' => $request->color_hex,
                'color_rgb' => "$r,$g,$b"
            ]);
        } catch (\Exception $exception) {
            return back()->withInput()->withError('Empresa não deletada! Verifique com o suporte.');
        }

        return redirect()->route('company.index')->withSuccess('Empresa atualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
    /**
     * @param Company $company
     * @return mixed
     */
    public function destroy(Company $company)
    {
        try {
            $company->attendances()->delete();
            $company->delete();
        } catch (\Exception $exception) {
            return back()->withInput()->withError('Empresa não deletada! Verifique com o suporte.');
        }

        return back()->withSuccess('Empresa deletada!');
    }
}
