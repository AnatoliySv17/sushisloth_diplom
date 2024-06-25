function setLanguage(lang) {
    document.getElementById('languageDropdown').innerText = lang;
    localStorage.setItem('language', lang); // Save the selected language to localStorage
    const elements = document.querySelectorAll('[data-lang]');
    elements.forEach(element => {
        const key = element.getAttribute('data-lang');
        if (translations[key]) {
            element.innerText = translations[key][lang.toLowerCase()];
        }
    });
    updateProductCards(lang);
}

function updateProductCards(lang) {
    const products = JSON.parse(localStorage.getItem('products')); // Assuming products are saved in localStorage
    document.querySelectorAll('.product-card').forEach((card, index) => {
        if (lang === 'EN') {
            card.querySelector('h3').innerText = products[index].name_en;
            card.querySelector('p[data-lang="category"]').innerText = `Category: ${products[index].category}`;
            card.querySelector('p[data-lang="weight"]').innerText = `Weight: ${products[index].weight_en || products[index].weight}`;
            card.querySelector('.price').innerText = `${products[index].price} грн`;
            card.querySelector('button[data-lang="add-to-cart"]').innerText = translations['add-to-cart'].en;
        } else {
            card.querySelector('h3').innerText = products[index].name;
            card.querySelector('p[data-lang="category"]').innerText = `Категорія: ${products[index].category}`;
            card.querySelector('p[data-lang="weight"]').innerText = `Вага: ${products[index].weight}`;
            card.querySelector('.price').innerText = `${products[index].price} грн`;
            card.querySelector('button[data-lang="add-to-cart"]').innerText = translations['add-to-cart'].ua;
        }
    });
}

