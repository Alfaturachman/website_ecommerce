<div style="padding:2rem 2rem;max-width:var(--max-width);margin:0 auto">
    <div class="flex justify-between items-center" style="margin-bottom:2rem;flex-wrap:wrap;gap:0.75rem">
        <div>
            <h1 style="font-size:1.35rem;font-weight:700;margin:0;letter-spacing:-0.02em">
                <?php if (isset($category)) : ?>
                    <?= $gender ? genderLabel($gender) . "'s " : '' ?><?= e($category) ?>
                <?php elseif (isset($gender) && $gender) : ?>
                    <?= genderLabel($gender) ?>'s Collection
                <?php else : ?>
                    Shop All
                <?php endif ?>
            </h1>
            <p style="color:var(--gray-400);font-size:0.82rem;margin:0.25rem 0 0">
                <?php if (isset($category)) : ?>
                    <?= $gender ? genderLabel($gender) . "'s " : '' ?><?= e($category) ?>
                <?php elseif (isset($gender) && $gender) : ?>
                    All <?= genderLabel($gender) ?>'s styles
                <?php else : ?>
                    All Categories
                <?php endif ?>
            </p>
        </div>
    </div>

    <div class="shop-layout">
        <!-- Desktop Sidebar -->
        <aside class="shop-sidebar">
            <div class="shop-sidebar__section">
                <div class="shop-sidebar__label">Gender</div>
                <div class="shop-sidebar__genders">
                    <?php $genders = ['' => 'All', 'L' => 'Men', 'W' => 'Women', 'U' => 'Unisex'] ?>
                    <?php $activeGender = $gender ?? '' ?>
                    <?php foreach ($genders as $code => $label) : ?>
                    <?php $isActive = $activeGender === $code ?>
                    <a href="<?= $code ? base_url("shop/" . strtolower($label)) : base_url('shop') ?>"
                       class="shop-sidebar__gender <?= $isActive ? 'shop-sidebar__gender--active' : '' ?>"><?= $label ?></a>
                    <?php endforeach ?>
                </div>
            </div>

            <div class="divider"></div>

            <div class="shop-sidebar__section">
                <div class="shop-sidebar__label">Shop by Price</div>
                <div class="price-range">
                    <div class="price-range__sliders">
                        <input type="range" class="price-range__input price-range__input--min" min="50000" max="1000000" step="10000" value="<?= e($min_price ?? 50000) ?>">
                        <input type="range" class="price-range__input price-range__input--max" min="50000" max="1000000" step="10000" value="<?= e($max_price ?? 1000000) ?>">
                    </div>
                    <div class="price-range__values">
                        <span class="price-range__value price-range__value--min">Rp <?= formatRupiah($min_price ?? 50000) ?></span>
                        <span class="price-range__separator">—</span>
                        <span class="price-range__value price-range__value--max">Rp <?= formatRupiah($max_price ?? 1000000) ?></span>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="shop-sidebar__section">
                <div class="shop-sidebar__label">Categories</div>
                <?php $baseUrl = $gender ? base_url('shop/' . strtolower(genderLabel($gender))) : base_url('shop') ?>
                <a href="<?= $baseUrl ?>" class="shop-sidebar__link <?= !isset($category) ? 'shop-sidebar__link--active' : '' ?>">All Items</a>
                <?php $cats = $gender ? getCategories($gender) : getCategories() ?>
                <?php foreach ($cats as $cat) : ?>
                <a href="<?= $gender ? base_url("shop/" . strtolower(genderLabel($gender)) . "/category/{$cat->slug}") : base_url("/shop/category/{$cat->slug}") ?>"
                   class="shop-sidebar__link <?= (isset($category) && $category == $cat->title) ? 'shop-sidebar__link--active' : '' ?>"><?= e($cat->title) ?></a>
                <?php endforeach ?>
            </div>
        </aside>

        <!-- Mobile Sidebar -->
        <aside class="shop-sidebar shop-sidebar--mobile" style="display:none">
            <div class="shop-sidebar__section">
                <div class="shop-sidebar__label">Gender</div>
                <div class="shop-sidebar__genders">
                    <?php foreach ($genders as $code => $label) : ?>
                    <?php $isActive = $activeGender === $code ?>
                    <a href="<?= $code ? base_url("shop/" . strtolower($label)) : base_url('shop') ?>"
                       class="shop-sidebar__gender <?= $isActive ? 'shop-sidebar__gender--active' : '' ?>"><?= $label ?></a>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="divider"></div>
            <div class="shop-sidebar__section">
                <div class="shop-sidebar__label">Categories</div>
                <a href="<?= $baseUrl ?>" class="shop-sidebar__link <?= !isset($category) ? 'shop-sidebar__link--active' : '' ?>">All Items</a>
                <?php foreach ($cats as $cat) : ?>
                <a href="<?= $gender ? base_url("shop/" . strtolower(genderLabel($gender)) . "/category/{$cat->slug}") : base_url("/shop/category/{$cat->slug}") ?>"
                   class="shop-sidebar__link <?= (isset($category) && $category == $cat->title) ? 'shop-sidebar__link--active' : '' ?>"><?= e($cat->title) ?></a>
                <?php endforeach ?>
            </div>
            <div class="divider"></div>
            <div class="shop-sidebar__section">
                <div class="shop-sidebar__label">Shop by Price</div>
                <div class="price-range">
                    <div class="price-range__sliders">
                        <input type="range" class="price-range__input price-range__input--min" min="50000" max="1000000" step="10000" value="<?= e($min_price ?? 50000) ?>">
                        <input type="range" class="price-range__input price-range__input--max" min="50000" max="1000000" step="10000" value="<?= e($max_price ?? 1000000) ?>">
                    </div>
                    <div class="price-range__values">
                        <span class="price-range__value price-range__value--min">Rp <?= formatRupiah($min_price ?? 50000) ?></span>
                        <span class="price-range__separator">—</span>
                        <span class="price-range__value price-range__value--max">Rp <?= formatRupiah($max_price ?? 1000000) ?></span>
                    </div>
                </div>
            </div>
        </aside>

        <main>
            <?php if (empty($content)) : ?>
                <div class="empty-state">
                    <div class="empty-state__icon"><i class="fas fa-box-open"></i></div>
                    <div class="empty-state__title">No products found</div>
                    <div class="empty-state__desc">Try adjusting your filters or browse all categories.</div>
                    <a href="<?= base_url('shop') ?>" class="btn btn--outline btn--sm">View All</a>
                </div>
            <?php else : ?>
                <div class="product-grid">
                    <?php foreach ($content as $row) : ?>
                    <a class="product-card" href="<?= base_url("shop/detail/{$row->product_slug}") ?>">
                        <div class="product-card__image">
                            <img src="<?= $row->image ? base_url("images/product/{$row->image}") : base_url("images/product/default.jpg") ?>" alt="<?= e($row->product_title) ?>">
                            <div class="product-card__hover"></div>
                        </div>
                        <div class="product-card__category"><?= e($row->product_title) ?></div>
                        <div class="product-card__title"><?= e($row->product_title) ?></div>
                        <div class="product-card__price">Rp <?= formatRupiah($row->price) ?></div>
                    </a>
                    <?php endforeach ?>
                </div>

                <?php if (isset($pagination)) : ?>
                <div class="flex justify-center mt-8">
                    <div class="flex gap-2" style="flex-wrap:wrap"><?= $pagination ?></div>
                </div>
                <?php endif ?>
            <?php endif ?>
        </main>
    </div>
