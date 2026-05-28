<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:2rem 1rem;background:var(--white)">
    <div style="width:100%;max-width:400px">
        <div style="text-align:center;margin-bottom:2.5rem">
            <a href="<?= base_url() ?>" style="font-size:1.25rem;font-weight:800;color:var(--charcoal);text-decoration:none;letter-spacing:-0.04em">NOMADENSTUFF</a>
            <p style="color:var(--gray-400);font-size:0.85rem;margin-top:0.5rem">Sign in to continue</p>
        </div>

        <div style="border:1px solid var(--gray-100);padding:2rem">
            <?php if ($this->session->flashdata('error')) : ?>
                <div style="background:var(--gray-bg);border:1px solid var(--gray-100);padding:0.75rem 1rem;margin-bottom:1.25rem;font-size:0.82rem;color:var(--gray-600)"><?= e($this->session->flashdata('error')) ?></div>
            <?php endif ?>

            <form action="login" method="POST">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-input" value="" placeholder="your@email.com" required>
                    <?= isset($validation) ? display_error($validation, 'email') : '' ?>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div style="display:flex;border:1px solid var(--gray-100);transition:var(--transition-fast)" class="password-wrap">
                        <input type="password" name="password" id="password" class="form-input" placeholder="Min. 6 characters" required style="border:none;flex:1">
                        <span onclick="togglePassword()" style="display:flex;align-items:center;padding:0 1rem;cursor:pointer;color:var(--gray-400);font-size:0.85rem;user-select:none">
                            <i class="fa fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                    <?= isset($validation) ? display_error($validation, 'password') : '' ?>
                </div>

                <button type="submit" class="btn btn--black w-full" style="height:48px;font-size:0.78rem;margin-top:0.5rem">
                    Sign In
                    <i class="fas fa-arrow-right" style="font-size:0.6rem"></i>
                </button>
            </form>

            <div style="text-align:center;margin-top:1.5rem;font-size:0.82rem;color:var(--gray-400)">
                Don't have an account?
                <a href="<?= base_url('register') ?>" style="color:var(--charcoal);font-weight:600;text-decoration:none;border-bottom:1px solid var(--gray-300);transition:var(--transition-fast)">Register</a>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    var pw = document.getElementById('password');
    var icon = document.getElementById('eyeIcon');
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.className = 'fa fa-eye-slash';
    } else {
        pw.type = 'password';
        icon.className = 'fa fa-eye';
    }
}

document.querySelectorAll('.password-wrap').forEach(function(wrap) {
    var input = wrap.querySelector('input');
    input.addEventListener('focus', function() { wrap.style.borderColor = 'var(--gray-600)'; });
    input.addEventListener('blur', function() { wrap.style.borderColor = 'var(--gray-100)'; });
});
</script>
