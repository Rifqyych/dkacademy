USE `dkacademy`;

INSERT INTO `mentors` (`nama_mentor`, `spesialisasi`, `deskripsi`, `foto`, `created_at`, `updated_at`)
SELECT
    'DK Academy IELTS Mentor Team',
    'IELTS Preparation',
    'Tim mentor membantu peserta memahami writing, speaking, reading, listening, dan strategi IELTS secara bertahap.',
    'images/mentor/mentor1.png',
    NOW(),
    NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `mentors` WHERE `nama_mentor` = 'DK Academy IELTS Mentor Team'
);

INSERT INTO `mentors` (`nama_mentor`, `spesialisasi`, `deskripsi`, `foto`, `created_at`, `updated_at`)
SELECT
    'DK Academy TOEFL Mentor Team',
    'TOEFL Preparation',
    'Tim mentor membantu peserta memperkuat structure, reading comprehension, listening, dan latihan TOEFL.',
    'images/mentor/mentor2.png',
    NOW(),
    NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `mentors` WHERE `nama_mentor` = 'DK Academy TOEFL Mentor Team'
);

INSERT INTO `mentors` (`nama_mentor`, `spesialisasi`, `deskripsi`, `foto`, `created_at`, `updated_at`)
SELECT
    'DK Academy English Mentor Team',
    'General English',
    'Tim mentor membantu peserta meningkatkan grammar, vocabulary, confidence, dan komunikasi Bahasa Inggris sehari-hari.',
    'images/mentor/mentor3.png',
    NOW(),
    NOW()
WHERE NOT EXISTS (
    SELECT 1 FROM `mentors` WHERE `nama_mentor` = 'DK Academy English Mentor Team'
);
