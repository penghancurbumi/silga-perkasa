<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    // Publik — submit lamaran (dari Next.js)
    public function store(Request $request)
    {
        $request->validate([
            'fullname'                      => 'required|string|max:255',
            'email'                         => 'required|email|unique:applicants,email',
            'phone'                         => 'required|string|max:20',
            'gender'                        => 'required|in:male,female',
            'birth_place'                   => 'required|string',
            'birth_date'                    => 'required|date',
            'address'                       => 'nullable|string',
            'kelurahan'                     => 'required|string',
            'kecamatan'                     => 'required|string',
            'kota'                          => 'required|string',
            'provinsi'                      => 'required|string',
            'postal_code'                   => 'required|string|max:10',
            'referral_source'               => 'required|in:jobstreet,linkedin,website,referral,other',
            'lowongan_id'                   => 'required|exists:lowongans,id',
            'resume'                        => 'required|file|mimes:pdf|max:2048',
            'declaration'                   => 'required|accepted',
            'educations'                    => 'required|array|min:1',
            'educations.*.jenjang'          => 'required|in:sd,smp,sma,smk,d3,d4,s1,s2,s3',
            'educations.*.institution_name' => 'required|string',
            'educations.*.prodi'            => 'nullable|string',
            'educations.*.gelar'            => 'nullable|string',
            'educations.*.ipk'              => 'nullable|numeric|min:0|max:4',
            'educations.*.start_date'       => 'required|date',
            'educations.*.end_date'         => 'nullable|date',
            'experiences'                   => 'nullable|array',
            'experiences.*.company_name'    => 'required_with:experiences|string',
            'experiences.*.job_title'       => 'required_with:experiences|string',
            'experiences.*.employment_type' => 'required_with:experiences|in:fulltime,parttime,internship,contract,freelance',
            'experiences.*.start_date'      => 'required_with:experiences|date',
            'experiences.*.end_date'        => 'nullable|date',
            'experiences.*.is_current'      => 'boolean',
            'experiences.*.job_description' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            $applicant = Applicant::create($request->only([
                'fullname', 'email', 'phone', 'gender',
                'birth_place', 'birth_date', 'address',
                'kelurahan', 'kecamatan', 'kota',
                'provinsi', 'postal_code', 'referral_source',
            ]));

            $applicant->educations()->createMany($request->educations);

            if ($request->experiences) {
                $experiences = collect($request->experiences)
                    ->filter(fn($e) => !empty($e['company_name']))
                    ->toArray();

                if (!empty($experiences)) {
                    $applicant->experiences()->createMany($experiences);
                }
            }

            if ($request->skills) {
                $applicant->skills()->createMany($request->skills);
            }

            $resumePath = $request->file('resume')->store('resumes', 'public');

            $applicant->applications()->create([
                'lowongan_id' => $request->lowongan_id,
                'resume'      => $resumePath,
                'declaration' => true,
                'status'      => 'pending',
                'applied_at'  => now(),
            ]);

            DB::commit();

            return response()->json([
                'message' => 'Lamaran berhasil dikirim.',
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Terjadi kesalahan.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    // HRD — detail pelamar
    public function show($id)
    {
        $applicant = Applicant::with([
            'educations',
            'experiences',
            'skills',
            'applications.lowongan',
        ])->findOrFail($id);

        return response()->json(['data' => $applicant]);
    }
}