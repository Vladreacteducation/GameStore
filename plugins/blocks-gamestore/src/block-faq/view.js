document.addEventListener('DOMContentLoaded', function () {
    const faqs = document.querySelectorAll('.faq-item');
    faqs.forEach((faq)=>{

        const question = faq.querySelector('.faq-item-title');
        const answer = faq.querySelector('.faq-item-description');

        question.addEventListener('click', function () {
            answer.classList.toggle('show');
            question.classList.toggle('open');
        });
    })
});