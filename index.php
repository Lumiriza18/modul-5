
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caesar Cipher | Text Encryption</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7ff, #edf1ff, #f8f9ff);
            color: #1e293b;
            display: flex;
            flex-direction: column;
        }

        header {
            padding: 25px 8%;
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .logo {
            width: 48px;
            height: 48px;
            border-radius: 15px;
            background: linear-gradient(135deg, #4361ee, #7957d5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            box-shadow: 0 6px 18px #5369e640;
        }

        header h1 {
            font-size: 21px;
            font-weight: 750;
        }

        header p {
            color: #64748b;
            font-size: 13px;
            margin-top: 4px;
        }

        main {
            width: 90%;
            max-width: 1000px;
            margin: 35px auto;
            flex: 1;
        }

        .intro {
            text-align: center;
            margin-bottom: 30px;
        }

        .intro .tag {
            display: inline-block;
            padding: 7px 13px;
            border-radius: 30px;
            background: #e4eaff;
            color: #4057c8;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .intro h2 {
            font-size: clamp(28px, 4vw, 40px);
            letter-spacing: -1px;
            margin-bottom: 12px;
        }

        .intro p {
            color: #64748b;
            line-height: 1.7;
            font-size: 15px;
        }

        .workspace {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
            align-items: stretch;
        }

        .card {
            background: rgba(255, 255, 255, 0.94);
            padding: 28px;
            border: 1px solid #e7eaf3;
            border-radius: 22px;
            box-shadow: 0 12px 35px #293c6710;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .icon-box {
            width: 42px;
            height: 42px;
            border-radius: 13px;
            background: #edf1ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .card-title h3 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .card-title p {
            color: #94a3b8;
            font-size: 12px;
        }

        label {
            display: block;
            font-weight: 650;
            font-size: 13px;
            margin-bottom: 9px;
        }

        textarea, input[type="number"] {
            width: 100%;
            border: 1px solid #dce2ee;
            border-radius: 12px;
            background: #fbfcff;
            padding: 14px;
            font: inherit;
            color: #1e293b;
            outline: none;
            transition: 0.2s;
        }

        textarea {
            min-height: 145px;
            resize: vertical;
            line-height: 1.6;
        }

        textarea:focus, input[type="number"]:focus {
            border-color: #6278ee;
            box-shadow: 0 0 0 4px #6278ee18;
        }

        .field {
            margin-bottom: 22px;
        }

        .hint {
            display: block;
            margin-top: 8px;
            color: #94a3b8;
            font-size: 12px;
        }

        .mode-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .mode-options input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .mode-options label {
            margin: 0;
            padding: 13px 8px;
            text-align: center;
            border: 1px solid #dce2ee;
            border-radius: 11px;
            color: #64748b;
            cursor: pointer;
            transition: 0.2s;
        }

        .mode-options input:checked + label {
            color: #4057d4;
            background: #edf1ff;
            border-color: #6278ee;
        }

        .primary-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(110deg, #4361ee, #7957d5);
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 7px 16px #5369e633;
            transition: 0.2s;
        }

        .primary-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px #5369e644;
        }

        .result-card {
            background: linear-gradient(145deg, #f0f4ff, #f8f7ff);
            border: 1px solid #e0e7ff;
        }

        .result-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .status {
            color: #3b67c4;
            background: #e0eaff;
            border-radius: 20px;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: 700;
        }

        .result-box {
            min-height: 200px;
            padding: 20px;
            border: 1px dashed #c7d2fe;
            background: #ffffffb8;
            border-radius: 14px;
            margin-bottom: 20px;
            overflow-wrap: anywhere;
        }

        .result-placeholder {
            color: #94a3b8;
            line-height: 1.7;
            font-size: 14px;
        }

        .result-text {
            color: #293e9c;
            font-family: Consolas, monospace;
            font-size: 19px;
            line-height: 1.7;
            white-space: pre-wrap;
        }

        .result-info {
            display: flex;
            gap: 10px;
            align-items: center;
            padding: 13px;
            border-radius: 11px;
            background: #ffffffb8;
            color: #64748b;
            font-size: 12px;
            margin-bottom: 18px;
        }

        .copy-btn {
            width: 100%;
            border: 1px solid #cbd5f5;
            color: #4057c8;
            background: white;
            padding: 13px;
            border-radius: 11px;
            font-weight: 650;
            cursor: pointer;
        }

        .copy-btn:hover {
            background: #edf1ff;
        }

        .feature-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-top: 24px;
        }

        .feature {
            padding: 17px;
            background: #ffffffa6;
            border: 1px solid #e7eaf3;
            border-radius: 15px;
        }

        .feature strong {
            display: block;
            font-size: 13px;
            margin: 9px 0 5px;
        }

        .feature p {
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.5;
        }

        footer {
            padding: 25px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
        }

        @media (max-width: 700px) {
            header {
                padding: 20px 5%;
            }

            main {
                margin: 20px auto;
                width: 92%;
            }

            .workspace {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 21px;
            }

            .feature-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="logo">🔐</div>
    <div>
        <h1>Caesar Cipher</h1>
        <p>Text Encryption Tool</p>
    </div>
</header>

<main>
    <section class="intro">
        <span class="tag">✦ KRIPTOGRAFI KLASIK</span>
        <h2>Amankan teks Anda.</h2>
        <p>
            Enkripsi dan dekripsi teks dengan metode Caesar Cipher.
            <br>
            Sederhana, cepat, dan mudah digunakan.
        </p>
    </section>

    <section class="workspace">

        <div class="card">
            <div class="card-title">
                <div class="icon-box">✍️</div>
                <div>
                    <h3>Input Teks</h3>
                    <p>Masukkan teks yang ingin diproses</p>
                </div>
            </div>

            <form action="cipher-proses.php" method="post"
                  id="cipherForm">

                <div class="field">
                    <label for="teks">Teks Anda</label>
                    <textarea
                        id="teks"
                        name="teks"
                        placeholder="Contoh: Hello World!"
                        required
                    ></textarea>
                    <span class="hint">
                        Huruf besar dan kecil akan tetap dibedakan.
                    </span>
                </div>

                <div class="field">
                    <label for="kunci">Kunci Pergeseran</label>
                    <input
                        type="number"
                        id="kunci"
                        name="kunci"
                        min="1"
                        max="25"
                        step="1"
                        placeholder="Masukkan angka 1-25"
                        required
                    >
                    <span class="hint">
                        Gunakan angka dari 1 sampai 25.
                    </span>
                </div>

                <div class="field">
                    <label>Pilih Operasi</label>
                    <div class="mode-options">
                        <div>
                            <input type="radio" id="enkripsi"
                                   name="aksi" value="enkripsi"
                                   checked>
                            <label for="enkripsi">🔒 Enkripsi</label>
                        </div>
                        <div>
                            <input type="radio" id="dekripsi"
                                   name="aksi" value="dekripsi">
                            <label for="dekripsi">🔓 Dekripsi</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="primary-btn">
                    ✨ Proses Teks
                </button>
            </form>
        </div>

        <div class="card result-card">
            <div class="card-title">
                <div class="icon-box">💎</div>
                <div>
                    <h3>Hasil Proses</h3>
                    <p>Hasil akan ditampilkan setelah diproses</p>
                </div>
            </div>

            <div class="result-label">
                <label style="margin:0">Output Teks</label>
                <span class="status">● SIAP</span>
            </div>

            <div class="result-box">
                <p class="result-placeholder">
                    Hasil enkripsi atau dekripsi akan muncul
                    setelah Anda menekan tombol
                    <b>Proses Teks</b>.
                    <br><br>
                    Contoh: Hello World! → Khoor Zruog!
                </p>
            </div>

            <div class="result-info">
                <span>🛡️</span>
                <span>
                    Caesar Cipher menggeser huruf berdasarkan
                    nilai kunci yang Anda masukkan.
                </span>
            </div>

            <button type="button" class="copy-btn"
                    onclick="alert('Proses teks terlebih dahulu untuk mendapatkan hasil.')">
                ▣ Salin Hasil
            </button>
        </div>

    </section>

    <section class="feature-row">
        <div class="feature">
            <span>🔐</span>
            <strong>Enkripsi Teks</strong>
            <p>Mengubah teks asli menjadi teks tersandi.</p>
        </div>

        <div class="feature">
            <span>🔓</span>
            <strong>Dekripsi Teks</strong>
            <p>Mengembalikan teks tersandi ke bentuk aslinya.</p>
        </div>

        <div class="feature">
            <span>🔠</span>
            <strong>Case-Sensitive</strong>
            <p>Huruf besar dan kecil tetap dipertahankan.</p>
        </div>
    </section>
</main>

<footer>
    Praktikum Keamanan Perangkat Lunak · Caesar Cipher
</footer>

</body>
</html>
