<?php

namespace App\Livewire\Public\Report;

use App\Models\District;
use App\Models\Division;
use App\Models\Report;
use App\Models\ReportEvidence;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Throwable;

class Create extends Component
{
    use WithFileUploads;

    /*
    |--------------------------------------------------------------------------
    | Accused Information
    |--------------------------------------------------------------------------
    */

    public string $accused_name = '';
    public string $alias = '';
    public string $phone = '';
    public string $organization = '';

    /*
    |--------------------------------------------------------------------------
    | Location
    |--------------------------------------------------------------------------
    */

    public ?int $division_id = null;
    public ?int $district_id = null;
    public ?int $upazila_id = null;
    public ?int $union_id = null;

    public string $incident_area = '';

    /*
    |--------------------------------------------------------------------------
    | Incident
    |--------------------------------------------------------------------------
    */

    public string $incident_date = '';
    public string $incident_time = '';

    public string $amount_demanded = '';
    public string $amount_paid = '';

    public string $description = '';

    /*
    |--------------------------------------------------------------------------
    | Reporter
    |--------------------------------------------------------------------------
    */

    public string $reporter_name = '';
    public string $reporter_phone = '';
    public string $reporter_email = '';

    public bool $is_anonymous = true;

    /*
    |--------------------------------------------------------------------------
    | Evidence
    |--------------------------------------------------------------------------
    */

    public array $evidence = [];

    /*
    |--------------------------------------------------------------------------
    | Submission State
    |--------------------------------------------------------------------------
    */

    public bool $submitted = false;

    public string $trackingCode = '';

    public string $submitError = '';

    /*
    |--------------------------------------------------------------------------
    | Validation Rules
    |--------------------------------------------------------------------------
    */

