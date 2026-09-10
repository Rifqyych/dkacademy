<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Program;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Throwable;

class WebsiteController extends Controller
{
    public function home()
    {
        $programs = $this->programs();
        $mentors = $this->mentors();
        $contact = $this->contactInfo();

        return view('welcome', compact('programs', 'mentors', 'contact'));
    }

    public function programsIndex()
    {
        $programs = $this->programs();

        return view('programs.index', compact('programs'));
    }

    public function programShow(string $program)
    {
        try {
            $program = $this->decorateProgram(Program::findOrFail($program));
        } catch (Throwable $exception) {
            $program = $this->fallbackPrograms()->firstWhere('id', (int) $program);

            abort_if(! $program, 404);
        }

        return view('programs.show', compact('program'));
    }

    public function about()
    {
        $contact = $this->contactInfo();

        return view('about', compact('contact'));
    }

    public function mentorsIndex()
    {
        $mentors = $this->mentors();

        return view('mentors.index', compact('mentors'));
    }

    public function successStories()
    {
        $contact = $this->contactInfo();

        return view('success-stories', compact('contact'));
    }

    public function contact()
    {
        $contact = $this->contactInfo();

        return view('contact', compact('contact'));
    }

    public function registration(Request $request)
    {
        $programs = $this->programs();
        $selectedProgram = $request->query('program');
        $selectedLevel = $request->query('level');

        return view('register', compact('programs', 'selectedProgram', 'selectedLevel'));
    }

    private function programs(): Collection|EloquentCollection
    {
        try {
            $programs = Program::query()
                ->orderByRaw("FIELD(nama_program, 'IELTS Preparation', 'TOEFL Preparation', 'General English', 'IELTS & TOEFL Simulation Test')")
                ->orderBy('nama_program')
                ->get();

            return $programs->isNotEmpty() ? $programs->map(fn ($program) => $this->decorateProgram($program)) : $this->fallbackPrograms();
        } catch (Throwable $exception) {
            return $this->fallbackPrograms();
        }
    }

    private function mentors(): Collection|EloquentCollection
    {
        try {
            $mentors = Mentor::query()->orderBy('nama_mentor')->get();

            return $mentors->isNotEmpty() ? $this->normalizeMentors($mentors) : $this->fallbackMentors();
        } catch (Throwable $exception) {
            return $this->fallbackMentors();
        }
    }

    private function fallbackMentors(): Collection
    {
        return collect([
            $this->mentorItem('DK Academy IELTS Mentor Team', 'IELTS Preparation', 'Tim mentor membantu peserta memahami writing, speaking, reading, listening, dan strategi IELTS secara bertahap.', 'images/mentor/mentor1.png'),
            $this->mentorItem('DK Academy TOEFL Mentor Team', 'TOEFL Preparation', 'Tim mentor membantu peserta memperkuat structure, reading comprehension, listening, dan latihan TOEFL.', 'images/mentor/mentor2.png'),
            $this->mentorItem('DK Academy English Mentor Team', 'General English', 'Tim mentor membantu peserta meningkatkan grammar, vocabulary, confidence, dan komunikasi Bahasa Inggris sehari-hari.', 'images/mentor/mentor3.png'),
            $this->mentorItem('DK Academy Simulation Test Mentor Team', 'IELTS & TOEFL Simulation Test', 'Tim mentor membantu peserta latihan format tes, review jawaban, dan simulasi IELTS/TOEFL.', 'images/mentor/mentor4.png'),
        ]);
    }

    private function mentorItem(string $name, string $specialization, string $description, string $photo): object
    {
        return (object) [
            'nama_mentor' => $name,
            'spesialisasi' => $specialization,
            'deskripsi' => $description,
            'foto' => $photo,
        ];
    }

