<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Imports\EmployeesImport;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmployeeCreated;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date',
            'email_professionnel' => [
                'required',
                'email',
                'unique:employees,email_professionnel',
                function ($attribute, $value, $fail) {
                    $allowed_domains = ['csi-corporation.com', 'csi-maghreb.com', 'csi-international.com'];
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowed_domains)) {
                        $fail("The $attribute domain must be one of: " . implode(', ', $allowed_domains));
                    }
                }
            ],
            'email_personnel' => 'nullable|email',
            'matricule' => 'required|string|numeric',
            'telephone' => 'required|string|numeric',
            'code_postal' => 'required|string|numeric',
            'ville' => 'required|string',
            'pays' => 'required|string',
            'adresse' => 'required|string',
            'situation_familiale' => 'required|string',
            'nombre_enfants' => 'required|integer',
        ]);

        // Récupérer l'email professionnel depuis la requête
        $email_professionnel = $request->input('email_professionnel');
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
        // Vérifier si l'utilisateur existe déjà par son email professionnel
        $user = User::where('email', $email_professionnel)->first();
        $defaultPassword = 'Csi@2019';
        // Si l'utilisateur n'existe pas, le créer
        if (!$user) {
            $user = User::create([
                'name' => $nom,
                'username' => $prenom,
                'email' => $email_professionnel,
                'password' => Hash::make($defaultPassword), // Vous pouvez générer un mot de passe aléatoire ou laisser vide selon vos besoins
            ]);
        }

        // Créer l'employé associé à cet utilisateur
        $employee = Employee::create([
            'user_id' => $user->id,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_naissance' => $request->date_naissance,
            'email_professionnel' => $request->email_professionnel,
            'email_personnel' => $request->email_personnel,
            'matricule' => $request->matricule,
            'telephone' => $request->telephone,
            'code_postal' => $request->code_postal,
            'ville' => $request->ville,
            'pays' => $request->pays,
            'adresse' => $request->adresse,
            'situation_familiale' => $request->situation_familiale,
            'nombre_enfants' => $request->nombre_enfants,
        ]);
        Mail::to($employee->email_professionnel)->send(new EmployeeCreated($employee, $defaultPassword));
        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'required|date',
            'email_professionnel' => [
                'required',
                'email',
                'unique:employees,email_professionnel,' . $employee->id,
                function ($attribute, $value, $fail) {
                    $allowed_domains = ['csi-corporation.com', 'csi-maghreb.com', 'csi-international.com'];
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowed_domains)) {
                        $fail("The $attribute domain must be one of: " . implode(', ', $allowed_domains));
                    }
                }
            ],
            'email_personnel' => 'nullable|email',
            'matricule' => 'required|string|numeric',
            'telephone' => 'required|string|numeric',
            'code_postal' => 'required|string|numeric',
            'ville' => 'required|string',
            'pays' => 'required|string',
            'adresse' => 'required|string',
            'situation_familiale' => 'required|string',
            'nombre_enfants' => 'required|integer',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
    /**
     * Export employees to an Excel file.
     *
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }

    /**
     * Import employees from an Excel file.
     *
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new EmployeesImport, $request->file('file'));

        return back()->with('success', 'Employees imported successfully.');
    }
}
