<div style="padding:4rem 2rem;max-width:600px;margin:0 auto;text-align:center">
    <div style="font-size:2.5rem;color:var(--gray-300);margin-bottom:1.5rem">
        <i class="fas fa-check-circle"></i>
    </div>

    <h1 style="font-size:1.35rem;font-weight:700;letter-spacing:-0.02em;margin-bottom:0.5rem">Order Placed</h1>
    <p style="color:var(--gray-500);font-size:0.9rem;margin-bottom:2rem">Thank you! Your order is being processed.</p>

    <div style="border:1px solid var(--gray-100);padding:1.5rem;margin-bottom:2rem;text-align:left">
        <div style="font-size:0.65rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--gray-400);margin-bottom:1rem">Order Details</div>

        <div class="flex justify-between mb-2">
            <span style="font-size:0.85rem;color:var(--gray-500)">Invoice</span>
            <span style="font-size:0.85rem;font-weight:600">#<?= e($content->invoice) ?></span>
        </div>
        <div class="flex justify-between">
            <span style="font-size:0.85rem;color:var(--gray-500)">Total Payment</span>
            <span style="font-size:0.85rem;font-weight:700">Rp <?= formatRupiah($content->total) ?></span>
        </div>
    </div>

    <div style="text-align:left;margin-bottom:2rem">
        <div style="font-size:0.65rem;font-weight:600;letter-spacing:0.12em;text-transform:uppercase;color:var(--gray-400);margin-bottom:0.75rem">Transfer to:</div>
        <div class="bank-list">
            <div class="bank-list__item">
                <img src="<?= base_url("assets/img/logo_bca.png") ?>" alt="BCA">
                <span><strong>BCA 5139742685</strong> a/n NOMADENSTUFF</span>
            </div>
            <div class="bank-list__item">
                <img src="<?= base_url("assets/img/logo_bri.png") ?>" alt="BRI">
                <span><strong>BRI 196214652186437</strong> a/n NOMADENSTUFF</span>
            </div>
            <div class="bank-list__item">
                <img src="<?= base_url("assets/img/logo_bni.png") ?>" alt="BNI">
                <span><strong>BNI 7982562143</strong> a/n NOMADENSTUFF</span>
            </div>
            <div class="bank-list__item">
                <img src="<?= base_url("assets/img/logo_bsi.png") ?>" alt="BSI">
                <span><strong>BSI 652146347895214</strong> a/n NOMADENSTUFF</span>
            </div>
            <div class="bank-list__item">
                <img src="<?= base_url("assets/img/logo_mandiri.png") ?>" alt="Mandiri">
                <span><strong>Mandiri 456321789532164</strong> a/n NOMADENSTUFF</span>
            </div>
        </div>
    </div>

    <p style="font-size:0.85rem;color:var(--gray-500);margin-bottom:1.5rem">After transferring, please confirm your payment.</p>

    <div class="flex flex-col gap-2" style="max-width:400px;margin:0 auto">
        <a href="<?= base_url("/myorder/detail/$content->invoice") ?>" class="btn btn--black w-full">
            Confirm Payment
        </a>
        <a href="<?= base_url('/') ?>" class="btn btn--outline w-full">Back to Home</a>
    </div>
</div>
