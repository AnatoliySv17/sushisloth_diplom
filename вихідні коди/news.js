document.addEventListener('DOMContentLoaded', function() {
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
        'order': { 'ua': 'Моє замовлення', 'en': 'My Order' },
        'news': { 'ua': 'Новини', 'en': 'News' },
        'home': { 'ua': 'Головна', 'en': 'Home' },
        'about': { 'ua': 'Про нас', 'en': 'About Us' },
        'help': { 'ua': 'Допомога', 'en': 'Help' },
        'latest-news': { 'ua': 'Останні новини', 'en': 'Latest News' },
        'news-title-1': { 'ua': 'Приєднуйтеся до нас на святкування запуску нових страв', 'en': 'Join Us for the Launch of New Dishes' },
        'news-content-1': { 'ua': 'Ми раді представити вам нові смачні страви, які створив наш новий шеф-кухар! Приєднуйтеся до нас на святковий захід з дегустацією, де ви зможете насолодитися нашими новинками.', 'en': 'We are excited to introduce new delicious dishes created by our new chef! Join us for a launch event with tastings where you can enjoy our new items.' },
        'news-title-2': { 'ua': 'Спеціальна акція до Дня Києва', 'en': 'Special Promotion for Kyiv Day' },
        'news-content-2': { 'ua': 'До Дня Києва ми підготували для вас спеціальні пропозиції та знижки! Замовляйте ваші улюблені суші та отримуйте бонусні страви у подарунок. Святкуйте разом з SushiSloth!', 'en': 'For Kyiv Day, we have prepared special offers and discounts for you! Order your favorite sushi and get bonus dishes as a gift. Celebrate with SushiSloth!' },
        'navigation': { 'ua': 'НАВІГАЦІЯ', 'en': 'NAVIGATION' },
        'social': { 'ua': 'Соц. мережі', 'en': 'Social Networks' },
        'contacts': { 'ua': 'Контакти', 'en': 'Contacts' },
        'phone': { 'ua': 'Телефон: +38 012 345 6789', 'en': 'Phone: +38 012 345 6789' },
        'address': { 'ua': 'Адреса: вул. Суші, 1, Київ, Україна', 'en': 'Address: Sushi St, 1, Kyiv, Ukraine' }
    };

    window.setLanguage = setLanguage;
    setLanguage('UA');
});