const translations = {
    'headline1': {
        'ua': 'Найсвіжіші інгредієнти',
        'en': 'Freshest Ingredients'
    },
    'headline2': {
        'ua': 'Незабутнє обслуговування',
        'en': 'Unforgettable Service'
    },
    'headline3': {
        'ua': 'Ваш притулок від міської метушні',
        'en': 'Your Escape from the Urban Hustle'
    },
    'order': {
        'ua': 'Моє замовлення',
        'en': 'My Order'
    },
    'news': {
        'ua': 'Новини',
        'en': 'News'
    },
    'home': {
        'ua': 'Головна',
        'en': 'Home'
    },
    'about': {
        'ua': 'Про нас',
        'en': 'About Us'
    },
    'help': {
        'ua': 'Допомога',
        'en': 'Help'
    },
    'slowly-enjoy': {
        'ua': 'Повільно, насолоджуйся смаком',
        'en': 'Slowly, Enjoy the Taste'
    },
    'text1.1': {
        'ua': 'Наші шеф-кухарі готують кожне блюдо з великою увагою до деталей, використовуючи лише найсвіжіші інгредієнти.',
        'en': 'Our chefs prepare each dish with great attention to detail, using only the freshest ingredients.'
    },
    'text1.2': {
        'ua': 'Наша місія – забезпечити вам незабутні враження від кожного прийому їжі.',
        'en': 'Our mission is to provide you with an unforgettable experience at every meal.'
    },
    'text2.1': {
        'ua': 'Наші працівники завжди готові зробити ваше перебування незабутнім.',
        'en': 'Our staff is always ready to make your stay unforgettable.'
    },
    'text2.2': {
        'ua': 'Від першого привітання до останнього шматочка, ми прагнемо забезпечити найвищий рівень обслуговування.',
        'en': 'From the first greeting to the last bite, we strive to provide the highest level of service.'
    },
    'text3.1': {
        'ua': 'SushiSloth - це не просто ресторан, це ваш притулок від міської метушні, де панує спокій та гастрономічна насолода.',
        'en': 'SushiSloth is not just a restaurant, it is your refuge from the hustle and bustle of the city, where tranquility and gastronomic pleasure reign.'
    },
    'order-now': {
        'ua': 'Замовити!!',
        'en': 'Order Now!!'
    },
    'all': {
        'ua': 'Все',
        'en': 'All'
    },
    'sushi': {
        'ua': 'Суші',
        'en': 'Sushi'
    },
    'ramen': {
        'ua': 'Рамен',
        'en': 'Ramen'
    },
    'tempura': {
        'ua': 'Темпура',
        'en': 'Tempura'
    },
    'dessert': {
        'ua': 'Десерти',
        'en': 'Desserts'
    },
    'cart': {
        'ua': 'Корзина',
        'en': 'Cart'
    },
    'total': {
        'ua': 'Всього:',
        'en': 'Total:'
    },
    'checkout': {
        'ua': 'Замовити',
        'en': 'Checkout'
    },
    'navigation': {
        'ua': 'НАВІГАЦІЯ',
        'en': 'NAVIGATION'
    },
    'social': {
        'ua': 'Соц. мережі',
        'en': 'Social Networks'
    },
    'contacts': {
        'ua': 'Контакти',
        'en': 'Contacts'
    },
    'phone': {
        'ua': 'Телефон: +38 012 345 6789',
        'en': 'Phone: +38 012 345 6789'
    },
    'address': {
        'ua': 'Адреса: вул. Суші, 1, Київ, Україна',
        'en': 'Address: Sushi St, 1, Kyiv, Ukraine'
    },
    'load-more': {
        'ua': 'Більше',
        'en': 'Load More'
    },
    'add-to-cart': {
        'ua': 'Додати в корзину',
        'en': 'Add to Cart'
    },
    'category': {
        'ua': 'Категорія',
        'en': 'Category'
    },
    'weight': {
        'ua': 'Вага',
        'en': 'Weight'
    },
    // Translations for about.php
    'about-us': {
        'ua': 'Про нас',
        'en': 'About Us'
    },
    'intro1': {
        'ua': 'Наш ресторан SushiSloth - це місце, де поєднуються традиції та сучасність. Ми пропонуємо широкий асортимент смачних суші, приготованих з найсвіжіших інгредієнтів. Наші шеф-кухарі мають багаторічний досвід та використовують тільки найкращі продукти, щоб ви могли насолоджуватися кожним шматочком.',
        'en': 'Our SushiSloth restaurant is a place where tradition meets modernity. We offer a wide range of delicious sushi made with the freshest ingredients. Our chefs have many years of experience and use only the best products so that you can enjoy every bite.'
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
    // Translations for help.php
    'how-to-order': {
        'ua': 'Як зробити замовлення?',
        'en': 'How to Order?'
    },
    'how-to-order-desc': {
        'ua': 'Щоб зробити замовлення, просто виберіть страви з нашого меню та додайте їх у кошик. Після цього перейдіть до кошика та заповніть необхідні дані для доставки та оплати.',
        'en': 'To place an order, simply select dishes from our menu and add them to your cart. Then proceed to the cart and fill in the necessary delivery and payment information.'
    },
    'customer-support': {
        'ua': 'Підтримка клієнтів',
        'en': 'Customer Support'
    },
    'customer-support-desc': {
        'ua': 'Якщо у вас виникли питання або проблеми, ви можете звернутися до нашої служби підтримки клієнтів за телефоном +38 012 345 6789 або написати нам на email: support@sushisloth.ua. Ми завжди раді допомогти вам!',
        'en': 'If you have any questions or issues, you can contact our customer support at +38 012 345 6789 or email us at support@sushisloth.ua. We are always happy to help you!'
    },
    // Translations for menu.php
    'menu': {
        'ua': 'Меню',
        'en': 'Menu'
    },
    'price': {
        'ua': 'Ціна',
        'en': 'Price'
    },
    'asc': {
        'ua': 'Від дешевих до дорогих',
        'en': 'From cheapest to most expensive'
    },
    'desc': {
        'ua': 'Від дорогих до дешевих',
        'en': 'From most expensive to cheapest'
    },
    'category': {
        'ua': 'Категорія',
        'en': 'Category'
    },
    // Translations for news.php
    'latest-news': {
        'ua': 'Останні новини',
        'en': 'Latest News'
    },
    'news-title-1': {
        'ua': 'Приєднуйтеся до нас на святкування запуску нових страв',
        'en': 'Join us for the launch celebration of new dishes'
    },
    'news-content-1': {
        'ua': 'Ми раді представити вам нові смачні страви, які створив наш новий шеф-кухар! Приєднуйтеся до нас на святковий захід з дегустацією, де ви зможете насолодитися нашими новинками.',
        'en': 'We are pleased to introduce you to new delicious dishes created by our new chef! Join us for a celebration event with tastings where you can enjoy our new dishes.'
    },
    'news-title-2': {
        'ua': 'Спеціальна акція до Дня Києва',
        'en': 'Special Promotion for Kyiv Day'
    },
    'news-content-2': {
        'ua': 'До Дня Києва ми підготували для вас спеціальні пропозиції та знижки! Замовляйте ваші улюблені суші та отримуйте бонусні страви у подарунок. Святкуйте разом з SushiSloth!',
        'en': 'For Kyiv Day, we have prepared special offers and discounts for you! Order your favorite sushi and receive bonus dishes as a gift. Celebrate together with SushiSloth!'
    }
};

window.setLanguage = setLanguage; // Экспортируем функцию для использования в HTML
