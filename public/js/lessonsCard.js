document.querySelector('#lessons').addEventListener('click', (e) => {
    document.querySelector('#dayNumberInput').value = e.target.closest('.lessons_card_button')?.dataset.day_number;
    document.querySelector('#weekNumberInput').value = e.target.closest('.lessons_card_button')?.dataset.week_number;
    document.querySelector('#lessonStartInput').value = e.target.closest('.lessons_card_button')?.dataset.lesson_start;
});

document.querySelector('#lessons').addEventListener('click', (e) => {
    document
        .querySelector(`${e.target.closest('.lessons_card_button').dataset.target} #lessonIdInput`)
        .value = e.target.closest('.lessons_card_button')?.dataset.lesson_id;
});
