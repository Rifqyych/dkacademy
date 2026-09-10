USE `dkacademy`;

UPDATE `programs`
SET
    `nama_program` = 'IELTS Preparation',
    `deskripsi` = 'Program persiapan IELTS untuk membantu peserta memahami format test, academic English, reading, listening, writing, dan speaking practice.',
    `icon` = 'IP',
    `updated_at` = NOW()
WHERE `nama_program` = 'English Conversation';

UPDATE `programs`
SET
    `nama_program` = 'TOEFL Preparation',
    `deskripsi` = 'Program persiapan TOEFL untuk memahami struktur soal, grammar, reading comprehension, listening, dan strategi menjawab.',
    `icon` = 'TP',
    `updated_at` = NOW()
WHERE `nama_program` = 'General English';

UPDATE `programs`
SET
    `nama_program` = 'General English',
    `deskripsi` = 'Program untuk meningkatkan kemampuan Bahasa Inggris sehari-hari, termasuk grammar, vocabulary, speaking, listening, dan confidence dalam berkomunikasi.',
    `icon` = 'GE',
    `updated_at` = NOW()
WHERE `nama_program` = 'IELTS & TOEFL Prediction Test';

UPDATE `programs`
SET
    `nama_program` = 'IELTS & TOEFL Simulation Test',
    `deskripsi` = 'Simulasi IELTS dan TOEFL untuk latihan format test, mengukur kemampuan awal, dan menentukan program belajar yang sesuai.',
    `icon` = 'ST',
    `updated_at` = NOW()
WHERE `nama_program` = 'IELTS & TOEFL Preparation';
