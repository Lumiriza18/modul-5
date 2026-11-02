
<?php
function caesarCipher($teks, $kunci, $modus) {
    $hasil = '';

    for ($i = 0; $i < strlen($teks); $i++) {
        $char = $teks[$i];

        if ($char >= 'A' && $char <= 'Z') {
            $awal = ord('A');
            $index = ord($char) - $awal;

            if ($modus === 'enkripsi') {
                $index = ($index + $kunci) % 26;
            } else {
                $index = ($index - $kunci + 26) % 26;
            }

            $hasil .= chr($awal + $index);
        } elseif ($char >= 'a' && $char <= 'z') {
            $awal = ord('a');
            $index = ord($char) - $awal;

            if ($modus === 'enkripsi') {
                $index = ($index + $kunci) % 26;
            } else {
                $index = ($index - $kunci + 26) % 26;
            }

            $hasil .= chr($awal + $index);
        } else {
            $hasil .= $char;
        }
    }

    return $hasil;
}

// Validasi request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Akses tidak valid. Silakan gunakan form.');
}

$teks = $_POST['teks'] ?? '';
$kunci = $_POST['kunci'] ?? '';
$aksi = $_POST['aksi'] ?? '';

if (trim($teks) === '') {
    exit('Error: Teks tidak boleh kosong.');
}

if ($kunci === '' || !ctype_digit((string)$kunci)) {
    exit('Error: Kunci harus berupa angka 1-25.');
}

$kunci = (int)$kunci;

if ($kunci < 1 || $kunci > 25) {
    exit('Error: Kunci harus antara 1 dan 25.');
}

if (!in_array($aksi, ['enkripsi', 'dekripsi'], true)) {
    exit('Error: Aksi tidak valid.');
}

$hasil = caesarCipher($teks, $kunci, $aksi);

$teksAman = htmlspecialchars($teks, ENT_QUOTES, 'UTF-8');
$hasilAman = htmlspecialchars($hasil, ENT_QUOTES, 'UTF-8');
$aksiLabel = $aksi === 'enkripsi' ? 'Enkripsi' : 'Dekripsi';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Caesar Cipher</title>

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
            font-size: 23px;
            box-shadow: 0 6px 18px #5369e640;
        }

        header h1 {
            font-size: 21px;
        }

        header p {
            color: #64748b;
            font-size: 13px;
            margin-top: 4px;
        }

        main {
            width: 90%;
            max-width: 850px;
            margin: 35px auto;
            flex: 1;
        }

        .intro {
            text-align: center;
            margin-bottom: 30px;
        }

        .tag {
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
            font-size: clamp(28px, 4vw, 38px);
            letter-spacing: -1px;
            margin-bottom: 10px;
        }

        .intro p {
            color: #64748b;
            line-height: 1.7;
        }

        .card {
            padding: 30px;
            background: #fff;
            border: 1px solid #e7eaf3;
            border-radius: 22px;
            box-shadow: 0 12px 35px #293c6710;
        }

        .card-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 25px;
        }

        .card-heading h3 {
            font-size: 19px;
            margin-bottom: 5px;
        }

        .card-heading p {
            color: #94a3b8;
            font-size: 13px;
        }

        .status {
            white-space: nowrap;
            padding: 7px 11px;
            border-radius: 20px;
            background: #e1f8ed;
            color: #168052;
            font-size: 11px;
            font-weight: 700;
        }

        .label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .text-box {
            background: #f9faff;
            border: 1px solid #e2e8f5;
            border-radius: 13px;
            padding: 17px;
            margin-bottom: 22px;
            overflow-wrap: anywhere;
            white-space: pre-wrap;
            line-height: 1.7;
        }

        .original {
            color: #475569;
        }

        .result-box {
            background: linear-gradient(135deg, #f0f4ff, #f8f7ff);
            border: 1px solid #dce4ff;
            border-radius: 15px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .result {
            color: #344ac0;
            font-family: Consolas, monospace;
            font-size: 23px;
            line-height: 1.7;
            overflow-wrap: anywhere;
            white-space: pre-wrap;
        }

        .info {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 15px;
            border-radius: 12px;
            background: #f8faff;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
            margin-bottom: 24px;
        }

        .buttons {
            display: flex;
            gap: 12px;
        }

        .btn {
            flex: 1;
            text-align: center;
            text-decoration: none;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-primary {
            color: white;
            border: none;
            background: linear-gradient(110deg, #4361ee, #7957d5);
            box-shadow: 0 6px 16px #5369e633;
        }

        .btn-secondary {
            color: #4057c8;
            border: 1px solid #d7def6;
            background: white;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        footer {
            padding: 25px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            header {
                padding: 20px 5%;
            }

            main {
                width: 92%;
                margin: 20px auto;
            }

            .card {
                padding: 21px;
            }

            .buttons {
                flex-direction: column;
            }

            .card-heading {
                align-items: flex-start;
            }

            .result {
                font-size: 19px;
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
        <span class="tag">✦ HASIL PEMROSESAN</span>
        <h2>Teks berhasil diproses!</h2>
        <p>Berikut hasil <?= strtolower($aksiLabel) ?> teks Anda.</p>
    </section>

    <section class="card">
        <div class="card-heading">
            <div>
                <h3>Ringkasan Hasil</h3>
                <p>Caesar Cipher · Kunci pergeseran <?= $kunci ?></p>
            </div>

            <span class="status">✓ Berhasil</span>
        </div>

        <label class="label">Teks Asli</label>
        <div class="text-box original"><?= $teksAman ?></div>

        <div class="result-box">
            <label class="label">Hasil <?= $aksiLabel ?></label>
            <div class="result" id="hasilTeks"><?= $hasilAman ?></div>
        </div>

        <div class="info">
            <span>🛡️</span>
            <span>
                Huruf besar dan kecil tetap dipertahankan.
                Spasi, angka, dan tanda baca tidak berubah.
            </span>
        </div>

        <div class="buttons">
            <button type="button" class="btn btn-primary"
                    onclick="salinHasil()">
                ▣ Salin Hasil
            </button>

            <a href="index.php" class="btn btn-secondary">
                ← Kembali ke Form
            </a>
        </div>
    </section>
</main>

<footer>
    Praktikum Keamanan Perangkat Lunak · Caesar Cipher
</footer>

<script>
    function salinHasil() {
        const teks = document.getElementById('hasilTeks').innerText;
        const tombol = document.querySelector('.btn-primary');

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(teks)
                .then(() => {
                    tombol.textContent = '✓ Berhasil Disalin!';
                    setTimeout(() => {
                        tombol.textContent = '▣ Salin Hasil';
                    }, 1800);
                })
                .catch(() => salinAlternatif(teks, tombol));
        } else {
            salinAlternatif(teks, tombol);
        }
    }

    function salinAlternatif(teks, tombol) {
        const area = document.createElement('textarea');
        area.value = teks;
        area.style.position = 'fixed';
        area.style.opacity = '0';
        document.body.appendChild(area);
        area.select();

        try {
            const berhasil = document.execCommand('copy');
            tombol.textContent = berhasil
                ? '✓ Berhasil Disalin!'
                : 'Salin manual: Ctrl+C';
        } catch (error) {
            tombol.textContent = 'Salin manual: Ctrl+C';
        }

        document.body.removeChild(area);

        setTimeout(() => {
            tombol.textContent = '▣ Salin Hasil';
        }, 1800);
    }
</script>

</body>
</html>
