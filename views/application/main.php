<!--<h1>Главная</h1>-->
<?php use yii\widgets\LinkPager; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин - Главная</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        /* Main content */
        .main-content {
            display: flex;
            margin: 20px 0;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: white;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            margin-right: 20px;
        }

        .catalog-title {
            font-size: 18px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .catalog-list {
            list-style: none;
        }

        .catalog-list li {
            margin-bottom: 8px;
        }

        .catalog-list a {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 5px 0;
            transition: color 0.3s;
        }

        .catalog-list a:hover {
            color: #3498db;
        }

        .catalog-list .subcategory {
            margin-left: 15px;
            font-size: 14px;
        }

        /* Products section */
        .products-section {
            flex: 1;
        }

        .search-sort {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            background-color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .search-box {
            position: relative;
            width: 60%;
        }

        .search-box input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .search-box button {
            position: absolute;
            right: 5px;
            top: 5px;
            background: #3498db;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        .sort-options select {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Products grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .product-image {
            height: 200px;
            background-color: #f9f9f9;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 15px;
        }

        .product-title {
            font-size: 16px;
            margin-bottom: 10px;
            height: 40px;
            overflow: hidden;
        }

        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .product-actions {
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid #3498db;
            color: #3498db;
        }

        .btn-outline:hover {
            background-color: #3498db;
            color: white;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                margin-right: 0;
                margin-bottom: 20px;
            }

            .search-sort {
                flex-direction: column;
            }

            .search-box {
                width: 100%;
                margin-bottom: 15px;
            }

            .footer-content {
                flex-direction: column;
            }

            .footer-section {
                width: 100%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

<!-- Main Content -->
<div class="container">
    <div class="main-content">
        <!-- Sidebar with catalog -->
        <aside class="sidebar">
            <h2 class="catalog-title">Каталог товаров</h2>

            <?php
                foreach ($sidebar as $side) {
                    if ($side->parent != null) {
                       $categories[$side->parent->name][] = $side;
                    }
                }
            ?>

            <ul class="catalog-list">
                <?php foreach ($categories as $parentName => $children): ?>
                    <li>
                        <a href="#"><?= $parentName ?></a>
                        <ul class="subcategory">
                            <?php foreach ($children as $child): ?>
                                <li><a href="#"><?= $child->name ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>

                <?= LinkPager::widget([
                    'pagination' => $sidebarPages,
                ]) ?>
            </ul>

        </aside>

        <!-- Products section -->
        <section class="products-section">
            <div class="search-sort">
                <div class="search-box">
                    <input type="text" placeholder="Поиск товаров...">
                    <button>Найти</button>
                </div>
                <div class="sort-options">
                    <select>
                        <option>Сортировка по умолчанию</option>
                        <option>По цене (возрастание)</option>
                        <option>По цене (убывание)</option>
                        <option>По популярности</option>
                        <option>По новизне</option>
                    </select>
                </div>
            </div>

            <div class="products-grid" style="max-height: 1000px; /* ← ОГРАНИЧЕНИЕ ВЫСОТЫ */ overflow-y: auto; /* ← ВКЛЮЧАЕМ СКРОЛЛ */">

                <?php foreach ($products as $product):?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/be/M249_FN_MINIMI_DA-SC-85-11586_c1.jpg/1600px-M249_FN_MINIMI_DA-SC-85-11586_c1.jpg" alt=<?= $product->category->name ?>>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title"><?= $product->name ?></h3>
                            <div class="product-price"><?= $product->price . '₽' ?></div>
                            <div class="product-actions">
                                <button class="btn btn-outline">В корзину</button>
                                <button class="btn btn-primary">Подробнее</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>

                <?= LinkPager::widget([
                    'pagination' => $productsPages,
                ]) ?>

               <!-- Product 1 -->
<!--                <div class="product-card">-->
<!--                    <div class="product-image">-->
<!--                        <img src="https://via.placeholder.com/250x200" alt="Смартфон">-->
<!--                    </div>-->
<!--                    <div class="product-info">-->
<!--                        <h3 class="product-title">Смартфон Samsung Galaxy S21</h3>-->
<!--                        <div class="product-price">34 999 ₽</div>-->
<!--                        <div class="product-actions">-->
<!--                            <button class="btn btn-outline">В корзину</button>-->
<!--                            <button class="btn btn-primary">Купить</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
                <!-- Product 2 -->
<!--                <div class="product-card">-->
<!--                    <div class="product-image">-->
<!--                        <img src="https://via.placeholder.com/250x200" alt="Ноутбук">-->
<!--                    </div>-->
<!--                    <div class="product-info">-->
<!--                        <h3 class="product-title">Ноутбук ASUS VivoBook 15</h3>-->
<!--                        <div class="product-price">45 990 ₽</div>-->
<!--                        <div class="product-actions">-->
<!--                            <button class="btn btn-outline">В корзину</button>-->
<!--                            <button class="btn btn-primary">Купить</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
               <!-- Product 3 -->
<!--                <div class="product-card">-->
<!--                    <div class="product-image">-->
<!--                        <img src="https://via.placeholder.com/250x200" alt="Наушники">-->
<!--                    </div>-->
<!--                    <div class="product-info">-->
<!--                        <h3 class="product-title">Наушники Sony WH-1000XM4</h3>-->
<!--                        <div class="product-price">24 990 ₽</div>-->
<!--                        <div class="product-actions">-->
<!--                            <button class="btn btn-outline">В корзину</button>-->
<!--                            <button class="btn btn-primary">Купить</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
               <!-- Product 4 -->
<!--                <div class="product-card">-->
<!--                    <div class="product-image">-->
<!--                        <img src="https://via.placeholder.com/250x200" alt="Телевизор">-->
<!--                    </div>-->
<!--                    <div class="product-info">-->
<!--                        <h3 class="product-title">Телевизор LG 55" 4K UHD</h3>-->
<!--                        <div class="product-price">52 499 ₽</div>-->
<!--                        <div class="product-actions">-->
<!--                            <button class="btn btn-outline">В корзину</button>-->
<!--                            <button class="btn btn-primary">Купить</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
               <!-- Product 5 -->
<!--                <div class="product-card">-->
<!--                    <div class="product-image">-->
<!--                        <img src="https://via.placeholder.com/250x200" alt="Холодильник">-->
<!--                    </div>-->
<!--                    <div class="product-info">-->
<!--                        <h3 class="product-title">Холодильник Bosch Serie 6</h3>-->
<!--                        <div class="product-price">68 990 ₽</div>-->
<!--                        <div class="product-actions">-->
<!--                            <button class="btn btn-outline">В корзину</button>-->
<!--                            <button class="btn btn-primary">Купить</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
              <!-- Product 6 -->
<!--                <div class="product-card">-->
<!--                    <div class="product-image">-->
<!--                        <img src="https://via.placeholder.com/250x200" alt="Кроссовки">-->
<!--                    </div>-->
<!--                    <div class="product-info">-->
<!--                        <h3 class="product-title">Кроссовки Nike Air Max 270</h3>-->
<!--                        <div class="product-price">12 499 ₽</div>-->
<!--                        <div class="product-actions">-->
<!--                            <button class="btn btn-outline">В корзину</button>-->
<!--                            <button class="btn btn-primary">Купить</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </section>
    </div>
</div>
</body>
</html>