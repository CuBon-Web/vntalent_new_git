<?php

namespace App\Http\Controllers;

use App\Mail\CustomerLeadSubmitted;
use App\models\CustomerLead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\models\website\Setting;

class CustomerLeadController extends Controller
{
    public function create()
    {
        return view('customer-leads.create');
    }

    public function store(Request $request)
    {
        if ((int) $request->input('quick_form') === 1) {
            $quickValidated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'nullable|email|max:255',
                'service' => 'nullable|string|max:255',
                'consultation_content' => 'nullable|string|max:2000',
                'quick_source' => 'nullable|string|max:100',
            ]);

            $lead = CustomerLead::create([
                'full_name' => $quickValidated['name'],
                'birth_date' => now()->toDateString(),
                'gender' => null,
                'phone' => $quickValidated['phone'],
                'email' => $quickValidated['email'] ?? null,
                'province' => 'Chua cap nhat',
                'education_level' => 'THPT',
                'major' => null,
                'graduation_year' => null,
                'learned_german' => 'no',
                'german_level' => null,
                'ready_to_learn_german' => 'Se trao doi khi tu van',
                'program_interest' => 'du-hoc-nghe',
                'desired_job' => 'nha-hang',
                'planned_departure_time' => null,
                'financial_capacity' => null,
                'work_experience' => null,
                'current_job' => null,
                'registrant_type' => null,
                'parent_phone' => null,
                'marketing_source' => $quickValidated['quick_source'] ?? 'form-trang-chu',
                'consultation_content' => $quickValidated['consultation_content'] ?? ($quickValidated['service'] ?? null),
            ]);

            $email = optional(Setting::first())->email;
            if ($email) {
                Mail::to($email)->send(new CustomerLeadSubmitted($lead));
            }

            return redirect()->back()->with('success', 'Thong tin cua ban da duoc ghi nhan. Chung toi se lien he som.');
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'nullable|in:male,female,other',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'province' => 'required|string|max:255',
            'education_level' => 'required|in:THPT,TC,CD,DH',
            'major' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer|min:1950|max:2100',
            'learned_german' => 'required|in:yes,no',
            'german_level' => 'nullable|in:A1,A2,B1,B2',
            'ready_to_learn_german' => 'required|string|max:255',
            'program_interest' => 'required|in:du-hoc-nghe,xkld',
            'desired_job' => 'required|in:nha-hang,khach-san',
            'planned_departure_time' => 'nullable|string|max:255',
            'financial_capacity' => 'nullable|string|max:255',
            'work_experience' => 'nullable|string|max:255',
            'current_job' => 'nullable|string|max:255',
            'registrant_type' => 'nullable|in:tot-nghiep-thpt,sinh-vien,di-lam',
            'parent_phone' => 'nullable|string|max:20',
            'marketing_source' => 'nullable|string|max:255',
            'consultation_content' => 'nullable|string|max:2000',
        ]);

        $lead = CustomerLead::create($validated);
        $email = optional(Setting::first())->email;
        if ($email) {
            Mail::to($email)->send(new CustomerLeadSubmitted($lead));
        }

        return redirect()
            ->route('customer-leads.create')
            ->with('success', 'Cảm ơn bạn! Thông tin đã được ghi nhận, đội ngũ tư vấn sẽ liên hệ sớm.');
    }
}
