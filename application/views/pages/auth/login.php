<div style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:2rem 1rem">
    <div style="width:100%;max-width:420px">
        <div style="text-align:center;margin-bottom:2rem">
            <a href="<?= base_url() ?>" style="font-size:1.5rem;font-weight:800;color:#1a1a1a;text-decoration:none;letter-spacing:-.5px">NOMADENSTUFF</a>
            <p style="color:#8a8a8a;font-size:.9rem;margin-top:.35rem">Sign in to continue shopping</p>
        </div>

        <div style="background:#fff;border-radius:24px;padding:2.25rem;box-shadow:0 8px 30px rgba(0,0,0,.06);border:1px solid #f0f0f0">
            <?php if ($this->session->flashdata('error')) : ?>
                <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:12px;padding:.75rem 1rem;margin-bottom:1.25rem;font-size:.85rem;color:#991b1b"><?= e($this->session->flashdata('error')) ?></div>
            <?php endif ?>

            <form action="login" method="POST">
                <div style="margin-bottom:1.25rem">
                    <label for="email" style="font-size:.85rem;font-weight:600;color:#1a1a1a;margin-bottom:.4rem;display:block">Email</label>
                    <input type="email" name="email" id="email" value="" placeholder="your@email.com" required
                        style="width:100%;padding:.7rem 1rem;border:1.5px solid #e0e0e0;border-radius:100px;font-size:.9rem;outline:none;transition:.3s;background:#fafafa;box-sizing:border-box"
                        onfocus="this.style.borderColor='#1a1a1a';this.style.background='#fff'"
                        onblur="this.style.borderColor='#e0e0e0';this.style.background='#fafafa'">
                    <?= isset($validation) ? display_error($validation, 'email') : '' ?>
                </div>

                <div style="margin-bottom:1.25rem">
                    <label for="password" style="font-size:.85rem;font-weight:600;color:#1a1a1a;margin-bottom:.4rem;display:block">Password</label>
                    <div style="display:flex;border:1.5px solid #e0e0e0;border-radius:100px;overflow:hidden;background:#fafafa;transition:.3s"
                         id="passwordWrap" onfocusin="this.style.borderColor='#1a1a1a';this.style.background='#fff'"
                         onfocusout="this.style.borderColor='#e0e0e0';this.style.background='#fafafa'">
                        <input type="password" name="password" id="password" placeholder="Min. 6 characters" required
                            style="flex:1;border:none;background:transparent;padding:.7rem 1rem;font-size:.9rem;outline:none;box-sizing:border-box">
                        <span onclick="togglePassword()" style="display:flex;align-items:center;padding:0 1rem;cursor:pointer;color:#8a8a8a;font-size:.9rem;user-select:none">
                            <i class="fa fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                    <?= isset($validation) ? display_error($validation, 'password') : '' ?>
                </div>

                <button type="submit" style="width:100%;padding:.75rem;border:none;border-radius:100px;background:#1a1a1a;color:#fff;font-weight:700;font-size:.9rem;cursor:pointer;transition:.3s;margin-top:.5rem"
                    onmouseover="this.style.background='#333'" onmouseout="this.style.background='#1a1a1a'">
                    Sign In
                </button>
            </form>

            <div style="text-align:center;margin-top:1.25rem;font-size:.85rem;color:#8a8a8a">
                Don't have an account? <a href="<?= base_url('register') ?>" style="color:#1a1a1a;font-weight:600;text-decoration:none;border-bottom:1.5px solid transparent;transition:.3s" onmouseover="this.style.borderColor='#1a1a1a'" onmouseout="this.style.borderColor='transparent'">Register</a>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const pw = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.className = 'fa fa-eye-slash';
    } else {
        pw.type = 'password';
        icon.className = 'fa fa-eye';
    }
}
</script>