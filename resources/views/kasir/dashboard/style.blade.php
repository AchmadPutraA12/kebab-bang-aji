<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
<style>
    body {
        background: linear-gradient(120deg, #322672 0%, #4537a3 70%, #788cf0 100%);
        font-family: 'Inter', Arial, sans-serif;
        min-height: 100vh;
    }

    .category-row {
        display: flex;
        gap: 16px;
        margin-bottom: 18px;
        margin-top: 18px;
        flex-wrap: wrap;
    }

    .category-btn {
        border: none;
        outline: none;
        padding: 12px 28px;
        font-size: 1rem;
        border-radius: 18px;
        font-weight: 600;
        background: #fff;
        color: #272952;
        box-shadow: 0 2px 12px #1b1b2e19;
        transition: 0.12s;
    }

    .category-btn.active,
    .category-btn:hover {
        background: #3e60ff;
        color: #fff;
        box-shadow: 0 4px 18px #0073ffd9;
    }

    .search-row {
        margin-bottom: 12px;
        width: 100%;
        display: flex;
        justify-content: flex-start;
        /* posisi search di kiri */
    }

    .search-box-container {
        position: relative;
        width: 100%;
        max-width: 350px;
    }

    .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        z-index: 2;
    }

    .search-input {
        border-radius: 18px;
        padding: 10px 20px 10px 38px;
        border: none;
        width: 100%;
        font-size: 1.12rem;
        background: #fafbff;
        color: #312c5a;
        box-shadow: 0 2px 10px #1b1b2e11;
        max-width: 350px;
    }

    @media (max-width: 767px) {
        .search-input {
            max-width: 100%;
            width: 100%;
        }

        .search-row {
            justify-content: flex-start;
        }
    }



    .product-list {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .product-card {
        width: 235px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 2px 18px #18164d13;
        padding-bottom: 18px;
        transition: 0.13s;
        position: relative;
        overflow: hidden;
        margin-bottom: 18px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .product-card.unavailable {
        filter: grayscale(1) brightness(.84);
        pointer-events: none;
        opacity: .58;
    }

    .product-img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        background: #232344;
        border-radius: 20px 20px 0 0;
    }

    .product-info {
        padding: 13px 14px 0 14px;
        text-align: center;
        flex: 1;
    }

    .product-title {
        font-size: 1.04rem;
        font-weight: 700;
        color: #35388c;
        letter-spacing: .5px;
        margin-bottom: 0;
        white-space: normal;
        word-break: break-all;
    }

    .product-cat {
        font-size: 0.97rem;
        color: #6b6ba1;
        margin-bottom: 2px;
    }

    .product-price {
        color: #23c170;
        font-size: 1.17rem;
        font-weight: 700;
        margin: 7px 0 3px 0;
    }

    .product-stock-row {
        margin-bottom: 8px;
    }

    .product-stock {
        background: #ececec;
        color: #454577;
        font-weight: bold;
        border-radius: 10px;
        padding: 2px 12px;
        font-size: 0.98rem;
        margin-right: 4px;
    }

    .btn-tambah {
        background: #21d189;
        color: #fff;
        border: none;
        border-radius: 13px;
        font-weight: 700;
        font-size: 1.04rem;
        width: 86%;
        padding: 6px 0;
        margin: 0 auto;
        margin-top: 8px;
        display: block;
        transition: 0.13s;
        box-shadow: 0 2px 12px #3ec89a2c;
    }

    .btn-tambah:disabled,
    .product-card.unavailable .btn-tambah {
        background: #c5c5c5 !important;
        color: #b4b4b4 !important;
        cursor: not-allowed;
    }

    .btn-tambah:hover:enabled {
        background: #13b16d;
    }

    .cart-panel {
        background: rgba(27, 28, 52, 0.92);
        border-radius: 20px;
        box-shadow: 0 8px 32px #2522743a;
        color: #fff;
        padding: 32px 24px 22px 24px;
        max-width: 440px;
        width: 100%;
        min-height: 510px;
        margin: 16px 0;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .cart-title {
        font-size: 2rem;
        font-weight: 900;
        margin-bottom: 15px;
        letter-spacing: 1px;
        color: #f2f2f2;
    }

    .cart-items-container {
        width: 100%;
        min-height: 65px;
    }

    .cart-item-row {
        display: grid;
        grid-template-columns: 50px 1fr auto;
        align-items: center;
        gap: 0px 8px;
        margin-bottom: 13px;
        position: relative;
        padding: 0 0 4px 0;
    }

    .cart-item-img-wrap {
        position: relative;
        width: 50px;
        height: 50px;
    }

    .cart-item-img {
        width: 46px;
        height: 46px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #fff2;
        background: #2a2c55;
    }

    .cart-remove-btn {
        position: absolute;
        right: -11px;
        top: -12px;
        background: none;
        border: none;
        color: #fa3b4c;
        font-size: 22px;
        width: 27px;
        height: 27px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3;
        cursor: pointer;
        outline: none;
        box-shadow: none;
        padding: 0;
    }

    .cart-remove-btn:hover {
        color: #dc143c;
        background: none;
    }

    .cart-item-main {
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .cart-item-title {
        font-size: 1.01rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 2px;
        white-space: normal;
        word-break: break-all;
    }

    .cart-item-price {
        font-weight: 600;
        font-size: 1.04rem;
        color: #6affb1;
        margin-bottom: 0;
    }

    .cart-qty-control {
        display: flex;
        align-items: center;
        background: #232347;
        border-radius: 7px;
        overflow: hidden;
        margin-left: 0;
        margin-right: 5px;
    }

    .cart-qty-control button {
        background: #1d2145;
        color: #fff;
        border: none;
        padding: 2px 11px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.12s;
    }

    .cart-qty-control button:hover {
        background: #24de98;
        color: #1b1b33;
    }

    .cart-empty-row {
        color: #aaa;
        margin-bottom: 14px;
        text-align: center;
    }

    .cart-summary-panel {
        background: #1bdc81;
        color: #151a26;
        border-radius: 15px;
        padding: 12px 22px;
        font-size: 1.04rem;
        margin-bottom: 13px;
        margin-top: 10px;
        width: 100%;
        font-weight: 600;
    }

    .cart-summary-panel .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2px;
        font-size: 0.97rem;
    }

    .cart-summary-panel .summary-total {
        font-size: 1.33rem;
        font-weight: 900;
        margin-top: 2px;
        display: flex;
        justify-content: space-between;
    }

    .cart-form-label {
        font-size: 1.02rem;
        font-weight: 700;
        margin: 6px 0 3px 0;
        color: #fff;
    }

    .cart-input {
        width: 100%;
        background: #232347;
        color: #fff;
        border-radius: 10px;
        border: none;
        padding: 8px 12px;
        font-size: 1.11rem;
        font-weight: 500;
        margin-bottom: 7px;
        margin-top: 2px;
    }

    .cart-input:focus {
        outline: 2px solid #1bdc81;
        background: #242555;
    }

    .btn-checkout {
        width: 100%;
        background: #1bdc81;
        color: #151a26;
        font-size: 1.21rem;
        font-weight: 900;
        border: none;
        border-radius: 12px;
        margin-top: 10px;
        margin-bottom: 2px;
        padding: 10px 0;
        box-shadow: 0 2px 12px #00a97028;
        transition: .13s;
    }

    .btn-checkout:hover {
        background: #18be6c;
    }

    .cart-clear-btn {
        background: none;
        border: none;
        color: #5cb1ff;
        font-size: 1rem;
        position: absolute;
        top: 32px;
        right: 24px;
        cursor: pointer;
        text-decoration: underline;
        z-index: 2;
    }

    .cart-clear-btn:hover {
        color: #2489ce;
    }

    @media (max-width: 1200px) {
        .product-list {
            gap: 14px;
        }

        .product-card {
            width: 190px;
        }
    }

    @media (max-width: 991px) {
        .d-flex.flex-row.flex-wrap {
            flex-direction: column !important;
        }

        .cart-panel {
            max-width: 100vw;
            margin-top: 30px;
            align-self: stretch;
        }

        .product-list {
            flex-direction: row;
            gap: 12px;
            justify-content: flex-start;
        }

        .product-card {
            width: 46vw;
            min-width: 170px;
            max-width: 250px;
        }
    }

    @media (max-width: 767px) {
        .product-list {
            flex-direction: column;
            gap: 0;
        }

        .product-card {
            width: 100%;
            max-width: 370px;
            margin: 0 auto 18px auto;
        }

        .cart-panel {
            padding: 17px 7vw 13px 7vw;
        }
    }
</style>
