USE `dkacademy`;

INSERT INTO `programs` (`nama_program`, `deskripsi`, `icon`, `created_at`, `updated_at`)
SELECT
    'TOEFL Preparation',
    'Program persiapan TOEFL untuk memahami struktur soal, grammar, reading comprehension, listening, dan strategi menjawab.',
    'TP',
    NOW(),
    NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `programs` WHERE `nama_program` = 'TOEFL Preparation'
);

INSERT INTO `programs` (`nama_program`, `deskripsi`, `icon`, `created_at`, `updated_at`)
SELECT
    'IELTS & TOEFL Simulation Test',
    'Simulasi IELTS dan TOEFL untuk latihan format test, mengukur kemampuan awal, dan menentukan program belajar yang sesuai.',
    'ST',
    NOW(),
    NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `programs` WHERE `nama_program` = 'IELTS & TOEFL Simulation Test'
);

INSERT INTO `programs` (`nama_program`, `deskripsi`, `icon`, `created_at`, `updated_at`)
SELECT
    'General English',
    'Program untuk meningkatkan kemampuan Bahasa Inggris sehari-hari, termasuk grammar, vocabulary, speaking, listening, dan confidence dalam berkomunikasi.',
    'GE',
    NOW(),
    NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `programs` WHERE `nama_program` = 'General English'
);

INSERT INTO `programs` (`nama_program`, `deskripsi`, `icon`, `created_at`, `updated_at`)
SELECT
    'IELTS Preparation',
    'Program persiapan IELTS untuk membantu peserta memahami format test, academic English, reading, listening, writing, dan speaking practice.',
    'IP',
    NOW(),
    NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `programs` WHERE `nama_program` = 'IELTS Preparation'
);

-- Mentor bisa diisi dengan team placeholder kalau belum ada nama mentor asli.
-- Kalau sudah punya data asli, masukkan dengan format berikut:
--
-- INSERT INTO `mentors` (`nama_mentor`, `spesialisasi`, `deskripsi`, `foto`, `created_at`, `updated_at`)
-- VALUES
-- ('Nama Mentor Asli', 'IELTS / TOEFL / General English', 'Deskripsi mentor asli.', NULL, NOW(), NOW());
