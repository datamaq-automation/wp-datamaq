<?php
/**
 * Template part for displaying the Contact section
 */

$data = get_datamaq_site_data()['contact']; 
?>
<section id="contacto" class="section-mobile tw:py-32 tw:bg-[#0c092f]">
    <div class="tw:container tw:mx-auto tw:px-4">
        <article class="tw:max-w-5xl tw:mx-auto tw:p-12 lg:tw:p-20 tw:bg-[#1a1c3d] tw:rounded-[3.5rem] tw:border tw:border-white/10 tw:shadow-2xl">
            <h2 class="tw:text-5xl tw:font-bold tw:text-white tw:mb-6"><?php echo esc_html($data['title']); ?></h2>
            <p class="tw:text-white/60 tw:mb-14 tw:text-xl lg:tw:text-2xl"><?php echo esc_html($data['subtitle']); ?></p>
            <form id="dm-contact-form" class="tw:grid tw:grid-cols-1 tw:gap-10">
                <?php wp_nonce_field( 'dm_contact_nonce', 'dm_contact_nonce_field' ); ?>
                <input type="hidden" name="action" value="submit_contact">
                
                <div class="tw:space-y-4">
                    <label class="tw:block tw:text-sm tw:font-black tw:text-white/30 tw:uppercase tw:tracking-[0.2em]">
                        Correo Electrónico
                    </label>
                    <input type="email" name="email" required 
                           class="tw:w-full tw:bg-black/40 tw:border-2 tw:border-white/5 tw:rounded-2xl tw:px-8 tw:py-6 tw:text-white tw:text-xl focus:tw:border-[#ff9a4d] tw:outline-none tw:transition-all"
                           placeholder="tu@email.com">
                </div>

                <div class="tw:space-y-4">
                    <label class="tw:block tw:text-sm tw:font-black tw:text-white/30 tw:uppercase tw:tracking-[0.2em]">
                        Consulta Técnica
                    </label>
                    <textarea name="message" required rows="6" 
                              class="tw:w-full tw:bg-black/40 tw:border-2 tw:border-white/5 tw:rounded-2xl tw:px-8 tw:py-6 tw:text-white tw:text-xl focus:tw:border-[#ff9a4d] tw:outline-none tw:transition-all" 
                              placeholder="Detalle el desafío..."></textarea>
                </div>

                <button type="submit" id="dm-submit-btn" class="tw:btn-primary tw:w-full tw:py-7 tw:text-2xl tw:font-black tw:shadow-xl hover:tw:shadow-[#ff9a4d]/20 transition-all">
                    <span id="dm-btn-text" class="tw:text-[#0c092f]">
                        <?php echo esc_html($data['submitLabel']); ?>
                    </span>
                </button>
                <p id="dm-form-feedback" class="tw:mt-8 tw:text-center tw:text-2xl tw:font-bold tw:hidden"></p>
            </form>
        </article>
    </div>
    <script>
    (function() {
        const form = document.getElementById('dm-contact-form');
        if (form) {
            form.onsubmit = async function(e) {
                e.preventDefault();
                const btn = document.getElementById('dm-submit-btn');
                const fb = document.getElementById('dm-form-feedback');
                
                btn.disabled = true; 
                fb.style.display = 'block'; 
                fb.textContent = 'Procesando...'; 
                fb.style.color = '#fff';
                
                try {
                    const res = await fetch('https://datamaq.com.ar/wp-admin/admin-ajax.php', {
                        method: 'POST',
                        body: new FormData(form)
                    });
                    const d = await res.json();
                    fb.textContent = d.data.message;
                    fb.style.color = d.success ? '#ff9a4d' : '#ef4444';
                    if (d.success) form.reset();
                } catch (err) { 
                    fb.textContent = 'Error de conexión.'; 
                    fb.style.color = '#ef4444'; 
                } finally { 
                    btn.disabled = false; 
                }
            };
        }
    })();
    </script>
</section>
