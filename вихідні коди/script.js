document.addEventListener('DOMContentLoaded', function() {
    const userId = localStorage.getItem('user_id') || 'guest';
    const cartKey = `cart_${userId}`;
    const cart = JSON.parse(localStorage.getItem(cartKey)) || [];
    let displayedProducts = 9;
    let allProducts = Array.from(document.querySelectorAll('.product-card'));

    
    function updateCart() {
        const cartItems = document.getElementById('cart-items');
        const cartTotalPrice = document.getElementById('cart-total-price');
        cartItems.innerHTML = '';
        let totalPrice = 0;

        cart.forEach(item => {
            const li = document.createElement('li');
            li.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
            li.innerHTML = `
                <img src="${item.img}" alt="${item.name}" class="img-fluid cart-item-img">
                <span>${item.name}</span>
                <input type="number" value="${item.quantity}" min="1" class="form-control form-control-sm mx-2" style="width: 60px;">
                <span>${item.price * item.quantity} грн</span>
                <button data-id="${item.id}" class="btn btn-danger btn-sm">X</button>
            `;
            cartItems.appendChild(li);

            const quantityInput = li.querySelector('input');
            const removeButton = li.querySelector('button');

            quantityInput.addEventListener('change', (e) => {
                item.quantity = parseInt(e.target.value);
                updateCart();
            });

            removeButton.addEventListener('click', () => {
                removeFromCart(item.id);
            });

            totalPrice += item.price * item.quantity;
        });

        cartTotalPrice.textContent = totalPrice;
        localStorage.setItem(cartKey, JSON.stringify(cart));
    }

    function addToCart(product) {
        const existingProduct = cart.find(item => item.id === product.id);
        if (existingProduct) {
            existingProduct.quantity++;
        } else {
            cart.push({ ...product, quantity: 1 });
        }
        updateCart();
    }

    function removeFromCart(id) {
        const productIndex = cart.findIndex(item => item.id === id);
        if (productIndex > -1) {
            cart.splice(productIndex, 1);
        }
        updateCart();
    }

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', (e) => {
            const productCard = e.target.closest('.product-card');
            const product = {
                id: productCard.dataset.id,
                name: productCard.querySelector('h3').textContent,
                price: parseFloat(productCard.querySelector('.price').textContent),
                img: productCard.querySelector('img').src
            };
            addToCart(product);
        });
    });

    function filterAndSort() {
        const category = document.getElementById('filter-category').value;
        const sort = document.getElementById('sort-price').value;

        let filteredProducts = allProducts.filter(product => category === 'all' || product.getAttribute('data-category') === category);
       
        if (sort === 'asc') {
            filteredProducts.sort((a, b) => parseFloat(a.querySelector('.price').textContent) - parseFloat(b.querySelector('.price').textContent));
        } else if (sort === 'desc') {
            filteredProducts.sort((a, b) => parseFloat(b.querySelector('.price').textContent) - parseFloat(a.querySelector('.price').textContent));
        }

        document.querySelector('.products').innerHTML = '';
        filteredProducts.slice(0, displayedProducts).forEach(product => {
            document.querySelector('.products').appendChild(product);
        });

        if (filteredProducts.length <= displayedProducts) {
            document.getElementById('load-more').style.display = 'none';
        } else {
            document.getElementById('load-more').style.display = 'block';
        }
    }

    document.getElementById('filter-category').addEventListener('change', () => {
        displayedProducts = 9;
        filterAndSort();
    });
    document.getElementById('sort-price').addEventListener('change', filterAndSort);

    document.getElementById('load-more').addEventListener('click', () => {
        displayedProducts += 9;
        filterAndSort();
    });

    filterAndSort();
    updateCart();
});
