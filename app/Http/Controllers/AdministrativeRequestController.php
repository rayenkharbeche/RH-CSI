<?php

// app/Http/Controllers/AdministrativeRequestController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdministrativeRequest;
use App\Models\Employee;
use App\Http\Requests\CreateAdministrativeRequestRequest;
use App\Http\Requests\UpdateAdministrativeRequestRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAdministrativeRequestNotification;
use App\Mail\UpdateAdministrativeRequestStatusNotification;
use App\Services\PdfService;
use App\Mail\DocumentMail;
class AdministrativeRequestController extends Controller
{
    protected $pdfService;
    public function index()
    {
        $requests = AdministrativeRequest::latest()->paginate(10);
        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('requests.create', compact('employees'));
    }

    public function store(CreateAdministrativeRequestRequest $request)
    {
        $validatedData = $request->validated();

        $demande = AdministrativeRequest::create($validatedData);

        // Récupérer l'employé associé à la demande
        $employee = Employee::findOrFail($request->employee_id);

        // Envoyer l'e-mail de notification pour la création de la demande
        Mail::to($employee->email_professionnel)->send(new NewAdministrativeRequestNotification($employee, $demande));

        return redirect()->route('requests.index')->with('success', 'Demande administrative créée avec succès.');
    }

    public function edit(AdministrativeRequest $request)
    {
        $employees = Employee::all();
        return view('requests.edit', compact('request', 'employees'));
    }

    public function update(Request $request, AdministrativeRequest $administrativeRequest)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $oldStatus = $administrativeRequest->status;
        $administrativeRequest->update($request->all());

        $employee = $administrativeRequest->employee;

        if ($administrativeRequest->status !== $oldStatus) {
            if ($administrativeRequest->status === 'approuvé') {
                $data = [
                    'title' => 'Document approuvé',
                    'content' => 'Votre document a été approuvé.',
                ];

                // Sélectionnez la vue PDF en fonction du type de demande et du pays de l'employé
                $viewName = $this->getViewNameForRequestType($administrativeRequest->type, $employee->pays, $employee->id);

                $pdf = $this->pdfService->generatePdf($data, $viewName);

                Mail::to($employee->email_professionnel)->send(new DocumentMail($employee, $administrativeRequest, $pdf));
            } else {
                Mail::to($employee->email_professionnel)->send(new UpdateAdministrativeRequestStatusNotification($employee, $administrativeRequest));
            }
        }

        return redirect()->route('requests.index')->with('success', 'Statut de la demande administrative mis à jour avec succès.');
    }

    private function getViewNameForRequestType($type, $country, $employeeId)
    {
        $employee = Employee::find($employeeId); // Récupérer l'employé depuis la base de données

        if (!$employee) {
            abort(404, 'Employé non trouvé');
        }

        if ($type == 'Attestation de travail') {
            if ($country == 'Tunisie') {
                return view('pdf.att_tra_tun', ['employee' => $employee]);
            } elseif ($country == 'France') {
                return view('pdf.att_tra_fr', ['employee' => $employee]);
            }
        } elseif ($type == 'Attestation de salaire') {
            if ($country == 'Tunisie') {
                return view('pdf.att_sal_tun', ['employee' => $employee]);
            } elseif ($country == 'France') {
                return view('pdf.att_sal_fr', ['employee' => $employee]);
            }
        }

        // Ajouter d'autres types de demande et pays ici si nécessaire

        // Retourner une vue par défaut si aucun cas ne correspond
        return view('pdf.default', ['employee' => $employee]);
    }


    public function destroy(AdministrativeRequest $request)
    {
        $request->delete();
        return redirect()->route('requests.index')->with('success', 'Demande administrative supprimée avec succès.');
    }
    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function approveRequest($id)
    {
        $administrativeRequest = AdministrativeRequest::findOrFail($id);

        if ($administrativeRequest->status == 'approuvé') {
            $employee = $administrativeRequest->employee;  // Assurez-vous que cette relation est définie dans votre modèle AdministrativeRequest

            $data = [
                'title' => 'Document approuvé',
                'content' => 'Votre document a été approuvé.',
            ];

            $pdf = $this->pdfService->generatePdf($data);

            Mail::to($employee->email_professionnel)->send(new DocumentMail($data, $pdf));

            return response()->json(['message' => 'E-mail envoyé avec succès.']);
        }

        return response()->json(['message' => 'La demande n\'est pas approuvée.'], 400);
    }
}