</div>

<style>
.price-range {
    padding-top: 0.25rem;
}

.price-range__sliders {
    position: relative;
    height: 36px;
}

.price-range__sliders::before {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    height: 4px;
    background: var(--gray-100);
    border-radius: 2px;
    transform: translateY(-50%);
    pointer-events: none;
}

.price-range__input {
    position: absolute;
    left: 0;
    width: 100%;
    height: 36px;
    -webkit-appearance: none;
    appearance: none;
    background: transparent;
    pointer-events: none;
    top: 0;
    margin: 0;
    z-index: 2;
}

.price-range__input::-webkit-slider-runnable-track {
    height: 4px;
    background: transparent;
}

.price-range__input::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: var(--charcoal);
    border: 2px solid #fff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.15);
    cursor: pointer;
    pointer-events: auto;
    margin-top: -7px;
    transition: 0.15s ease;
    position: relative;
}

.price-range__input::-webkit-slider-thumb:hover {
    transform: scale(1.15);
}

.price-range__input::-moz-range-track {
    height: 4px;
    background: transparent;
}

.price-range__input::-moz-range-thumb {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: var(--charcoal);
    border: 2px solid #fff;
    box-shadow: 0 1px 3px rgba(0,0,0,0.15);
    cursor: pointer;
    pointer-events: auto;
}

.price-range__values {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.25rem;
    margin-top: 0.5rem;
}

.price-range__value {
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--charcoal);
    white-space: nowrap;
}

.price-range__separator {
    font-size: 0.65rem;
    color: var(--gray-400);
}

@media (max-width: 768px) {
    .shop-sidebar--mobile { display: block !important; }
}
</style>

<script>
(function() {
    var sidebars = document.querySelectorAll('.shop-sidebar');
    [].forEach.call(sidebars, function(sidebar) {
        var minInput = sidebar.querySelector('.price-range__input--min');
        var maxInput = sidebar.querySelector('.price-range__input--max');
        var minLabel = sidebar.querySelector('.price-range__value--min');
        var maxLabel = sidebar.querySelector('.price-range__value--max');

        if (!minInput || !maxInput || !minLabel || !maxLabel) return;

        function formatPrice(val) {
            return 'Rp ' + Number(val).toLocaleString('id-ID');
        }

        function updateLabels() {
            var minVal = parseInt(minInput.value);
            var maxVal = parseInt(maxInput.value);
            if (minVal > maxVal) {
                if (document.activeElement === minInput) {
                    minInput.value = maxVal;
                    minVal = maxVal;
                } else {
                    maxInput.value = minVal;
                    maxVal = minVal;
                }
            }
            minLabel.textContent = formatPrice(minVal);
            maxLabel.textContent = formatPrice(maxVal);
        }

        function applyFilter() {
            var minVal = parseInt(minInput.value);
            var maxVal = parseInt(maxInput.value);
            if (minVal > maxVal) {
                if (document.activeElement === minInput) {
                    minInput.value = maxVal;
                    minVal = maxVal;
                } else {
                    maxInput.value = minVal;
                    maxVal = minVal;
                }
            }
            var url = new URL(window.location.href);
            if (minVal > 50000) {
                url.searchParams.set('min_price', minVal);
            } else {
                url.searchParams.delete('min_price');
            }
            if (maxVal < 1000000) {
                url.searchParams.set('max_price', maxVal);
            } else {
                url.searchParams.delete('max_price');
            }
            window.location.href = url.toString();
        }

        minInput.addEventListener('input', updateLabels);
        maxInput.addEventListener('input', updateLabels);
        minInput.addEventListener('change', applyFilter);
        maxInput.addEventListener('change', applyFilter);
    });
})();
</script>
