<style type="text/css">
    /* From Uiverse.io by Galahhad */ 
.switch {
  /* switch */
  --switch-width: 46px;
  --switch-height: 24px;
  --switch-bg: rgb(131, 131, 131);
  --switch-checked-bg: rgb(0, 218, 80);
  --switch-offset: calc((var(--switch-height) - var(--circle-diameter)) / 2);
  --switch-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
  /* circle */
  --circle-diameter: 18px;
  --circle-bg: #fff;
  --circle-shadow: 1px 1px 2px rgba(146, 146, 146, 0.45);
  --circle-checked-shadow: -1px 1px 2px rgba(163, 163, 163, 0.45);
  --circle-transition: var(--switch-transition);
  /* icon */
  --icon-transition: all .2s cubic-bezier(0.27, 0.2, 0.25, 1.51);
  --icon-cross-color: var(--switch-bg);
  --icon-cross-size: 6px;
  --icon-checkmark-color: var(--switch-checked-bg);
  --icon-checkmark-size: 10px;
  /* effect line */
  --effect-width: calc(var(--circle-diameter) / 2);
  --effect-height: calc(var(--effect-width) / 2 - 1px);
  --effect-bg: var(--circle-bg);
  --effect-border-radius: 1px;
  --effect-transition: all .2s ease-in-out;
}

.switch input {
  display: none;
}

.switch {
  display: inline-block;
}

.switch svg {
  -webkit-transition: var(--icon-transition);
  -o-transition: var(--icon-transition);
  transition: var(--icon-transition);
  position: absolute;
  height: auto;
}

.switch .checkmark {
  width: var(--icon-checkmark-size);
  color: var(--icon-checkmark-color);
  -webkit-transform: scale(0);
  -ms-transform: scale(0);
  transform: scale(0);
}

.switch .cross {
  width: var(--icon-cross-size);
  color: var(--icon-cross-color);
}

.slider {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  width: var(--switch-width);
  height: var(--switch-height);
  background: var(--switch-bg);
  border-radius: 999px;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  position: relative;
  -webkit-transition: var(--switch-transition);
  -o-transition: var(--switch-transition);
  transition: var(--switch-transition);
  cursor: pointer;
}

.circle {
  width: var(--circle-diameter);
  height: var(--circle-diameter);
  background: var(--circle-bg);
  border-radius: inherit;
  -webkit-box-shadow: var(--circle-shadow);
  box-shadow: var(--circle-shadow);
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-transition: var(--circle-transition);
  -o-transition: var(--circle-transition);
  transition: var(--circle-transition);
  z-index: 1;
  position: absolute;
  left: var(--switch-offset);
}

.slider::before {
  content: "";
  position: absolute;
  width: var(--effect-width);
  height: var(--effect-height);
  left: calc(var(--switch-offset) + (var(--effect-width) / 2));
  background: var(--effect-bg);
  border-radius: var(--effect-border-radius);
  -webkit-transition: var(--effect-transition);
  -o-transition: var(--effect-transition);
  transition: var(--effect-transition);
}

/* actions */

.switch input:checked+.slider {
  background: var(--switch-checked-bg);
}

.switch input:checked+.slider .checkmark {
  -webkit-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
}

.switch input:checked+.slider .cross {
  -webkit-transform: scale(0);
  -ms-transform: scale(0);
  transform: scale(0);
}

.switch input:checked+.slider::before {
  left: calc(100% - var(--effect-width) - (var(--effect-width) / 2) - var(--switch-offset));
}

