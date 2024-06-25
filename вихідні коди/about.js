document.addEventListener('DOMContentLoaded', function () {
    function setLanguage(lang) {
        const languageDropdown = document.getElementById('languageDropdown');
        if (languageDropdown) {
            languageDropdown.innerText = lang;
        }
        const elements = document.querySelectorAll('[data-lang]');
        elements.forEach(element => {
            const key = element.getAttribute('data-lang');
            if (translations[key]) {
                element.innerText = translations[key][lang.toLowerCase()];
            }
        });
    }

    const translations = {
        'about-us': { 'ua': 'Про нас', 'en': 'About Us' },
        'intro1': { 
            'ua': 'Наш ресторан SushiSloth - це місце, де поєднуються традиції та сучасність. Ми пропонуємо широкий асортимент смачних суші, приготованих з найсвіжіших інгредієнтів. Наші шеф-кухарі мають багаторічний досвід та використовують тільки найкращі продукти, щоб ви могли насолоджуватися кожним шматочком.', 
            'en': 'Our SushiSloth restaurant is a place where tradition meets modernity. We offer a wide range of delicious sushi made from the freshest ingredients. Our chefs have years of experience and use only the best products so you can enjoy every bite.' 
        },
        'intro2': { 
            'ua': 'Ми прагнемо створити незабутню атмосферу для наших гостей. Наша місія - забезпечити вам найкращий сервіс та задоволення від кожного візиту.', 
            'en': 'We strive to create an unforgettable atmosphere for our guests. Our mission is to provide you with the best service and satisfaction with every visit.' 
        },
        'intro3': { 
            'ua': 'Ми створили сучасний та стильний інтер\'єр, де ви зможете насолоджуватися не лише смачною їжею, а й приємною атмосферою. Наш ресторан ідеально підходить для романтичних побачень, зустрічей з друзями або сімейних свят.', 
            'en': 'We have created a modern and stylish interior where you can enjoy not only delicious food but also a pleasant atmosphere. Our restaurant is perfect for romantic dates, meetings with friends, or family celebrations.' 
        },
        'intro4': { 
            'ua': 'Приєднуйтесь до нас у SushiSloth і відкрийте для себе справжній смак Японії в серці нашого міста!', 
            'en': 'Join us at SushiSloth and discover the true taste of Japan in the heart of our city!' 
        },
        'navigation': { 'ua': 'НАВІГАЦІЯ', 'en': 'NAVIGATION' },
        'order': { 'ua': 'Моє замовлення', 'en': 'My Order' },
        'news': { 'ua': 'Новини', 'en': 'News' },
        'home': { 'ua': 'Головна', 'en': 'Home' },
        'about': { 'ua': 'Про нас', 'en': 'About Us' },
        'help': { 'ua': 'Допомога', 'en': 'Help' },
        'staff': { 'ua': 'Для персоналу', 'en': 'For Staff' },
        'social': { 'ua': 'Соц. мережі', 'en': 'Social Networks' },
        'contacts': { 'ua': 'Контакти', 'en': 'Contacts' },
        'phone': { 'ua': 'Телефон: +38 012 345 6789', 'en': 'Phone: +38 012 345 6789' },
        'address': { 'ua': 'Адреса: вул. Суші, 1, Київ, Україна', 'en': 'Address: Sushi St, 1, Kyiv, Ukraine' }
    };

    window.setLanguage = setLanguage;
    setLanguage('UA'); // Установити мову по замовчуванню як українську
});
