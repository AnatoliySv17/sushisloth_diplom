document.addEventListener('DOMContentLoaded', function() {
    const user = localStorage.getItem('user_id') || 'guest';
    const cartKey = `cart_${user}`;
    const cart = JSON.parse(localStorage.getItem(cartKey)) || [];
    const deliveryFee = 59;
    let totalAmount = cart.reduce((sum, item) => sum + item.price * item.quantity, 0) + deliveryFee;

    const totalProductsCountElement = document.getElementById('total-products-count');
    const totalAmountElement = document.getElementById('total-amount');
    const orderItems = document.getElementById('order-items');
    const payButton = document.getElementById('pay-button');
    const liqpayFormContainer = document.getElementById('liqpay-form-container');
    const emptyCartMessage = document.createElement('p');

    const translations = {
        'cart-empty': {
            'ua': 'Ваш кошик пустий',
            'en': 'Your cart is empty'
        }
    };

    function updateOrderDetails() {
        totalProductsCountElement.innerText = cart.reduce((total, item) => total + item.quantity, 0);
        totalAmountElement.innerText = totalAmount.toFixed(2) + " грн";
        
        if (cart.length === 0) {
            emptyCartMessage.textContent = translations['cart-empty'][localStorage.getItem('language').toLowerCase()];
            orderItems.appendChild(emptyCartMessage);
            payButton.disabled = true;
        } else {
            if (emptyCartMessage.parentNode) {
                emptyCartMessage.parentNode.removeChild(emptyCartMessage);
            }
            payButton.disabled = false;
        }
    }

    function renderCartItems() {
        orderItems.innerHTML = '';
        cart.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.quantity}x</td>
                <td>${item.name}</td>
                <td>${item.price.toFixed(2)} грн</td>
            `;
            orderItems.appendChild(row);
        });
    }

    if (totalProductsCountElement && totalAmountElement && orderItems) {
        renderCartItems();
        updateOrderDetails();
    }

    window.addToOrder = function(name, price, img) {
        const existingProduct = cart.find(item => item.name === name);
        if (existingProduct) {
            existingProduct.quantity++;
        } else {
            cart.push({ name, price, img, quantity: 1 });
        }
        updateCart();
        localStorage.setItem(cartKey, JSON.stringify(cart));
    }

    function updateCart() {
        orderItems.innerHTML = '';
        totalAmount = cart.reduce((sum, item) => sum + item.price * item.quantity, 0) + deliveryFee;
        renderCartItems();
        updateOrderDetails();
    }

    fetch('products.json')
        .then(response => response.json())
        .then(products => {
            const additionalProductsContainer = document.querySelector('.carousel-inner');
            if (additionalProductsContainer) {
                const shuffledProducts = products.sort(() => 0.5 - Math.random());
                const selectedProducts = shuffledProducts.slice(0, 5);
                selectedProducts.forEach((product, index) => {
                    const productCard = document.createElement('div');
                    productCard.classList.add('carousel-item');
                    if (index === 0) {
                        productCard.classList.add('active');
                    }
                    productCard.innerHTML = `
                        <div class="additional-product card m-2">
                            <div class="card-body">
                                <img src="${product.img}" class="card-img-top" alt="${product.name}">
                                <h5 class="card-title">${product.name}</h5>
                                <p class="card-text">${product.price.toFixed(2)} грн</p>
                                <button class="btn btn-primary" onclick="addToOrder('${product.name}', ${product.price}, '${product.img}')">Додати в замовлення</button>
                            </div>
                        </div>
                    `;
                    additionalProductsContainer.appendChild(productCard);
                });
            }
        })
        .catch(error => {
            console.error('Error loading products:', error);
        });

    const form = document.getElementById('order-form');
    if (form) {
        form.addEventListener('submit', (event) => {
            event.preventDefault();

            const paymentType = document.querySelector('input[name="paymentType"]:checked').value;
            if (paymentType === 'card') {
                liqpayFormContainer.style.display = 'block';
                payButton.style.display = 'none';
            } else {
                liqpayFormContainer.style.display = 'none';
                payButton.style.display = 'block';
                alert('Оплата готівкою буде здійснена при доставці!');
            }

            const order = {
                firstName: document.getElementById('firstName').value,
                surname: document.getElementById('surname').value,
                telephone: document.getElementById('telephone').value,
                email: document.getElementById('email').value,
                address: document.getElementById('address').value,
                addressSpecification: document.getElementById('address-specification').value,
                paymentType,
                cart,
                totalAmount
            };

            fetch('submit_order.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(order)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Ваше замовлення успішно оформлено!');
                    localStorage.removeItem(cartKey);
                    window.location.href = 'index.php';
                } else {
                    alert('Виникла помилка при оформленні замовлення.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    const paymentTypeInputs = document.querySelectorAll('input[name="paymentType"]');
    paymentTypeInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value === 'cash') {
                payButton.innerText = 'Оплатити при доставці';
                liqpayFormContainer.style.display = 'none';
                payButton.style.display = 'block';
            } else {
                payButton.innerText = 'Оплатити карткою онлайн';
                liqpayFormContainer.style.display = 'block';
                payButton.style.display = 'none';
            }
        });
    });

    const orderForm = document.getElementById('order-form');
    if (orderForm) {
        orderForm.addEventListener('input', function() {
            const form = this;
            const isValid = form.checkValidity();
            payButton.disabled = !isValid;
        });
    }

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

    setLanguage(localStorage.getItem('language') || 'UA');
});