.switch input:checked+.slider .circle {
  left: calc(100% - var(--circle-diameter) - var(--switch-offset));
  -webkit-box-shadow: var(--circle-checked-shadow);
  box-shadow: var(--circle-checked-shadow);
}
</style>
<form id="form-edit-kategori" method="POST" enctype="multipart/form-data">
    <div style="width: 100%; height: 150px; overflow: hidden; border-radius: 8px;">
        <img src="<?= base_url('uploads/thumbnail_kategori/'.$kategori->thumbnail_kategori) ?>" 
             class="img-fluid w-100 h-100" 
             style="object-fit: cover;">
    </div>
    <div class="row">
        <div class="col-lg-6 d-flex justify-between align-items-center mt-1">
            <img src="<?= base_url('uploads/ikon_kategori/'.$kategori->ikon_kategori) ?>" 
                 style="border-radius: 20px; height: 40px; width: 40px; margin-right: 10px;">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div>
                    <span class="fs-2"><?= $kategori->id_kategori ?></span>
                    <h5><?= $kategori->nama_kategori ?></h5>
                </div>
            </div>
        </div>
        <div class="col-lg-6 justify-content-end">
            <div class="d-flex align-items-center">
                <p>Unggulan</p>
                <!-- From Uiverse.io by Galahhad -->
                <label class="switch">
                    <input type="checkbox" id="toggleUnggulan" <?= ($kategori->unggulan === 'true') ? 'checked' : ''; ?>>
                    <div class="slider">
                        <div class="circle">
                            <svg class="cross" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 365.696 365.696" height="6" width="6" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g>
                                    <path data-original="#000000" fill="currentColor" d="M243.188 182.86 356.32 69.726c12.5-12.5 12.5-32.766 0-45.247L341.238 9.398c-12.504-12.503-32.77-12.503-45.25 0L182.86 122.528 69.727 9.374c-12.5-12.5-32.766-12.5-45.247 0L9.375 24.457c-12.5 12.504-12.5 32.77 0 45.25l113.152 113.152L9.398 295.99c-12.503 12.503-12.503 32.769 0 45.25L24.48 356.32c12.5 12.5 32.766 12.5 45.247 0l113.132-113.132L295.99 356.32c12.503 12.5 32.769 12.5 45.25 0l15.081-15.082c12.5-12.504 12.5-32.77 0-45.25zm0 0"></path>
                                </g>
                            </svg>
                            <svg class="checkmark" xml:space="preserve" style="enable-background:new 0 0 512 512" viewBox="0 0 24 24" height="10" width="10" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g>
                                    <path class="" data-original="#000000" fill="currentColor" d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z"></path>
                                </g>
                            </svg>
                        </div>
                    </div>
                </label>
                <!-- Input Hidden untuk Menyimpan Status Checkbox -->
                <input type="hidden" name="unggulan" id="unggulan_hidden" value="<?= ($kategori->unggulan === 'true') ? 'true' : 'false'; ?>">
            </div>

            <!-- Input File -->
            <div id="background_unggulan" style="display: none;">
                <label for="background_unggulan_input">Background Unggulan</label>
                <input type="file" id="background_unggulan_input" name="background_unggulan" class="form-control" accept="image/*">
            </div>
        </div>
    </div>
    <input type="hidden" name="id_kategori" value="<?= $kategori->id_kategori ?>">
    <label for="nama_kategori">Nama Kategori:</label>
    <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required value="<?= $kategori->nama_kategori ?>">
    <div class="row">
        <div class="col-lg-6">
            <label for="thumbnail_kategori">Thumbnail:</label>
            <input type="file" name="thumbnail_kategori" id="thumbnail_kategori" class="form-control" accept="image/*">
        </div>
        <div class="col-lg-6">
            <label for="ikon_kategori">Ikon:</label>
            <input type="file" name="ikon_kategori" id="ikon_kategori" class="form-control" accept="image/*">
        </div>
    </div>
    <div class="d-flex justify-content-end mt-3">
        <div class="btn btn-outline-danger btn-delete-kategori mx-3" data-id="<?= $kategori->id_kategori ?>">Hapus</div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
<script>
    function updateUnggulanState() {
        var checkbox = document.getElementById('toggleUnggulan');
        var bgUnggulan = document.getElementById('background_unggulan');
        var inputFile = document.getElementById('background_unggulan_input');
        var unggulanHidden = document.getElementById('unggulan_hidden');

        if (checkbox.checked) {
            bgUnggulan.style.display = 'block';
            inputFile.setAttribute('required', 'required');
            unggulanHidden.value = 'true';
        } else {
            bgUnggulan.style.display = 'none';
            inputFile.removeAttribute('required');
            unggulanHidden.value = 'false';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateUnggulanState();
    });


    // Jalankan saat toggle berubah
    document.getElementById('toggleUnggulan').addEventListener('change', updateUnggulanState);
</script>
<script>
    document.getElementById('form-edit-kategori').addEventListener('submit', function (e) {
        const maxSize = 2 * 1024 * 1024; // 2MB
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        const fileInputs = [
            document.getElementById('thumbnail_kategori'),
            document.getElementById('ikon_kategori'),
            document.getElementById('background_unggulan_input')
        ];

        for (let input of fileInputs) {
            const file = input?.files[0];
            if (file) {
                if (!validTypes.includes(file.type)) {
                    alert(`File pada "${input.name}" harus berupa gambar (jpg, png, gif, webp)!`);
                    e.preventDefault();
                    return;
                }

                if (file.size > maxSize) {
                    alert(`Ukuran file pada "${input.name}" maksimal 2 MB!`);
                    e.preventDefault();
                    return;
                }
            }
        }
    });
</script>

