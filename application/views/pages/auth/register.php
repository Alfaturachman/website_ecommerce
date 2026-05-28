<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:2rem 1rem;background:var(--white)">
    <div style="width:100%;max-width:480px">
        <div style="text-align:center;margin-bottom:2.5rem">
            <a href="<?= base_url() ?>" style="font-size:1.25rem;font-weight:800;color:var(--charcoal);text-decoration:none;letter-spacing:-0.04em">NOMADENSTUFF</a>
            <p style="color:var(--gray-400);font-size:0.85rem;margin-top:0.5rem">Create your account and start thrifting</p>
        </div>

        <div style="border:1px solid var(--gray-100);padding:2rem">
            <?php if ($this->session->flashdata('error')) : ?>
                <div style="background:var(--gray-bg);border:1px solid var(--gray-100);padding:0.75rem 1rem;margin-bottom:1.25rem;font-size:0.82rem;color:var(--gray-600)"><?= e($this->session->flashdata('error')) ?></div>
            <?php endif ?>

            <form action="register" method="POST">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
                    <div class="form-group" style="margin:0">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-input" placeholder="Your name" required>
                        <small class="form-error"><?= form_error('name') ?></small>
                    </div>
                    <div class="form-group" style="margin:0">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-input" placeholder="your@email.com" required>
                        <small class="form-error"><?= form_error('email') ?></small>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-input" placeholder="08xxxxxxxxxx" required>
                    <small class="form-error"><?= form_error('phone') ?></small>
                </div>

                <div class="form-group">
                    <label class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-textarea" placeholder="Your shipping address" required style="min-height:70px"><?= set_value('address') ?></textarea>
                    <small class="form-error"><?= form_error('address') ?></small>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem">
                    <div class="form-group" style="margin:0">
                        <label class="form-label">Password</label>
                        <div style="display:flex;border:1px solid var(--gray-100);transition:var(--transition-fast)" class="password-wrap">
                            <input type="password" name="password" id="password" class="form-input" placeholder="Min. 6 chars" required style="border:none;flex:1">
                            <span onclick="togglePw('password','eye1')" style="display:flex;align-items:center;padding:0 0.75rem;cursor:pointer;color:var(--gray-400);user-select:none">
                                <i class="fa fa-eye" id="eye1"></i>
                            </span>
                        </div>
                        <small class="form-error"><?= form_error('password') ?></small>
                    </div>
                    <div class="form-group" style="margin:0">
                        <label class="form-label">Confirm Password</label>
                        <div style="display:flex;border:1px solid var(--gray-100);transition:var(--transition-fast)" class="password-wrap">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Repeat" required style="border:none;flex:1">
                            <span onclick="togglePw('password_confirmation','eye2')" style="display:flex;align-items:center;padding:0 0.75rem;cursor:pointer;color:var(--gray-400);user-select:none">
                                <i class="fa fa-eye" id="eye2"></i>
                            </span>
                        </div>
                        <small class="form-error"><?= form_error('password_confirmation') ?></small>
                    </div>
                </div>

                <button type="submit" class="btn btn--black w-full" style="height:48px;font-size:0.78rem;margin-top:1rem">
                    Create Account
                    <i class="fas fa-arrow-right" style="font-size:0.6rem"></i>
                </button>
            </form>

            <div style="text-align:center;margin-top:1.5rem;font-size:0.82rem;color:var(--gray-400)">
                Already have an account?
                <a href="<?= base_url('login') ?>" style="color:var(--charcoal);font-weight:600;text-decoration:none;border-bottom:1px solid var(--gray-300);transition:var(--transition-fast)">Sign In</a>
            </div>
        </div>
    </div>
</div>

<script>
function togglePw(inputId, iconId) {
    var pw = document.getElementById(inputId);
    var icon = document.getElementById(iconId);
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
