<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employers;

class EmployersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employers = Employers::all(); 
        return view('Employers.index', ['employers' => $employers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try 
        {
            $validatedData = $request->validate
            ([
                'Фамилия' => 'required|max:255',
                'Имя' => 'required|max:255',
                'Отчество' => 'required|max:255',
                'Организация' => 'required|max:255',
                'Дата_Основания' => 'required|date_format:Y-m-d',
                'Вакансия' => 'required|max:255',
                'Телефон' => 'required|max:255',
                'Email' => 'required|max:255',
            ]);

            $file_name = ""; 

            if($request->hasFile('Фото')) {
                $file_name = '/img/employers/'.time().'.'.$request->Фото->getClientOriginalExtension();
                $request->Фото->move(public_path('img/employers'),$file_name);
            } else {
                echo "Фото не загружено";
            }
            $employer = new Employers;
            $employer->Фамилия = $request->Фамилия;
            $employer->Имя = $request->Имя;
            $employer->Отчество = $request->Отчество;
            $employer->Организация = $request->Организация;
            $employer->Дата_Основания = $request->Дата_Основания;
            $employer->Вакансия = $request->Вакансия;
            $employer->Телефон = $request->Телефон;
            $employer->Email = $request->Email;
            $employer->Фото = $file_name;
            $employer->save();
        
            return redirect('/Employers/index');
        }   
        catch (\Exception $e) {echo('Ошибка при создании работодателя: ' . $e->getMessage());}
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
    public function edit($id)
    {
        $employer = Employers::find($id);
        return view('employers.edit', compact('employer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $employer = Employers::find($id);
        $validatedData = $request->validate
            ([
                'Фамилия' => 'required|max:255',
                'Имя' => 'required|max:255',
                'Отчество' => 'required|max:255',
                'Организация' => 'required|max:255',
                'Дата_Основания' => 'required|date_format:Y-m-d',
                'Вакансия' => 'required|max:255',
                'Телефон' => 'required|max:255',
                'Email' => ' required|max:255',
            ]);

            $file_name = $employer->Фото; 

            if($request->hasFile('Фото')) {
                $file_name = '/img/employers/'.time().'.'.$request->Фото->getClientOriginalExtension();
                $request->Фото->move(public_path('img/employers'),$file_name);
            } else {
                echo "Фото не загружено";
            }
           
            $employer->Фамилия = $request->Фамилия;
            $employer->Имя = $request->Имя;
            $employer->Отчество = $request->Отчество;
            $employer->Организация = $request->Организация;
            $employer->Дата_Основания = $request->Дата_Основания;
            $employer->Вакансия = $request->Вакансия;
            $employer->Телефон = $request->Телефон;
            $employer->Email = $request->Email;
            $employer->Фото = $file_name;
        $employer->save();
        return redirect('/Employers/index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employer = Employers::findOrFail($id);
        $image_path=public_path();
        $image = $image_path.$employer->Фото;
        if(file_exists($image)){
            @unlink($image);
        }
        $employer->delete();
        return redirect('/Employers/index');
    }
}
