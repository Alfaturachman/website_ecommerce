<div style="max-width:1280px;margin:0 auto;padding:2rem 1.5rem">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:.75rem">
        <div>
            <h1 style="font-size:1.35rem;font-weight:700;color:#1a1a1a;margin:0"><?php if (isset($category)) : ?><?= $gender ? genderLabel($gender) . "'s " : '' ?><?= e($category) ?><?php elseif (isset($gender) && $gender) : ?><?= genderLabel($gender) ?>'s Collection<?php else : ?>Shop All<?php endif ?></h1>
            <p style="color:#8a8a8a;font-size:.85rem;margin:.25rem 0 0"><?php if (isset($category)) : ?><?= $gender ? genderLabel($gender) . "'s " : '' ?><?= e($category) ?><?php elseif (isset($gender) && $gender) : ?>All <?= genderLabel($gender) ?>'s styles<?php else : ?>All Categories<?php endif ?></p>
        </div>
    </div>

    <div class="shop-layout shop-layout--mobile" style="display:grid;grid-template-columns:240px 1fr;gap:2rem">
        <aside>
            <div style="background:#fff;border-radius:20px;padding:1.5rem;border:1px solid #f0f0f0;box-shadow:0 4px 16px rgba(0,0,0,.04);position:sticky;top:5rem">

                <!-- Gender -->
                <div style="margin-bottom:1.25rem">
                    <h6 style="font-size:.65rem;font-weight:700;color:#999;letter-spacing:1.5px;text-transform:uppercase;margin:0 0 .75rem">Gender</h6>
                    <div style="display:flex;flex-wrap:wrap;gap:.45rem">
                        <?php $genders = ['' => 'All', 'L' => 'Men', 'W' => 'Women', 'U' => 'Unisex'] ?>
                        <?php $activeGender = $gender ?? '' ?>
                        <?php foreach ($genders as $code => $label) : ?>
                        <?php $isActive = $activeGender === $code ?>
                        <a href="<?= $code ? base_url("shop/" . strtolower($label)) : base_url('shop') ?>"
                           style="padding:.4rem .85rem;border-radius:100px;font-size:.78rem;font-weight:600;text-decoration:none;transition:.2s;background:<?= $isActive ? '#1a1a1a' : '#f2f2f2' ?>;color:<?= $isActive ? '#fff' : '#666' ?>"
                           onmouseover="this.style.background='<?= $isActive ? '#1a1a1a' : '#e0e0e0' ?>'"
                           onmouseout="this.style.background='<?= $isActive ? '#1a1a1a' : '#f2f2f2' ?>'"><?= $label ?></a>
                        <?php endforeach ?>
                    </div>
                </div>

                <div style="height:1px;background:#f0f0f0;margin:0 0 1.25rem"></div>

                <!-- Categories -->
                <h6 style="font-size:.65rem;font-weight:700;color:#999;letter-spacing:1.5px;text-transform:uppercase;margin:0 0 .75rem">Categories</h6>
                <div style="display:flex;flex-direction:column;gap:.15rem">
                    <?php $baseUrl = $gender ? base_url('shop/' . strtolower(genderLabel($gender))) : base_url('shop') ?>
                    <a href="<?= $baseUrl ?>"
                       style="display:flex;align-items:center;gap:.5rem;padding:.45rem .75rem;border-radius:8px;font-size:.82rem;font-weight:500;color:#1a1a1a;text-decoration:none;transition:.15s;background:<?= !isset($category) ? '#f5f5f5' : 'transparent' ?>;border-left:3px solid <?= !isset($category) ? '#1a1a1a' : 'transparent' ?>"
                       onmouseover="this.style.background='#f5f5f5'"
                       onmouseout="this.style.background='<?= !isset($category) ? '#f5f5f5' : 'transparent' ?>'">All Items</a>

                    <?php $cats = $gender ? getCategories($gender) : getCategories() ?>
                    <?php foreach ($cats as $cat) : ?>
                    <a href="<?= $gender ? base_url("shop/" . strtolower(genderLabel($gender)) . "/category/{$cat->slug}") : base_url("/shop/category/{$cat->slug}") ?>"
                       style="display:flex;align-items:center;gap:.5rem;padding:.45rem .75rem;border-radius:8px;font-size:.82rem;font-weight:500;color:#555;text-decoration:none;transition:.15s;background:<?= (isset($category) && $category == $cat->title) ? '#f5f5f5' : 'transparent' ?>;border-left:3px solid <?= (isset($category) && $category == $cat->title) ? '#1a1a1a' : 'transparent' ?>"
                       onmouseover="this.style.background='#f5f5f5'"
                       onmouseout="this.style.background='<?= (isset($category) && $category == $cat->title) ? '#f5f5f5' : 'transparent' ?>'"><?= e($cat->title) ?></a>
                    <?php endforeach ?>
                </div>
            </div>
        </aside>

        <main>
            <div class="mobile-categories" style="display:none;flex-direction:column;gap:0;margin-bottom:1.5rem;background:#fff;border-radius:20px;padding:1.25rem;border:1px solid #f0f0f0;box-shadow:0 4px 16px rgba(0,0,0,.04)">

                <div style="margin-bottom:1rem">
                    <h6 style="font-size:.65rem;font-weight:700;color:#999;letter-spacing:1.5px;text-transform:uppercase;margin:0 0 .75rem">Gender</h6>
                    <div style="display:flex;flex-wrap:wrap;gap:.45rem">
                        <?php $genders = ['' => 'All', 'L' => 'Men', 'W' => 'Women', 'U' => 'Unisex'] ?>
                        <?php $activeGender = $gender ?? '' ?>
                        <?php foreach ($genders as $code => $label) : ?>
                        <?php $isActive = $activeGender === $code ?>
                        <a href="<?= $code ? base_url("shop/" . strtolower($label)) : base_url('shop') ?>"
                           style="padding:.4rem .85rem;border-radius:100px;font-size:.78rem;font-weight:600;text-decoration:none;transition:.2s;background:<?= $isActive ? '#1a1a1a' : '#f2f2f2' ?>;color:<?= $isActive ? '#fff' : '#666' ?>"
                           onmouseover="this.style.background='<?= $isActive ? '#1a1a1a' : '#e0e0e0' ?>'"
                           onmouseout="this.style.background='<?= $isActive ? '#1a1a1a' : '#f2f2f2' ?>'"><?= $label ?></a>
                        <?php endforeach ?>
                    </div>
                </div>

                <div style="height:1px;background:#f0f0f0;margin:0 0 1rem"></div>

                <h6 style="font-size:.65rem;font-weight:700;color:#999;letter-spacing:1.5px;text-transform:uppercase;margin:0 0 .75rem">Categories</h6>
                <div style="display:flex;flex-direction:column;gap:.15rem">
                    <?php $baseUrl = $gender ? base_url('shop/' . strtolower(genderLabel($gender))) : base_url('shop') ?>
                    <a href="<?= $baseUrl ?>"
                       style="display:flex;align-items:center;gap:.5rem;padding:.45rem .75rem;border-radius:8px;font-size:.82rem;font-weight:500;color:#1a1a1a;text-decoration:none;transition:.15s;background:<?= !isset($category) ? '#f5f5f5' : 'transparent' ?>;border-left:3px solid <?= !isset($category) ? '#1a1a1a' : 'transparent' ?>"
                       onmouseover="this.style.background='#f5f5f5'"
                       onmouseout="this.style.background='<?= !isset($category) ? '#f5f5f5' : 'transparent' ?>'">All Items</a>

                    <?php $cats = $gender ? getCategories($gender) : getCategories() ?>
                    <?php foreach ($cats as $cat) : ?>
                    <a href="<?= $gender ? base_url("shop/" . strtolower(genderLabel($gender)) . "/category/{$cat->slug}") : base_url("/shop/category/{$cat->slug}") ?>"
                       style="display:flex;align-items:center;gap:.5rem;padding:.45rem .75rem;border-radius:8px;font-size:.82rem;font-weight:500;color:#555;text-decoration:none;transition:.15s;background:<?= (isset($category) && $category == $cat->title) ? '#f5f5f5' : 'transparent' ?>;border-left:3px solid <?= (isset($category) && $category == $cat->title) ? '#1a1a1a' : 'transparent' ?>"
                       onmouseover="this.style.background='#f5f5f5'"
                       onmouseout="this.style.background='<?= (isset($category) && $category == $cat->title) ? '#f5f5f5' : 'transparent' ?>'"><?= e($cat->title) ?></a>
                    <?php endforeach ?>
                </div>
            </div>
            <?php if (empty($content)) : ?>
                <div style="text-align:center;padding:4rem 1rem;background:#fff;border-radius:24px;border:1px solid #f0f0f0">
                    <p style="color:#8a8a8a;font-size:.95rem;margin:0">No products found in this category.</p>
                </div>
            <?php else : ?>
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1.25rem">
                    <?php foreach ($content as $row) : ?>
                    <a href="<?= base_url("shop/detail/{$row->product_slug}") ?>" style="background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 16px rgba(0,0,0,.04);transition:.35s;text-decoration:none;color:#1a1a1a;border:1px solid #f0f0f0"
                       onmouseover="this.style.boxShadow='0 12px 36px rgba(0,0,0,.08)';this.style.transform='translateY(-3px)'"
                       onmouseout="this.style.boxShadow='0 4px 16px rgba(0,0,0,.04)';this.style.transform='translateY(0)'">
                        <div style="aspect-ratio:1/1;overflow:hidden;background:#f5f5f5">
                            <img src="<?= $row->image ? base_url("images/product/{$row->image}") : base_url("images/product/default.jpg") ?>" alt="<?= e($row->product_title) ?>" style="width:100%;height:100%;object-fit:cover;transition:.5s"
                                 onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        <div style="padding:.85rem 1rem 1.15rem">
                            <div style="font-size:.875rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= e($row->product_title) ?></div>
                            <div style="color:#d4a853;font-weight:700;font-size:.9rem;margin-top:.2rem">Rp <?= formatRupiah($row->price) ?></div>
                        </div>
                    </a>
                    <?php endforeach ?>
                </div>

                <?php if (isset($pagination)) : ?>
                <div style="display:flex;justify-content:center;margin-top:3rem">
                    <div style="display:flex;gap:.35rem;flex-wrap:wrap"><?= $pagination ?></div>
                </div>
                <?php endif ?>
            <?php endif ?>
        </main>
    </div>
</div>

<style>
@media (max-width: 768px) {
    .shop-layout { grid-template-columns: 1fr !important; }
    .shop-layout aside { display: none !important; }
    .mobile-categories { display: flex !important; }
}
</style>