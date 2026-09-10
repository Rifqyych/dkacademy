import './bootstrap';

document.documentElement.classList.add('reveal-ready');

const navbar = document.querySelector('[data-navbar]');
const navToggle = document.querySelector('[data-nav-toggle]');
const navMenu = document.querySelector('[data-nav-menu]');

if (navbar) {
    const syncNavbar = () => {
        navbar.classList.toggle('is-scrolled', window.scrollY > 12);
    };

    syncNavbar();
    window.addEventListener('scroll', syncNavbar, { passive: true });
}

if (navToggle && navMenu) {
    navToggle.addEventListener('click', () => {
        const isOpen = navMenu.classList.toggle('is-open');
        navToggle.setAttribute('aria-expanded', String(isOpen));
    });
}

const revealItems = document.querySelectorAll('[data-reveal]');

if (revealItems.length) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.14 });

    revealItems.forEach((item) => observer.observe(item));
}

document.querySelectorAll('[data-faq]').forEach((faq) => {
    faq.querySelectorAll('.faq-item button').forEach((button) => {
        button.addEventListener('click', () => {
            const item = button.closest('.faq-item');
            const isOpen = item.classList.toggle('is-open');
            const icon = button.querySelector('i');

            if (icon) {
                icon.className = isOpen ? 'bi bi-dash' : 'bi bi-plus';
            }
        });
    });
});

document.querySelectorAll('[data-program-finder]').forEach((finder) => {
    let programs = [];

    try {
        programs = JSON.parse(finder.dataset.programFinder || '[]');
    } catch (error) {
        programs = [];
    }

    const result = finder.querySelector('[data-program-result]');
    const buttons = finder.querySelectorAll('[data-goal]');

    const matchProgram = (goal) => {
        const goalText = goal.toLowerCase();

        if (!programs.length) {
            return null;
        }

        if (goalText === 'level') {
            return programs.find((program) => program.name.toLowerCase().includes('english')) || programs[0];
        }

        return programs.find((program) => {
            const haystack = `${program.name} ${program.description}`.toLowerCase();
            return haystack.includes(goalText);
        }) || programs[0];
    };

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            buttons.forEach((item) => item.classList.remove('is-active'));
            button.classList.add('is-active');

            const program = matchProgram(button.dataset.goal);

            if (!result) {
                return;
            }

            result.hidden = false;

            if (!program) {
                result.innerHTML = `
                    <h3>Recommended for You</h3>
                    <p>No saved program data was available during this check. Please contact DK Academy for a direct recommendation.</p>
                    <a href="/daftar-kursus" class="btn btn-primary">Register Now</a>
                `;
                return;
            }

            result.innerHTML = `
                <h3>Recommended for You</h3>
                <p><strong>${program.name}</strong></p>
                <p>Based on your goal, this program may be suitable for you.</p>
                <div class="button-row">
                    <a href="${program.url}" class="btn btn-outline">View Program</a>
                    <a href="${program.registerUrl}" class="btn btn-primary">Register Now</a>
                </div>
            `;
        });
    });
});

document.querySelectorAll('[data-level-check]').forEach((quiz) => {
    const questions = [
        {
            question: 'She _____ English every Monday.',
            options: ['study', 'studies', 'studying'],
            answer: 1,
        },
        {
            question: 'Choose the correct sentence.',
            options: ['I am interested in English.', 'I interested English.', 'I am interest English.'],
            answer: 0,
        },
        {
            question: 'What is the opposite of "difficult"?',
            options: ['Easy', 'Strong', 'Late'],
            answer: 0,
        },
        {
            question: 'They have lived in Makassar _____ 2021.',
            options: ['for', 'since', 'during'],
            answer: 1,
        },
        {
            question: 'If I had more time, I _____ more.',
            options: ['practice', 'will practice', 'would practice'],
            answer: 2,
        },
        {
            question: 'The report _____ by the teacher yesterday.',
            options: ['checked', 'was checked', 'is checking'],
            answer: 1,
        },
    ];

    let current = 0;
    let score = 0;

    const count = quiz.querySelector('[data-quiz-count]');
    const question = quiz.querySelector('[data-quiz-question]');
    const options = quiz.querySelector('[data-quiz-options]');
    const result = quiz.querySelector('[data-quiz-result]');

    const levelFromScore = () => {
        if (score <= 1) return 'Beginner';
        if (score <= 3) return 'Elementary';
        if (score <= 5) return 'Intermediate';
        return 'Upper Intermediate';
    };

    const renderResult = () => {
        if (count) count.textContent = 'Completed';
        if (question) question.textContent = 'Estimated English Level';
        if (options) options.innerHTML = '';
        if (result) {
            const level = levelFromScore();
            result.hidden = false;
            result.innerHTML = `
                <h3>${level}</h3>
                <p>This quick test provides an approximate indication of your current English level.</p>
                <div class="button-row">
                    <a href="/programs" class="btn btn-outline">View Recommended Program</a>
                    <a href="/daftar-kursus?level=${encodeURIComponent(level)}" class="btn btn-primary">Register Now</a>
                </div>
            `;
        }
    };

    const renderQuestion = () => {
        const item = questions[current];

        if (count) count.textContent = `Question ${current + 1} of ${questions.length}`;
        if (question) question.textContent = item.question;
        if (result) result.hidden = true;
        if (!options) return;

        options.innerHTML = '';
        item.options.forEach((option, index) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = option;
            button.addEventListener('click', () => {
                if (index === item.answer) {
                    score += 1;
                }

                current += 1;

                if (current >= questions.length) {
                    renderResult();
                } else {
                    renderQuestion();
                }
            });
            options.appendChild(button);
        });
    };

    renderQuestion();
});
