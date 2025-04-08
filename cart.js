function updateQuantity(button, change) {
    const input = button.parentElement.querySelector('input');
    let quantity = parseInt(input.value);
    quantity += change;
    if (quantity < 1) quantity = 1;
    input.value = quantity;

    updateTotal();
}

function updateTotal() {
    const items = document.querySelectorAll('.cart-item');
    let subtotal = 0;

    items.forEach(item => {
        const price = parseFloat(item.querySelector('.item-price').textContent.replace('$', ''));
        const quantity = parseInt(item.querySelector('.item-quantity input').value);
        subtotal += price * quantity;
    });

    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('total').textContent = `$${subtotal.toFixed(2)}`; // Shipping is free in this example
}

document.querySelectorAll('.remove-btn').forEach(button => {
    button.addEventListener('click', () => {
        button.parentElement.remove();
        updateTotal();
    });
});