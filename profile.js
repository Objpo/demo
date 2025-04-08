let currentPasswordStored = "123456";

// Quản lý thay đổi mật khẩu
function changePassword() {
    const currentPassword = document.getElementById("currentPassword").value.trim();
    const newPassword = document.getElementById("newPassword").value.trim();
    const confirmPassword = document.getElementById("confirmPassword").value.trim();
    const notification = document.getElementById("notification");

    notification.style.display = "none";
    notification.classList.remove("success", "error");

    try {
        if (!currentPassword) throw new Error("Please enter your current password!");
        if (currentPassword !== currentPasswordStored) throw new Error("Current password is incorrect!");
        if (!newPassword) throw new Error("Please enter a new password!");
        if (newPassword.length < 8) throw new Error("Password must be at least 8 characters!");
        if (newPassword !== confirmPassword) throw new Error("Passwords do not match!");

        currentPasswordStored = newPassword;
        showNotification("Password updated successfully!", "success");
        resetForm();
    } catch (error) {
        showNotification(error.message, "error");
    }
}

// Hiển thị thông báo
function showNotification(message, type) {
    const notification = document.getElementById("notification");
    notification.textContent = message;
    notification.classList.add(type);
    notification.style.display = "block";
    setTimeout(() => {
        notification.style.display = "none";
        notification.classList.remove(type);
    }, 3000);
}

// Reset form mật khẩu
function resetForm() {
    document.querySelectorAll(".password-section input").forEach(input => input.value = "");
}

// Chuyển đổi chế độ chỉnh sửa hồ sơ
function toggleEditProfile() {
    const inputs = document.querySelectorAll(".info-section input");
    const select = document.getElementById("gender");
    const editBtn = document.querySelector(".edit-btn");
    const isEditable = inputs[0].hasAttribute("readonly");

    if (isEditable) {
        inputs.forEach(input => input.removeAttribute("readonly"));
        select.removeAttribute("disabled");
        editBtn.textContent = "Save Changes";
    } else {
        inputs.forEach(input => input.setAttribute("readonly", "true"));
        select.setAttribute("disabled", "true");
        editBtn.textContent = "Edit Profile";
        showNotification("Profile updated successfully!", "success");
    }
}

// Cuộn lên đầu trang
function topFunction() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Tất cả sự kiện jQuery và logic chính
$(document).ready(function () {
    // Khởi tạo giỏ hàng từ localStorage
    let cart = JSON.parse(localStorage.getItem('cartItems')) || [];

    // Cập nhật giao diện giỏ hàng
    function updateCart() {
        const cartList = $('#cart-list');
        const cartTotal = $('#cart-total');
        cartList.empty();

        if (cart.length === 0) {
            cartList.append('<li>Giỏ hàng trống</li>');
            cartTotal.text('Tổng tiền: $0');
        } else {
            let total = 0;
            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                const li = $(`
                    <li>
                        <span>${item.name} (x${item.quantity}) - $${itemTotal.toFixed(2)}</span>
                        <button class="btn btn-sm btn-danger remove-item" data-index="${index}">Xóa</button>
                    </li>
                `);
                cartList.append(li);
            });
            cartTotal.text(`Tổng tiền: $${total.toFixed(2)}`);
        }
        localStorage.setItem('cartItems', JSON.stringify(cart));
    }

    // Toggle menu hamburger
    $('.navbar-toggler').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('collapsed');
        $('#navbarTogglerDemo02').toggleClass('show');
        $('body').toggleClass('noscroll');
        $("header").toggleClass("active");
    });

    // Đóng menu khi nhấp vào liên kết
    $('.navbar-nav .nav-link').on('click', function () {
        if ($(window).width() <= 991) {
            $('.navbar-toggler').addClass('collapsed');
            $('#navbarTogglerDemo02').removeClass('show');
            $('body').removeClass('noscroll');
            $("header").removeClass("active");
        }
    });

    // Đóng menu khi nhấp ra ngoài
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.navbar').length && !$(e.target).is('.navbar-toggler') && $('#navbarTogglerDemo02').hasClass('show')) {
            $('.navbar-toggler').addClass('collapsed');
            $('#navbarTogglerDemo02').removeClass('show');
            $('body').removeClass('noscroll');
            $("header").removeClass("active");
        }
    });

    // Điều chỉnh khi thay đổi kích thước màn hình
    $(window).on('resize', function () {
        if ($(window).width() > 991) {
            $('.navbar-toggler').addClass('collapsed');
            $('#navbarTogglerDemo02').removeClass('show');
            $('body').removeClass('noscroll');
            $("header").removeClass("active");
        }
    });

    // Fixed navbar và hiển thị nút khi cuộn
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 80) {
            $('#site-header').addClass('nav-fixed');
        } else {
            $('#site-header').removeClass('nav-fixed');
        }

        // Hiển thị/ẩn nút cuộn lên đầu và giỏ hàng
        let topButton = $('#movetop');
        let cartButton = $('#cartButton');
        if (scroll > 100) {
            topButton.show();
            cartButton.show();
        } else {
            topButton.hide();
            cartButton.hide();
        }
    });

    // Chuyển hướng đến trang giỏ hàng
    $('#cartButton').on('click', function () {
        window.location.href = "/shoppingcart/shoppingcart.html";
    });

    // Toggle giỏ hàng
    $('.cart-icon').on('click', function (e) {
        e.preventDefault();
        $('#cart-items').toggleClass('active');
    });

    // Đóng giỏ hàng khi nhấp ra ngoài
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.cart-icon').length && !$(e.target).closest('#cart-items').length) {
            $('#cart-items').removeClass('active');
        }
    });

    // Thêm sản phẩm vào giỏ hàng (yêu cầu nút .btn-buy trong HTML khác)
    $('.btn-buy').on('click', function () {
        const name = $(this).data('name');
        const price = parseFloat($(this).data('price'));
        const existingItem = cart.find(item => item.name === name);

        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({ name, price, quantity: 1 });
        }
        updateCart();
        alert(`Đã thêm "${name}" vào giỏ hàng!`);
    });

    // Xóa từng sản phẩm
    $('#cart-list').on('click', '.remove-item', function () {
        const index = $(this).data('index');
        cart.splice(index, 1);
        updateCart();
    });

    // Xóa toàn bộ giỏ hàng
    $('#clear-cart').on('click', function () {
        cart = [];
        updateCart();
        alert('Đã xóa toàn bộ giỏ hàng!');
    });

    // Load giỏ hàng ban đầu
    updateCart();

    // Đảm bảo menu đóng khi tải trang trên mobile
    if ($(window).width() <= 991) {
        $('.navbar-toggler').addClass('collapsed');
        $('#navbarTogglerDemo02').removeClass('show');
    }
});

// Gán sự kiện khi DOM tải xong
document.addEventListener("DOMContentLoaded", () => {
    document.querySelector(".update-btn").addEventListener("click", changePassword);
    document.querySelector(".edit-btn").addEventListener("click", toggleEditProfile);
});