    protected function rules(): array
    {
        return [

            'accused_name' => [
                'required',
                'string',
                'max:255',
            ],

            'alias' => [
                'nullable',
                'string',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'organization' => [
                'nullable',
                'string',
                'max:255',
            ],

            'division_id' => [
                'required',
                'exists:divisions,id',
            ],

            'district_id' => [
                'required',
                'exists:districts,id',
            ],

            'upazila_id' => [
                'nullable',
                'exists:upazilas,id',
            ],

            'union_id' => [
                'nullable',
                'exists:unions,id',
            ],

            'incident_area' => [
                'required',
                'string',
                'max:500',
            ],

            'incident_date' => [
                'nullable',
                'date',
                'before_or_equal:today',
            ],

            'incident_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'amount_demanded' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'amount_paid' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'description' => [
                'required',
                'string',
                'min:20',
                'max:10000',
            ],

            'reporter_name' => [
                'nullable',
                'string',
                'max:255',
            ],

            'reporter_phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'reporter_email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'is_anonymous' => [
                'boolean',
            ],

            'evidence' => [
                'nullable',
                'array',
                'max:10',
            ],

            'evidence.*' => [
                'file',
                'max:20480',
                'mimes:jpg,jpeg,png,webp,pdf,mp4,mov,mp3,wav,m4a,doc,docx',
            ],

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Validation Messages
    |--------------------------------------------------------------------------
    */

    protected function messages(): array
    {
        return [

            'accused_name.required' =>
                'যার বিষয়ে অভিযোগ করছেন তার নাম লিখুন।',

            'division_id.required' =>
                'বিভাগ নির্বাচন করুন।',

            'district_id.required' =>
                'জেলা নির্বাচন করুন।',

            'incident_area.required' =>
                'ঘটনার নির্দিষ্ট স্থান বা এলাকা লিখুন।',

            'description.required' =>
                'ঘটনার বিস্তারিত বিবরণ লিখুন।',

            'description.min' =>
                'ঘটনার বিবরণ কমপক্ষে ২০ অক্ষরের হতে হবে।',

            'incident_date.before_or_equal' =>
                'ভবিষ্যতের তারিখ নির্বাচন করা যাবে না।',

            'reporter_email.email' =>
                'সঠিক Email Address লিখুন।',

            'evidence.max' =>
                'সর্বোচ্চ ১০টি Evidence upload করা যাবে।',

            'evidence.*.max' =>
                'প্রতিটি Evidence সর্বোচ্চ 20MB হতে পারবে।',

            'evidence.*.mimes' =>
                'অনুমোদিত File Type ব্যবহার করুন।',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Division Changed
    |--------------------------------------------------------------------------
    */

    public function updatedDivisionId(): void
    {
        $this->district_id = null;
        $this->upazila_id = null;
        $this->union_id = null;
    }

    /*
    |--------------------------------------------------------------------------
    | District Changed
    |--------------------------------------------------------------------------
    */

    public function updatedDistrictId(): void
    {
        $this->upazila_id = null;
        $this->union_id = null;
    }

    /*
    |--------------------------------------------------------------------------
    | Upazila Changed
    |--------------------------------------------------------------------------
    */

    public function updatedUpazilaId(): void
    {
        $this->union_id = null;
    }

    /*
    |--------------------------------------------------------------------------
    | Generate Unique Tracking Code
    |--------------------------------------------------------------------------
    */

    private function generateTrackingCode(): string
    {
        do {

            $code =
                'NB-' .
                now()->format('ymd') .
                '-' .
                strtoupper(Str::random(8));

        } while (
            Report::query()
                ->where('tracking_code', $code)
                ->exists()
        );

        return $code;
    }

    /*
    |--------------------------------------------------------------------------
    | Detect Evidence Type
    |--------------------------------------------------------------------------
    */

    private function evidenceType(string $mime): string
    {
        if (str_starts_with($mime, 'image/')) {
            return 'image';
        }

        if (str_starts_with($mime, 'video/')) {
            return 'video';
        }

        if (str_starts_with($mime, 'audio/')) {
            return 'audio';
        }

        if (
            str_contains($mime, 'pdf') ||
            str_contains($mime, 'word') ||
            str_contains($mime, 'document') ||
            str_contains($mime, 'officedocument')
        ) {
            return 'document';
        }

        return 'other';
    }

    /*
    |--------------------------------------------------------------------------
    | Submit Report
    |--------------------------------------------------------------------------
    */

    public function submit(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Prevent accidental second submission
        |--------------------------------------------------------------------------
        */

        if ($this->submitted) {
            return;
        }

        $this->submitError = '';

        /*
        |--------------------------------------------------------------------------
        | Validate
        |--------------------------------------------------------------------------
        */

        $this->validate();

        /*
        |--------------------------------------------------------------------------
        | Prepare tracking code BEFORE transaction
        |--------------------------------------------------------------------------
        */

        $trackingCode = $this->generateTrackingCode();

        /*
        |--------------------------------------------------------------------------
        | Keep stored files so they can be removed if transaction fails
        |--------------------------------------------------------------------------
        */

        $storedEvidencePaths = [];

        try {

            DB::transaction(function () use (
                $trackingCode,
                &$storedEvidencePaths
            ) {

                /*
                |--------------------------------------------------------------------------
                | Content Hash
                |--------------------------------------------------------------------------
                */

                $contentHash = hash(
                    'sha256',

                    Str::lower(
                        trim($this->accused_name)
                    )
                    . '|' .

                    (string) $this->district_id
                    . '|' .

                    Str::lower(
                        trim($this->incident_area)
                    )
                    . '|' .

                    Str::lower(
                        trim($this->description)
                    )
                );

                /*
                |--------------------------------------------------------------------------
                | Create Report
                |--------------------------------------------------------------------------
                */

                $report = Report::create([

                    'tracking_code' =>
                        $trackingCode,

                    'accused_name' =>
                        trim($this->accused_name),

                    'alias' =>
                        filled($this->alias)
                            ? trim($this->alias)
                            : null,

                    'phone' =>
                        filled($this->phone)
                            ? trim($this->phone)
                            : null,

                    'organization' =>
                        filled($this->organization)
                            ? trim($this->organization)
                            : null,

                    /*
                    |--------------------------------------------------------------------------
                    | Location
                    |--------------------------------------------------------------------------
                    */

                    'division_id' =>
                        $this->division_id,

                    'district_id' =>
                        $this->district_id,

                    'upazila_id' =>
                        $this->upazila_id,

                    'union_id' =>
                        $this->union_id,

                    'incident_area' =>
                        trim($this->incident_area),

                    /*
                    |--------------------------------------------------------------------------
                    | Incident
                    |--------------------------------------------------------------------------
                    */

                    'incident_date' =>
                        filled($this->incident_date)
                            ? $this->incident_date
                            : null,

                    'incident_time' =>
                        filled($this->incident_time)
                            ? $this->incident_time
                            : null,

                    'amount_demanded' =>
                        filled($this->amount_demanded)
                            ? $this->amount_demanded
                            : null,

                    'amount_paid' =>
                        filled($this->amount_paid)
                            ? $this->amount_paid
                            : null,

                    'description' =>
                        trim($this->description),

                    /*
                    |--------------------------------------------------------------------------
                    | Reporter
                    |--------------------------------------------------------------------------
                    */

                    'reporter_name' =>
                        filled($this->reporter_name)
                            ? trim($this->reporter_name)
                            : null,

                    'reporter_phone' =>
                        filled($this->reporter_phone)
                            ? trim($this->reporter_phone)
                            : null,

                    'reporter_email' =>
                        filled($this->reporter_email)
                            ? trim($this->reporter_email)
                            : null,

                    'is_anonymous' =>
                        $this->is_anonymous,

                    /*
                    |--------------------------------------------------------------------------
                    | Status
                    |--------------------------------------------------------------------------
                    */

                    'status' => 'pending',

                    /*
                    |--------------------------------------------------------------------------
                    | Security / Duplicate Detection
                    |--------------------------------------------------------------------------
                    */

                    'submission_ip_hash' => hash(
                        'sha256',
                        (string) request()->ip()
                        . '|'
                        . (string) config('app.key')
                    ),

                    'content_hash' =>
                        $contentHash,

                ]);

                /*
                |--------------------------------------------------------------------------
                | Evidence
                |--------------------------------------------------------------------------
                */

                foreach ($this->evidence as $file) {

                    /*
                     * Private/local storage.
                     * Evidence is NOT stored inside public/storage.
                     */

                    $path = $file->store(
                        'evidence/' . $report->id,
                        'local'
                    );

                    if (!$path) {
                        throw new \RuntimeException(
                            'Evidence file could not be stored.'
                        );
                    }

                    $storedEvidencePaths[] = $path;

                    /*
                    |--------------------------------------------------------------------------
                    | Get actual local-storage path safely
                    |--------------------------------------------------------------------------
                    */

                    $absolutePath =
                        Storage::disk('local')
                            ->path($path);

                    /*
                    |--------------------------------------------------------------------------
                    | SHA-256
                    |--------------------------------------------------------------------------
                    */

                    $sha256 = null;

                    if (
                        is_file($absolutePath) &&
                        is_readable($absolutePath)
                    ) {

                        $sha256 = hash_file(
                            'sha256',
                            $absolutePath
                        );

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Create Evidence DB Record
                    |--------------------------------------------------------------------------
                    */

                    ReportEvidence::create([

                        'report_id' =>
                            $report->id,

                        'type' =>
                            $this->evidenceType(
                                (string) $file->getMimeType()
                            ),

                        'file_path' =>
                            $path,

                        'original_name' =>
                            $file->getClientOriginalName(),

                        'mime_type' =>
                            $file->getMimeType(),

                        'file_size' =>
                            $file->getSize(),

                        'sha256_hash' =>
                            $sha256,

                        'is_verified' =>
                            false,

                        'is_public' =>
                            false,

                    ]);

                }

            }, 3);

        } catch (Throwable $exception) {

            /*
            |--------------------------------------------------------------------------
            | DB rollback happens automatically.
            |
            | But uploaded files are filesystem operations, so remove any files
            | that were stored before the exception.
            |--------------------------------------------------------------------------
            */

            foreach ($storedEvidencePaths as $path) {

                if (
                    Storage::disk('local')
                        ->exists($path)
                ) {

                    Storage::disk('local')
                        ->delete($path);

                }

            }

            /*
            |--------------------------------------------------------------------------
            | Log actual technical error
            |--------------------------------------------------------------------------
            */

            report($exception);

            /*
            |--------------------------------------------------------------------------
            | User-safe error message
            |--------------------------------------------------------------------------
            */

            $this->submitError =
                'অভিযোগটি জমা দেওয়া যায়নি। অনুগ্রহ করে আবার চেষ্টা করুন।';

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |
        | We only reach this point after the transaction completed successfully.
        |--------------------------------------------------------------------------
        */

        $this->trackingCode = $trackingCode;

        /*
        |--------------------------------------------------------------------------
        | Clear Form
        |--------------------------------------------------------------------------
        |
        | trackingCode must NOT be reset.
        |--------------------------------------------------------------------------
        */

        $this->reset([
            'accused_name',
            'alias',
            'phone',
            'organization',

            'division_id',
            'district_id',
            'upazila_id',
            'union_id',

            'incident_area',
            'incident_date',
            'incident_time',

            'amount_demanded',
            'amount_paid',

            'description',

            'reporter_name',
            'reporter_phone',
            'reporter_email',

            'evidence',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Restore default anonymous state
        |--------------------------------------------------------------------------
        */

        $this->is_anonymous = true;

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        |
        | Your Blade already checks:
        |
        | @if($submitted)
        |
        | so this switches the whole form to the success screen.
        |--------------------------------------------------------------------------
        */

        $this->submitted = true;

        /*
        |--------------------------------------------------------------------------
        | Scroll browser to top
        |--------------------------------------------------------------------------
        */

        $this->js(
            "window.scrollTo({ top: 0, behavior: 'smooth' });"
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        return view(
            'livewire.public.report.create',
            [

                /*
                |--------------------------------------------------------------------------
                | Divisions
                |--------------------------------------------------------------------------
                */

                'divisions' =>
                    Division::query()
                        ->where('is_active', true)
                        ->orderBy('name_bn')
                        ->get(),

                /*
                |--------------------------------------------------------------------------
                | Districts
                |--------------------------------------------------------------------------
                */

                'districts' =>
                    $this->division_id

                        ? District::query()
                            ->where(
                                'division_id',
                                $this->division_id
                            )
                            ->where(
                                'is_active',
                                true
                            )
                            ->orderBy('name_bn')
                            ->get()

                        : collect(),

                /*
                |--------------------------------------------------------------------------
                | Upazilas
                |--------------------------------------------------------------------------
                */

                'upazilas' =>
                    $this->district_id

                        ? Upazila::query()
                            ->where(
                                'district_id',
                                $this->district_id
                            )
                            ->where(
                                'is_active',
                                true
                            )
                            ->orderBy('name_bn')
                            ->get()

                        : collect(),

                /*
                |--------------------------------------------------------------------------
                | Unions
                |--------------------------------------------------------------------------
                */

                'unions' =>
                    $this->upazila_id

                        ? Union::query()
                            ->where(
                                'upazila_id',
                                $this->upazila_id
                            )
                            ->where(
                                'is_active',
                                true
                            )
                            ->orderBy('name_bn')
                            ->get()

                        : collect(),

            ]
        )->layout(
            'components.layouts.public'
        );
    }
}