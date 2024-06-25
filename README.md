# "Дипломна робота" фахового молодшого бакалавра на тему "Розробка вебсайту закладу харчування"

Виконав: *Свинаренко Анатолій Олексійович*


## Зміст
- [Основні вимоги до продукт](#основні-вимоги-до-продукту)
- [Прототип інтерфейсу користувача](#прототип-інтерфейсу-користувача)
- [Тестування](#тестування)

## Основні вимоги до продукту

Основними вимогами до продукту є можливість інтернет-оплати, онлайн замовлення та адаптація під різні пристрої. Вебсайт має містити чітку структуру, логічно побудовані секції та блоки. Програмний продукт має бути простим у використанні.

ФУНКЦІОНАЛЬНІ ВИМОГИ (вимоги до програмного забезпечення, які описують внутрішню роботу системи, її поведінку):
Відповідно до поставленого завдання необхідно розробити систему вибору та замовлення їжі клієнтами закладу харчування. Користувач може:
-	реєструватись, або ж здійснювати вхід до вже існуючого облікового запису;
-	вільно пересуватись сторінками сайту за допомогою навігаційного меню;
-	переглядати новини та актуальні акційні пропозиції від закладу;
-	переглядати наявний каталог страв пропонований закладом;
-	здійснювати замовлення їжі онлайн;
-	вибирати оплату готівкою при отриманні замовлення;
-	здійснювати оплату замовлення в інтернеті;
-	вибирати мови інтерфейсу: англійська, українська;
Адміністратор має можливість:
-	додавати нові страви до меню, вказуючи назву, категорію ціну, вагу та додаючи зображення;
-	змінювати деталі існуючих страв та видаляти їх з меню;
-	переглядати активні замовлення від користувачів;
-	додавати нових користувачів з правами адміністратора;

Крім цього встановлено, що вебсайт має бути адаптивним під різні типи пристроїв. 

НЕФУНКЦІОНАЛЬНІ ВИМОГИ (вимоги до програмного забезпечення, які задають критерії для оцінки якості його роботи):
-	наявність оригінального логотипу;
-	зручність використання;
-	логічно побудовані секції та блоки;
-	чітка структура;
-	якісний контент;
-	безпека та надійність;
-	продуктивність;
-	масштабованість;
-	
Діаграма послідовності графічно демонструє порядок взаємодії певних об’єктів програми у часі.

Посилання на [діаграму послідовності](https://github.com/AnatoliySv17/sushisloth_diplom/blob/main/images/%D0%B4%D1%96%D0%B0%D0%B3%D1%80%D0%B0%D0%BC%D0%B0%20%D0%BF%D0%BE%D1%81%D0%BB%D1%96%D0%B4%D0%BE%D0%B2%D0%BD%D0%BE%D1%81%D1%82%D0%B5%D0%B9.png)

### Прототип інтерфейсу користувача

Значну частину роботи по розробці UI/UX-дизайну було реалізовано за допомогою Figma. На цій платформі є практично все необхідне для роботи з графікою, векторними об’єктами, шрифтами, ефектами і т.д. 

Було створено початковий макет, прототип інтерфейсу продукту.

Посилання на зображення 1 [макет-прототип](https://github.com/AnatoliySv17/sushisloth_diplom/blob/main/images/Desktop%20-%20main1.png)

Посилання на зображення 2 [макет-прототип](https://github.com/AnatoliySv17/sushisloth_diplom/blob/main/images/Desktop%20-%20main2.png)

### Архітектура системи

Діаграма прецедентів наочно демонструє можливості системи, а також взаємодію користувача з нею.

Посилання на [діаграму прецендентів](https://github.com/AnatoliySv17/sushisloth_diplom/blob/main/images/%D0%B4%D1%96%D0%B0%D0%B3%D1%80%D0%B0%D0%BC%D0%B0%20%D0%BF%D1%80%D0%B5%D1%86%D0%B5%D0%B4%D0%B5%D0%BD%D1%82%D1%96%D0%B2.png)

ПРЕЦЕДЕНТ: НАВІГАЦІЙНЕ МЕНЮ
Ектор: користувач.
Передумова: відкриття вебсайту.
Післяумова: перехід на вибрану сторінку.
Сценарій:
1.	Вибрати необхідний пункт меню.
2.	Натиснути на вибраний пункт меню.
ПРЕЦЕДЕНТ: ЗМІНА МОВИ ІНТЕРФЕЙСУ
Ектор: користувач.
Передумова: вебсайт з українською мовою інтерфейсу.
Післяумова: вебсайт з вибраною мовою інтерфейсу.
Сценарій:
1.	Натиснути на кнопку вибору мови в правою верхньому куті сторінки.
2.	Обрати мову натиснувши на її найменування.
ПРЕЦЕДЕНТ: РЕЄСТРАЦІЯ НОВОГО КОРИСТУВАЧА.
Ектор: користувач.
Передумова: користувач не має облікового запису на сайту.
Післяумова: користувач зареєстрований на сайті та може увійти в систему.
Сценарій:
1.	Відкриття сторінки реєстрації.
2.	Введення необхідних даних.
3.	Натискання кнопки «Зареєструватися».
4.	Перевірка системою наявність облікового запису в базі даних.
5.	Якщо введені дані валідні, система зберігає новий обліковий запис у базі даних.
6.	Система відображає повідомлення про успішну реєстрацію.
ПРЕЦЕДЕНТ: ВХІД КОРИСТУВАЧА
Ектор: користувач.
Передумова: користувач має обліковий запис на сайті.
Післяумова: користувач увійшов у систему.
Сценарій:
1.	Користувач відкриває сторінку входу.
2.	Вводить ім’я користувача і пароль.
3.	Натискає кнопку «Увійти».
4.	Система порівнює введені дані з даними в базі.
5.	Якщо дані коректні, система зберігає сесію користувача та перенаправляє його на головну сторінку.
ПРЕЦЕДЕНТ: ДОДАВАННЯ ТОВАРУ ДО КОШИКА.
Ектор: користувач.
Передумова: користувач здійснив вхід в систему і переглядає сторінку меню.
Післяумова: обраний товар доданий до кошика користувача.
Сценарій:
1.	Користувач переглядає список товарів на сторінці меню.
2.	Натискає кнопку «Додати до кошика» біля обраного товару.
3.	Система додає товар до кошика користувача.
4.	Система оновлює відображення кошика, показуючи доданий товар.
ПРЕЦЕДЕНТ: ОФОРМЛЕННЯ ЗАМОВЛЕННЯ.
Ектор: користувач.
Передумова: наявність товарів у кошику користувача.
Післяумова: замовлення оформлене та збережене в системі.
Сценарій:
1.	Користувач відкриває сторінку кошика.
2.	Перевіряє список товарів у кошику.
3.	Натискає кнопку «Оформити замовлення».
4.	Вводить необхідні дані для доставки.
5.	Здійснює вибір способу оплати.
6.	Підтверджує замовлення.
7.	Система перевіряє введені дані. 
8.	Якщо дані коректні, система створює нове замовлення в базі даних.
9.	Система відображає повідомлення про успішне оформлення замовлення.
ПРЕЦЕДЕНТ: УПРАВЛІННЯ СТРАВАМИ.
Ектор: адміністратор.
Передумова: адміністратор увійшов у систему.
Післяумова: адміністратор додав, відредагував або видалив страву.
Сценарій:
1.	Адміністратор відкриває сторінку управління стравами.
2.	Адміністратор додає страву попередню заповнивши всі необхідні дані.
3.	Адміністратор змінює поля з даними страви та підтверджує зміни натисканням кнопки «Зберегти».
4.	Адміністатор видаляє страву з бази натиснувши кнопку «Видалити».
ПРЕЦЕДЕНТ: ПЕРЕГЛЯД ЗАМОВЛЕНЬ.
Ектор: адміністратор.
Передумова: адміністратор увійшов у систему.
Післяумова: адміністратор переглянув інформацію про замовлення.
Сценарій:
1.	Адміністратор відкриває сторінку управління замовленнями.
2.	Система завантажує список замовлень з бази даних.
3.	Адміністратор переглядає деталі замовлення.
ПРЕЦЕДЕНТ: ДОДАВАННЯ НОВОГО АДМІНІСТРАТОРА.
Ектор: адміністратор.
Передумова: адміністратор увійшов у систему.
Післяумова: адміністратор створив обліковий запис користувача з правами адміністратора.
Сценарій:
1.	Адміністратор відкриває сторінку додавання адміністраторів.
2.	Адміністратор вводить ім’я та пароль до нового облікового записку.
3.	Адміністратор натискає кнопку «Створити адміністратора».

Оскільки система містить базу даних, яка зберігає в собі інформацію про клієнтів, страви, страви і тд. Було створено ER-діаграму, що наглядно відображає всі «сутності», зв’язані між собою різними зв’язками в системі (Додаток В).

Посилання на [ER-діаграму](https://github.com/AnatoliySv17/sushisloth_diplom/blob/main/images/er-%D0%B4%D1%96%D0%B0%D0%B3%D1%80%D0%B0%D0%BC%D0%B0.png)

Взаємодія елементів сторінки зображена за допомогою діаграми.

Посилання на [діаграму взаємодії елементів сторінки](https://github.com/AnatoliySv17/sushisloth_diplom/blob/main/images/%D1%81%D1%82%D1%80%D1%83%D0%BA%D1%82%D1%83%D1%80%D0%B0.png)


## Тестування

Тестування продуктивності - тестування, що перевіряє, чи працює сайт при певному навантаженні та відповідає вимогам щодо швидкості та продуктивності. 

Для цього тестування було використано сервіс GTmetrix.

GTmetrix - тестування, що перевіряє, чи сумісний програмний продукт з різними операційними системами та апаратними засобами.

На тестуванні продуктивності сайт показав себе дуже. Завантаження сторінки було за 0.3-0.5 секунди, що є дуже гарним результатом.

Тестування сумісності - тестування, що перевіряє, чи сумісний програмний продукт з різними операційними системами та апаратними засобами. Було використано BrowserStack.

BrowserStack - інструмент хмарних тестів, який дозволяє тестувати веб-сайти та додатки на різних платформах та пристроях, включаючи настільні ПК, планшети та мобільні телефони.

В процесі тестування сайт було перевірено в різних браузерах: Microsoft Edge, Google Chrome, Opera, Mozilla Firefox. Такожж були проведені тести мобільних версій на операційних системах Android і IOS. За результатом тестування ніяких помилок не виявлено.

Додатково було виконано перевірку доступності і часу відповіді за допомогою сервісу моніторингу аптайму Alerta та перевірку верстки та валідності лендингу за допомогою сервісу W3C Markup Validation.

Посилання на [результати тестування](https://github.com/AnatoliySv17/sushisloth_diplom/blob/main/images/%D0%97%D0%BD%D1%96%D0%BC%D0%BE%D0%BA%20%D0%B5%D0%BA%D1%80%D0%B0%D0%BD%D0%B0%202024-06-25%20091813.png)
