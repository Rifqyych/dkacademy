<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Services\WhatsAppRegistrationNotifier;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class RegistrationController extends Controller
{
    public function store(Request $request, WhatsAppRegistrationNotifier $notifier)
    {
        $request->validate([
            'full_name' => 'required|max:255',
            'email' => 'required|email|unique:registrations,email',
            'phone' => 'required|max:20',
            'program' => 'required',
            'level' => 'required',
            'message' => 'nullable'
        ]);

        $data = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'program' => $request->program,
            'level' => $request->level,
            'message' => $request->message,
        ];

        if (Schema::hasColumn('registrations', 'tanggal_daftar')) {
            $data['tanggal_daftar'] = Carbon::now()->toDateString();
        }

        if (Schema::hasColumn('registrations', 'status')) {
            $data['status'] = 'baru';
        }

        $registration = Registration::create($data);

        $notifier->send($registration);

        return redirect()
            ->route('kursus.daftar')
            ->with('success', 'Pendaftaran berhasil dikirim. Tim DK Academy akan segera menghubungi kamu.');
    }
}