    private function normalizeMentors(EloquentCollection $mentors): Collection
    {
        $fallbacks = $this->fallbackMentors()->keyBy(fn ($mentor) => strtolower($mentor->spesialisasi));
        $fromDatabase = collect();

        foreach ($mentors as $mentor) {
            $key = strtolower(trim($mentor->spesialisasi));

            if (! $fromDatabase->has($key)) {
                $fromDatabase->put($key, $mentor);
            }
        }

        return collect([
            'IELTS Preparation',
            'TOEFL Preparation',
            'General English',
            'IELTS & TOEFL Simulation Test',
        ])->map(function (string $specialization) use ($fallbacks, $fromDatabase) {
            $key = strtolower($specialization);
            $mentor = $fromDatabase->get($key) ?: $fallbacks->get($key);

            $mentor->spesialisasi = $specialization;
            $mentor->foto = $this->mentorImage($specialization);

            return $mentor;
        });
    }

    private function mentorImage(string $specialization): string
    {
        $normalized = strtolower($specialization);

        return match (true) {
            str_contains($normalized, 'simulation') => 'images/mentor/mentor4.png',
            str_contains($normalized, 'toefl') => 'images/mentor/mentor2.png',
            str_contains($normalized, 'general') => 'images/mentor/mentor3.png',
            default => 'images/mentor/mentor1.png',
        };
    }

    private function fallbackPrograms(): Collection
    {
        return collect([
            $this->programItem(1, 'IELTS Preparation', 'Program persiapan IELTS untuk membantu peserta memahami format test, academic English, reading, listening, writing, dan speaking practice.', 'IP'),
            $this->programItem(2, 'TOEFL Preparation', 'Program persiapan TOEFL untuk memahami struktur soal, grammar, reading comprehension, listening, dan strategi menjawab.', 'TP'),
            $this->programItem(3, 'General English', 'Program untuk meningkatkan kemampuan Bahasa Inggris sehari-hari, termasuk grammar, vocabulary, speaking, listening, dan confidence dalam berkomunikasi.', 'GE'),
            $this->programItem(4, 'IELTS & TOEFL Simulation Test', 'Simulasi IELTS dan TOEFL untuk latihan format test, mengukur kemampuan awal, dan menentukan program belajar yang sesuai.', 'ST'),
        ]);
    }

    private function programItem(int $id, string $name, string $description, string $icon): object
    {
        return (object) [
            'id' => $id,
            'nama_program' => $name,
            'deskripsi' => $description,
            'icon' => $icon,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'image' => $this->programImage($name),
            'imagePosition' => $this->programImagePosition($name),
        ];
    }

    private function decorateProgram(object $program): object
    {
        $program->image = $this->programImage($program->nama_program);
        $program->imagePosition = $this->programImagePosition($program->nama_program);

        return $program;
    }

    private function programImage(string $name): string
    {
        $normalized = strtolower($name);

        return match (true) {
            str_contains($normalized, 'simulation') => 'images/programs/toefl&ielts simulation test.png',
            str_contains($normalized, 'ielts') => 'images/programs/ielts preperation.png',
            str_contains($normalized, 'toefl') => 'images/programs/toefl preperation.png',
            default => 'images/programs/general english.png',
        };
    }

    private function programImagePosition(string $name): string
    {
        $normalized = strtolower($name);

        return match (true) {
            str_contains($normalized, 'general') => 'center 24%',
            str_contains($normalized, 'simulation') => 'center 55%',
            str_contains($normalized, 'toefl') => 'center 45%',
            default => 'center 42%',
        };
    }

    private function contactInfo(): array
    {
        $address = 'Jl. Manggis No.10, Losari, Kec. Ujung Pandang, Kota Makassar, Sulawesi Selatan';

        return [
            'address' => $address,
            'phone' => '+62 812-1066-9659',
            'whatsappUrl' => 'https://wa.me/6281210669659',
            'email' => 'dkacademy@gmail.com',
            'instagram' => 'https://www.instagram.com/dk.academy.id/',
            'workingHours' => 'Senin - Sabtu, 08:00 - 20:00',
            'mapUrl' => 'https://www.google.com/maps/search/?api=1&query=' . urlencode($address),
            'mapEmbedUrl' => 'https://www.google.com/maps?q=' . urlencode($address) . '&output=embed',
            'sourceUrl' => 'https://www.kitalulus.com/company/dk-academy-53wa',
            'jobSourceUrl' => 'https://www.kitalulus.com/lowongan/detail/english-teacher-9coe',
        ];
    }
}
